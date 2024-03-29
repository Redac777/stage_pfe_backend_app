<?php

namespace App\Modules\Planning\Models;

use App\Modules\Box\Models\Box;
use App\Modules\Equipement\Models\Equipement;
use App\Modules\Shift\Models\Shift;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    use HasFactory;

    public function users(){
        return $this->hasMany(User::class);
    }
    public function equipements(){
        return $this->hasMany(Equipement::class);
    }

    public function boxes(){
        return $this->hasMany(Box::class);
    }
    public function shift(){
        return $this->belongsTo(Shift::class);
    }
}
