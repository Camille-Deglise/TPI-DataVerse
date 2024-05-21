<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
| Route de base initialisée par Laravel
|   Route::get('/', function () {
    return view('welcome');
        });
*/


/*Route de la page home du site */
Route::get('/home',  [HomeController::class, 'home'])->name('home');

/*Route pour la page d'inscription */
Route::get('/register',  [RegisterController::class, 'registerForm']) ->name('register');
Route::post('/register', [RegisterController::class,'storeDB']);
/*-----------------------------------------------------------------------------*/

/*Route qui envoie l'email de vérification COPIE SITE de LARAVAEL*/
Route::post('/email/verification-notification', function (Request $request)
{
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware('auth')->name('verification.send');

/* Route qui vérifie si l'email est validé */
Route::get('/email/verify({id}/{hash}', [VerificationController::class,'verify'])
->middleware('signed')->name('verification.verify');

/*-------------------------------------------------------------------------------------------*/
/*Route pour la page de connexion */
Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/login', [LoginController::class, 'doLogin']);
Route::delete('/logout', [LoginController::class,'logout'])
->middleware('auth')
->name('logout');

/*Route pour la vue de réinitialisation du mot de passe */
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');


 /*Route qui envoie l'email de réinitialisation COPIE site de LARAVEL */
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');


/*Route pour le formulaire de reset du mot de passe */
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

/*Route qui modifie le mot de passe dans la base de donnée COPIE SITE DE LARAVEL */
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:14|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');