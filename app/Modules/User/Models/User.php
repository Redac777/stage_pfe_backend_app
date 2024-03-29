<?php

namespace App\Modules\User\Models;

use App\Modules\Box\Models\Box;
use App\Modules\Planning\Models\Planning;
use App\Modules\ProfileGroup\Models\ProfileGroup;
use App\Modules\Role\Models\Role;
use App\Modules\Shift\Models\Shift;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'matricule',
        'firstname',
        'lastname',
        'isactive',
        'email',
        'password',
        'shift_id',
        'role_id',
        'profile_group_id',
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
