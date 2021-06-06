<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Library extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'msg_title', 
        'msg_text', 
        'upload_video', 
        'upload_image', 
        'add_url', 
        'telephone', 
        'selected_date', 
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function patientMessages()
    {
        return $this->hasMany(PatientMessage::class);
    }
}
