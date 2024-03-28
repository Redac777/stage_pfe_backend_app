<?php

namespace App\Modules\Equipement\Models;

use App\Modules\ProfileGroup\Models\ProfileGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable = ['matricule','status'];

    public function profilegroup(){
        return $this->belongsTo(ProfileGroup::class);
    }
}
