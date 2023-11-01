<?php

namespace App\Http\Controllers;

use Auth;
// use Storage;
use Validator;
use App\Models\Folder;
use App\Models\Upload;
use App\Models\Picture;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SubFolderController extends Controller
{
    public function Subcreate(Request $request)
    {

        $folderId = $request->folder_id;
        $parentFolder = Folder::where('id', $folderId)->first();
    
        if (!$parentFolder) {
            return redirect()->back()->with('error', 'Parent folder not found');
        }
    
        $validator = Validator::make($request->all(), [
            'folder_name' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
    
        $folderInput = trim($request->input('folder_name'));
        $folderPath = public_path("storage/{$parentFolder->folder_name}/{$folderInput}");
    
        if (File::exists($folderPath)) {
            return redirect()->back()->with('error', 'Subfolder already exists');
        }
    
        File::makeDirectory($folderPath, 0777, true, true);
    
        $subFolder = Folder::create([
            'folder_name' => $folderInput,
            'main_folder_id' => $folderId
        ]);
    
        return redirect()->back()->with('success', 'Subfolder Created.');
    }
    
}
