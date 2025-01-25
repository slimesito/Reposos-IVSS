<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function showProfileSettings($id)
    {
        $user = User::findOrFail($id);

        return view('users.profile_settings', compact('user'));
    }

    public function profileSettingsUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'password' => 'nullable|min:8|confirmed',
            'pregunta_secreta1' => 'nullable|max:50',
            'respuesta_secreta1' => 'nullable|max:50',
            'pregunta_secreta2' => 'nullable|max:50',
            'respuesta_secreta2' => 'nullable|max:50',
            'pregunta_secreta3' => 'nullable|max:50',
            'respuesta_secreta3' => 'nullable|max:50',
            'foto' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ], 
        [
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->pregunta_secreta1 = ($request->pregunta_secreta1);
        $user->respuesta_secreta1 = ($request->respuesta_secreta1);
        $user->pregunta_secreta2 = ($request->pregunta_secreta2);
        $user->respuesta_secreta2 = ($request->respuesta_secreta2);
        $user->pregunta_secreta3 = ($request->pregunta_secreta3);
        $user->respuesta_secreta3 = ($request->respuesta_secreta3);
        
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('public/app/assets/fotos');
            $user->foto = $fotoPath;
        }

        $user->save();

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }
}
