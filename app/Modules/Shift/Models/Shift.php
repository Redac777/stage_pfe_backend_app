<?php

namespace App\Modules\Shift\Models;

use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = ['category'];
    public function users(){
        return $this->hasMany(User::class);
    }
}
