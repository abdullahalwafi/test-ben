<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topik extends Model
{
    protected $primaryKey = 'id_topik';
    protected $fillable = ['topik'];

    public function datasets(): HasMany
    {
        return $this->hasMany(Dataset::class, 'id_topik', 'id_topik');
    }
}
