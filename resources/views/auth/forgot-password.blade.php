<x-guest-layout>
	<div class="mb-4 text-sm text-gray-600">
		Passwort vergessen? Kein Problem. Gib einfach deine E-Mail Adresse ein und wir senden dir einen Link zum Zurücksetzen
		deines Passworts
	</div>

	<!-- Session Status -->
	<x-auth-session-status class="mb-4" :status="session('status')" />

	<form method="POST" action="{{ route('password.email') }}">
		@csrf

		<!-- Email Address -->
		<div>
			<x-input-label for="email" value="E-Mail Adresse" />
			<x-text-input class="mt-1 block w-full" id="email" name="email" type="email" :value="old('email')" required
				autofocus />
			<x-input-error class="mt-2" :messages="$errors->get('email')" />
		</div>

		<div class="mt-4 flex items-center justify-end">
			<x-primary-button>
				Link anfordern
			</x-primary-button>
		</div>
	</form>
</x-guest-layout>
