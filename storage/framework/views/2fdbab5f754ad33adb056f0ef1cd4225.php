<?php if($this instanceof \Filament\Actions\Contracts\HasActions && (! $this->hasActionsModalRendered)): ?>
    <form wire:submit.prevent="callMountedAction">
        <?php
            $action = $this->getMountedAction();
        ?>

        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.modal.index','data' => ['alignment' => $action?->getModalAlignment(),'closeButton' => $action?->hasModalCloseButton(),'closeByClickingAway' => $action?->isModalClosedByClickingAway(),'displayClasses' => 'block','footerActions' => $action?->getVisibleModalFooterActions(),'footerActionsAlignment' => $action?->getModalFooterActionsAlignment(),'heading' => $action?->getModalHeading(),'icon' => $action?->getModalIcon(),'iconColor' => $action?->getModalIconColor(),'id' => $this->id . '-action','slideOver' => $action?->isModalSlideOver(),'stickyFooter' => $action?->isModalFooterSticky(),'description' => $action?->getModalDescription(),'visible' => filled($action),'width' => $action?->getModalWidth(),'wire:key' => $action ? $this->id . '.actions.' . $action->getName() . '.modal' : null,'xInit' => 'livewire = $wire.__instance','xOn:closedFormComponentActionModal.window' => 'if (($event.detail.id === \''.e($this->id).'\') && $wire.mountedActions.length) open()','xOn:modalClosed.stop' => '
                const mountedActionShouldOpenModal = '.e(\Illuminate\Support\Js::from($action && $this->mountedActionShouldOpenModal())).'


                if (! mountedActionShouldOpenModal) {
                    return
                }

                if (
                    (\'mountedFormComponentActions\' in livewire?.serverMemo.data) &&
                    livewire.serverMemo.data.mountedFormComponentActions.length
                ) {
                    return
                }

                if (\'mountedActions\' in livewire?.serverMemo.data) {
                    livewire.call(\'unmountAction\', false)
                }
            ','xOn:openedFormComponentActionModal.window' => 'if ($event.detail.id === \''.e($this->id).'\') close()']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalAlignment()),'close-button' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->hasModalCloseButton()),'close-by-clicking-away' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalClosedByClickingAway()),'display-classes' => 'block','footer-actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getVisibleModalFooterActions()),'footer-actions-alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalFooterActionsAlignment()),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalHeading()),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalIcon()),'icon-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalIconColor()),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->id . '-action'),'slide-over' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalSlideOver()),'sticky-footer' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalFooterSticky()),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalDescription()),'visible' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(filled($action)),'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalWidth()),'wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action ? $this->id . '.actions.' . $action->getName() . '.modal' : null),'x-init' => 'livewire = $wire.__instance','x-on:closed-form-component-action-modal.window' => 'if (($event.detail.id === \''.e($this->id).'\') && $wire.mountedActions.length) open()','x-on:modal-closed.stop' => '
                const mountedActionShouldOpenModal = '.e(\Illuminate\Support\Js::from($action && $this->mountedActionShouldOpenModal())).'


                if (! mountedActionShouldOpenModal) {
                    return
                }

                if (
                    (\'mountedFormComponentActions\' in livewire?.serverMemo.data) &&
                    livewire.serverMemo.data.mountedFormComponentActions.length
                ) {
                    return
                }

                if (\'mountedActions\' in livewire?.serverMemo.data) {
                    livewire.call(\'unmountAction\', false)
                }
            ','x-on:opened-form-component-action-modal.window' => 'if ($event.detail.id === \''.e($this->id).'\') close()']); ?>
            <?php if($action): ?>
                <?php echo e($action->getModalContent()); ?>


                <?php if(count(($infolist = $action->getInfolist())?->getComponents() ?? [])): ?>
                    <?php echo e($infolist); ?>

                <?php elseif($this->mountedActionHasForm()): ?>
                    <?php echo e($this->getMountedActionForm()); ?>

                <?php endif; ?>

                <?php echo e($action->getModalContentFooter()); ?>

            <?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
    </form>

    <?php
        $this->hasActionsModalRendered = true;
    ?>
<?php endif; ?>

<?php if($this instanceof \Filament\Infolists\Contracts\HasInfolists && (! $this->hasInfolistsModalRendered)): ?>
    <form wire:submit.prevent="callMountedInfolistAction">
        <?php
            $action = $this->getMountedInfolistAction();
        ?>

        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.modal.index','data' => ['alignment' => $action?->getModalAlignment(),'closeButton' => $action?->hasModalCloseButton(),'closeByClickingAway' => $action?->isModalClosedByClickingAway(),'displayClasses' => 'block','footerActions' => $action?->getVisibleModalFooterActions(),'footerActionsAlignment' => $action?->getModalFooterActionsAlignment(),'heading' => $action?->getModalHeading(),'icon' => $action?->getModalIcon(),'iconColor' => $action?->getModalIconColor(),'id' => $this->id . '-infolist-action','slideOver' => $action?->isModalSlideOver(),'stickyFooter' => $action?->isModalFooterSticky(),'description' => $action?->getModalDescription(),'visible' => filled($action),'width' => $action?->getModalWidth(),'wire:key' => $action ? $this->id . '.infolist.actions.' . $action->getName() . '.modal' : null,'xInit' => 'livewire = $wire.__instance','xOn:closedFormComponentActionModal.window' => 'if (($event.detail.id === \''.e($this->id).'\') && $wire.mountedInfolistActions.length) open()','xOn:modalClosed.stop' => '
                const mountedInfolistActionShouldOpenModal = '.e(\Illuminate\Support\Js::from($action && $this->mountedInfolistActionShouldOpenModal())).'


                if (! mountedInfolistActionShouldOpenModal) {
                    return
                }

                if (
                    (\'mountedFormComponentActions\' in livewire?.serverMemo.data) &&
                    livewire.serverMemo.data.mountedFormComponentActions.length
                ) {
                    return
                }

                if (\'mountedInfolistActions\' in livewire?.serverMemo.data) {
                    livewire.call(\'unmountInfolistAction\', false)
                }
            ','xOn:openedFormComponentActionModal.window' => 'if ($event.detail.id === \''.e($this->id).'\') close()']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalAlignment()),'close-button' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->hasModalCloseButton()),'close-by-clicking-away' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalClosedByClickingAway()),'display-classes' => 'block','footer-actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getVisibleModalFooterActions()),'footer-actions-alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalFooterActionsAlignment()),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalHeading()),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalIcon()),'icon-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalIconColor()),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->id . '-infolist-action'),'slide-over' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalSlideOver()),'sticky-footer' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalFooterSticky()),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalDescription()),'visible' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(filled($action)),'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalWidth()),'wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action ? $this->id . '.infolist.actions.' . $action->getName() . '.modal' : null),'x-init' => 'livewire = $wire.__instance','x-on:closed-form-component-action-modal.window' => 'if (($event.detail.id === \''.e($this->id).'\') && $wire.mountedInfolistActions.length) open()','x-on:modal-closed.stop' => '
                const mountedInfolistActionShouldOpenModal = '.e(\Illuminate\Support\Js::from($action && $this->mountedInfolistActionShouldOpenModal())).'


                if (! mountedInfolistActionShouldOpenModal) {
                    return
                }

                if (
                    (\'mountedFormComponentActions\' in livewire?.serverMemo.data) &&
                    livewire.serverMemo.data.mountedFormComponentActions.length
                ) {
                    return
                }

                if (\'mountedInfolistActions\' in livewire?.serverMemo.data) {
                    livewire.call(\'unmountInfolistAction\', false)
                }
            ','x-on:opened-form-component-action-modal.window' => 'if ($event.detail.id === \''.e($this->id).'\') close()']); ?>
            <?php if($action): ?>
                <?php echo e($action->getModalContent()); ?>


                <?php if(count(($infolist = $action->getInfolist())?->getComponents() ?? [])): ?>
                    <?php echo e($infolist); ?>

                <?php elseif($this->mountedInfolistActionHasForm()): ?>
                    <?php echo e($this->getMountedInfolistActionForm()); ?>

                <?php endif; ?>

                <?php echo e($action->getModalContentFooter()); ?>

            <?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
    </form>

    <?php
        $this->hasInfolistsModalRendered = true;
    ?>
<?php endif; ?>

<?php if($this instanceof \Filament\Tables\Contracts\HasTable && (! $this->hasTableModalRendered)): ?>
    <form wire:submit.prevent="callMountedTableAction">
        <?php
            $action = $this->getMountedTableAction();
        ?>

        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.modal.index','data' => ['alignment' => $action?->getModalAlignment(),'closeButton' => $action?->hasModalCloseButton(),'closeByClickingAway' => $action?->isModalClosedByClickingAway(),'displayClasses' => 'block','footerActions' => $action?->getVisibleModalFooterActions(),'footerActionsAlignment' => $action?->getModalFooterActionsAlignment(),'heading' => $action?->getModalHeading(),'icon' => $action?->getModalIcon(),'iconColor' => $action?->getModalIconColor(),'id' => $this->id . '-table-action','slideOver' => $action?->isModalSlideOver(),'stickyFooter' => $action?->isModalFooterSticky(),'description' => $action?->getModalDescription(),'visible' => filled($action),'width' => $action?->getModalWidth(),'wire:key' => $action ? $this->id . '.table.actions.' . $action->getName() . '.modal' : null,'xInit' => 'livewire = $wire.__instance','xOn:closedFormComponentActionModal.window' => 'if (($event.detail.id === \''.e($this->id).'\') && $wire.mountedTableActions.length) open()','xOn:modalClosed.stop' => '
                const mountedTableActionShouldOpenModal = '.e(\Illuminate\Support\Js::from($action && $this->mountedTableActionShouldOpenModal())).'


                if (! mountedTableActionShouldOpenModal) {
                    return
                }

                if (
                    (\'mountedFormComponentActions\' in livewire?.serverMemo.data) &&
                    livewire.serverMemo.data.mountedFormComponentActions.length
                ) {
                    return
                }

                if (\'mountedTableActions\' in livewire?.serverMemo.data) {
                    livewire.call(\'unmountTableAction\', false)
                }
            ','xOn:openedFormComponentActionModal.window' => 'if ($event.detail.id === \''.e($this->id).'\') close()']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalAlignment()),'close-button' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->hasModalCloseButton()),'close-by-clicking-away' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalClosedByClickingAway()),'display-classes' => 'block','footer-actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getVisibleModalFooterActions()),'footer-actions-alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalFooterActionsAlignment()),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalHeading()),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalIcon()),'icon-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalIconColor()),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->id . '-table-action'),'slide-over' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalSlideOver()),'sticky-footer' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalFooterSticky()),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalDescription()),'visible' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(filled($action)),'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalWidth()),'wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action ? $this->id . '.table.actions.' . $action->getName() . '.modal' : null),'x-init' => 'livewire = $wire.__instance','x-on:closed-form-component-action-modal.window' => 'if (($event.detail.id === \''.e($this->id).'\') && $wire.mountedTableActions.length) open()','x-on:modal-closed.stop' => '
                const mountedTableActionShouldOpenModal = '.e(\Illuminate\Support\Js::from($action && $this->mountedTableActionShouldOpenModal())).'


                if (! mountedTableActionShouldOpenModal) {
                    return
                }

                if (
                    (\'mountedFormComponentActions\' in livewire?.serverMemo.data) &&
                    livewire.serverMemo.data.mountedFormComponentActions.length
                ) {
                    return
                }

                if (\'mountedTableActions\' in livewire?.serverMemo.data) {
                    livewire.call(\'unmountTableAction\', false)
                }
            ','x-on:opened-form-component-action-modal.window' => 'if ($event.detail.id === \''.e($this->id).'\') close()']); ?>
            <?php if($action): ?>
                <?php echo e($action->getModalContent()); ?>


                <?php if(count(($infolist = $action->getInfolist())?->getComponents() ?? [])): ?>
                    <?php echo e($infolist); ?>

                <?php elseif($this->mountedTableActionHasForm()): ?>
                    <?php echo e($this->getMountedTableActionForm()); ?>

                <?php endif; ?>

                <?php echo e($action->getModalContentFooter()); ?>

            <?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
    </form>

    <form wire:submit.prevent="callMountedTableBulkAction">
        <?php
            $action = $this->getMountedTableBulkAction();
        ?>

        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.modal.index','data' => ['alignment' => $action?->getModalAlignment(),'closeButton' => $action?->hasModalCloseButton(),'closeByClickingAway' => $action?->isModalClosedByClickingAway(),'displayClasses' => 'block','footerActions' => $action?->getVisibleModalFooterActions(),'footerActionsAlignment' => $action?->getModalFooterActionsAlignment(),'heading' => $action?->getModalHeading(),'icon' => $action?->getModalIcon(),'iconColor' => $action?->getModalIconColor(),'id' => $this->id . '-table-bulk-action','slideOver' => $action?->isModalSlideOver(),'stickyFooter' => $action?->isModalFooterSticky(),'description' => $action?->getModalDescription(),'visible' => filled($action),'width' => $action?->getModalWidth(),'wire:key' => $action ? $this->id . '.table.bulk-actions.' . $action->getName() . '.modal' : null,'xInit' => 'livewire = $wire.__instance','xOn:closedFormComponentActionModal.window' => 'if (($event.detail.id === \''.e($this->id).'\') && $wire.mountedTableBulkAction) open()','xOn:modalClosed.stop' => '
                const mountedTableBulkActionShouldOpenModal = '.e(\Illuminate\Support\Js::from($action && $this->mountedTableBulkActionShouldOpenModal())).'


                if (! mountedTableBulkActionShouldOpenModal) {
                    return
                }

                if (
                    (\'mountedFormComponentActions\' in livewire?.serverMemo.data) &&
                    livewire.serverMemo.data.mountedFormComponentActions.length
                ) {
                    return
                }

                if (\'mountedTableBulkAction\' in livewire?.serverMemo.data) {
                    livewire.set(\'mountedTableBulkAction\', null)
                }
            ','xOn:openedFormComponentActionModal.window' => 'if ($event.detail.id === \''.e($this->id).'\') close()']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalAlignment()),'close-button' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->hasModalCloseButton()),'close-by-clicking-away' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalClosedByClickingAway()),'display-classes' => 'block','footer-actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getVisibleModalFooterActions()),'footer-actions-alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalFooterActionsAlignment()),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalHeading()),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalIcon()),'icon-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalIconColor()),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->id . '-table-bulk-action'),'slide-over' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalSlideOver()),'sticky-footer' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalFooterSticky()),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalDescription()),'visible' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(filled($action)),'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalWidth()),'wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action ? $this->id . '.table.bulk-actions.' . $action->getName() . '.modal' : null),'x-init' => 'livewire = $wire.__instance','x-on:closed-form-component-action-modal.window' => 'if (($event.detail.id === \''.e($this->id).'\') && $wire.mountedTableBulkAction) open()','x-on:modal-closed.stop' => '
                const mountedTableBulkActionShouldOpenModal = '.e(\Illuminate\Support\Js::from($action && $this->mountedTableBulkActionShouldOpenModal())).'


                if (! mountedTableBulkActionShouldOpenModal) {
                    return
                }

                if (
                    (\'mountedFormComponentActions\' in livewire?.serverMemo.data) &&
                    livewire.serverMemo.data.mountedFormComponentActions.length
                ) {
                    return
                }

                if (\'mountedTableBulkAction\' in livewire?.serverMemo.data) {
                    livewire.set(\'mountedTableBulkAction\', null)
                }
            ','x-on:opened-form-component-action-modal.window' => 'if ($event.detail.id === \''.e($this->id).'\') close()']); ?>
            <?php if($action): ?>
                <?php echo e($action->getModalContent()); ?>


                <?php if(count(($infolist = $action->getInfolist())?->getComponents() ?? [])): ?>
                    <?php echo e($infolist); ?>

                <?php elseif($this->mountedTableBulkActionHasForm()): ?>
                    <?php echo e($this->getMountedTableBulkActionForm()); ?>

                <?php endif; ?>

                <?php echo e($action->getModalContentFooter()); ?>

            <?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
    </form>

    <?php
        $this->hasTableModalRendered = true;
    ?>
<?php endif; ?>

<?php if(! $this->hasFormsModalRendered): ?>
    <?php
        $action = $this->getMountedFormComponentAction();
    ?>

    <form wire:submit.prevent="callMountedFormComponentAction">
        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.modal.index','data' => ['alignment' => $action?->getModalAlignment(),'closeButton' => $action?->hasModalCloseButton(),'closeByClickingAway' => $action?->isModalClosedByClickingAway(),'displayClasses' => 'block','footerActions' => $action?->getVisibleModalFooterActions(),'footerActionsAlignment' => $action?->getModalFooterActionsAlignment(),'heading' => $action?->getModalHeading(),'icon' => $action?->getModalIcon(),'iconColor' => $action?->getModalIconColor(),'id' => $this->id . '-form-component-action','slideOver' => $action?->isModalSlideOver(),'stickyFooter' => $action?->isModalFooterSticky(),'description' => $action?->getModalDescription(),'visible' => filled($action),'width' => $action?->getModalWidth(),'wire:key' => $action ? $this->id . '.' . $action->getComponent()->getStatePath() . '.actions.' . $action->getName() . '.modal' : null,'xInit' => 'livewire = $wire.__instance','xOn:modalClosed.stop' => '
                const mountedFormComponentActionShouldOpenModal = '.e(\Illuminate\Support\Js::from($action && $this->mountedFormComponentActionShouldOpenModal())).'


                if (mountedFormComponentActionShouldOpenModal && \'mountedFormComponentActions\' in livewire?.serverMemo.data) {
                    livewire.call(\'unmountFormComponentAction\', false)
                }
            ']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalAlignment()),'close-button' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->hasModalCloseButton()),'close-by-clicking-away' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalClosedByClickingAway()),'display-classes' => 'block','footer-actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getVisibleModalFooterActions()),'footer-actions-alignment' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalFooterActionsAlignment()),'heading' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalHeading()),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalIcon()),'icon-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalIconColor()),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->id . '-form-component-action'),'slide-over' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalSlideOver()),'sticky-footer' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->isModalFooterSticky()),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalDescription()),'visible' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(filled($action)),'width' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action?->getModalWidth()),'wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($action ? $this->id . '.' . $action->getComponent()->getStatePath() . '.actions.' . $action->getName() . '.modal' : null),'x-init' => 'livewire = $wire.__instance','x-on:modal-closed.stop' => '
                const mountedFormComponentActionShouldOpenModal = '.e(\Illuminate\Support\Js::from($action && $this->mountedFormComponentActionShouldOpenModal())).'


                if (mountedFormComponentActionShouldOpenModal && \'mountedFormComponentActions\' in livewire?.serverMemo.data) {
                    livewire.call(\'unmountFormComponentAction\', false)
                }
            ']); ?>
            <?php if($action): ?>
                <?php echo e($action->getModalContent()); ?>


                <?php if(count(($infolist = $action->getInfolist())?->getComponents() ?? [])): ?>
                    <?php echo e($infolist); ?>

                <?php elseif($this->mountedFormComponentActionHasForm()): ?>
                    <?php echo e($this->getMountedFormComponentActionForm()); ?>

                <?php endif; ?>

                <?php echo e($action->getModalContentFooter()); ?>

            <?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
    </form>

    <?php
        $this->hasFormsModalRendered = true;
    ?>
<?php endif; ?>
<?php /**PATH /home/k/Documents/spatie/mostDonePos/vendor/filament/actions/src/../resources/views/components/modals.blade.php ENDPATH**/ ?>