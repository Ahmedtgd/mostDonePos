<?php

namespace Filament\Http\Livewire;

use Filament\Facades\Filament;
use Filament\GlobalSearch\GlobalSearchResults;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class GlobalSearch extends Component
{
    public ?string $search = '';

    public function getResults(): ?GlobalSearchResults
    {
        $search = trim($this->search);

        if (blank($search)) {
            return null;
        }

        $results = Filament::getGlobalSearchProvider()->getResults($this->search);

        if ($results === null) {
            return $results;
        }

        $this->dispatchBrowserEvent('open-global-search-results');

        return $results;
    }

    public function isEnabled(): bool
    {
        foreach (Filament::getResources() as $resource) {
            if ($resource::canGloballySearch()) {
                return true;
            }
        }

        return false;
    }

    public static function getName(): string
    {
        return 'filament.core.global-search';
    }

    public function render(): View
    {
        return view('filament::components.global-search.index', [
            'results' => $this->getResults(),
        ]);
    }
}
