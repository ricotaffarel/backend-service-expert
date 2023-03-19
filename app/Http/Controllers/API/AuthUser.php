<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthUser extends Controller
{

    public function login(Request $request)
    {
        try {
            // Validate request

            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // Find user by email
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error('Unauthorized', 401);
            }

            $user = User::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password)) {
                throw new Exception('Invalid password');
            }

            // Generate token
            $toketResult = $user->createToken('authToken')->plainTextToken;

            // Return response
            return ResponseFormatter::success([
                'access_token' => $toketResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Login success');
        } catch (Exception $error) {
            return ResponseFormatter::error('Authentication Failed');
        }
    }

    public function loginpegawai(Request $request)
    {
        try {
            // Validate request

            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            // // Find user by email
            // $credentials = request(['email', 'password']);
            // if (!Auth::attempt($credentials)) {
            //     return ResponseFormatter::error('Unauthorized', 401);
            // }

            $user = Pegawai::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password)) {
                throw new Exception('Invalid password');
            }

            // Generate token
            $toketResult = $user->createToken('authToken')->plainTextToken;

            // Return response
            return ResponseFormatter::success([
                'access_token' => $toketResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Login success');
        } catch (Exception $error) {
            return ResponseFormatter::error('Authentication Failed');
        }
    }

    public function register(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'gender' => ['required', 'string'],
                'roles_id' => ['required', 'gte:2', 'lte:4', 'integer']
            ]);

            if ($request->roles_id == 2) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'gender' => $request->gender,
                    'roles_id' => $request->roles_id,
                    'status_user' => 'Pending'
                ]);
            } else if ($request->roles_id == 4) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'gender' => $request->gender,
                    'roles_id' => $request->roles_id,
                    'status_user' => 'Aktif'
                ]);
            } else {
                return ResponseFormatter::error('Register failed');
            }
            return ResponseFormatter::success([
                'user' => $user
            ], 'Register success');
        } catch (Exception $error) {
            // Return error response
            return ResponseFormatter::error($error->getMessage());
        }
    }

    public function logout(Request $request)
    {
        // Revoke Token
        $token = $request->user()->currentAccessToken()->delete();

        // Return response
        return ResponseFormatter::success($token, 'Logout success');
    }

    public function fetch(Request $request)
    {
        // Get user
        $user = $request->user();

        // Return response
        return ResponseFormatter::success($user, 'Fetch success');
    }


    public function update(Request $request)
    {
        //define validation rules
        $auth = $request->user();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $params['photo'] = $image->store('public/image');
            $user = User::where('id', $auth->id)->first();
            Storage::delete('public/image/' . $user->image);
            //print($image->store('public/image'));
            $params = [
                'photo' => $image->store('public/image'),
            ];

            User::where('id', $user->id)->update(
                [
                    'photo' => $image->store('public/image'),
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'gender' => $request->gender,
                ]
            );
        }

        return ResponseFormatter::success([
            'user' => $user
        ], 'Update success');
    }
}
