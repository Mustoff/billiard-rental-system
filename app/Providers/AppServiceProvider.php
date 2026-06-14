<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Aktifkan bootstrap pagination (opsional jika kamu pakai bootstrap)
        Paginator::useBootstrap();

        // Cek secara aman apakah database terhubung dan tabel 'settings' sudah terbuat
        if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
            $webSetting = Setting::first();
            View::share('webSetting', $webSetting);
        } else {
            // Sediakan objek kosong (Fallback) agar file view tidak melempar eror "Attempt to read property on null"
            View::share('webSetting', new Setting());
        }
    }
}     