<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class RegistrationController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        $classes = DB::table('classes')->get();
        return view('auth.register', ['classes' => $classes]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegistrationRequest $request): RedirectResponse
    {
        $request->validate($request->rules());

        if (!str_ends_with($request->email, 'schmieders.dev')) {
            throw ValidationException::withMessages([
                'email' => 'Bitte benutze deine Schul-E-Mail-Adresse',
            ]);
        }

        if (DB::table('users')->where('email', '=', $request->email)->exists()) {
            throw ValidationException::withMessages([
                'email' => 'Du hast dich bereits registriert. Bitte setze dein Passwort zurück, falls du dich nicht anmelden kannst.',
            ]);
        }

        if (!isset($request->classes) || count($request->classes) === 0) {
            throw ValidationException::withMessages([
                'classes' => 'Bitte wähle mindestens eine Klasse.',
            ]);
        }

        $isTeacher = str_ends_with($request->email, '@schmieders.de');

        $role = DB::table('roles')
            ->select('id')
            ->where('name', '=', $isTeacher ? 'Lehrer*in' : 'Schüler*in')
            ->first()->id;

        $uid = DB::table('users')
            ->insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $role,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);

        DB::table('questions')
            ->insertOrIgnore([
                'user' => $uid,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);

        $classes = DB::table('classes')
            ->whereIn('name', $request->classes)
            ->get();

        foreach ($classes as $class) {
            DB::table('user_class')
                ->insert([
                    'user' => $uid,
                    'class' => $class->id
                ]);
        }

        if (!Auth::attempt($request->only('email', 'password'), true)) {
            return redirect()->route('login')->with('session', 'Dein Account wurde erstellt. Bitte melde dich jetzt an.');
        }

        Auth::user()->sendEmailVerificationNotification();

        return redirect()->route('form');
    }
}
