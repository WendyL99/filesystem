<?php

namespace App\Models;

use App\Admin\Models\FileBasics;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
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
