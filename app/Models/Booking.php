<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'date',
        'table_id',
        'start_time',
        'end_time',
        'bookers_name',
        'total_customer',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
