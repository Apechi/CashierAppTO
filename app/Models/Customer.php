<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'email', 'no_telp', 'address'];

    protected $searchableFields = ['*'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
