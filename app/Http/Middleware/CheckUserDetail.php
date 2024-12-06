<?php

namespace App\Http\Middleware;

use App\Models\Konsumen;
use App\Models\RentalMobil;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserDetail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::find(auth()->user()->id);
        // dd($user);
        $roleUser = [];

        foreach ($user->roles as $item) {
            array_push($roleUser, $item->kode_role);
        }

        if(in_array('CST', $roleUser)) {
            $konsumen = Konsumen::where('user_id', $user->id)->exists();

            if(!$konsumen) {
                // Cek apakah sudah di redirect ke profile sebelumnya
                if ($request->route()->getName() !== 'users.profile') {
                    return redirect()->route('users.profile', $user->id);
                }
            }
        }
        if (in_array('ADM', $roleUser)) {
            $rentalMobil = RentalMobil::where('user_id', $user->id)->exists();

            if (!$rentalMobil) {
                // Cek apakah sudah di redirect ke profil sebelumnya
                if ($request->route()->getName() !== 'users.profile') {
                    return redirect()->route('users.profile', $user->id);
                }
            }
        }
        return $next($request);
    }
}
