<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\address;
use App\Models\cities;
use App\Models\districts;
use App\Models\provinces;
use App\Models\villages;
use Exception;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class AlamatController extends Controller
{
    public function indexcities() {
        try {

        $data = cities::all();

        return ResponseFormatter::success([
            // 'access_token' => $toketResult,
            // 'token_type' => 'Bearer',
            'data' => $data
        ], 'Get data success');

    } catch (Exception $error) {
        // Return error response

        return ResponseFormatter::error($error->getMessage());
    }
}



public function indexprovinces() {
    try {

        $data = provinces::all();

        return ResponseFormatter::success([
            // 'access_token' => $toketResult,
            // 'token_type' => 'Bearer',
            'data' => $data
        ], 'Get data success');

    } catch (Exception $error) {
        // Return error response

        return ResponseFormatter::error($error->getMessage());
    }

}

public function indexvillages() {
    try {

        $data = villages::all();

        return ResponseFormatter::success([
            // 'access_token' => $toketResult,
            // 'token_type' => 'Bearer',
            'data' => $data
        ], 'Get data success');

    } catch (Exception $error) {
        // Return error response

        return ResponseFormatter::error($error->getMessage());
    }

}

public function indexdistricts() {
    try {

        $data = districts::all();

        return ResponseFormatter::success([
            // 'access_token' => $toketResult,
            // 'token_type' => 'Bearer',
            'data' => $data
        ], 'Get data success');

    } catch (Exception $error) {
        // Return error response

        return ResponseFormatter::error($error->getMessage());
    }
}

public function indexaddress() {
    try {

    $data = address::all();

    return ResponseFormatter::success([
        // 'access_token' => $toketResult,
        // 'token_type' => 'Bearer',
        'data' => $data
    ], 'Get data success');

} catch (Exception $error) {
    // Return error response

    return ResponseFormatter::error($error->getMessage());
}
}


public function createaddress(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'province_code' => ['required', 'string', 'max:255'],
                'city_code' => ['required', 'string', 'max:255'],
                'district_code' => ['required', 'string', 'max:255'],
                'villages_code' => ['required', 'string', 'max:255'],
                'title' => ['required', 'string', 'max:255'],
                'detail_address' => ['required', 'string', 'max:255'],
            ]);

            // Create user

                $user = address::create([
                    // 'code' => $request->code,
                    'province_code' => $request->province_code,
                    'city_code' => $request->city_code,
                    'district_code' => $request->district_code,
                    'villages_code' => $request->villages_code,
                    'title' => $request->title,
                    'detail_address' => $request->detail_address
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


    public function update(Request $request)
    {

        address::where('id' , $request->id)->update(
            [
                'province_code' => $request->province_code,
                'city_code' => $request->city_code,
                'district_code' => $request->district_code,
                'villages_code' => $request->villages_code,
                'title' => $request->title,
                'detail_address' => $request->detail_address
        ]
        );
        $address = address::where('id', $request->id)->first();
    return ResponseFormatter::success([
            // 'access_token' => $toketResult,
            // 'token_type' => 'Bearer',
            'data' => $address
        ], 'Update success');
    }

    public function destroy(Request $request)
    {
        try {
            // Validate request
            //delete image

           $add =  address::where("id", $request->id);
           $arr =$request->id;
        if ($add) {
            return ResponseFormatter::error([
            'message' => "id tidak ditemukan"
            ], 'Delete failed');
        }

        else {

        }

           $add->delete();



        //delete post

            // Generate token
            // $toketResult = $user->createToken('authToken')->plainTextToken;

            // Return response
            return ResponseFormatter::success([
                // 'access_token' => $toketResult,
                // 'token_type' => 'Bearer',
                'user' => $add
            ], 'Delete success');

        } catch (Exception $error) {
            // Return error response

            return ResponseFormatter::error($error->getMessage());
        }
    }

    }
