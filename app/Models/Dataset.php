<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dataset extends Model
{
    protected $fillable = [
        'id_topik',
        'nama_dataset',
        'meta_data_json',
        'metadata_info',
        'files',
        'last_update',
    ];

    protected $casts = [
        'meta_data_json' => 'array',
        'last_update' => 'datetime',
    ];

    public function topik(): BelongsTo
    {
        return $this->belongsTo(Topik::class, 'id_topik', 'id_topik');
    }
}
