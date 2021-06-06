<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keydate extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'patient_id',
        'type',
        'condition_id',
        'subcondition_id',
        'test_order',
        'apt_date',
        'apt_kickoff_date',
        'test_types',
        'apt_campaign_id',
        
        'lab_ref',
        'next_test_order',
        'result_type',
        'results',
        'result_date',
        'result_kickoff_date',
        'next_test_order',
        'result_campaign_id',
        'next_apt_due'
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'apt_date' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function outbound()
    {
        return $this->hasOne(Outbound::class);
    }

    public function testType()
    {
        return $this->belongsTo(TestType::class);
    }

    public function condition()
    {
        return $this->belongTo(Condition::class);
    }

    public function subcondition()
    {
        return $this->belongTo(SubCondition::class);
    }

    public function apt_campaign()
    {
        return $this->belongTo(PatientCampaign::class);
    }

    public function result_campaign()
    {
        return $this->belongTo(PatientCampaign::class);
    }
}
