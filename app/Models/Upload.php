<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'main_filename',
        'file_id',
        'file_path',
        'file_type',
        'file_size',
        'folder_name',
        'move_folder',   
    ];

}
