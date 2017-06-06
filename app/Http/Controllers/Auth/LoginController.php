<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Entities\EloquentUser;
use App\Repositories\MemberRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use LaravelDoctrine\ORM\Facades\EntityManager;

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
     * @var MemberRepository
     */
    private $memberRepository;

    /**
     * Create a new controller instance.
     *
     * @param MemberRepository $memberRepository
     */
    public function __construct(MemberRepository $memberRepository)
    {
        $this->middleware('guest')->except('logout');
        $this->memberRepository = $memberRepository;
    }

    /**
     * @return mixed
     */
    public function redirectToAirStream()
    {
        return Socialite::driver('airstream')->redirect();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleAirStreamCallback()
    {
        $user = Socialite::driver('airstream')->user();

        if(!(in_array('Committee', $user->groups) || in_array('Net Admins', $user->groups)))
        {
            abort(403, "Sorry, you don't have access to the Air-Stream EloquentAsset Register");
        }

        session()->put('oauth_token', $user->token);

        $localUser = EntityManager::getRepository(User::class)->findOneBy(['member_id' => $user->id]);

        if(!$localUser) {
            $member = $this->memberRepository->findById($user->id);
            $localUser = User::fromMember($member);

            EntityManager::persist($localUser);
            EntityManager::flush();
        }
        
        auth()->login($localUser);

        return redirect()->route('home');
    }
}
