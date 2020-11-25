<?php

namespace App\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class FileBasics extends Model
{
    protected $table = 'file_basics';

    protected $primaryKey = 'fileID';

    protected $casts = [
        'extra' => 'json',
    ];

    public function educations()
    {
        return $this->hasMany(FileEducations::class, 'fileID');
    }

    public function workexperience()
    {
        return $this->hasMany(FileWorkExperience::class, 'fileID');
    }

    public function getLuanguageAttribute($value)
    {
        return explode(',', $value);
    }

    public function setLuanguageAttribute($value)
    {
        $this->attributes['luanguage'] = implode(',', $value);
    }
}
