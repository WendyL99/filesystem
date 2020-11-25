<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class FileEducations extends Model
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
