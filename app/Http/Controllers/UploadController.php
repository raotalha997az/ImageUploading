<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use App\Models\Folder;
use App\Models\Upload;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Picture;
use Illuminate\Support\Facades\File;


class UploadController extends Controller
{
public function upload(Request $request){
    $inputfolder = $request->input('file_name');
    dd($inputfolder);
    $folder = Folder::create([
        'folder_name' => $request->file_name,
        'path_name' => $request->file_name,
    ]);
    foreach($request->pictures as $picture){
        Picture::created([
            'picture_name' => $picture['name'],
            'folder_id' => $folder->id,
        ]);
    }
}

public function  index(){
    return view('sampleupload');
}


public function uploading(Request $request)
 {   
    // dd($request);
    $request->validate([
        'folder_name' => 'required',
        'uploads.*' => 'required|file', // Note the asterisk (*) to validate an array of files
    ]);

    $folderName = $request->input('folder_name');

    $folderPath = public_path("storage/$folderName");
    if (!File::exists($folderPath)) {
        File::makeDirectory($folderPath, 0777, true, true);
    }

    $uploadedFiles = $request->file('uploads');

    foreach ($uploadedFiles as $file) {
        $fileName = $file->getClientOriginalName();
        $file->move($folderPath, $fileName);
    }

    return redirect()->back()->with('success', 'Files uploaded successfully.');
}

}
