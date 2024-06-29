<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\Cabang;
use App\Scopes\BranchScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToBranch
{
    protected static function booted(): void
    {
        static::addGlobalScope(new BranchScope());

        static::creating(function (self $model) {
            $model->id_cabang = auth()->user()?->id_cabang;
        });
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Cabang::class, 'id_cabang');
    }
}
