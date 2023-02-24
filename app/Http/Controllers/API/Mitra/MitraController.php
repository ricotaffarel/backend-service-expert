<?php

namespace App\Http\Controllers\API\Mitra;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MitraController extends Controller
{
    public function create(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'gender' => ['required', 'string'],
            ]);

            // Create user

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'gender' => $request->gender,
                    'roles_id' => 2,
                    'status_user' => 'Aktif'
                ]);

            // Generate token
            // $toketResult = $user->createToken('authToken')->plainTextToken;

            // Return response
            return ResponseFormatter::success([
                // 'access_token' => $toketResult,
                // 'token_type' => 'Bearer',
                'user' => $user
            ], 'Register success');

        } catch (Exception $error) {
            // Return error response

            return ResponseFormatter::error($error->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Validate request
            //delete image
            User::where("id", $id)->delete();

        //delete post

            // Generate token
            // $toketResult = $user->createToken('authToken')->plainTextToken;

            // Return response
            return ResponseFormatter::success([
                // 'access_token' => $toketResult,
                // 'token_type' => 'Bearer',
                //'user' => $user
            ], 'Delete success');

        } catch (Exception $error) {
            // Return error response

            return ResponseFormatter::error($error->getMessage());
        }
    }




}