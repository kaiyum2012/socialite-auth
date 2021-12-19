<?php


namespace Kaiyum2012\SocialiteAuth\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Kaiyum2012\SocialiteAuth\Contracts\Sociable;
use Kaiyum2012\SocialiteAuth\Models\HasSocialAccounts;
use Kaiyum2012\SocialiteAuth\Models\SocialAccount;
use Laravel\Socialite\Facades\Socialite;
use Throwable;
use UnexpectedValueException;
use function config;
use function throw_if;

/**
 * @property string $provider
 */
class SocialAuthController extends \App\Http\Controllers\Controller
{
    /**
     * @var string|null
     */
    private $provider;

    /**
     * @var \Laravel\Socialite\Contracts\User
     */
    private $user;

    public function __construct(Request $request)
    {
        $this->provider = $request->get('provider');
    }

    /**
     * @throws Throwable
     */
    public function redirect()
    {
        throw_if(!$this->validateProvider(), new UnexpectedValueException());
        return Socialite::driver($this->provider)->redirect();
    }

    public function authenticated()
    {
        $this->user = Socialite::driver($this->provider)->user();
        if (!$socialAccount = $this->getSocialAccount()) {
            $socialAccount = $this->createSocialAccount([
                'identifier' => $this->user->getId(),
                'provider' => $this->provider,
                'token' => property_exists($this->user, 'token') ? $this->user->token : null,
                'expire_on' => property_exists($this->user, 'expiresIn') ? Carbon::now()->addSeconds($this->user->expiresIn) : null,
                'data' => property_exists($this->user, 'user') ? $this->user->user : null
            ]);
        }

        Auth::login($socialAccount->user);
        return redirect(HasSocialAccounts::$authenticatedRoute);
    }

    private function validateProvider(): bool
    {
        return in_array($this->provider, config('socialite-auth.providers')) && config('socialite-auth.enable');
    }

    private function getSocialAccount()
    {
        return SocialAccount::query()->where('identifier', '=', $this->user->getId())->first();
    }

    private function createUser(): Sociable
    {
        if (!$newUser = App::make(config('socialite-auth.user_model'))->where('email', '=', $this->user->getEmail())->first()) {

            $password = Hash::make(Str::random(8));
            App::make(config('socialite-auth.user_model'))->createUserUsing([
                'email' => $this->user->getEmail(),
                'name' => $this->user->getName(),
                'password' => $password])->save();

            $newUser = App::make(config('socialite-auth.user_model'))
                ->where('email', '=', $this->user->getEmail())
                ->where('password', '=', $password)
                ->first();
        }

        return $newUser;
    }

    private function createSocialAccount($account)
    {
        $user = $this->createUser();
        return SocialAccount::query()->create(array_merge(['user_id' => $user->getKey()], $account));
    }
}
