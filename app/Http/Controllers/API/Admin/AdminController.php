<?php

namespace App\Http\Controllers\API\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){
    $user = User::where('id', 3)->first();
        $data[] = [
        ];
        return ResponseFormatter::success([
            // 'access_token' => $toketResult,
            // 'token_type' => 'Bearer',
            'user' => $data
        ], 'Update success');

    }

    public function updates(Request $request)
    {
        $auth = $request->user();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $user = User::where('id', $auth->id)->first();
            $path = public_path('storage/image/'.$user->image);

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);

            $filename = $user->image;
            $folder = '/storage/image/' . 'storage/image/'.$user->image;

            $check = public_path($folder) . $filename;

            if (File::exists($check)) {
                File::delete($check);
            }

            $filePath = $image->update($folder, $filename, 'public');


            return ResponseFormatter::success([
                // 'access_token' => $toketResult,
                // 'token_type' => 'Bearer',
                'user' => $user,
                'file' => $filePath
            ], 'Update success');


        }
    }
    }
    // public function update(Request $request) {

    //     if ($request->file("gambar")) {
    //         if ($request->gambar_lama) {
    //             Storage::delete($request->gambar_lama);
    //         }

    //         $data = $request->file("gambar")->store("artikel");
    //     } else {
    //         $data = $request->gambar_lama;
    //     }

    //     Produk::where("id", $request->id)->update([
    //     "gambar" => $data,
    //     "nama_produk" => $request->nama_produk,
    //     "id_unit" => $request->id_unit,
    //     "harga_produk" => $request->harga_produk,
    //     "id_kategori" => $request->id_kategori,
    //     ]);
    //     return redirect("/produk")->with('message','Data Berhasil Diubah');
    // }


    public function update(Request $request)
    {
       //define validation rules
       $auth = $request->user();
       // $request->validate([
       //     'name' => ['required', 'string', 'max:255'],
       //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
       //     'password' => ['required', 'string', 'min:8'],
       //     'gender' => ['required', 'string'],
       //     'roles_id' => ['required', 'gte:2', 'lte:4', 'integer']
       // ]);

       // dd($request);


       if ($request->hasFile('image')) {
           $image = $request->file('image');
           $params['photo'] = $image->store('public/image');





           $user = User::where('id', $auth->id)->first();
           Storage::delete('public/image/'.$user->image);
           //print($image->store('public/image'));
           $params = [
               'photo' => $image->store('public/image'),
               // 'name' => $request->name,
               // 'email' => $request->email,
               // 'password' => Hash::make($request->password),
               // 'gender' => $request->gender,
               // 'roles_id' => $request->roles_id,
               // 'status_user' => 'Tidak Aktif'
           ];

           User::where('id' , $user->id)->update(
               [
               'photo' => $image->store('public/image'),
               'name' => $request->name,
               'email' => $request->email,
               'password' => Hash::make($request->password),
               'gender' => $request->gender,
               'roles_id' => $request->roles_id,
               'status_user' => 'Tidak Aktif'
           ]
           );

       }
       // if ($request->hasFile('image')) {

       //     //upload image
       //     $image = $request->file('image');
       //     $image->storeAs('public/image', $image->hashName());

       //     //delete old image
       //     Storage::delete('public/image/'.$user->image);

       //     //update post with new image
       //     $user->update([
       //         'image'     => $image->hashName(),
       //         'title'     => $request->title,
       //         'content'   => $request->content,
       //     ]);

       // } else {

       //     //update post without image
       //     $user->update([
       //         'title'     => $request->title,
       //         'content'   => $request->content,
       //     ]);
       // }

       //check if validation fails

           // $user->update([
           //     'photo' => $params['photo']
           // ]);

       //check if image is not empty


       //return response
       //return new ResponseFormatter(true, 'Data Post Berhasil Diubah!', $user);

       return ResponseFormatter::success([
               // 'access_token' => $toketResult,
               // 'token_type' => 'Bearer',
               'user' => $user
           ], 'Update success');

       }


}
