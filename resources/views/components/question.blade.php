@props(['id', 'label', 'value'])

<div>
	<x-input-label :value="$label" :for="$id" />
	<x-text-input class="mt-1 block w-full" type="text" :value="$value" :id="$id" :name="$id" />
</div>
