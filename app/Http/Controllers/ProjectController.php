<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        // Save the project for the logged-in user
        Auth::user()->projects()->attach($request->project_id, [
            'start_date' => $request->start_date,
        ]);

        return 'Success';
    }
}
