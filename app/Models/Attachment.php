<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    use Tenantable;

    protected $fillable = [
        'title',
        'path',
        'group_id'
    ];

    # Relationships

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
