<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.signin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'password' => 'required',
        ], [
            'identifier.required' => 'Ju lutem shkruani email-in ose emrin e përdoruesit.',
            'password.required' => 'Ju lutem shkruani fjalëkalimin.',
        ]);

        $identifier = $request->input('identifier');

        $credentials = filter_var($identifier, FILTER_VALIDATE_EMAIL)
            ? ['email' => $identifier, 'password' => $request->password]
            : ['username' => $identifier, 'password' => $request->password];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->roles->isEmpty()) {
                Auth::logout();
                return view('admin.auth.review');
            }

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'login' => 'Email ose fjalekalimi eshte gabim',
        ]);
    }





    public function showReviewPage()
    {
        return view('admin.auth.review'); // This view will display the message to the user
    }


    public function showSignupForm()
    {
        return view('admin.auth.signup');
    }

    public function signup(Request $request)
    {

        $request->validate([
            'name' => 'required|regex:/^[\pL\s]+$/u|string|max:255',
            'lastname' => 'required|regex:/^[\pL\s]+$/u|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ], [
            'name.required' => 'Ju lutem shkruani emrin ',
            'name.regex' => 'Emri mund të përmbajë vetëm shkronja dhe hapësira.',
            'lastname.required' => 'Ju lutem shkruani mbiemrin.',
            'lastname.regex' => 'Mbiemri mund të përmbajë vetëm shkronja dhe hapësira.',
            'username.required' => 'Ju lutem shkruani emrin perdorues.',
            'username.unique' => 'Ky username është tashmë i regjistruar. Ju lutem zgjidhni një tjetër.',
            'email.required' => 'Ju lutem shkruani email.',
            'email.unique' => 'Ky email është tashmë i regjistruar. Ju lutem zgjidhni një tjetër.',
            'password.required' => 'Ju lutem shkruani fjalëkalimin.',
        ]);

        User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Llogaria u krijua me sukses.Ju lutem kyquni.');
    }



    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
