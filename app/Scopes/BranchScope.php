<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class BranchScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        /** @var \App\Models\User|null $user */
        $user = auth()->user();

        if ($user && $user->branch?->id_cabang) {
            $builder->where('id_cabang', $user->branch->id_cabang);
        }
    }
}
