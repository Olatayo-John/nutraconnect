<x-layout>
    <section class="login-wrapper">
        <div class="container">
            <div class="row login-flex">
                <div class="col-md-5">
                    <div class="log-img">
                        <img src="{{ asset('assets/images/side-login.png') }}">
                    </div>
                </div>
                <div class="col-md-7">

                    <div class="login-form">

                        <form class="login__form" method="post" action="{{ route('login') }}">
                            @csrf
                            @method('post')

                            <div class="login__form-wrapper">
                                <div class="logo-img mb-5">
                                    <img src="{{ asset('assets/images/login-logo.png') }}">
                                </div>
                                <h1>SIGN IN WITH</h1>
                                <p>WELCOME TO NUTRACONNECT</p>
                                <div class="login__field-group">
                                    <label class="login__label" for="user-email">Email</label>
                                    <input class="login__field mt-2 mb-3" id="user-email" name="email" type="text"
                                        placeholder="Enter Your Email" name="user_email">

                                    @error('email')
                                        <span class="text-danger err">{{ $message }}</span>
                                    @enderror
                                    <span class="text-danger err" id="emailErr"></span>
                                </div>

                                <div class="login__field-group mt-3">
                                    <label class="login__label" for="pass">Password</label>
                                    <input class="login__field mt-2 mb-3" id="pass" name="password"
                                        type="password " placeholder="Enter Your Password" name="pass">

                                    @error('password')
                                        <span class="text-danger err">{{ $message }}</span>
                                    @enderror
                                    <span class="text-danger err" id="passwordErr"></span>
                                </div>

                                <div class="login__field-group login__field-group--horz">
                                    <label class="login__label login__label--horz">
                                        <input class="login__checkbox" type="checkbox" name="remember"
                                            name="remember_me">
                                        <span>Remember me</span>
                                    </label>

                                    <a href="{{ route('password.request') }}">Forgot password ?</a>
                                </div>

                                <button class="login__btn mb-3" id="sendOtpBtn" type="button" data-login="false">
                                    <span class="login__btn-label">Send OTP Code</span>
                                </button>

                                @error('otp')
                                    <span class="text-danger err">{{ $message }}</span>
                                @enderror
                                <span class="text-danger err" id="otpErr"></span>
                                <span class="text-success succ" id="otpSucc"></span>

                                <div class="login__field-group mt-3" id="otp_group">
                                    <label class="login__label" for="pass">Enter OTP Code</label>
                                    <div class="otp mt-3 mb-3">
                                        <input class="login__field w-10-custom" name="otp[]" id="pass"
                                            type="text" placeholder="">
                                        <input class="login__field w-10-custom" name="otp[]" id="pass"
                                            type="text" placeholder="">
                                        <input class="login__field w-10-custom" name="otp[]" id="pass"
                                            type="text" placeholder="">
                                        <input class="login__field w-10-custom" name="otp[]" id="pass"
                                            type="text" placeholder="">
                                        <input class="login__field w-10-custom" name="otp[]" id="pass"
                                            type="text" placeholder="">
                                    </div>
                                </div>

                                <button class="login__btn mt-3 mb-3" type="submit" data-login="false">
                                    <span class="login__btn-label">Sign In</span>
                                </button>

                                <div class="text-end login__field-group">
                                    <a href="{{ route('register') }}">Create Account</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @push('script')
        <script>
            $(document).ready(function() {
                $(document).on('click', '#sendOtpBtn', function() {
                    var email = $('#user-email').val();

                    $.ajax({
                        url: "{{ route('send-otp') }}",
                        method: "post",
                        dataType: "json",
                        data: {
                            '_token': "{{ csrf_token() }}",
                            '_method': "post",
                            'email': email
                        },
                        beforeSend: function() {
                            //clear prev. message
                            $('span.err,span.succ').text('').hide();
                        },
                        success: function(res) {

                            if (res.status === true) {
                                // $('#alertDivAjaxSucc').html(res.msg).show();
                                $('#otpSucc').html(res.msg).show();
                                $('#otp_group').show();
                            }
                        },
                        error: function(eRes) {
                            const errorKeys = ['email', 'password', 'otp'];
                            const errors = eRes.responseJSON.errors;

                            $(errorKeys).each(function(key, value) {
                                var errValue = errors['' + value + ''];

                                if ((errValue) && (errValue !== "") && (errValue !==
                                        null) && (errValue !== undefined)) {
                                    $('span#' + value + 'Err')
                                        .text(errValue[0]).show();
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endpush


</x-layout>
