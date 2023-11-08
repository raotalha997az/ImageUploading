<?php

namespace App\Http\Controllers;

use Auth;
// use Storage;

use App\Models\Folder;
use App\Models\Upload;
use App\Models\Picture;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;




class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $inputfolder = $request->input('file_name');
    
        $folder = Folder::create([
            'folder_name' => $request->file_name,
            'path_name' => $request->file_name,
        ]);
        foreach ($request->pictures as $picture) {
            Picture::created([
                'picture_name' => $picture['name'],
                'folder_id' => $folder->id,
            ]);
        }
    }

    public function  index()
    {
        return view('sampleupload');
    }


    public function uploading(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'folder_name' => 'required',
            'uploads.*' => 'required|mimes:jpeg,png,gif',
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
            $fileName = $random . $fileName1;
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


    public function show()
    {

        $folders = Folder::where('main_folder_id',0)->get();
        return view('folder', compact('folders'));
    }


    public function foldersimgshow($id)
    {
        $folder = Folder::find($id);

        // dd($folder->main_folder_id);
        $main_folder = Folder::where('id',$folder->main_folder_id)->first();
        if (!$folder) {
            return abort(404);
        }

        // Retrieve images associated with the folder
        $images = Picture::where('folder_id', $id)->get();
        $folders = Folder::where('id', $id)->latest()->first();
        $foldersall = Folder::where('id', '!=', $id)->get();
        $subfolders = Folder::where('main_folder_id',$id)->get();
        // $SubFolders = Folder::where('main_folder_id' , $id);
            return view('imagefile', compact('images', 'folders', 'foldersall', 'folder','subfolders','main_folder'));
    }

    
    public function Foldercreate(Request $request)
    {   
        $folderId = $request->folder_id;

        //   dd($request);  
        $validator = Validator::make($request->all(), [
            'folder_name' => 'required',
        ]);

        $folderName = trim($request->input('folder_name'));
        // $folderPath = public_path("storage/$folderName");
        $folderPath = public_path("$folderName");
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0777, true, true);
        }
        $folder = Folder::create([
            'folder_name' => $folderName,
        ]);
        return redirect()->back()->with('success', 'Folder Created.');

    }

    // Delete iamge
    public function delete(Request $request)
    {   
        $id = $request->input('picture_id');
        $image = Picture::where('id',$request->picture_id)->first();
        $fileName = $image->picture_name;
        
        // dd($fileName);

        $new_folder = Folder::where('id', $request->folder_id)->first();


        if($new_folder->main_folder_id == 0){
            $folderPath = public_path("$new_folder->folder_name");
            $folderPath2 = ("/".$new_folder->folder_name);
        }
        else{
            $parent1 = Folder::where('id',$new_folder->main_folder_id)->first();
            if($parent1->main_folder_id == 0){
                
                $folderPath = public_path($parent1->folder_name."/".$new_folder->folder_name);
                $folderPath2 = ($parent1->folder_name."/".$new_folder->folder_name);
            }else{
                if($parent1->main_folder_id == 0){
                    $folderPath = public_path($parent1->folder_name."/".$new_folder->folder_name);
                    $folderPath2 = ($parent1->folder_name."/".$new_folder->folder_name);
                }else{
                    if($parent1->main_folder_id != 0){
                        $parent2 = Folder::where('id',$parent1->main_folder_id)->first();
                        if($parent2->main_folder_id == 0){
                            $folderPath = public_path($parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);
                            $folderPath2 = ($parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);
                        }else{
                            if($parent2->main_folder_id != 0){
                                $parent3 = Folder::where('id',$parent2->main_folder_id)->first();
                                if($parent3->main_folder_id == 0){
                                    $folderPath = public_path($parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);
                                    $folderPath2 = ($parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);
                                }else{
                                    if($parent3->main_folder_id == 0){
                                        $folderPath = public_path($parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);
                                        $folderPath2 = ($parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);
                                    }else{
                                        $parent4 = Folder::where('id',$parent3->main_folder_id)->first();
                                        if($parent4->main_folder_id == 0){
                                            $folderPath = public_path($parent4->folder_name."/".$parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);                                                
                                            $folderPath2 = ($parent4->folder_name."/".$parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);                                                
                                        }
                                        else{
                                            $parent5 = Folder::where('id',$parent4->main_folder_id)->first();
                                            if($parent5->main_folder_id == 0)
                                            {
                                                $folderPath = public_path($parent5->folder_name."/".$parent4->folder_name."/".$parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);                                                
                                                $folderPath2 = ($parent5->folder_name."/".$parent4->folder_name."/".$parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);                                                
                                            }
                                            else{
                                                $folderPath = public_path($parent5->folder_name."/".$parent4->folder_name."/".$parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);                                                
                                                $folderPath2 = ($parent5->folder_name."/".$parent4->folder_name."/".$parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);                                                
                                            }}}}}}}}}}
        // $folderPath = public_path("storage/$folderName");
        // $folderPath = public_path("$folderName");
        // dd($folderPath);
        File::delete("$folderPath/$fileName");
        
        $image->delete();
    
   

        return redirect()->back()->with('success', 'Image deleted successfully');
    } 

 




    public function insertImage(Request $request)
    {
        $folder = Folder::where('id', $request->folder_id)->first();
    
       
            $new_folder = Folder::where('id', $request->folder_id)->pluck('folder_name')->first();
    
            // Validate the request
            $validator = Validator::make($request->all(), [
                'folder_name' => 'required',
                'uploads.*' => 'required|file',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
    
            $new_folder = Folder::where('id', $request->folder_id)->first();
            if($new_folder->main_folder_id == 0){
                $folderPath = public_path("$new_folder->folder_name");
                $folderPath2 = ($new_folder->folder_name);
            }
            else{
                $parent1 = Folder::where('id',$new_folder->main_folder_id)->first();
                if($parent1->main_folder_id == 0){
                    
                    $folderPath = public_path($parent1->folder_name."/".$new_folder->folder_name);
                    $folderPath2 = ($parent1->folder_name."/".$new_folder->folder_name);
                    // dd($folderPath2);

                }else{
                    if($parent1->main_folder_id == 0){
                        $folderPath = public_path($parent1->folder_name."/".$new_folder->folder_name);
                        $folderPath2 = ($parent1->folder_name."/".$new_folder->folder_name);
                    }else{
                        if($parent1->main_folder_id != 0){
                            $parent2 = Folder::where('id',$parent1->main_folder_id)->first();
                            if($parent2->main_folder_id == 0){
                                $folderPath = public_path($parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);
                                $folderPath2 = ($parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);
                            }else{
                                if($parent2->main_folder_id != 0){
                                    $parent3 = Folder::where('id',$parent2->main_folder_id)->first();
                                    if($parent3->main_folder_id == 0){
                                        $folderPath = public_path($parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);
                                        $folderPath2 = ($parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);
                                    }else{
                                        if($parent3->main_folder_id == 0){
                                            $folderPath = public_path($parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);
                                            $folderPath2 = ($parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);
                                        }else{
                                            $parent4 = Folder::where('id',$parent3->main_folder_id)->first();
                                            if($parent4->main_folder_id == 0){
                                                $folderPath = public_path($parent4->folder_name."/".$parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);                                                
                                                $folderPath2 = ($parent4->folder_name."/".$parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);                                                
                                            }
                                            else{
                                                $parent5 = Folder::where('id',$parent4->main_folder_id)->first();
                                                if($parent5->main_folder_id == 0)
                                                {
                                                    $folderPath = public_path($parent5->folder_name."/".$parent4->folder_name."/".$parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);                                                
                                                    $folderPath2 = ($parent5->folder_name."/".$parent4->folder_name."/".$parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);                                                
                                                }
                                                else{
                                                    $folderPath = public_path($parent5->folder_name."/".$parent4->folder_name."/".$parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);                                                
                                                    $folderPath2 = ($parent5->folder_name."/".$parent4->folder_name."/".$parent3->folder_name."/".$parent2->folder_name."/".$parent1->folder_name."/".$new_folder->folder_name);                                                
                                                }}}}}}}}}}

    
            // if (!File::isDirectory($folderPath)) {
            //     File::makeDirectory($folderPath, 0777, true, true);
            // }
    
            $currentURL = url('/');
            $uploadedFiles = $request->file('uploads');
    
            if ($uploadedFiles) {
                $folderId = $request->input('folder_id');
    
                // Initialize the image counter from session or cache
                $imageCounter = session()->get('imageCounter', 1);
    
                foreach ($uploadedFiles as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = "image$imageCounter.$extension";
    
                    // Increment the counter for the next image
                    $imageCounter++;
    
                    $file->move($folderPath, $fileName);
                    // http://127.0.0.1:8000/pp/pp1/Left%20Winger/Branch%20of%20Left%20Weigner/image32.jpeg
                    // dd($folderPath);
                    $folderpathtrim = trim($folderPath2);
                    $picture = new Picture();
                    $picture->picture_name = $fileName;
                    $picture->path_name = "/$folderPath2/$fileName";
                    $picture->folder_id = $folderId;
                    $picture->save();
                }
    
                // Store the updated image counter in session or cache
                session(['imageCounter' => $imageCounter]);
            }

       
        
            return redirect()->back()->with('success', 'Files uploaded successfully.');
        }
  

    public function foldersdestroy(Request $request)
    {
   
    $folderId = $request->input('folder_id');
    $folder = Folder::find($folderId);
    $folder = Folder::where('id',$request->folder_id)->first();
    if (!$folder) {
        return redirect()->back()->with('success', 'Folder not found');
    }

    // Delete Main Folder code
    if ($folder->main_folder_id == 0) {
        $folderName = $folder->folder_name;
        // $folderPath = public_path("storage/$folderName");
        $folderPath = public_path("$folderName");

        // Delete the folder from the database
        $folder->delete();

        // Check if the folder actually exists in storage and delete it
        if (File::exists($folderPath)) {
            File::deleteDirectory($folderPath);
        } else {
            return redirect()->back()->with('success', 'Folder not found in storage');
        }
    } elseif ($folder->main_folder_id != 0) {
        $parentfolder = Folder::where('id', $folder->main_folder_id)->pluck('folder_name')->first();
        $new_folder = Folder::where('id', $request->folder_id)->pluck('folder_name')->first();

        if (!$folder) {
            return redirect()->back()->with('success', 'Folder not found');
        }

        $folderName = $folder->folder_name;
        
        // $folderPath = public_path("storage/$parentfolder/$folderName");
        $folderPath = public_path("$parentfolder/$folderName");
        $folder->delete();
        if (File::exists($folderPath)) {
            File::deleteDirectory($folderPath);
        } else {
            return redirect()->back()->with('success', 'Folder deleted successfully');
        }
        $folder->delete();
    }

    return redirect()->back()->with('success', 'Folder deleted successfully');
}




}
