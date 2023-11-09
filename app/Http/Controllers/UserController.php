<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        // TASK: turn this SQL query into Eloquent
        // select * from users
        //   where email_verified_at is not null
        //   order by created_at desc
        //   limit 3

       $users = User::whereNotNull('email_verified_at')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();

        return view('users.index', compact('users'));
    }

    public function show($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            abort(404, 'User not found');
        }

        return view('users.show', compact('user'));
    }

    public function check_create($name, $email)
    {
        // TASK: find a user by $name and $email
        //   if not found, create a user with $name, $email and random password
        $user = User::firstOrNew(['name' => $name, 'email' => $email]);

        if (!$user->exists) {
            $user->password = bcrypt(Str::random(10));
            $user->save();
        }

        return view('users.show', compact('user'));
    }

    public function check_update($name, $email)
    {
        $user = User::firstOrNew(['name' => $name]);
        $user->email = $email;

        // If the user is new (not yet saved in the database), set a random password and save
        if (!$user->exists) {
            $user->password = bcrypt(Str::random(10));
            $user->save();
        } else {
            $user->save(); // If the user exists, update the email
        }

        return view('users.show', compact('user'));
    }

    public function destroy(Request $request)
    {
        // TASK: delete multiple users by their IDs
        // SQL: delete from users where id in ($request->users)
        // $request->users is an array of IDs, ex. [1, 2, 3]

        // Insert Eloquent statement here
        User::destroy($request->users);

        return redirect('/')->with('success', 'Users deleted');
    }

    public function only_active()
    {
        // TASK: That "active()" doesn't exist at the moment.
        //   Create this scope to filter "where email_verified_at is not null"
        $users = User::active()->get();

        return view('users.index', compact('users'));
    }

}
