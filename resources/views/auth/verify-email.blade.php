<x-layout>
    <div class="login-wrapper">
        <div class="bg-overlay bg-white"></div>
        <div class="container">
            <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-lg-6 col-xl-6">

                        <div class="text-center">
                            <div class="mb-4 mb-md-5">
                                <img src="{{ asset('assets/images/login-logo.png') }}" alt="" height="22"
                                    class="auth-logo-dark">
                            </div>

                            <div class="text-muted mb-4">
                                <h5 class="">Verify Your Email</h5>
                            </div>

                            <div class="alert alert-success text-center mb-4" role="alert">
                                Verification email sent to your registered email address. Please check it
                            </div>

                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-info w-100">Resend Verification Email</button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-danger w-100">Log Out</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->

            </div>
        </div><!-- end container -->
    </div>
</x-layout>
