<?php

namespace App\Models;

use App\Admin\Models\FileBasics;
use Illuminate\Database\Eloquent\Model;

class Educations extends Model
{
    protected $table = "file_educations";

    protected $primaryKey = "eduID";

    protected $fillable = ['school_name'];

    public function scopeOfBasics($query, $basics)
    {
        return $query->where('fileID', $basics);
    }

    public function basics()
    {
        return $this->belongsTo(FileBasics::class, 'fileID');
    }
}
