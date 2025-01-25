<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password');
    }

    public function validarEmail(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        return redirect()->intended('/inicio');
    }

    public function showSecurityQuestionForm(Request $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();

        return view('auth.passwords.answer_security_questions', [
            'email' => $request->email,
            'question1' => $user->security_question_1,
            'question2' => $user->security_question_2,
            'question3' => $user->security_question_3,
        ]);
    }

    public function verifySecurityAnswers(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'security_answer_1' => 'required|string',
            'security_answer_2' => 'required|string',
            'security_answer_3' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        if (Hash::check($request->security_answer_1, $user->security_answer_1) &&
            Hash::check($request->security_answer_2, $user->security_answer_2) &&
            Hash::check($request->security_answer_3, $user->security_answer_3)) {
            return view('auth.passwords.reset', ['email' => $request->email]);
        }

        return back()->withErrors(['security_answers' => 'Las respuestas de seguridad no coinciden.']);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('status', 'Password has been reset!');
    }
}
