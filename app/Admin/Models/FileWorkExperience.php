<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class FileWorkExperience extends Model
{
    protected $table = "file_work_experience";

    protected $primaryKey = "weID";

    protected $fillable = [];

    public function scopeOfBasics($query, $basics)
    {
        return $query->where('fileID', $basics);
    }

    public function basics()
    {
        return $this->belongsTo(FileBasics::class, 'fileID');
    }
}
