<?php

namespace App\Providers;

use App\Models\cart;
use App\Models\compoCart;
use App\Models\orders;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('*', function ($view) {
            $user = auth()->user();
            $cart = null;
            if ($user) {
                $cart = cart::where('user_id', $user->id)->get();
            }
            $view->with(['cart' => $cart]);
        });
        View::composer('*', function ($view) {
            $user = auth()->user();
            $compoCart = null;
            if ($user) {
                $compoCart = compoCart::where('user_id', $user->id)->get();
            }
            $view->with(['compoCart' => $compoCart]);
        });
        View::composer('*', function ($view) {
            $user = auth()->user();
            $cartCount = 0;
            $cartx = 0;
            $carty = 0;
            if ($user) {
                $cart = cart::where('user_id', $user->id)->get();
                $compoCart = compoCart::where('user_id', $user->id)->get();
                $cartx = $cart->count();
                $carty = $compoCart->count();
                $cartCount = $cartx + $carty;
            }
            $view->with('cartCount', $cartCount);
        });

        $NewOrders = orders::where('order_status', 0)->paginate(5);

        View::share('NewOrders', $NewOrders);
    }
}
