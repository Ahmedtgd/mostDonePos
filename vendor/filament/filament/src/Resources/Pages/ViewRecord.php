<?php

namespace Filament\Resources\Pages;

use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\RestoreAction;
use Filament\Forms\Form;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Form $form
 */
class ViewRecord extends Page implements HasInfolists
{
    use Concerns\HasRelationManagers;
    use Concerns\InteractsWithRecord;
    use InteractsWithFormActions;
    use InteractsWithInfolists;

    /**
     * @var view-string
     */
    protected static string $view = 'filament::resources.pages.view-record';

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    /**
     * @var array<int | string, string | array<mixed>>
     */
    protected $queryString = [
        'activeRelationManager',
    ];

    public function getBreadcrumb(): string
    {
        return static::$breadcrumb ?? __('filament::resources/pages/view-record.breadcrumb');
    }

    public function getContentTabLabel(): ?string
    {
        return __('filament::resources/pages/view-record.content.tab.label');
    }

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->authorizeAccess();

        if ($this->hasInfolist()) {
            return;
        }

        $this->fillForm();
    }

    protected function authorizeAccess(): void
    {
        static::authorizeResourceAccess();

        abort_unless(static::getResource()::canView($this->getRecord()), 403);
    }

    protected function hasInfolist(): bool
    {
        return (bool) count($this->getInfolist('infolist')->getComponents());
    }

    protected function fillForm(): void
    {
        $this->callHook('beforeFill');

        $data = $this->getRecord()->attributesToArray();

        $data = $this->mutateFormDataBeforeFill($data);

        $this->form->fill($data);

        $this->callHook('afterFill');
    }

    /**
     * @param  array<string>  $attributes
     */
    protected function refreshFormData(array $attributes): void
    {
        $this->data = [
            ...$this->data,
            ...$this->getRecord()->only($attributes),
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        return $data;
    }

    protected function configureAction(Action $action): void
    {
        $action
            ->record($this->getRecord())
            ->recordTitle($this->getRecordTitle());

        match (true) {
            $action instanceof DeleteAction => $this->configureDeleteAction($action),
            $action instanceof EditAction => $this->configureEditAction($action),
            $action instanceof ForceDeleteAction => $this->configureForceDeleteAction($action),
            $action instanceof ReplicateAction => $this->configureReplicateAction($action),
            $action instanceof RestoreAction => $this->configureRestoreAction($action),
            default => null,
        };
    }

    protected function configureEditAction(EditAction $action): void
    {
        $resource = static::getResource();

        $action
            ->authorize($resource::canEdit($this->getRecord()))
            ->form(fn (Form $form): Form => static::getResource()::form($form));

        if ($resource::hasPage('edit')) {
            $action->url(fn (): string => static::getResource()::getUrl('edit', ['record' => $this->getRecord()]));
        }
    }

    protected function configureForceDeleteAction(ForceDeleteAction $action): void
    {
        $resource = static::getResource();

        $action
            ->authorize($resource::canForceDelete($this->getRecord()))
            ->successRedirectUrl($resource::getUrl('index'));
    }

    protected function configureReplicateAction(ReplicateAction $action): void
    {
        $action
            ->authorize(static::getResource()::canReplicate($this->getRecord()));
    }

    protected function configureRestoreAction(RestoreAction $action): void
    {
        $action
            ->authorize(static::getResource()::canRestore($this->getRecord()));
    }

    protected function configureDeleteAction(DeleteAction $action): void
    {
        $resource = static::getResource();

        $action
            ->authorize($resource::canDelete($this->getRecord()))
            ->successRedirectUrl($resource::getUrl('index'));
    }

    public function getTitle(): string | Htmlable
    {
        if (filled(static::$title)) {
            return static::$title;
        }

        return __('filament::resources/pages/view-record.title', [
            'label' => $this->getRecordTitle(),
        ]);
    }

    public function form(Form $form): Form
    {
        return static::getResource()::form(
            $form
                ->operation('view')
                ->disabled()
                ->model($this->getRecord())
                ->statePath('data')
                ->columns($this->hasInlineLabels() ? 1 : 2)
                ->inlineLabel($this->hasInlineLabels()),
        );
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return static::getResource()::infolist(
            $infolist
                ->record($this->getRecord())
                ->columns($this->hasInlineLabels() ? 1 : 2)
                ->inlineLabel($this->hasInlineLabels()),
        );
    }

    protected function getMountedActionFormModel(): Model
    {
        return $this->getRecord();
    }

    /**
     * @return array<string, mixed>
     */
    public function getWidgetData(): array
    {
        return [
            'record' => $this->getRecord(),
        ];
    }
}
