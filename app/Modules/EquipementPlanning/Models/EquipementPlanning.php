<?php

namespace App\Modules\EquipementPlanning\Models;

use App\Modules\EquipementPlanningWorkingHours\Models\EquipementPlanningWorkingHours;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipementPlanning extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipement_id',
        'planning_id',
        'stopped_at',
        'reason'
    ];

    protected $table = 'equipements_plannings';

    public function equipementPlanningWorkingHours(){
        return $this->hasMany(EquipementPlanningWorkingHours::class);
    }
}
