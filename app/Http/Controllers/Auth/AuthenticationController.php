<?php

namespace App\Http\Controllers\Auth;

use AllowDynamicProperties;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Interfaces\AuthenticationInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;

#[AllowDynamicProperties]
class AuthenticationController extends Controller
{
    public function __construct(AuthenticationInterface $authentication)
    {
        $this->authentication = $authentication;
    }

    /**
     * User sign up form
     * @return View
     */
    public function signUpForm(): View
    {
        return view('auth.sign_up');
    }

    /**
     * User sign up
     * @param SignUpRequest $request
     * @return RedirectResponse
     */
    public function signUp(SignUpRequest $request): RedirectResponse
    {
        $data = $request->only(['name', 'email', 'password']);

        $user = $this->authentication->register($data);

        if (!$user) {
            return redirect()->back()->with('error', 'Registration failed.')->setStatusCode(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        return redirect()->route('login')->with('success', 'Registration successes.')->setStatusCode(HttpResponse::HTTP_CREATED);
    }

    /**
     * User sign in form
     * @return View
     */
    public function signInForm(): View
    {
        return view('auth.sign_in');
    }

    /**
     * User sign in
     * @param SignInRequest $request
     * @return RedirectResponse
     */
    public function signIn(SignInRequest $request): RedirectResponse
    {
        $credentials = $request->only(['email', 'password']);

        if ($this->authentication->login($credentials)) {
            return redirect()->route('home')->with('success', 'Login successful.')->setStatusCode(HttpResponse::HTTP_OK);
        }

        return redirect()->back()->with('error', 'Invalid credentials.')->setStatusCode(HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * User logout
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        $this->authentication->logout();

        return redirect()->route('login')->with('success', 'Logout successful.')->setStatusCode(HttpResponse::HTTP_OK);
    }
}
