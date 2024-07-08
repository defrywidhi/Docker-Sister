<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthWebController extends Controller
{


    public function showLoginForm()
    {
        return view('auth.login'); // Adjust the view name as per your application's structure
    }

     // Menampilkan form registrasi
     public function showRegistrationForm()
     {
         return view('auth.register');
     }

     public function showForgotPasswordForm()
    {
        return view('auth.passwords.email');
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }



    // REGISTER WEB
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);

            return redirect('/login'); // Ganti dengan halaman setelah registrasi berhasil
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Registration failed.'])->withInput();
        }
    }

    // LOGIN WEB
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect('/'); // Ganti dengan halaman setelah login berhasil
            }

            return redirect()->back()->withErrors(['message' => 'Invalid credentials.'])->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'Login failed.'])->withInput();
        }
    }

    // LOGOUT WEB
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the current session
        $request->session()->invalidate();

        // Clear the session data from the storage
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // FORGOT PASSWORD WEB
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? redirect()->back()->with(['message' => 'Reset password link sent successfully.'])
            : redirect()->back()->withErrors(['message' => 'Failed to send reset password link.']);
    }

    // RESET PASSWORD WEB
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect('/login')->with(['message' => 'Password reset successfully.'])
            : redirect()->back()->withErrors(['message' => 'Failed to reset password.']);
    }
}
