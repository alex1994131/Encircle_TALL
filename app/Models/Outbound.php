<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Outbound extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'keydate_id',
        'message',
        'message_data',
        'recipient',
        'trust',
        'trust_logo',
    ];

    protected $searchableFields = ['*'];

    public function keydate()
    {
        return $this->belongsTo(Keydate::class);
    }
}
