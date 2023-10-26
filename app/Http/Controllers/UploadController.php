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


// public function uploading(Request $request)
//  {   
//     // dd($request);
//     $request->validate([
//         'folder_name' => 'required',
//         'uploads.*' => 'required|file', // Note the asterisk (*) to validate an array of files
//     ]);

//     $folderName = $request->input('folder_name');

//     $folderPath = public_path("storage/$folderName");
//     if (!File::exists($folderPath)) {
//         File::makeDirectory($folderPath, 0777, true, true);
//     }

//     $uploadedFiles = $request->file('uploads');

//     foreach ($uploadedFiles as $file) {
//         $fileName = $file->getClientOriginalName();
//         $file->move($folderPath, $fileName);
//     }

//     return redirect()->back()->with('success', 'Files uploaded successfully.');
// }

public function uploading(Request $request)
{
    $request->validate([
        'folder_name' => 'required',
        'uploads.*' => 'required|file', // Note the asterisk (*) to validate an array of files
    ]);

    $folderName = $request->input('folder_name');
    $random = Str::random(15);
    $folderPath = public_path("storage/$folderName");
    if (!File::exists($folderPath)) {
        File::makeDirectory($folderPath, 0777, true, true);
    }

    $uploadedFiles = $request->file('uploads');
        $folder = Folder::create([
            'folder_name' => $folderName,     
        ]);
        $folderId = Folder::latest()->pluck('id')->first();
        foreach ($uploadedFiles as $file) {
            $fileName1 = $file->getClientOriginalName();
            $fileName = $random.$fileName1;
            $file->move($folderPath, $fileName);
            $fileType = $file->getClientOriginalExtension();
            // Get the current URL
            $currentURL = url('/');
            // return $folder->id;
            Picture::create([
            'picture_name' => $fileName,  
            'path_name' => "$currentURL/storage/$folderName/$fileName",    
            'folder_id' => $folderId,   
        ]);
    }
    return redirect()->route('folders')->with('success', 'Files uploaded successfully.');
}


public function show(){
    $folders = Folder::get();
    return view('folder', compact('folders')); 
}


public function foldersimgshow($id){
    // Retrieve the folder with the specified ID
    $folder = Folder::find($id);

    if(!$folder){
        return abort(404); // Handle the case where folder with the given ID is not found
    }

    // Retrieve images associated with the folder
    $images = Picture::where('folder_id', $id)->get();
    $folders = Folder::where('id', $id)->latest()->first();
    $foldersall = Folder::get();

    return view('imagefile', compact('images','folders','foldersall'));
}

}
