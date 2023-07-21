@props(['isTeacher', 'image', 'data'])
<x-app-layout>

	<div class="mb-12 text-4xl font-bold">
		Fragen
		<!-- Session Status -->
		<x-auth-session-status class="mb-4 mt-1" :status="session('status')" />
	</div>

	<input id="image" name="image" type="file" accept="image/*" hidden />

	<div class="mb-6">
		<div class="text-center">
			<div class="mx-auto h-24 w-24 rounded-full bg-cover bg-center" id="image_preview"
				style="background-image: url({{ $image }});">
			</div>
			<x-secondary-button class="mt-3" style="height: 42px;" onclick="document.getElementById('image').click()">
				Bild hochladen
			</x-secondary-button>
		</div>
	</div>

	<form class="min-h-form grid grid-cols-1 gap-5 md:grid-cols-2" id="form" action="{{ route('form') }}"
		method="POST">
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

	<script type="text/javascript">
		const upload = (event) => {
			const formData = new FormData()
			formData.append('image', event.target.files[0])
			window.axios.post('image', formData, {
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				})
				.then(() => {
					window.location.reload()
				})
		}
		document.getElementById('image').addEventListener('change', upload)
	</script>
</x-app-layout>
