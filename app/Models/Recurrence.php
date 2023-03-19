<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurrence extends Model
{
    use HasFactory;

    # Relationships

    public function invoices()
    {
        return $this->belongsTo(Invoice::class);
    }
}
