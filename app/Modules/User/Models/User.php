<?php

namespace App\Modules\User\Models;

use App\Modules\Box\Models\Box;
use App\Modules\Planning\Models\Planning;
use App\Modules\ProfileGroup\Models\ProfileGroup;
use App\Modules\Role\Models\Role;
use App\Modules\Shift\Models\Shift;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'matricule',
        'firstname',
        'lastname',
        'isactive',
        'email',
        'password',
    ];
    
    public function shift(){
        return $this->belongsTo(Shift::class);
    }
    public function profileGroup(){
        return $this->belongsTo(ProfileGroup::class);
    }
    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function boxes(){
        return $this->hasMany(Box::class);
    }
    public function plannings(){
        return $this->hasMany(Planning::class);
    }
}
