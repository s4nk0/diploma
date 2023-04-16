<?php

namespace App\Providers;

use App\Mixins\CollectionMixin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\PendingResourceRegistration;
use Illuminate\Support\ServiceProvider;

class MixinServiceProvider extends ServiceProvider
{
    /** @psalm-var array<class-string, class-string> */
    protected array $mixins = [
        Collection::class => CollectionMixin::class,
    ];

    /** @psalm-var array<class-string, class-string> */
    protected array $testingMixins = [
        //
    ];

    public function register()
    {
        foreach ($this->mixins as $class => $mixin) {
            $class::mixin(new $mixin);
        }

        if ($this->app->environment('testing')) {
            foreach ($this->testingMixins as $class => $mixin) {
                $class::mixin(new $mixin);
            }
        }
    }
}
