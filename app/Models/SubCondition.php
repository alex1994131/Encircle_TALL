<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCondition extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;

    protected $table = 'subconditions';
    
    protected $fillable = ['condition_id','name'];

    protected $searchableFields = ['*'];

    public function condition()
    {
        return $this->belongTo(Condition::class);
    }

    public function compaign() {
        return $this->hasOne(Compaign::class);
    }

    public function patientcampaign() {
        return $this->hasOne(PatientCampaign::class);
    }
}
