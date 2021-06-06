<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientCampaign extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'patient_id',
        'condition',
        'subcondition',
        'trust_id',        
        'title',
        'content',
        'msgs',
        'campaign_id',
        'status',
        'category'
    ];

    protected $searchableFields = ['*'];

    protected $table = 'patient_campaigns';

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function patientMessages()
    {
        return $this->hasMany(PatientMessage::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function getCondition() {
        return $this->belongsTo(Condition::class, 'condition');
    }

    public function getSubCondition() {
        return $this->belongsTo(SubCondition::class, 'subcondition');
    }

    public function libraries() {
        $lib_ids = explode(',', $this->msgs);
        $libraries = [];
        foreach($lib_ids as $each)
            array_push($libraries, PatientMessage::find($each));
        return $libraries;
    }
}
