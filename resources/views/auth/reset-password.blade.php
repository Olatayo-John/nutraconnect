<x-layout>
    <div class="login-wrapper">
        <div class="bg-overlay bg-white"></div>
        <div class="container">
            <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-lg-6 col-xl-5">

                        <div class="text-center">
                            <div class="mb-4 mb-md-5">
                                <img src="{{ asset('assets/images/login-logo.png') }}" alt="" height="22"
                                    class="auth-logo-dark">
                            </div>

                            <div class="text-muted mb-4">
                                <h5 class="">Reset Password</h5>
                            </div>

                            <form method="post" action="{{ route('password.store') }}">
                                @csrf
                                @method('post')

                                <!-- Password Reset Token -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <div class="form-group mt-3">
                                    <label class="login__label" for="user-email">Email</label>
                                    <input type="email" name="email" class="form-control login__field mt-2 mb-3" value="{{ $request->email }}" readonly>

                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-3">
                                    <label class="login__label" for="user-password">Password</label>
                                    <input type="password" name="password" class="form-control login__field mt-2 mb-3" id="input-newpassword"
                                        placeholder="Password">

                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-3">
                                    <label class="login__label" for="user-confirm-password">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control login__field mt-2 mb-3"
                                        id="input-confirmpassword" placeholder="Password">
                                    <div class="form-floating-icon">

                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-info w-100" type="submit">Reset</button>
                                </div>
                            </form><!-- end form -->

                            <div class="mt-5 text-center text-muted">
                                <p>Remember It ? <a href="{{ route('login') }}"
                                        class="fw-medium text-decoration-underline"> Sign In </a></p>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->

            </div>

        </div><!-- end container -->
    </div>
</x-layout>
