<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.user');
    }

    public function store(StoreUserRequest $request)
    {
        $email = $request->email;
        $name = $request->name;
        $isAdmin = $request->is_admin;
        $userNotExist = User::query()->where('email', $email)->doesntExist();

        if ($userNotExist) {
            $password =Str::random(8);
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'is_admin' => $isAdmin,
            ]);

            event(new UserCreated($user, $password));

            return redirect('/');
        }

        return response()->json(['error' => 'такой пользователь уже существует']);
    }
}
