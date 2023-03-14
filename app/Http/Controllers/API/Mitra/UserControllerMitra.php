<?php

namespace App\Http\Controllers\API\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserControllerMitra extends Controller
{

    public function view(Request $request)
    {
        try {

            $user = User::where('roles_id', 'like', '%' . 3 . '%');

            return ResponseFormatter::success([
                'data' => $user->paginate(10)
            ], 'View Success');

        } catch (Exception $error) {
            // Return error response
            return ResponseFormatter::error($error->getMessage());
        }
    }

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
                    'roles_id' => 3,
                    'status_user' => 'Aktif'
                ]);
         
            // Return response
            return ResponseFormatter::success([
                'user' => $user
            ], 'Create User success');

        } catch (Exception $error) {
            // Return error response

            return ResponseFormatter::error($error->getMessage());
        }
    }
    public function update(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'id' => ['required', 'integer'],
                'name' => ['string', 'max:255'],
                'email' => ['string', 'email', 'max:255', 'unique:users'],
                'password' => ['string', 'min:8'],
                'gender' => ['string'],
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $params['photo'] = $image->store('public/image');
                $user = User::where('id', $request->id)->first();
                Storage::delete('public/image/' . $user->image);
                //print($image->store('public/image'));
                $params = [
                    'photo' => $image->store('public/image'),
                ];

                $user = User::find($request->id);
                // Update user
                $user->update([
                    'photo' => $image->store('public/image'),
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'gender' => $request->gender,
                ]);

                // Return response
                return ResponseFormatter::success([
                    'user' => $user
                ], 'Create User success');
            }

        } catch (Exception $error) {
            // Return error response

            return ResponseFormatter::error($error->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            // find id user
            $user = User::find($request->id);

            if (!$user) {
                throw new Exception('User not found');
            }
            //delete user
            $user->delete();

            return ResponseFormatter::success('Delete success');

        } catch (Exception $error) {
            // Return error response

            return ResponseFormatter::error($error->getMessage());
        }
    }
}