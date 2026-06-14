<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
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
        // Paksa penggunaan HTTPS di lingkungan produksi
        if ($this->app->environment('production')) {
        URL::forceScheme('https');
    }
        // Aktifkan bootstrap pagination
        Paginator::useBootstrap();

        // Mengamankan proses booting aplikasi menggunakan try-catch
        try {
            // Cek secara aman apakah database terhubung dan tabel 'settings' sudah terbuat
            if (Schema::hasTable('settings')) {
                $webSetting = Setting::first();
                View::share('webSetting', $webSetting);
            } else {
                // Sediakan objek kosong (Fallback) jika tabel settings belum di-migrate
                View::share('webSetting', new Setting());
            }
        } catch (\Exception $e) {
            // Jika database belum siap/terkoneksi saat menjalankan 'php artisan config:cache',
            // tangkap erornya secara senyap dan berikan objek kosong sebagai fallback aman.
            View::share('webSetting', new Setting());
        }
    }
}