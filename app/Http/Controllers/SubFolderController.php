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
    public function Subcreate(Request $request)  {
        $folderId = $request->folder_id;
        $folder = Folder::where('id', $request->folder_id)->pluck('folder_name')->first();
        // dd($folderinput); 
        $validator = Validator::make($request->all(), [
            'folder_name' => 'required',
        ]);
        
        $folderinput = trim($request->input('folder_name'));
        $folderPath = public_path("storage/$folder/$folderinput");
    
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0777, true, true);
        }
        $folder = Folder::create([
            'folder_name' => $folderinput,
            'main_folder_id'=> $folderId
        ]);
        return redirect()->back()->with('success', 'Sub Folder Created.');
    }
}
