<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;  // Agregar esta importación
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // Verificamos si el usuario es Admin y su contraseña está en texto plano
            if ($user->role === 'Admin' && !$this->isPasswordHashed($user->password)) {
                // Si la contraseña está en texto plano y es un Admin, verificamos la contraseña en texto plano
                if ($user->password === $credentials['password']) {
                    // Iniciar sesión
                    Auth::login($user);

                    // Encriptar la contraseña en el primer login
                    $user->password = Hash::make($credentials['password']);
                    $user->save();

                    return redirect()->intended('dashboard'); // Redirigir al dashboard o página principal
                }
            }

            // Si la contraseña ya está encriptada o no es un Admin, usamos el mecanismo normal de verificación
            if (Auth::attempt($credentials)) {
                return redirect()->intended('dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Verificar si la contraseña no está encriptada (es texto plano).
     */
    private function isPasswordHashed($password)
    {
        return strlen($password) > 60;  // La longitud de un hash bcrypt normalmente es mayor que 60
    }
}
