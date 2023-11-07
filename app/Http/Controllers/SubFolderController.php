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

        $parentAll2 = Folder::where('id',$parentFolder->main_folder_id)->first();

        if ($parentFolder->main_folder_id == 0) {
            $folderPath = public_path("{$parentFolder->folder_name}/{$folderInput}");
        }
         elseif($parentAll2->main_folder_id != 0) {
            $parentAll = Folder::where('id', $parentFolder->main_folder_id)->first();
            if($parentAll->main_folder_id != 0){
                $parentFolderMain = Folder::where('id',$parentAll->main_folder_id)->first();
                $folderPath = public_path("{$parentFolderMain->folder_name}/{$parentAll->folder_name}/{$parentFolder->folder_name}/{$folderInput}");
            }else{
                $folderPath = public_path("{$parentAll->folder_name}/{$parentFolder->folder_name}/{$folderInput}");
            }

            File::makeDirectory($folderPath, 0777, true, true);
            Folder::create([
                'folder_name' => $folderInput,
                'main_folder_id' => $parentFolder->id
            ]);
        }
        else{
            $mainParent = Folder::where('id', $parentAll2->main_folder_id)->first();
            if($mainParent){
                $folderPath = public_path("{$mainParent->folder_name}/{$parentAll2->folder_name}/{$parentFolder->folder_name}/{$folderInput}");
            }else{
                $folderPath = public_path("{$parentAll2->folder_name}/{$parentFolder->folder_name}/{$folderInput}");
            }
        }
        if (File::exists($folderPath)) {
            return redirect()->back()->with('error', 'Subfolder already exists');
        }
    
        File::makeDirectory($folderPath, 0777, true, true);
    
        Folder::create([
            'folder_name' => $folderInput,
            'main_folder_id' => $parentFolder->id
        ]);
    
        return redirect()->back()->with('success', 'Subfolder Created.');
    }
    
        
    
}
