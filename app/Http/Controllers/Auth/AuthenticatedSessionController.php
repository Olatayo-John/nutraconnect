<?php

namespace App\Http\Controllers\Auth;

use App\Models\OTP;
use App\Jobs\OtpMailJob;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    //send otp to email
    public function sendOtp()
    {
        $validated = request()->validate([
            'email' => ['required', 'string', 'email', Rule::exists('users', 'email')]
        ]);

        //generate OTP
        // $otp = mt_rand(0, 100000);
        $otp = '12345';
        $validated['otp'] = $otp;

        //save to db for recollection
        DB::transaction(function () use ($validated) {
            OTP::updateOrCreate(
                [
                    'email' => $validated['email'],
                ],
                [
                    'otp' => password_hash($validated['otp'], PASSWORD_DEFAULT)
                ]
            );

            //send via mail
            // OtpMailJob::dispatch($validated);
        });

        $data['status'] = true;
        $data['otpG'] = $otp;
        $data['msg'] = 'OTP sent to your email';

        return response()->json($data);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        //verify otp first before trying to login user
        $res = $this->verifyOtp($email = $request->input('email'), $otp = $request->input('otp'));

        if ($res === true) {
            $request->authenticate();

            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            throw ValidationException::withMessages([
                'otp' => 'Incorrect OTP Provided',
            ]);
        }
    }

    public function verifyOtp(String $email, Int $otp)
    {
        if ($otp ?? false) {
            // $dbRes = OTP::where('email', $email)->firstOrFail(); //just throws error
            $dbRes = OTP::where('email', $email)->firstOr(function () use ($email) {
                throw ValidationException::withMessages([
                    'otp' => 'No OTP found for ' . $email,
                ]);
            });

            if (password_verify($otp, $dbRes['otp'])) {
                return true;

                //maybe mark user email address as verified
            }
        }
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
}
