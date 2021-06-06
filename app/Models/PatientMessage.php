<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientMessage extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'patient_id',
        'patient_campaign_id',
        'library_id',  
        'msg_title', 
        'msg_text', 
        'upload_video', 
        'upload_image', 
        'add_url', 
        'telephone', 
        'selected_date',       
    ];

    protected $searchableFields = ['*'];

    protected $table = 'patient_messages';

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function patientCampaign()
    {
        return $this->belongsTo(PatientCampaign::class);
    }

    public function library()
    {
        return $this->belongsTo(Library::class);
    }
}
