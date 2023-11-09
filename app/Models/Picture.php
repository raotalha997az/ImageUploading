<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Picture extends Model
{ use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'picture';

    protected $fillable = [
        'picture_name',
        'path_name',
        'folder_id',
    ];
    public function folder():BelongsTo
{
    return $this->belongsTo(Folder::class,'folder_id');
}

}
