<?php

namespace App\Providers;

use App\View\Components\CustomInput;
use App\View\Components\CustomSelect;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Blade::component('custom-input', CustomInput::class);
        Blade::component('custom-select', CustomSelect::class);

        Blade::directive('formatNum', function ($num) {
            return "<?php echo number_format($num, 0, '', '.'); ?>";
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
