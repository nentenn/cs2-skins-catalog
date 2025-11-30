<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $favoritesCount = $user->favorites()->count();

        return view('profile.index', [
            'user'           => $user,
            'favoritesCount' => $favoritesCount,
        ]);
    }
}
