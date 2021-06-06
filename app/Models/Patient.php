<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name', 
        'dob', 
        'nhsnum', 
        'phone', 
        'email', 
        'notes', 
        'campaigns'
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'dob' => 'date',
    ];

    public function keydates()
    {
        return $this->hasMany(Keydate::class);
    }

    public function patientCampaigns()
    {
        return $this->hasMany(PatientCampaign::class);
    }

    public function patientMessages()
    {
        return $this->hasMany(PatientMessage::class);
    }

    public function trusts()
    {
        return $this->belongsToMany(Trust::class);
    }
}
