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
                                <h5 class="">Forgot Password</h5>
                            </div>

                            <div class="alert alert-success text-center mb-4" role="alert">
                                Enter your Email and instructions will be sent to you!
                            </div>

                            <form method="post" action="{{ route('password.email') }}">
                                @csrf
                                @method('post')

                                <div class="login__field-group">
                                    <label class="login__label" for="user-email">Email</label>
                                    <input class="login__field mt-2 mb-3" id="user-email" name="email" type="text"
                                        placeholder="Enter Your Email" name="user_email">

                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-info w-100">Send Request</button>
                                </div>
                            </form><!-- end form -->
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->

               
            </div>
        </div><!-- end container -->
    </div>
</x-layout>
