<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users'      => User::count(),
            'products'   => Product::count(),
            'categories' => Category::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
