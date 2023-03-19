<?php


namespace App\Models\Traits;

use App\Models\Group;
use App\Scopes\GroupScope;

trait Tenantable
{
    protected static function bootTenantable()
    {
        static::addGlobalScope(new GroupScope());
        static::creating(function ($model) {
            $model->group_id = request()->payload['group_id'];
        });
    }

    public function tenant()
    {
        return $this->belongsTo(Group::class);
    }
}
