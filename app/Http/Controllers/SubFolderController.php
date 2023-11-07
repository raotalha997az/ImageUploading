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
    
        if($parentAll2 != null){
            $mainParent = Folder::where('id', $parentAll2->main_folder_id)->first();
            
            if ($parentFolder->main_folder_id == 0) {
                $folderPath = public_path("{$parentFolder->folder_name}/{$folderInput}");
            }
             elseif($parentAll2->main_folder_id != 0) {
                $parentAll = Folder::where('id', $parentFolder->main_folder_id)->first();
                if($parentAll->main_folder_id != 0){
                    $parentFolderMain = Folder::where('id',$parentAll->main_folder_id)->first();
                    if($parentFolderMain->main_folder_id == 0){
                        $folderPath = public_path("{$parentFolderMain->folder_name}/{$parentAll->folder_name}/{$parentFolder->folder_name}/{$folderInput}");
                    }
                }else{
                    if($parentAll->main_folder_id == 0){
                        $folderPath = public_path("{$parentAll->folder_name}/{$parentFolder->folder_name}/{$folderInput}");
                    }
                }
    
               
            }
                if($mainParent != null){
                    if($mainParent->main_folder_id == 0){
                        $folderPath = public_path("{$mainParent->folder_name}/{$parentAll2->folder_name}/{$parentFolder->folder_name}/{$folderInput}");
                    }
                }
                else{
                    if($parentAll2->main_folder_id == 0){
                        $folderPath = public_path("{$parentAll2->folder_name}/{$parentFolder->folder_name}/{$folderInput}");
                    }
                }
                
            if($mainParent != null){
            if($mainParent->main_folder_id != 0){
                $parentofmain = Folder::where('id',$mainParent->main_folder_id)->first();
                if($parentofmain->main_folder_id == 0){
                    $folderPath = public_path("{$parentofmain->folder_name}/{$mainParent->folder_name}/{$parentAll2->folder_name}/{$parentFolder->folder_name}/{$folderInput}");
                    // dd($folderPath);
                    // dd('ASDASDSADSAD');
                }
            }
            if (File::exists($folderPath)) {
                return redirect()->back()->with('error', 'Subfolder already exists');
            }
            
            $parentfourth = Folder::where('id',$mainParent->main_parent_id)->first();
            if($parentfourth != null){
                if($parentfourth->main_folder_id == 0){
                    $folderPath = public_path("{$parentfourth->folder_name}/{$parentofmain->folder_name}/{$parentAll2->folder_name}/{$parentFolder->folder_name}/{$folderInput}");
                }
            }
        }
        // dd($folderPath);
        // dd('JKHKJKKK');

            File::makeDirectory($folderPath, 0777, true, true);
        
            Folder::create([
                'folder_name' => $folderInput,
                'main_folder_id' => $parentFolder->id
            ]);
        }else{
            if($parentFolder->main_folder_id == 0){
                $folderPath = public_path("{$parentFolder->folder_name}/{$folderInput}");
            }

            File::makeDirectory($folderPath, 0777, true, true);
        
            Folder::create([
                'folder_name' => $folderInput,
                'main_folder_id' => $parentFolder->id
            ]);
        }
    
        return redirect()->back()->with('success', 'Subfolder Created.');
    }
    
        
    
}
