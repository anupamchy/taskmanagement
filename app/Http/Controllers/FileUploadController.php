<?php
namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([

            'files.*' =>
            'required|mimes:jpg,jpeg,png,pdf|max:2048',

        ]);

        $uploadedFiles = [];

        foreach ($request->file('files') as $file) {

            // STORE FILE
            $path = $file->store(
                'uploads',
                'public'
            );

            // STORE DB
            $saved = FileUpload::create([

                'user_id'   => auth()->id(),

                'file_name' =>
                $file->getClientOriginalName(),

                'file_path' => $path,

            ]);

            $uploadedFiles[] = [

                'id'   => $saved->id,

                'name' => $saved->file_name,

                'path' => asset(
                    'storage/' . $saved->file_path
                ),

            ];
        }

        return response()->json($uploadedFiles);
    }
}
