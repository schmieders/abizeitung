<x-guest-layout>
	<div class="mb-4 text-sm text-gray-600">
		Vielen Dank fürs Registrieren! Zunächst müssen wir deine E-Mail Adresse verifizieren. Bitte klicke dafür auf den Link,
		den wir dir soeben zugesendet haben. Solltest du keine E-Mail erhalten haben, senden wir dir gerne eine weitere.
	</div>

	@if (session('status') == 'verification-link-sent')
		<div class="mb-4 text-sm font-medium text-green-600">
			Ein neuer Link wurde an deine E-Mail Adresse gesendet.
		</div>
	@endif

	<div class="mt-4 flex items-center justify-between">
		<form method="POST" action="{{ route('verification.send') }}">
			@csrf

			<div>
				<x-primary-button>
					E-Mail erneut senden
				</x-primary-button>
			</div>
		</form>

		<form method="POST" action="{{ route('logout') }}">
			@csrf

			<button
				class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
				type="submit">
				Abmelden
			</button>
		</form>
	</div>
</x-guest-layout>
