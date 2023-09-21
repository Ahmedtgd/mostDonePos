<?php extract(collect($attributes->getAttributes())->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
@props(['form','tag','xOn:click','wire:click','href','target','type','color','keyBindings','tooltip','disabled','icon','indicator','indicatorColor','size','labelSrOnly','class','label','inline'])
<x-filament::icon-button :form="$form" :tag="$tag" :x-on:click="$xOnClick" :wire:click="$wireClick" :href="$href" :target="$target" :type="$type" :color="$color" :key-bindings="$keyBindings" :tooltip="$tooltip" :disabled="$disabled" :icon="$icon" :indicator="$indicator" :indicator-color="$indicatorColor" :size="$size" :label-sr-only="$labelSrOnly" :class="$class" :label="$label" :inline="$inline" >

{{ $slot ?? "" }}
</x-filament::icon-button>