<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basics extends Model
{
    protected $table = "file_basics";

    protected $primaryKey = "fileID";

    protected $casts = [
        'extra' => 'json'
    ];

    public function educations()
    {
        return $this->hasMany(Educations::class, 'fileID');
    }

    public function workexperience()
    {
        return $this->hasMany(WorkExperience::class, 'fileID');
    }
}
