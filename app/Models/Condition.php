<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condition extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    protected $table = 'conditions';

    protected $fillable = ['name',];

    protected $searchableFields = ['*'];

    public function subConditions()
    {
        return $this->hasMany(SubCondition::class);
    }

    public function compaign() {
        return $this->hasOne(Compaign::class);
    }

    public function patientcampagin() {
        return $this->hasOne(PatientCampaign::class);
    }
}
