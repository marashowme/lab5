<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Відображення списку зареєстрованих користувачів
     */
    public function index()
    {
        $users = User::query()->orderBy('name')->paginate(15);

        return view('users.index', compact('users'));
    }
}
