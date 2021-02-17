<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Helpers\Auth\SocialiteHelper;
use App\Http\Requests\RegisterRequest;
use App\Events\Frontend\Auth\UserRegistered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repositories\Frontend\Auth\UserRepository;
use GoogleRecaptchaToAnyForm\GoogleRecaptcha;
/**
 * Class RegisterController.
 */
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Where to redirect users after login.
     *
     * @return string
      public function redirectPath()
    {
        return route('frontend.auth.login');
    }
     */
     public function redirectPath()
    {
        return route('frontend.auth.login');
    }
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        abort_unless(config('access.registration'), 404);
        $showRecaptcha = GoogleRecaptcha::show('6LeaQLgZAAAAAM9k3w4nb0JK8QivBbVhFQ5TWlH9', 'password_confirmation', 'no_debug', 'mt-3','Please tick the reCAPTCHA checkbox first!');
        
        return view('frontend.auth.register')
            ->withSocialiteLinks((new SocialiteHelper)->getSocialLinks())->with('captcha',$showRecaptcha);
    }

    /**
     * @param RegisterRequest $request
     *
     * @throws \Throwable
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(RegisterRequest $request)
    {
        abort_unless(config('access.registration'), 404);
        
        GoogleRecaptcha::verify('6LeaQLgZAAAAAKgAgcXFN8DwZ4Mzde_7e0Fju8BD', 'Google Recaptcha Validation Failed!!');
        
        $user = $this->userRepository->create($request->only('first_name', 'last_name', 'email', 'password','register_as'));
        
       
        // If the user must confirm their email or their account requires approval,
        // create the account but don't log them in.
        if (config('access.users.confirm_email') || config('access.users.requires_approval')) {
            event(new UserRegistered($user));

            return redirect($this->redirectPath())->with('user',$user)->withFlashSuccess(
                config('access.users.requires_approval') ?
                    __('exceptions.frontend.auth.confirmation.created_pending') :
                    __('exceptions.frontend.auth.confirmation.created_confirm',['name'=>$user->first_name,'surname'=>$user->last_name])
            );
        }

        auth()->login($user);

        event(new UserRegistered($user));

        return redirect($this->redirectPath());
    }
}
