<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class FormController extends Controller
{
    public function create(Request $request): View
    {
        $data = DB::table('questions')
            ->where('user', '=', $request->user()->id)
            ->first();

        return view('form', ['isTeacher' => $request->user()->isTeacher(), 'data' => $data]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->except(['_token']);
        $data['updated_at'] = Carbon::now()->toDateTimeString();

        DB::table('questions')
            ->where('user', '=', $request->user()->id)
            ->update($data);

        return redirect()->route('form')->with('status', 'Deine Änderungen wurden erfolgreich gespeichert.');
    }
}
