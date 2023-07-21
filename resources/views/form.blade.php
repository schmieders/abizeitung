@props(['isTeacher', 'data'])
<x-app-layout>

	<div class="mb-12 text-4xl font-bold">
		Fragen
		<!-- Session Status -->
		<x-auth-session-status class="mb-4 mt-1" :status="session('status')" />
	</div>

	<form class="min-h-form grid grid-cols-1 gap-5 md:grid-cols-2" id="form" action="{{ route('form') }}" method="POST">
		@csrf

		@if ($isTeacher)
			@include('form.teacher')
		@else
			@include('form.student')
		@endif
	</form>

	<x-primary-button class="mt-4 w-full select-none justify-center" type="button"
		onclick="document.getElementById('form').submit()">
		Änderungen speichern
	</x-primary-button>
</x-app-layout>
