<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Library;

class Campaign extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'trust_id',
        'content',
        'condition_id',
        'subCondition_id',
        'msgs',
        'category',
        'published',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function trusts() {
        return $this->belongsTo(Trust::class);
    }

    public function libraries() {
        $lib_ids = explode(',', $this->msgs);
        $libraries = [];
        foreach($lib_ids as $each)
            array_push($libraries, Library::find($each));
        return $libraries;
    }

    public function patientCampaigns() {
        return $this->hasMany(PatientCampaign::class);
    }

    public function condition() {
        return $this->belongsTo(Condition::class);
    }

    public function subCondition() {
        return $this->belongsTo(SubCondition::class, 'subCondition_id');
    }
    
    public function getTrust($id)
    {
        $trust = Trust::find($id);
        return $trust;
    }
}
