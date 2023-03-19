<?php

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    use Tenantable;

    protected $fillable = [
        'name',
        'value',
        'scheduled_payment_date',
        'category_id',
        'recurrence_id',
        'attachment_id',
        'group_id',
        'user_id'
    ];

    # Relationships

    public function attachment()
    {
        return $this->hasOne(Attachment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function recurrency()
    {
        return $this->hasOne(Recurrence::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
