<?php
    use Filament\Tables\Actions\Position as ActionsPosition;
    use Filament\Tables\Actions\RecordCheckboxPosition;
    use Filament\Tables\Filters\Layout as FiltersLayout;

    $actions = $getActions();
    $actionsAlignment = $getActionsAlignment();
    $actionsPosition = $getActionsPosition();
    $actionsColumnLabel = $getActionsColumnLabel();
    $columns = $getVisibleColumns();
    $collapsibleColumnsLayout = $getCollapsibleColumnsLayout();
    $content = $getContent();
    $contentGrid = $getContentGrid();
    $contentFooter = $getContentFooter();
    $filterIndicators = [
        ...($hasSearch() ? ['resetTableSearch' => $getSearchIndicator()] : []),
        ...collect($getColumnSearchIndicators())
            ->mapWithKeys(fn (string $indicator, string $column): array => [
                "resetTableColumnSearch('{$column}')" => $indicator,
            ])
            ->all(),
        ...array_reduce(
            $getFilters(),
            fn (array $carry, \Filament\Tables\Filters\BaseFilter $filter): array => [
                ...$carry,
                ...collect($filter->getIndicators())
                    ->mapWithKeys(fn (string $label, int | string $field) => [
                        "removeTableFilter('{$filter->getName()}'" . (is_string($field) ? ' , \'' . $field . '\'' : null) . ')' => $label,
                    ])
                    ->all(),
            ],
            [],
        ),
    ];
    $hasColumnsLayout = $hasColumnsLayout();
    $hasSummary = $hasSummary();
    $header = $getHeader();
    $headerActions = array_filter(
        $getHeaderActions(),
        fn (\Filament\Tables\Actions\Action | \Filament\Tables\Actions\BulkAction | \Filament\Tables\Actions\ActionGroup $action): bool => $action->isVisible(),
    );
    $headerActionsPosition = $getHeaderActionsPosition();
    $heading = $getHeading();
    $group = $getGrouping();
    $bulkActions = array_filter(
        $getBulkActions(),
        fn (\Filament\Tables\Actions\BulkAction | \Filament\Tables\Actions\ActionGroup $action): bool => $action->isVisible(),
    );
    $groups = $getGroups();
    $description = $getDescription();
    $isGroupsOnly = $isGroupsOnly() && $group;
    $isReorderable = $isReorderable();
    $isReordering = $isReordering();
    $isColumnSearchVisible = $isSearchableByColumn();
    $isGlobalSearchVisible = $isSearchable();
    $isSelectionEnabled = $isSelectionEnabled();
    $recordCheckboxPosition = $getRecordCheckboxPosition();
    $isStriped = $isStriped();
    $isLoaded = $isLoaded();
    $hasFilters = $isFilterable();
    $filtersLayout = $getFiltersLayout();
    $hasFiltersDropdown = $hasFilters && ($filtersLayout === FiltersLayout::Dropdown);
    $hasFiltersAboveContent = $hasFilters && in_array($filtersLayout, [FiltersLayout::AboveContent, FiltersLayout::AboveContentCollapsible]);
    $hasFiltersAboveContentCollapsible = $hasFilters && ($filtersLayout === FiltersLayout::AboveContentCollapsible);
    $hasFiltersBelowContent = $hasFilters && ($filtersLayout === FiltersLayout::BelowContent);
    $isColumnToggleFormVisible = $hasToggleableColumns();
    $pluralModelLabel = $getPluralModelLabel();
    $records = $isLoaded ? $getRecords() : null;
    $allSelectableRecordsCount = $isLoaded ? $getAllSelectableRecordsCount() : null;
    $columnsCount = count($columns);

    if (count($actions) && (! $isReordering)) {
        $columnsCount++;
    }

    if ($isSelectionEnabled || $isReordering) {
        $columnsCount++;
    }

    if ($group) {
        $groupedSummarySelectedState = $this->getTableSummarySelectedState($this->getAllTableSummaryQuery(), modifyQueryUsing: fn (\Illuminate\Database\Query\Builder $query) => $group->groupQuery($query, model: $getQuery()->getModel()));
    }

    $getHiddenClasses = function (Filament\Tables\Columns\Column $column): ?string {
        if ($breakpoint = $column->getHiddenFrom()) {
            return match ($breakpoint) {
                'sm' => 'sm:hidden',
                'md' => 'md:hidden',
                'lg' => 'lg:hidden',
                'xl' => 'xl:hidden',
                '2xl' => '2xl:hidden',
            };
        }

        if ($breakpoint = $column->getVisibleFrom()) {
            return match ($breakpoint) {
                'sm' => 'hidden sm:table-cell',
                'md' => 'hidden md:table-cell',
                'lg' => 'hidden lg:table-cell',
                'xl' => 'hidden xl:table-cell',
                '2xl' => 'hidden 2xl:table-cell',
            };
        }

        return null;
    };
?>

<div
    x-data="{
        collapsedGroups: [],

        hasHeader: true,

        isLoading: false,

        selectedRecords: [],

        shouldCheckUniqueSelection: true,

        init: function () {
            $wire.on('deselectAllTableRecords', () => this.deselectAllRecords())

            $watch('selectedRecords', () => {
                if (! this.shouldCheckUniqueSelection) {
                    this.shouldCheckUniqueSelection = true

                    return
                }

                this.selectedRecords = [...new Set(this.selectedRecords)]

                this.shouldCheckUniqueSelection = false
            })
        },

        mountBulkAction: function (name) {
            $wire.mountTableBulkAction(name, this.selectedRecords)
        },

        toggleSelectRecordsOnPage: function () {
            let keys = this.getRecordsOnPage()

            if (this.areRecordsSelected(keys)) {
                this.deselectRecords(keys)

                return
            }

            this.selectRecords(keys)
        },

        getRecordsOnPage: function () {
            let keys = []

            for (checkbox of $el.getElementsByClassName(
                'filament-tables-record-checkbox',
            )) {
                keys.push(checkbox.value)
            }

            return keys
        },

        selectRecords: function (keys) {
            for (key of keys) {
                if (this.isRecordSelected(key)) {
                    continue
                }

                this.selectedRecords.push(key)
            }
        },

        deselectRecords: function (keys) {
            for (key of keys) {
                let index = this.selectedRecords.indexOf(key)

                if (index === -1) {
                    continue
                }

                this.selectedRecords.splice(index, 1)
            }
        },

        selectAllRecords: async function () {
            this.isLoading = true

            this.selectedRecords = await $wire.getAllSelectableTableRecordKeys()

            this.isLoading = false
        },

        deselectAllRecords: function () {
            this.selectedRecords = []
        },

        isRecordSelected: function (key) {
            return this.selectedRecords.includes(key)
        },

        areRecordsSelected: function (keys) {
            return keys.every((key) => this.isRecordSelected(key))
        },

        toggleCollapseGroup: function (group) {
            if (this.isGroupCollapsed(group)) {
                this.collapsedGroups.splice(this.collapsedGroups.indexOf(group), 1)

                return
            }

            this.collapsedGroups.push(group)
        },

        isGroupCollapsed: function (group) {
            return this.collapsedGroups.includes(group)
        },

        resetCollapsedGroups: function () {
            this.collapsedGroups = []
        },
    }"
    class="filament-tables-component"
    <?php if(! $isLoaded): ?>
        wire:init="loadTable"
    <?php endif; ?>
>
    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.container','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::container'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <div
            class="filament-tables-header-container"
            x-show="hasHeader = <?php echo \Illuminate\Support\Js::from($renderHeader = ($header || $heading || $description || ($headerActions && (! $isReordering)) || $isReorderable || count($groups) || $isGlobalSearchVisible || $hasFilters || $isColumnToggleFormVisible))->toHtml() ?> || (selectedRecords.length && <?php echo \Illuminate\Support\Js::from(count($bulkActions))->toHtml() ?>)"
            <?php if(! $renderHeader): ?> x-cloak <?php endif; ?>
        >
            <?php if($header): ?>
                <?php echo e($header); ?>

            <?php elseif($heading || $description || $headerActions): ?>
                <div
                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                        'filament-tables-header-hr-wrapper px-2 pt-2',
                        'hidden' => ! ($heading || $description) && $isReordering,
                    ]); ?>"
                >
                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.header','data' => ['actions' => $isReordering ? [] : $headerActions,'actionsPosition' => $headerActionsPosition,'class' => 'mb-2','heading' => $heading,'description' => $description]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isReordering ? [] : $headerActions),'actions-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($headerActionsPosition),'class' => 'mb-2','heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($heading),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($description)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.hr','data' => ['xShow' => \Illuminate\Support\Js::from($isReorderable || count($groups) || $isGlobalSearchVisible || $hasFilters || $isColumnToggleFormVisible) . ' || (selectedRecords.length && ' . \Illuminate\Support\Js::from(count($bulkActions)) . ')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::hr'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Js::from($isReorderable || count($groups) || $isGlobalSearchVisible || $hasFilters || $isColumnToggleFormVisible) . ' || (selectedRecords.length && ' . \Illuminate\Support\Js::from(count($bulkActions)) . ')')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if($hasFiltersAboveContent): ?>
                <div
                    class="px-2"
                    x-data="{ areFiltersOpen: <?php echo \Illuminate\Support\Js::from(! $hasFiltersAboveContentCollapsible)->toHtml() ?> }"
                >
                    <div class="py-2">
                        <?php if($hasFiltersAboveContentCollapsible): ?>
                            <div
                                x-on:click="areFiltersOpen = ! areFiltersOpen"
                                class="flex w-full justify-end"
                            >
                                <?php echo e($getFiltersTriggerAction()->indicator(count(\Illuminate\Support\Arr::flatten($filterIndicators)))); ?>

                            </div>
                        <?php endif; ?>

                        <div class="p-4" x-show="areFiltersOpen">
                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.filters.index','data' => ['form' => $getFiltersForm()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::filters'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['form' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getFiltersForm())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                        </div>
                    </div>

                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.hr','data' => ['xShow' => \Illuminate\Support\Js::from($isReorderable || count($groups) || $isGlobalSearchVisible || $isColumnToggleFormVisible) . ' || (selectedRecords.length && ' . \Illuminate\Support\Js::from(count($bulkActions)) . ')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::hr'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-show' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Js::from($isReorderable || count($groups) || $isGlobalSearchVisible || $isColumnToggleFormVisible) . ' || (selectedRecords.length && ' . \Illuminate\Support\Js::from(count($bulkActions)) . ')')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                </div>
            <?php endif; ?>

            <div
                x-show="<?php echo \Illuminate\Support\Js::from($shouldRenderHeaderDiv = ($isReorderable || count($groups) || $isGlobalSearchVisible || $hasFiltersDropdown || $isColumnToggleFormVisible))->toHtml() ?> || (selectedRecords.length && <?php echo \Illuminate\Support\Js::from(count($bulkActions))->toHtml() ?>)"
                <?php if(! $shouldRenderHeaderDiv): ?> x-cloak <?php endif; ?>
                class="filament-tables-header-toolbar flex h-14 items-center justify-between px-3 py-2"
                x-bind:class="{
                    'gap-3': <?php echo \Illuminate\Support\Js::from($isReorderable)->toHtml() ?> || <?php echo \Illuminate\Support\Js::from(count($groups))->toHtml() ?> || (selectedRecords.length && <?php echo \Illuminate\Support\Js::from(count($bulkActions))->toHtml() ?>),
                }"
            >
                <div class="flex shrink-0 items-center sm:gap-3">
                    <?php if($isReorderable): ?>
                        <?php echo e($getReorderRecordsTriggerAction($isReordering)); ?>

                    <?php endif; ?>

                    <?php if(count($groups)): ?>
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.groups','data' => ['dropdownOnDesktop' => $areGroupsInDropdownOnDesktop(),'groups' => $groups,'triggerAction' => $getGroupRecordsTriggerAction()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::groups'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['dropdown-on-desktop' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($areGroupsInDropdownOnDesktop()),'groups' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groups),'trigger-action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getGroupRecordsTriggerAction())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                    <?php endif; ?>

                    <?php if((! $isReordering) && count($bulkActions)): ?>
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.actions.index','data' => ['actions' => $bulkActions,'xShow' => 'selectedRecords.length','xCloak' => 'x-cloak']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bulkActions),'x-show' => 'selectedRecords.length','x-cloak' => 'x-cloak']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                    <?php endif; ?>
                </div>

                <?php if($isGlobalSearchVisible || $hasFiltersDropdown || $isColumnToggleFormVisible): ?>
                    <div
                        class="flex flex-1 items-center justify-end gap-3 md:max-w-md"
                    >
                        <?php if($isGlobalSearchVisible): ?>
                            <div
                                class="filament-tables-search-container flex flex-1 items-center justify-end"
                            >
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.search-input','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if($hasFiltersDropdown || $isColumnToggleFormVisible): ?>
                            <div class="flex items-center gap-x-1">
                                <?php if($hasFiltersDropdown): ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.filters.dropdown','data' => ['form' => $getFiltersForm(),'indicatorsCount' => count(\Illuminate\Support\Arr::flatten($filterIndicators)),'maxHeight' => $getFiltersFormMaxHeight(),'triggerAction' => $getFiltersTriggerAction(),'width' => $getFiltersFormWidth(),'class' => 'shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::filters.dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['form' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getFiltersForm()),'indicators-count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(count(\Illuminate\Support\Arr::flatten($filterIndicators))),'max-height' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getFiltersFormMaxHeight()),'trigger-action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getFiltersTriggerAction()),'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getFiltersFormWidth()),'class' => 'shrink-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                <?php endif; ?>

                                <?php if($isColumnToggleFormVisible): ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.toggleable.dropdown','data' => ['form' => $getColumnToggleForm(),'maxHeight' => $getColumnToggleFormMaxHeight(),'triggerAction' => $getToggleColumnsTriggerAction(),'width' => $getColumnToggleFormWidth(),'class' => 'shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::toggleable.dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['form' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getColumnToggleForm()),'max-height' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getColumnToggleFormMaxHeight()),'trigger-action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getToggleColumnsTriggerAction()),'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getColumnToggleFormWidth()),'class' => 'shrink-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if($isReordering): ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.reorder.indicator','data' => ['colspan' => $columnsCount,'class' => 'border-t dark:border-gray-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::reorder.indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['colspan' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($columnsCount),'class' => 'border-t dark:border-gray-700']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        <?php elseif($isSelectionEnabled && $isLoaded): ?>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.selection-indicator','data' => ['allSelectableRecordsCount' => $allSelectableRecordsCount,'colspan' => $columnsCount,'xShow' => 'selectedRecords.length','class' => 'border-t dark:border-gray-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::selection-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['all-selectable-records-count' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($allSelectableRecordsCount),'colspan' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($columnsCount),'x-show' => 'selectedRecords.length','class' => 'border-t dark:border-gray-700']); ?>
                 <?php $__env->slot('selectedRecordsCount', null, []); ?> 
                    <span x-text="selectedRecords.length"></span>
                 <?php $__env->endSlot(); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        <?php endif; ?>

        <div>
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.filters.indicators','data' => ['indicators' => $filterIndicators,'class' => 'border-t dark:border-gray-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::filters.indicators'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['indicators' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filterIndicators),'class' => 'border-t dark:border-gray-700']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        </div>

        <div
            <?php if($pollingInterval = $getPollingInterval()): ?>
                wire:poll.<?php echo e($pollingInterval); ?>

            <?php endif; ?>
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'filament-tables-table-container overflow-x-auto dark:border-gray-700',
                'overflow-x-auto' => $content || $hasColumnsLayout,
                'rounded-t-xl' => ! $renderHeader,
                'border-t' => $renderHeader,
            ]); ?>"
            x-bind:class="{
                'rounded-t-xl': ! hasHeader,
                'border-t': hasHeader,
            }"
        >
            <?php if(($content || $hasColumnsLayout) && ($records !== null) && count($records)): ?>
                <?php if(! $isReordering): ?>
                    <?php
                        $sortableColumns = array_filter(
                            $columns,
                            fn (\Filament\Tables\Columns\Column $column): bool => $column->isSortable(),
                        );
                    ?>

                    <div
                        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            'flex items-center gap-4 border-b bg-gray-500/5 px-4 dark:border-gray-700',
                            'hidden' => (! $isSelectionEnabled) && (! count($sortableColumns)),
                        ]); ?>"
                    >
                        <?php if($isSelectionEnabled): ?>
                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.checkbox.index','data' => ['label' => __('filament-tables::table.fields.bulk_select_page.label'),'xOn:click' => 'toggleSelectRecordsOnPage','xBind:checked' => '
                                    let recordsOnPage = getRecordsOnPage()

                                    if (recordsOnPage.length && areRecordsSelected(recordsOnPage)) {
                                        $el.checked = true

                                        return \'checked\'
                                    }

                                    $el.checked = false

                                    return null
                                ','class' => \Illuminate\Support\Arr::toCssClasses(['hidden' => $isReordering])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-tables::table.fields.bulk_select_page.label')),'x-on:click' => 'toggleSelectRecordsOnPage','x-bind:checked' => '
                                    let recordsOnPage = getRecordsOnPage()

                                    if (recordsOnPage.length && areRecordsSelected(recordsOnPage)) {
                                        $el.checked = true

                                        return \'checked\'
                                    }

                                    $el.checked = false

                                    return null
                                ','class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses(['hidden' => $isReordering]))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                        <?php endif; ?>

                        <?php if(count($sortableColumns)): ?>
                            <div
                                x-data="{
                                    column: $wire.entangle('tableSortColumn'),
                                    direction: $wire.entangle('tableSortDirection'),
                                }"
                                x-init="
                                    $watch('column', function (newColumn, oldColumn) {
                                        if (! newColumn) {
                                            direction = null

                                            return
                                        }

                                        if (oldColumn) {
                                            return
                                        }

                                        direction = 'asc'
                                    })
                                "
                                class="flex flex-wrap items-center gap-1 py-1 text-xs sm:text-sm"
                            >
                                <label>
                                    <span class="me-1 font-medium">
                                        <?php echo e(__('filament-tables::table.sorting.fields.column.label')); ?>

                                    </span>

                                    <select
                                        x-model="column"
                                        style="
                                            background-position: right 0.2rem
                                                center;
                                        "
                                        class="rounded-lg border-0 border-gray-300 bg-gray-500/5 py-1 pe-6 ps-2 text-xs font-medium focus:border-primary-500 focus:ring-0 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 sm:text-sm"
                                    >
                                        <option value="">-</option>

                                        <?php $__currentLoopData = $sortableColumns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option
                                                value="<?php echo e($column->getName()); ?>"
                                            >
                                                <?php echo e($column->getLabel()); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </label>

                                <label x-show="column" x-cloak>
                                    <span class="sr-only">
                                        <?php echo e(__('filament-tables::table.sorting.fields.direction.label')); ?>

                                    </span>

                                    <select
                                        x-model="direction"
                                        style="
                                            background-position: right 0.2rem
                                                center;
                                        "
                                        class="rounded-lg border-0 border-gray-300 bg-gray-500/5 py-1 pe-6 ps-2 text-xs font-medium focus:border-primary-500 focus:ring-0 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-primary-500 sm:text-sm"
                                    >
                                        <option value="asc">
                                            <?php echo e(__('filament-tables::table.sorting.fields.direction.options.asc')); ?>

                                        </option>

                                        <option value="desc">
                                            <?php echo e(__('filament-tables::table.sorting.fields.direction.options.desc')); ?>

                                        </option>
                                    </select>
                                </label>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if($content): ?>
                    <?php echo e($content->with(['records' => $records])); ?>

                <?php else: ?>
                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.grid.index','data' => ['xSortable' => true,'xOn:end.stop' => '$wire.reorderTable($event.target.sortable.toArray())','default' => $contentGrid['default'] ?? 1,'sm' => $contentGrid['sm'] ?? null,'md' => $contentGrid['md'] ?? null,'lg' => $contentGrid['lg'] ?? null,'xl' => $contentGrid['xl'] ?? null,'twoXl' => $contentGrid['2xl'] ?? null,'class' => \Illuminate\Support\Arr::toCssClasses([
                            'dark:divide-gray-700',
                            'divide-y' => ! $contentGrid,
                            'p-2 gap-2' => $contentGrid,
                        ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::grid'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-sortable' => true,'x-on:end.stop' => '$wire.reorderTable($event.target.sortable.toArray())','default' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contentGrid['default'] ?? 1),'sm' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contentGrid['sm'] ?? null),'md' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contentGrid['md'] ?? null),'lg' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contentGrid['lg'] ?? null),'xl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contentGrid['xl'] ?? null),'two-xl' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contentGrid['2xl'] ?? null),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                            'dark:divide-gray-700',
                            'divide-y' => ! $contentGrid,
                            'p-2 gap-2' => $contentGrid,
                        ]))]); ?>
                        <?php
                            $previousRecord = null;
                            $previousRecordGroupKey = null;
                            $previousRecordGroupTitle = null;
                        ?>

                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $recordAction = $getRecordAction($record);
                                $recordKey = $getRecordKey($record);
                                $recordUrl = $getRecordUrl($record);
                                $recordGroupKey = $group?->getKey($record);
                                $recordGroupTitle = $group?->getTitle($record);

                                $collapsibleColumnsLayout?->record($record);
                                $hasCollapsibleColumnsLayout = (bool) $collapsibleColumnsLayout?->isVisible();
                            ?>

                            <?php if($recordGroupTitle !== $previousRecordGroupTitle): ?>
                                <?php if($hasSummary && (! $isReordering) && filled($previousRecordGroupTitle)): ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.table','data' => ['class' => 'col-span-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-full']); ?>
                                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.summary.row','data' => ['columns' => $columns,'heading' => __('filament-tables::table.summary.subheadings.group', ['group' => $previousRecordGroupTitle, 'label' => $pluralModelLabel]),'query' => $group->scopeQuery($this->getAllTableSummaryQuery(), $previousRecord),'selectedState' => $groupedSummarySelectedState[$previousRecordGroupKey] ?? [],'extraHeadingColumn' => true,'placeholderColumns' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::summary.row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($columns),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-tables::table.summary.subheadings.group', ['group' => $previousRecordGroupTitle, 'label' => $pluralModelLabel])),'query' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->scopeQuery($this->getAllTableSummaryQuery(), $previousRecord)),'selected-state' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groupedSummarySelectedState[$previousRecordGroupKey] ?? []),'extra-heading-column' => true,'placeholder-columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                <?php endif; ?>

                                <div
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'col-span-full bg-gray-500/5',
                                        'rounded-xl shadow-sm' => $contentGrid,
                                    ]); ?>"
                                >
                                    <?php
                                        $tag = $group->isCollapsible() ? 'button' : 'div';
                                    ?>

                                    <<?php echo e($tag); ?>

                                        <?php if($group->isCollapsible()): ?>
                                            type="button"
                                            x-on:click="toggleCollapseGroup(<?php echo \Illuminate\Support\Js::from($recordGroupTitle)->toHtml() ?>)"
                                        <?php endif; ?>
                                        class="flex w-full justify-start gap-x-2 whitespace-nowrap px-4 py-2"
                                    >
                                        <?php if($group->isCollapsible()): ?>
                                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => 'heroicon-m-chevron-up','alias' => 'tables::grouping.collapse','size' => 'h-5 w-5','color' => 'text-gray-600 dark:text-gray-300','class' => 'transition','xBind:class' => 'isGroupCollapsed('.e(\Illuminate\Support\Js::from($recordGroupTitle)).') && \'rotate-180\'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'heroicon-m-chevron-up','alias' => 'tables::grouping.collapse','size' => 'h-5 w-5','color' => 'text-gray-600 dark:text-gray-300','class' => 'transition','x-bind:class' => 'isGroupCollapsed('.e(\Illuminate\Support\Js::from($recordGroupTitle)).') && \'rotate-180\'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                        <?php endif; ?>

                                        <div
                                            class="flex flex-col items-start gap-y-1"
                                        >
                                            <span
                                                class="text-sm font-medium text-gray-600 dark:text-gray-300"
                                            >
                                                <?php if($group->isTitlePrefixedWithLabel()): ?>
                                                        <?php echo e($group->getLabel()); ?>:
                                                <?php endif; ?>

                                                <?php echo e($recordGroupTitle); ?>

                                            </span>

                                            <?php if(filled($recordGroupDescription = $group->getDescription($record, $recordGroupTitle))): ?>
                                                <span
                                                    class="text-sm text-gray-500 dark:text-gray-400"
                                                >
                                                    <?php echo e($recordGroupDescription); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </<?php echo e($tag); ?>>
                                </div>
                            <?php endif; ?>

                            <div
                                <?php if($hasCollapsibleColumnsLayout): ?>
                                    x-data="{ isCollapsed: <?php echo \Illuminate\Support\Js::from($collapsibleColumnsLayout->isCollapsed())->toHtml() ?> }"
                                    x-init="$dispatch('collapsible-table-row-initialized')"
                                    x-on:expand-all-table-rows.window="isCollapsed = false"
                                    x-on:collapse-all-table-rows.window="isCollapsed = true"
                                <?php endif; ?>
                                wire:key="<?php echo e($this->id); ?>.table.records.<?php echo e($recordKey); ?>"
                                <?php if($isReordering): ?>
                                    x-sortable-item="<?php echo e($recordKey); ?>"
                                    x-sortable-handle
                                <?php endif; ?>
                                x-bind:class="{
                                    'hidden':
                                        <?php echo e($group?->isCollapsible() ? 'true' : 'false'); ?> &&
                                        isGroupCollapsed('<?php echo e($recordGroupTitle); ?>'),
                                }"
                            >
                                <div
                                    x-bind:class="{
                                        'bg-gray-50 dark:bg-gray-500/10': isRecordSelected('<?php echo e($recordKey); ?>'),
                                    }"
                                    class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'relative h-full px-4 transition',
                                        'hover:bg-gray-50 dark:hover:bg-gray-500/10' => $recordUrl || $recordAction,
                                        'dark:border-gray-600' => ! $contentGrid,
                                        'group' => $isReordering,
                                        'rounded-xl border border-gray-200 shadow-sm dark:border-gray-700 dark:bg-gray-700/40' => $contentGrid,
                                        ...$getRecordClasses($record),
                                    ]); ?>"
                                >
                                    <div
                                        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                            'items-center gap-4 md:me-0 md:flex' => (! $contentGrid),
                                            'me-6' => $isSelectionEnabled || $hasCollapsibleColumnsLayout || $isReordering,
                                        ]); ?>"
                                    >
                                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.reorder.handle','data' => ['class' => \Illuminate\Support\Arr::toCssClasses([
                                                'absolute top-3 end-3',
                                                'md:relative md:top-0 end-0' => ! $contentGrid,
                                                'hidden' => ! $isReordering,
                                            ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::reorder.handle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                                                'absolute top-3 end-3',
                                                'md:relative md:top-0 end-0' => ! $contentGrid,
                                                'hidden' => ! $isReordering,
                                            ]))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

                                        <?php if($isSelectionEnabled && $isRecordSelectable($record)): ?>
                                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.checkbox.index','data' => ['label' => __('filament-tables::table.fields.bulk_select_record.label', ['key' => $recordKey]),'xModel' => 'selectedRecords','value' => $recordKey,'class' => \Illuminate\Support\Arr::toCssClasses([
                                                    'filament-tables-record-checkbox absolute top-3 end-3',
                                                    'md:relative md:top-0 md:end-0' => ! $contentGrid,
                                                    'hidden' => $isReordering,
                                                ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-tables::table.fields.bulk_select_record.label', ['key' => $recordKey])),'x-model' => 'selectedRecords','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recordKey),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                                                    'filament-tables-record-checkbox absolute top-3 end-3',
                                                    'md:relative md:top-0 md:end-0' => ! $contentGrid,
                                                    'hidden' => $isReordering,
                                                ]))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                        <?php endif; ?>

                                        <?php if($hasCollapsibleColumnsLayout): ?>
                                            <div
                                                class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                                    'absolute end-1',
                                                    'top-10' => $isSelectionEnabled,
                                                    'top-1' => ! $isSelectionEnabled,
                                                    'md:relative md:end-0 md:top-0' => ! $contentGrid,
                                                    'hidden' => $isReordering,
                                                ]); ?>"
                                            >
                                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon-button','data' => ['icon' => 'heroicon-m-chevron-down','iconAlias' => 'tables::collapsible-column.trigger','color' => 'gray','size' => 'sm','xOn:click' => 'isCollapsed = ! isCollapsed','xBind:class' => 'isCollapsed || \'-rotate-180\'','class' => 'transition']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'heroicon-m-chevron-down','icon-alias' => 'tables::collapsible-column.trigger','color' => 'gray','size' => 'sm','x-on:click' => 'isCollapsed = ! isCollapsed','x-bind:class' => 'isCollapsed || \'-rotate-180\'','class' => 'transition']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($recordUrl): ?>
                                            <a
                                                href="<?php echo e($recordUrl); ?>"
                                                class="filament-tables-record-url-link block flex-1 py-3"
                                            >
                                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.columns.layout','data' => ['components' => $getColumnsLayout(),'record' => $record,'recordKey' => $recordKey,'rowLoop' => $loop]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::columns.layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['components' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getColumnsLayout()),'record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record),'record-key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recordKey),'row-loop' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($loop)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                            </a>
                                        <?php elseif($recordAction): ?>
                                            <?php
                                                if ($getAction($recordAction)) {
                                                    $recordWireClickAction = "mountTableAction('{$recordAction}', '{$recordKey}')";
                                                } else {
                                                    $recordWireClickAction = "{$recordAction}('{$recordKey}')";
                                                }
                                            ?>

                                            <button
                                                wire:click="<?php echo e($recordWireClickAction); ?>"
                                                wire:target="<?php echo e($recordWireClickAction); ?>"
                                                wire:loading.attr="disabled"
                                                type="button"
                                                class="filament-tables-record-action-button block flex-1 py-3 disabled:pointer-events-none disabled:opacity-70"
                                            >
                                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.columns.layout','data' => ['components' => $getColumnsLayout(),'record' => $record,'recordKey' => $recordKey,'rowLoop' => $loop]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::columns.layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['components' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getColumnsLayout()),'record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record),'record-key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recordKey),'row-loop' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($loop)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                            </button>
                                        <?php else: ?>
                                            <div class="flex-1 py-3">
                                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.columns.layout','data' => ['components' => $getColumnsLayout(),'record' => $record,'recordKey' => $recordKey,'rowLoop' => $loop]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::columns.layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['components' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getColumnsLayout()),'record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record),'record-key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recordKey),'row-loop' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($loop)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if(count($actions)): ?>
                                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.actions.index','data' => ['actions' => $actions,'alignment' => $actionsPosition === ActionsPosition::AfterContent ? 'start' : 'start md:end','record' => $record,'wrap' => '-md','class' => \Illuminate\Support\Arr::toCssClasses([
                                                    'absolute bottom-1 end-1' => $actionsPosition === ActionsPosition::BottomCorner,
                                                    'md:relative md:bottom-0 md:end-0' => $actionsPosition === ActionsPosition::BottomCorner && (! $contentGrid),
                                                    'mb-3' => $actionsPosition === ActionsPosition::AfterContent,
                                                    'md:mb-0' => $actionsPosition === ActionsPosition::AfterContent && (! $contentGrid),
                                                    'hidden' => $isReordering,
                                                ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions),'alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionsPosition === ActionsPosition::AfterContent ? 'start' : 'start md:end'),'record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record),'wrap' => '-md','class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                                                    'absolute bottom-1 end-1' => $actionsPosition === ActionsPosition::BottomCorner,
                                                    'md:relative md:bottom-0 md:end-0' => $actionsPosition === ActionsPosition::BottomCorner && (! $contentGrid),
                                                    'mb-3' => $actionsPosition === ActionsPosition::AfterContent,
                                                    'md:mb-0' => $actionsPosition === ActionsPosition::AfterContent && (! $contentGrid),
                                                    'hidden' => $isReordering,
                                                ]))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                        <?php endif; ?>
                                    </div>

                                    <?php if($hasCollapsibleColumnsLayout): ?>
                                        <div
                                            x-show="! isCollapsed"
                                            x-collapse
                                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                                '-mx-2 pb-2',
                                                'md:ps-20' => (! $contentGrid) && $isSelectionEnabled,
                                                'md:ps-12' => (! $contentGrid) && (! $isSelectionEnabled),
                                                'hidden' => $isReordering,
                                            ]); ?>"
                                        >
                                            <?php echo e($collapsibleColumnsLayout->viewData(['recordKey' => $recordKey])); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php
                                $previousRecordGroupKey = $recordGroupKey;
                                $previousRecordGroupTitle = $recordGroupTitle;
                                $previousRecord = $record;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($hasSummary && (! $isReordering) && filled($previousRecordGroupTitle) && ((! $records instanceof \Illuminate\Contracts\Pagination\Paginator) || (! $records->hasMorePages()))): ?>
                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.table','data' => ['class' => 'col-span-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'col-span-full']); ?>
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.summary.row','data' => ['columns' => $columns,'heading' => __('filament-tables::table.summary.subheadings.group', ['group' => $previousRecordGroupTitle, 'label' => $pluralModelLabel]),'query' => $group->scopeQuery($this->getAllTableSummaryQuery(), $previousRecord),'selectedState' => $groupedSummarySelectedState[$previousRecordGroupKey] ?? [],'extraHeadingColumn' => true,'placeholderColumns' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::summary.row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($columns),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-tables::table.summary.subheadings.group', ['group' => $previousRecordGroupTitle, 'label' => $pluralModelLabel])),'query' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->scopeQuery($this->getAllTableSummaryQuery(), $previousRecord)),'selected-state' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groupedSummarySelectedState[$previousRecordGroupKey] ?? []),'extra-heading-column' => true,'placeholder-columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                        <?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                <?php endif; ?>

                <?php if(($content || $hasColumnsLayout) && $contentFooter): ?>
                    <?php echo e($contentFooter->with(['columns' => $columns, 'records' => $records])); ?>

                <?php endif; ?>

                <?php if($hasSummary && (! $isReordering)): ?>
                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.table','data' => ['class' => 'border-t dark:border-gray-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'border-t dark:border-gray-700']); ?>
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.summary.index','data' => ['columns' => $columns,'pluralModelLabel' => $pluralModelLabel,'records' => $records,'extraHeadingColumn' => true,'placeholderColumns' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::summary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($columns),'plural-model-label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pluralModelLabel),'records' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($records),'extra-heading-column' => true,'placeholder-columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                <?php endif; ?>
            <?php elseif(($records !== null) && count($records)): ?>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.table','data' => ['reorderable' => $isReorderable]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['reorderable' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isReorderable)]); ?>
                     <?php $__env->slot('header', null, []); ?> 
                        <?php if($isReordering): ?>
                            <th></th>
                        <?php else: ?>
                            <?php if(count($actions) && $actionsPosition === ActionsPosition::BeforeCells): ?>
                                <?php if($actionsColumnLabel): ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.header-cell','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::header-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                        <?php echo e($actionsColumnLabel); ?>

                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                <?php else: ?>
                                    <th class="w-5"></th>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if($isSelectionEnabled && $recordCheckboxPosition === RecordCheckboxPosition::BeforeCells): ?>
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.checkbox.cell','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::checkbox.cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.checkbox.index','data' => ['label' => __('filament-tables::table.fields.bulk_select_page.label'),'xOn:click' => 'toggleSelectRecordsOnPage','xBind:checked' => '
                                            let recordsOnPage = getRecordsOnPage()

                                            if (recordsOnPage.length && areRecordsSelected(recordsOnPage)) {
                                                $el.checked = true

                                                return \'checked\'
                                            }

                                            $el.checked = false

                                            return null
                                        ']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-tables::table.fields.bulk_select_page.label')),'x-on:click' => 'toggleSelectRecordsOnPage','x-bind:checked' => '
                                            let recordsOnPage = getRecordsOnPage()

                                            if (recordsOnPage.length && areRecordsSelected(recordsOnPage)) {
                                                $el.checked = true

                                                return \'checked\'
                                            }

                                            $el.checked = false

                                            return null
                                        ']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                            <?php endif; ?>

                            <?php if(count($actions) && $actionsPosition === ActionsPosition::BeforeColumns): ?>
                                <?php if($actionsColumnLabel): ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.header-cell','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::header-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                        <?php echo e($actionsColumnLabel); ?>

                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                <?php else: ?>
                                    <th class="w-5"></th>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if($isGroupsOnly): ?>
                            <th
                                class="filament-tables-header-cell whitespace-nowrap px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300"
                            >
                                <?php echo e($group->getLabel()); ?>

                            </th>
                        <?php endif; ?>

                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.header-cell','data' => ['activelySorted' => $getSortColumn() === $column->getName(),'name' => $column->getName(),'alignment' => $column->getAlignment(),'sortable' => $column->isSortable() && (! $isReordering),'sortDirection' => $getSortDirection(),'class' => 'filament-table-header-cell-'.e(str($column->getName())->camel()->kebab()).' '.e($getHiddenClasses($column)).'','attributes' => \Filament\Support\prepare_inherited_attributes($column->getExtraHeaderAttributeBag()),'wrap' => $column->isHeaderWrapped()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::header-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actively-sorted' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getSortColumn() === $column->getName()),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($column->getName()),'alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($column->getAlignment()),'sortable' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($column->isSortable() && (! $isReordering)),'sort-direction' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getSortDirection()),'class' => 'filament-table-header-cell-'.e(str($column->getName())->camel()->kebab()).' '.e($getHiddenClasses($column)).'','attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($column->getExtraHeaderAttributeBag())),'wrap' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($column->isHeaderWrapped())]); ?>
                                <?php echo e($column->getLabel()); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if(! $isReordering): ?>
                            <?php if(count($actions) && $actionsPosition === ActionsPosition::AfterColumns): ?>
                                <?php if($actionsColumnLabel): ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.header-cell','data' => ['alignment' => 'right']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::header-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alignment' => 'right']); ?>
                                        <?php echo e($actionsColumnLabel); ?>

                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                <?php else: ?>
                                    <th class="w-5"></th>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if($isSelectionEnabled && $recordCheckboxPosition === RecordCheckboxPosition::AfterCells): ?>
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.checkbox.cell','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::checkbox.cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.checkbox.index','data' => ['label' => __('filament-tables::table.fields.bulk_select_page.label'),'xOn:click' => 'toggleSelectRecordsOnPage','xBind:checked' => '
                                            let recordsOnPage = getRecordsOnPage()

                                            if (recordsOnPage.length && areRecordsSelected(recordsOnPage)) {
                                                $el.checked = true

                                                return \'checked\'
                                            }

                                            $el.checked = false

                                            return null
                                        ']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-tables::table.fields.bulk_select_page.label')),'x-on:click' => 'toggleSelectRecordsOnPage','x-bind:checked' => '
                                            let recordsOnPage = getRecordsOnPage()

                                            if (recordsOnPage.length && areRecordsSelected(recordsOnPage)) {
                                                $el.checked = true

                                                return \'checked\'
                                            }

                                            $el.checked = false

                                            return null
                                        ']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                            <?php endif; ?>

                            <?php if(count($actions) && $actionsPosition === ActionsPosition::AfterCells): ?>
                                <?php if($actionsColumnLabel): ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.header-cell','data' => ['alignment' => 'right']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::header-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alignment' => 'right']); ?>
                                        <?php echo e($actionsColumnLabel); ?>

                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                <?php else: ?>
                                    <th class="w-5"></th>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                     <?php $__env->endSlot(); ?>

                    <?php if($isColumnSearchVisible): ?>
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.row','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            <?php if($isReordering): ?>
                                <td></td>
                            <?php else: ?>
                                <?php if(count($actions) && in_array($actionsPosition, [ActionsPosition::BeforeCells, ActionsPosition::BeforeColumns])): ?>
                                    <td></td>
                                <?php endif; ?>

                                <?php if($isSelectionEnabled && $recordCheckboxPosition === RecordCheckboxPosition::BeforeCells): ?>
                                    <td></td>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.cell','data' => ['class' => 'filament-table-individual-search-cell-'.e(str($column->getName())->camel()->kebab()).' px-4 py-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'filament-table-individual-search-cell-'.e(str($column->getName())->camel()->kebab()).' px-4 py-1']); ?>
                                    <?php if($column->isIndividuallySearchable()): ?>
                                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.search-input','data' => ['wireModel' => 'tableColumnSearches.'.e($column->getName()).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::search-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire-model' => 'tableColumnSearches.'.e($column->getName()).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                    <?php endif; ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if(! $isReordering): ?>
                                <?php if(count($actions) && in_array($actionsPosition, [ActionsPosition::AfterColumns, ActionsPosition::AfterCells])): ?>
                                    <td></td>
                                <?php endif; ?>

                                <?php if($isSelectionEnabled && $recordCheckboxPosition === RecordCheckboxPosition::AfterCells): ?>
                                    <td></td>
                                <?php endif; ?>
                            <?php endif; ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                    <?php endif; ?>

                    <?php if(($records !== null) && count($records)): ?>
                        <?php
                            $previousRecord = null;
                            $previousRecordGroupKey = null;
                            $previousRecordGroupTitle = null;
                        ?>

                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $recordAction = $getRecordAction($record);
                                $recordKey = $getRecordKey($record);
                                $recordUrl = $getRecordUrl($record);
                                $recordGroupKey = $group?->getKey($record);
                                $recordGroupTitle = $group?->getTitle($record);
                            ?>

                            <?php if($recordGroupTitle !== $previousRecordGroupTitle): ?>
                                <?php if($hasSummary && (! $isReordering) && filled($previousRecordGroupTitle)): ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.summary.row','data' => ['actions' => count($actions),'actionsPosition' => $actionsPosition,'columns' => $columns,'heading' => $isGroupsOnly ? $previousRecordGroupTitle : __('filament-tables::table.summary.subheadings.group', ['group' => $previousRecordGroupTitle, 'label' => $pluralModelLabel]),'groupsOnly' => $isGroupsOnly,'selectionEnabled' => $isSelectionEnabled,'query' => $group->scopeQuery($this->getAllTableSummaryQuery(), $previousRecord),'selectedState' => $groupedSummarySelectedState[$previousRecordGroupKey] ?? [],'recordCheckboxPosition' => $recordCheckboxPosition]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::summary.row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(count($actions)),'actions-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionsPosition),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($columns),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isGroupsOnly ? $previousRecordGroupTitle : __('filament-tables::table.summary.subheadings.group', ['group' => $previousRecordGroupTitle, 'label' => $pluralModelLabel])),'groups-only' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isGroupsOnly),'selection-enabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isSelectionEnabled),'query' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->scopeQuery($this->getAllTableSummaryQuery(), $previousRecord)),'selected-state' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groupedSummarySelectedState[$previousRecordGroupKey] ?? []),'record-checkbox-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recordCheckboxPosition)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                <?php endif; ?>

                                <?php if(! $isGroupsOnly): ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.row','data' => ['class' => 'filament-tables-group-header-row bg-gray-500/5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'filament-tables-group-header-row bg-gray-500/5']); ?>
                                        <td colspan="<?php echo e($columnsCount); ?>">
                                            <?php
                                                $tag = $group->isCollapsible() ? 'button' : 'div';
                                            ?>

                                            <<?php echo e($tag); ?>

                                                <?php if($group->isCollapsible()): ?>
                                                    type="button"
                                                    x-on:click="toggleCollapseGroup(<?php echo \Illuminate\Support\Js::from($recordGroupTitle)->toHtml() ?>)"
                                                <?php endif; ?>
                                                class="flex w-full justify-start gap-x-2 whitespace-nowrap px-4 py-2"
                                            >
                                                <?php if($group->isCollapsible()): ?>
                                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.icon','data' => ['name' => 'heroicon-m-chevron-up','alias' => 'tables::grouping.collapse','size' => 'h-5 w-5','color' => 'text-gray-600 dark:text-gray-300','class' => 'transition','xBind:class' => 'isGroupCollapsed('.e(\Illuminate\Support\Js::from($recordGroupTitle)).') && \'rotate-180\'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'heroicon-m-chevron-up','alias' => 'tables::grouping.collapse','size' => 'h-5 w-5','color' => 'text-gray-600 dark:text-gray-300','class' => 'transition','x-bind:class' => 'isGroupCollapsed('.e(\Illuminate\Support\Js::from($recordGroupTitle)).') && \'rotate-180\'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                                <?php endif; ?>

                                                <div
                                                    class="flex flex-col items-start gap-y-1"
                                                >
                                                    <span
                                                        class="text-sm font-medium text-gray-600 dark:text-gray-300"
                                                    >
                                                        <?php if($group->isTitlePrefixedWithLabel()): ?>
                                                                <?php echo e($group->getLabel()); ?>:
                                                        <?php endif; ?>

                                                        <?php echo e($recordGroupTitle); ?>

                                                    </span>

                                                    <?php if(filled($recordGroupDescription = $group->getDescription($record, $recordGroupTitle))): ?>
                                                        <span
                                                            class="text-sm text-gray-500 dark:text-gray-400"
                                                        >
                                                            <?php echo e($recordGroupDescription); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </<?php echo e($tag); ?>>
                                        </td>
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if(! $isGroupsOnly): ?>
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.row','data' => ['recordAction' => $recordAction,'recordUrl' => $recordUrl,'wire:key' => $this->id . '.table.records.' . $recordKey,'xSortableItem' => $isReordering ? $recordKey : null,'xSortableHandle' => $isReordering,'striped' => $isStriped,'xBind:class' => '{
                                        \'hidden\': '.e($group?->isCollapsible() ? 'true' : 'false').' && isGroupCollapsed(\''.e($recordGroupTitle).'\'),
                                        \'bg-gray-50 dark:bg-gray-500/10\': isRecordSelected(\''.e($recordKey).'\'),
                                    }','class' => \Illuminate\Support\Arr::toCssClasses([
                                        'group cursor-move' => $isReordering,
                                        ...$getRecordClasses($record),
                                    ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['record-action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recordAction),'record-url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recordUrl),'wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->id . '.table.records.' . $recordKey),'x-sortable-item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isReordering ? $recordKey : null),'x-sortable-handle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isReordering),'striped' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isStriped),'x-bind:class' => '{
                                        \'hidden\': '.e($group?->isCollapsible() ? 'true' : 'false').' && isGroupCollapsed(\''.e($recordGroupTitle).'\'),
                                        \'bg-gray-50 dark:bg-gray-500/10\': isRecordSelected(\''.e($recordKey).'\'),
                                    }','class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                                        'group cursor-move' => $isReordering,
                                        ...$getRecordClasses($record),
                                    ]))]); ?>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.reorder.cell','data' => ['class' => \Illuminate\Support\Arr::toCssClasses([
                                            'hidden' => ! $isReordering,
                                        ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::reorder.cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                                            'hidden' => ! $isReordering,
                                        ]))]); ?>
                                        <?php if($isReordering): ?>
                                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.reorder.handle','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::reorder.handle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                        <?php endif; ?>
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

                                    <?php if(count($actions) && $actionsPosition === ActionsPosition::BeforeCells): ?>
                                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.actions.cell','data' => ['class' => \Illuminate\Support\Arr::toCssClasses([
                                                'hidden' => $isReordering,
                                            ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::actions.cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                                                'hidden' => $isReordering,
                                            ]))]); ?>
                                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.actions.index','data' => ['actions' => $actions,'alignment' => $actionsAlignment ?? 'start','record' => $record]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions),'alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionsAlignment ?? 'start'),'record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                    <?php endif; ?>

                                    <?php if($isSelectionEnabled && $recordCheckboxPosition === RecordCheckboxPosition::BeforeCells): ?>
                                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.checkbox.cell','data' => ['class' => \Illuminate\Support\Arr::toCssClasses([
                                                'hidden' => $isReordering,
                                            ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::checkbox.cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                                                'hidden' => $isReordering,
                                            ]))]); ?>
                                            <?php if($isRecordSelectable($record)): ?>
                                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.checkbox.index','data' => ['label' => __('filament-tables::table.fields.bulk_select_record.label', ['key' => $recordKey]),'xModel' => 'selectedRecords','value' => $recordKey,'class' => 'filament-tables-record-checkbox']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-tables::table.fields.bulk_select_record.label', ['key' => $recordKey])),'x-model' => 'selectedRecords','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recordKey),'class' => 'filament-tables-record-checkbox']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                            <?php endif; ?>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                    <?php endif; ?>

                                    <?php if(count($actions) && $actionsPosition === ActionsPosition::BeforeColumns): ?>
                                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.actions.cell','data' => ['class' => \Illuminate\Support\Arr::toCssClasses([
                                                'hidden' => $isReordering,
                                            ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::actions.cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                                                'hidden' => $isReordering,
                                            ]))]); ?>
                                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.actions.index','data' => ['actions' => $actions,'alignment' => $actionsAlignment ?? 'start','record' => $record]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions),'alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionsAlignment ?? 'start'),'record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                    <?php endif; ?>

                                    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $column->record($record);
                                            $column->rowLoop($loop->parent);
                                        ?>

                                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.cell','data' => ['wire:key' => ''.e($this->id).'.table.record.'.e($recordKey).'.column.'.e($column->getName()).'','wire:loading.remove.delay' => '','wire:target' => ''.e(implode(',', \Filament\Tables\Table::LOADING_TARGETS)).'','class' => 'filament-table-cell-'.e(str($column->getName())->camel()->kebab()).' '.e($getHiddenClasses($column)).'','attributes' => \Filament\Support\prepare_inherited_attributes($column->getExtraCellAttributeBag())]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:key' => ''.e($this->id).'.table.record.'.e($recordKey).'.column.'.e($column->getName()).'','wire:loading.remove.delay' => '','wire:target' => ''.e(implode(',', \Filament\Tables\Table::LOADING_TARGETS)).'','class' => 'filament-table-cell-'.e(str($column->getName())->camel()->kebab()).' '.e($getHiddenClasses($column)).'','attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($column->getExtraCellAttributeBag()))]); ?>
                                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.columns.column','data' => ['column' => $column,'record' => $record,'recordAction' => $recordAction,'recordKey' => $recordKey,'recordUrl' => $recordUrl,'isClickDisabled' => $column->isClickDisabled() || $isReordering]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::columns.column'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['column' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($column),'record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record),'record-action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recordAction),'record-key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recordKey),'record-url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recordUrl),'is-click-disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($column->isClickDisabled() || $isReordering)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php if(count($actions) && $actionsPosition === ActionsPosition::AfterColumns): ?>
                                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.actions.cell','data' => ['class' => \Illuminate\Support\Arr::toCssClasses([
                                                'hidden' => $isReordering,
                                            ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::actions.cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                                                'hidden' => $isReordering,
                                            ]))]); ?>
                                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.actions.index','data' => ['actions' => $actions,'alignment' => $actionsAlignment ?? 'end','record' => $record]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions),'alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionsAlignment ?? 'end'),'record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                    <?php endif; ?>

                                    <?php if($isSelectionEnabled && $recordCheckboxPosition === RecordCheckboxPosition::AfterCells): ?>
                                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.checkbox.cell','data' => ['class' => \Illuminate\Support\Arr::toCssClasses([
                                                'hidden' => $isReordering,
                                            ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::checkbox.cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                                                'hidden' => $isReordering,
                                            ]))]); ?>
                                            <?php if($isRecordSelectable($record)): ?>
                                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.checkbox.index','data' => ['label' => __('filament-tables::table.fields.bulk_select_record.label', ['key' => $recordKey]),'xModel' => 'selectedRecords','value' => $recordKey,'class' => 'filament-tables-record-checkbox']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament-tables::table.fields.bulk_select_record.label', ['key' => $recordKey])),'x-model' => 'selectedRecords','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recordKey),'class' => 'filament-tables-record-checkbox']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                            <?php endif; ?>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                    <?php endif; ?>

                                    <?php if(count($actions) && $actionsPosition === ActionsPosition::AfterCells): ?>
                                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.actions.cell','data' => ['class' => \Illuminate\Support\Arr::toCssClasses([
                                                'hidden' => $isReordering,
                                            ])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::actions.cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
                                                'hidden' => $isReordering,
                                            ]))]); ?>
                                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.actions.index','data' => ['actions' => $actions,'alignment' => $actionsAlignment ?? 'end','record' => $record]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::actions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actions),'alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionsAlignment ?? 'end'),'record' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($record)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                    <?php endif; ?>

                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.loading-cell','data' => ['colspan' => $columnsCount,'wire:loading.class.remove.delay' => 'hidden','class' => 'hidden','wire:key' => $this->id . '.table.records.' . $recordKey . '.loading-cell','wire:target' => ''.e(implode(',', \Filament\Tables\Table::LOADING_TARGETS)).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::loading-cell'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['colspan' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($columnsCount),'wire:loading.class.remove.delay' => 'hidden','class' => 'hidden','wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->id . '.table.records.' . $recordKey . '.loading-cell'),'wire:target' => ''.e(implode(',', \Filament\Tables\Table::LOADING_TARGETS)).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                            <?php endif; ?>

                            <?php
                                $previousRecordGroupKey = $recordGroupKey;
                                $previousRecordGroupTitle = $recordGroupTitle;
                                $previousRecord = $record;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($hasSummary && (! $isReordering) && filled($previousRecordGroupTitle) && ((! $records instanceof \Illuminate\Contracts\Pagination\Paginator) || (! $records->hasMorePages()))): ?>
                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.summary.row','data' => ['actions' => count($actions),'actionsPosition' => $actionsPosition,'columns' => $columns,'heading' => $isGroupsOnly ? $previousRecordGroupTitle : __('filament-tables::table.summary.subheadings.group', ['group' => $previousRecordGroupTitle, 'label' => $pluralModelLabel]),'groupsOnly' => $isGroupsOnly,'selectionEnabled' => $isSelectionEnabled,'query' => $group->scopeQuery($this->getAllTableSummaryQuery(), $previousRecord),'selectedState' => $groupedSummarySelectedState[$previousRecordGroupKey] ?? [],'recordCheckboxPosition' => $recordCheckboxPosition]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::summary.row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(count($actions)),'actions-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionsPosition),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($columns),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isGroupsOnly ? $previousRecordGroupTitle : __('filament-tables::table.summary.subheadings.group', ['group' => $previousRecordGroupTitle, 'label' => $pluralModelLabel])),'groups-only' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isGroupsOnly),'selection-enabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isSelectionEnabled),'query' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($group->scopeQuery($this->getAllTableSummaryQuery(), $previousRecord)),'selected-state' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($groupedSummarySelectedState[$previousRecordGroupKey] ?? []),'record-checkbox-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recordCheckboxPosition)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                        <?php endif; ?>

                        <?php if($contentFooter): ?>
                             <?php $__env->slot('footer', null, []); ?> 
                                <?php echo e($contentFooter->with(['columns' => $columns, 'records' => $records])); ?>

                             <?php $__env->endSlot(); ?>
                        <?php endif; ?>

                        <?php if($hasSummary && (! $isReordering)): ?>
                            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.summary.index','data' => ['actions' => count($actions),'actionsPosition' => $actionsPosition,'columns' => $columns,'groupsOnly' => $isGroupsOnly,'selectionEnabled' => $isSelectionEnabled,'pluralModelLabel' => $pluralModelLabel,'records' => $records,'recordCheckboxPosition' => $recordCheckboxPosition]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::summary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(count($actions)),'actions-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($actionsPosition),'columns' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($columns),'groups-only' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isGroupsOnly),'selection-enabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isSelectionEnabled),'plural-model-label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pluralModelLabel),'records' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($records),'record-checkbox-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($recordCheckboxPosition)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            <?php elseif($records === null): ?>
                <div
                    class="filament-tables-defer-loading-indicator flex items-center justify-center p-6"
                >
                    <div
                        class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-50 text-primary-500 dark:bg-gray-700"
                    >
                        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.loading-indicator','data' => ['class' => 'h-6 w-6']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::loading-indicator'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-6 w-6']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <?php if($emptyState = $getEmptyState()): ?>
                    <?php echo e($emptyState); ?>

                <?php else: ?>
                    <tr>
                        <td colspan="<?php echo e($columnsCount); ?>">
                            <div
                                class="flex w-full items-center justify-center p-4"
                            >
                                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.empty-state.index','data' => ['icon' => $getEmptyStateIcon(),'actions' => $getEmptyStateActions()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getEmptyStateIcon()),'actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getEmptyStateActions())]); ?>
                                     <?php $__env->slot('heading', null, []); ?> 
                                        <?php echo e($getEmptyStateHeading()); ?>

                                     <?php $__env->endSlot(); ?>

                                     <?php $__env->slot('description', null, []); ?> 
                                        <?php echo e($getEmptyStateDescription()); ?>

                                     <?php $__env->endSlot(); ?>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <?php if($records instanceof \Illuminate\Contracts\Pagination\Paginator &&
             ((! $records instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator) || $records->total())): ?>
            <div
                class="filament-tables-pagination-container border-t p-2 dark:border-gray-700"
            >
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.pagination.index','data' => ['paginator' => $records,'pageOptions' => $getPaginationPageOptions()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::pagination'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['paginator' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($records),'page-options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getPaginationPageOptions())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if($hasFiltersBelowContent): ?>
            <div class="px-2 pb-2">
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.hr','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::hr'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

                <div class="mt-2 p-4">
                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-tables::components.filters.index','data' => ['form' => $getFiltersForm()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-tables::filters'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['form' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getFiltersForm())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-actions::components.modals','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-actions::modals'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
</div>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/tables/src/../resources/views/index.blade.php ENDPATH**/ ?>