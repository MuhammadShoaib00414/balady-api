<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function studentMunicipality()
    {
        return $this->belongsTo(Municipality::class, 'municipality');
    }


    public function subMunicipality()
    {
        return $this->belongsTo(SubMunicipality::class,'sub_municipality');
    }
}
