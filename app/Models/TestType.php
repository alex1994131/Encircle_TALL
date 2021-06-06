<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestType extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['test_name'];

    protected $searchableFields = ['*'];

    protected $table = 'test_types';

    public function keydates()
    {
        return $this->hasMany(Keydate::class);
    }
}
