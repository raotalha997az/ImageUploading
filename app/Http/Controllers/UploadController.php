<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use Validator;
use App\Models\Folder;
use App\Models\Upload;
use App\Models\Picture;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    $validator = Validator::make($request->all(), [
        'folder_name' => 'required',
        'uploads.*' => 'required|file',
    ]);
    // $request->validate([
    //     'folder_name' => 'required',
    //     'uploads.*' => 'required|file', // Note the asterisk (*) to validate an array of files
    // ]);

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
    $folder = Folder::find($id);

    if(!$folder){
        return abort(404);
    }

    // Retrieve images associated with the folder
    $images = Picture::where('folder_id', $id)->get();
    $folders = Folder::where('id', $id)->latest()->first();
    $foldersall = Folder::where('id','!=',$id)->get();

    return view('imagefile', compact('images','folders','foldersall','folder'));
}

public function Move(Request $request){
    $new_folder = Folder::where('id',$request->folder_id)->pluck('folder_name');
    // dd($request);
    foreach($request->pictures as $picture){
        Picture::where('id',$picture)->update([
            'folder_id' => $request->folder_id
        ]);

        $picture_name = Picture::where('id', $picture)->pluck('picture_name');


        $sourceFolder = "storage/{$request->old_folder}";
        $targetFolder = "storage/{$new_folder}"; 
    
        // Check if the source folder exists
        if (File::exists($sourceFolder)) {
            // Get a list of all files in the source folder
            $files = File::allFiles($sourceFolder);
    
            // Move each file to the target folder
            foreach ($files as $file) {
                $newFilePath = "{$targetFolder}/{$picture_name}";
                $cleanFolderName = str_replace(['[', ']', '&quot;'], '',$new_folder);
                File::move($file->getPathname(), $newFilePath);
            }
        } 
        
    }


    return to_route('folders');
}
public function Foldercreate(Request $request) {
//   dd($request);  
  $validator = Validator::make($request->all(), [
    'folder_name' => 'required',
]);

$folderName = $request->input('folder_name');
$folderPath = public_path("storage/$folderName");
if (!File::exists($folderPath)) {
    File::makeDirectory($folderPath, 0777, true, true);
}
    $folder = Folder::create([
        'folder_name' => $folderName,     
    ]);
    return to_route('folders');
}

}
