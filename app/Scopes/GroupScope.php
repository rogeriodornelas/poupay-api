<?php


namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class GroupScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('group_id', session()->get('group_id'));
    }
}
