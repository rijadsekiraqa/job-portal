<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('super-admin')) {
            $applications = Application::with(['user', 'user.companies'])->get();
        } else {
            $applications = Application::with(['user', 'user.companies'])
                ->where('user_id', $currentUser->id)
                ->get();
        }

        return view('admin.applications.index', compact('applications'));
    }

    public function show($id)
    {
        $application = Application::findOrFail($id);
        return view('admin.applications.view', compact('application'));
    }
}
