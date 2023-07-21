@props(['disabled' => false, 'label', 'id'])

<label class="inline-flex items-center" :for="$id">
	<input type="checkbox" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
	    'class' => 'rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500',
	]) !!}>
	<span class="ml-2 select-none text-sm text-gray-600">{{ $label }}</span>
</label>
