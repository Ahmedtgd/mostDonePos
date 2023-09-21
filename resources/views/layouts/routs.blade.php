<x-app-layout>
    <div class="container">
        <h2>Route Buttons</h2>

        <x-nav-link :href="route('products.index')">
            Products Index
        </x-nav-link>

        <x-application-logo>
            Application Logo Button
        </x-application-logo>

        <x-danger-button :href="route('customers.index')">
            Customers Index
        </x-danger-button>

        <x-dropdown-link :href="route('cards.index')">
            Cards Index
        </x-dropdown-link>

        <x-input-label>
            Input Label Button
        </x-input-label>

        <x-nav-link :href="route('categories.index')">
            Categories Index
        </x-nav-link>

        <x-primary-button :href="route('orders.index')">
            Orders Index
        </x-primary-button>

        

        <x-secondary-button :href="route('profile.edit')">
            Edit Profile
        </x-secondary-button>

        <x-text-input>
            Text Input Button
        </x-text-input>
    </div>
    </x-app-layout>