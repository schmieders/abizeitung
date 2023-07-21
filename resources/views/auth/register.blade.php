@props(['classes'])

<x-guest-layout>
	<!-- Session Status -->
	<x-auth-session-status class="mb-4" :status="session('status')" />

	<div class="mb-3 text-right">
		<a class="font-bold hover:underline" href="{{ route('login') }}">Schon Registriert? Jetzt anmelden!</a>
	</div>
	<form method="POST" action="{{ route('register') }}">
		@csrf

		<!-- Name -->
		<div>
			<x-input-label for="name" value="Name" />
			<x-text-input class="mt-1 block w-full" id="name" name="name" type="text" required autofocus
				autocomplete="name" />
			<x-input-error class="mt-2" :messages="$errors->get('name')" />
		</div>

		<!-- Email Address -->
		<div class="mt-4">
			<x-input-label for="email" value="E-Mail Adresse" />
			<x-text-input class="mt-1 block w-full" id="email" name="email" type="email" :value="old('email')" required
				autocomplete="email" />
			<x-input-error class="mt-2" :messages="$errors->get('email')" />
		</div>

		<div class="mt-4">
			<x-input-label for="classes" value="Klassen" />
			<div class="grid grid-cols-3 gap-5">
				@foreach ($classes as $class)
					<x-check-input name="classes[]" :value="$class->id" :id="$class->name" :label="$class->name" />
				@endforeach
			</div>
			<x-input-error class="mt-2" :messages="$errors->get('classes')" />
		</div>

		<!-- Password -->
		<div class="mt-4">
			<x-input-label for="password" value="Passwort" />

			<x-text-input class="mt-1 block w-full" id="password" name="password" type="password" required autocomplete="off" />

			<x-input-error class="mt-2" :messages="$errors->get('password')" />
		</div>

		<!-- Password -->
		<div class="mt-4">
			<x-input-label for="confirm_password" value="Passwort bestätigen" />

			<x-text-input class="mt-1 block w-full" id="confirm_password" name="confirm_password" type="password" required
				autocomplete="off" />

			<x-input-error class="mt-2" :messages="$errors->get('confirm_password')" />
		</div>

		<div class="mt-4 flex items-center justify-end">
			<x-primary-button class="ml-3">Registrieren</x-primary-button>
		</div>
	</form>
</x-guest-layout>
