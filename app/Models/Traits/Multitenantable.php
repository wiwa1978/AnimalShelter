<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;


trait Multitenantable
{

    public static function bootMultitenantable()
    {

        $user = Auth::user();

        if (auth()->check()) {
            static::creating(function ($model) {
                $model->user_id = auth()->id();
            });

            if (!$user->hasRole('super_admin')) {
                static::addGlobalScope('created_by_user_id', function (Builder $builder) {
                    $builder->where('user_id', auth()->id());
                });
            }
        }
    }
}
