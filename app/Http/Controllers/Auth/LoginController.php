<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Auth;
use Jenssegers\Optimus\Optimus;
use Socialite;

use App\User;
use App\UserSocial;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        //return response()->json($user->getEmail());

        $authUser = $this->findOrCreateUser($user, $provider);

        //return response()->json($authUser);

        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {

        $spark_user = null;
        //if no email found then return an error
        $social_email               = $user->getEmail();
        if (!$social_email) {

            return response()->json(false);
        }

        //search in the social table if user is already registered
        $social_provider_id         = $user->getId();
        $user_social                = UserSocial::where('provider_id', $social_provider_id)->first();

        //if found then search the users table
        if ($user_social) {
            $spark_user             = User::where('id', '=', $user_social->user_id)->first();

            return $spark_user;
        }

        //if not found using provider id then,
        //check if user has already registered using an email
        if ($social_email) {
            //if ($user_social->settings['email']) {
                $spark_user         = User::where('email', '=', $social_email)->first();
            //}
        }

        //if user has already registered then don't try to register again, instead just update social table record
        if (!$spark_user) {

            $spark_user             = new User;
            $spark_user->name       = $user->getName();
            $spark_user->email      = $social_email;

            $optimus_enc            = new Optimus(405894989, 1442879877, 1202735029);
            $social_provider_id_enc = $optimus_enc->encode($social_provider_id);

            $spark_user->password   = bcrypt($social_provider_id_enc);
            $spark_user->photo_url  = $user->getAvatar();
            $spark_user->save();

        }

        //update social table
        $user_social                = new UserSocial;
        $user_social->user_id       = $spark_user->id;
        $user_social->provider_id   = $user->id;
        $user_social->settings      = $user;
        $user_social->save();

        return $spark_user;
    }
}
