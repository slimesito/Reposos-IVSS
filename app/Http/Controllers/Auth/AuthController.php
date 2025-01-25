<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'login_error' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            ]);
        }

        if (!$user->activo) {
            return back()->with('message', 'Tu usuario se encuentra inactivo.');
        }

        // Omitir la validación de IP si el cod_cargo del usuario es 4
        if ((int)$user->cod_cargo !== 4) {
            $centroAsistencial = DB::table('CENTROS_ASISTENCIALES')
                ->where('id', $user->id_centro_asistencial)
                ->first();

            if (!$centroAsistencial) {
                return back()->withErrors([
                    'login_error' => 'El centro asistencial asociado no existe.',
                ]);
            }

            $rangoIp = $centroAsistencial->rango_ip;
            $userIp = $request->ip();
            $userIpPrefix = $this->getIpPrefix($userIp);

            // Registrar la IP del usuario y el rango IP del centro asistencial para depuración
            Log::info('IP del usuario: ' . $userIp . ' | Prefijo IP del usuario: ' . $userIpPrefix);
            Log::info('Rango IP del centro asistencial: ' . $rangoIp);

            if ($userIpPrefix !== $rangoIp) {
                return back()->withErrors([
                    'login_error' => 'La dirección IP no coincide con el rango permitido para tu usuario.',
                ]);
            }
        }

        $user->ultimo_inicio_sesion = now();
        $user->save();

        Auth::login($user);

        return redirect()->intended('/inicio');
    }

    private function getIpPrefix($ip)
    {
        $ipParts = explode('.', $ip);
        return implode('.', array_slice($ipParts, 0, 3));
    }

}
