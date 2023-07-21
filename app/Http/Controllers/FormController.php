<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use function Ramsey\Uuid\v4;

class FormController extends Controller
{
    public function create(Request $request): View
    {
        $data = DB::table('questions')
            ->where('user', '=', $request->user()->id)
            ->first();

        return view('form', ['isTeacher' => $request->user()->isTeacher(), 'image' => $request->user()->image(), 'data' => $data]);
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

    public function createImage(Request $request)
    {
        return response()->file(storage_path('app/avatars') . '/' . $request->user()->image);
    }

    public function storeImage(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,heic,tiff,webp'
        ]);

        if ($request->user()->image) {
            File::delete(storage_path('app/avatars') . '/' . $data[0]->image);
        }

        $fileName = $request->file('image')->hashName();

        $request->image->move(storage_path('app/avatars'), $fileName);

        DB::table('users')
            ->where('id', '=', $request->user()->id)
            ->update([
                'image' => $fileName,
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);

        return response()->json();
    }
}
