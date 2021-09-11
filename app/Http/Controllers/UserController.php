<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function show(User $user)
    {
        $backgroundColor = $user->background_color;
        $textColor = $user->text_color;

        $user->load('links');

        return view('users.show', [
            'user' => $user,
            'backgroundColor' => $backgroundColor,
            'textColor' => $textColor
        ]);
    }

    public function edit()
    {
        return view('users.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        //always want a full Hexadecimel, e.g. #ff00ff
        $request->validate([
            'background_color' => 'required|size:7|starts_with:#',
            'text_color' => 'required|size:7|starts_with:#'
        ]);

        Auth::user()->update($request->only(['background_color', 'text_color']));

        return redirect()->back()->with(['success' => 'Changes saved successfully!']);
    }

}
