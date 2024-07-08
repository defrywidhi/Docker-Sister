<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
       //REGSITER
    public function register(Request $request){
           $validator = Validator::make($request->all(), [
               'name' => 'required|string|max:255',
               'email' => 'required|string|max:255|unique:users',
               'password' => 'required|string|min:8'
           ]);
   
           if ($validator->fails()) {
               return response()->json([
                   'success' => false,
                   'message' => 'Validation failed',
                   'errors' => $validator->errors()
               ], 422);
           }
   
           try {
               $user = User::create([
                   'name' => $request->name,
                   'email' => $request->email,
                   'password' => Hash::make($request->password)
               ]);

            //    $token = $user->createToken('auth_token')->plainTextToken;
               return response()->json([
                   'success' => true,
                   'message' => 'User registered successfully',
                   'data' => $user,
                //    'access_token' => $token,
               ], 201); // Created
           } catch (\Exception $e) {
               return response()->json([
                   'success' => false,
                   'message' => 'Registration failed',
                   'error' => $e->getMessage()
               ], 500); // Internal Server Error
           }
    }

    // // REGISTER WEB
    //         public function showRegistrationForm()
    //     {
    //         return view('auth.register');
    //     }



    //LOGIN
    public function login(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => 'failed',
                    'messages' => $validator->errors()
                ], 422);
            }

            $user = User::where('email', $request->email)->first();

            // Verifikasi password menggunakan Hash::check
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    "status" => 'failed',
                    "message" => 'Email atau Password Salah',
                    "data" => []
                ], 400);
            }

            // Buat token untuk pengguna
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                "status" => 'success',
                "message" => 'Data ditemukan',
                "data" => [
                    'user' => $user,
                    'token' => $token,
                ],
            ], 200);
            
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => $th->getMessage(),
                "data" => [],
            ], 500);
        }
    }


    // // LOGIN FORM WEB
    //         public function showLoginForm()
    //     {
    //         return view('auth.login');
    //     }

 

    //LOGOUT
    public function logout(Request $request){
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'status' => 'Aman',
                'message' => 'Logout successful'
            ], 202);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Gagal',
                'message' => 'Logout failed',
                'error' => $e->getMessage() 
            ], 500); 
        }
    }

    // // LOGOUT WEB
    // public function webLogout()
    // {
    //     Auth::logout();
    
    //     return redirect('/');
    // }


   // FORGOT PASSWORD
    public function forgotPassword(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            // Jika validasi gagal
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Kirim link reset password
            $status = Password::sendResetLink($request->only('email'));

            // Tanggapan berdasarkan status pengiriman link
            return $status === Password::RESET_LINK_SENT
                ? response()->json([
                    'success' => true,
                    'message' => 'Reset password link sent successfully.'
                ], 200)
                : response()->json([
                    'success' => false,
                    'message' => 'Failed to send reset password link.'
                ], 500);
        } catch (\Exception $e) {
            // Tangani kesalahan umum
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while sending the reset password link.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // // FORGOT PASSWORD WEB
    //         public function showForgotPasswordForm()
    //     {
    //         return view('auth.passwords.email');
    //     }


   // RESET PASSWORD
    public function resetPassword(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Jika validasi gagal
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Reset password
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->password = Hash::make($password);
                    $user->save();
                }
            );

            // Tanggapan berdasarkan status reset password
            return $status === Password::PASSWORD_RESET
                ? response()->json(['success' => true, 'message' => 'Password reset successfully.'])
                : response()->json(['success' => false, 'message' => 'Failed to reset password.'], 500);
        } catch (\Exception $e) {
            // Tangani kesalahan umum
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while resetting the password.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // // RESET PASSWORD WEB
    //         public function showResetPasswordForm($token)
    //     {
    //         return view('auth.passwords.reset', ['token' => $token]);
    //     }

    

}





