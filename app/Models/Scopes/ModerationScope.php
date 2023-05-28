<?php

namespace App\Models\Scopes;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ModerationScope implements Scope
{
    protected $extensions = ['AcceptModeration', 'DeclineModeration', 'WithForModeration', 'WithoutForModeration', 'OnlyForModeration'];

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('status_moderation_id',1);
    }

    public function extend(Builder $builder)
    {
        foreach ($this->extensions as $extension) {
            $this->{"add{$extension}"}($builder);
        }

        $builder->onDelete(function (Builder $builder) {
            return $builder->update([
                'status_moderation_id' => StatusEnum::STATUS_MODERATION_PROCESSING_ID->value,
            ]);
        });
    }

    protected function addAcceptModeration(Builder $builder)
    {
        $builder->macro('acceptModeration', function (Builder $builder) {
            $builder->withForModeration();

            return $builder->update(['status_moderation_id' => StatusEnum::STATUS_MODERATION_PROCESSING_ID->value]);
        });
    }

    protected function addDeclineModeration(Builder $builder)
    {
        $builder->macro('declineModeration', function (Builder $builder) {
            $builder->withForModeration();

            return $builder->update(['status_moderation_id' => StatusEnum::STATUS_MODERATION_NOT_ACCEPTED_ID->value]);
        });
    }

    protected function addWithForModeration(Builder $builder)
    {
        $builder->macro('withForModeration', function (Builder $builder, $withForModeration = true) {
            if (! $withForModeration) {
                return $builder->withoutForModeration();
            }

            return $builder->withoutGlobalScope($this);
        });
    }

    protected function addWithoutForModeration(Builder $builder)
    {
        $builder->macro('withoutForModeration', function (Builder $builder) {
            $model = $builder->getModel();

            $builder->withoutGlobalScope($this)->where('status_moderation_id',1);

            return $builder;
        });
    }

    protected function addOnlyForModeration(Builder $builder)
    {
        $builder->macro('onlyForModeration', function (Builder $builder) {
            $model = $builder->getModel();

            $builder->withoutGlobalScope($this)->where('status_moderation_id','!==',1);

            return $builder;
        });
    }
}
