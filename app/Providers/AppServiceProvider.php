<?php

namespace App\Providers;

use Html;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Html::macro('full_title', function ($page_title) {
            $base_title = "Laravel Tutorial Sample App";
            if (empty($page_title)) {
                return $base_title;
            }
            return $base_title . " | " . $page_title;
        });
        Html::macro('pluralize', function ($count, $noun) {
            if ($count === 1) {
                return $count . ' ' . $noun;
            }
            return $count . ' ' . str_plural($noun);
        });
        Html::macro('gravatar_for', function ($user, $options = ['size' => 50]) {
            $gravatar_id = md5(strtolower($user->email));
            $gravatar_url = "https://secure.gravatar.com/avatar/$gravatar_id?s={$options['size']}";
            return "<img src=\"$gravatar_url\" alt=\"{$user->name}\" class=\"gravatar\">";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() === 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }
    }
}
