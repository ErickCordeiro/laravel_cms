<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    public function upload(Request $request)
    {

        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        //Alterando o nome do Arquivo
        $imageName = time() . '.' . $request->file->extension();

        $request->file->move(public_path('media/images'), $imageName);

        return [
            'location' => asset('media/images/' . $imageName)
        ];
    }
}
