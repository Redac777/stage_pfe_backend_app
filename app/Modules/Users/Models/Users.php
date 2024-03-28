<?php

namespace App\Modules\Users\Models;

use App\Modules\ProfileGroup\Models\ProfileGroup;
use App\Modules\Role\Models\Role;
use App\Modules\Shift\Models\Shift;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Users extends Model
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
    
    
}
