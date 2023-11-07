<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Folder extends Model
{  use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'folder';
    protected $fillable = [

        'folder_name',
        'main_folder_id'
    ];

    public function mainfolder():BelongsTo
    {
        return $this->belongsTo(Folder::class, 'main_folder_id');
    }
}
