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

                        <form class="login__form" method="post" action="{{ route('register') }}">
                            @csrf
                            @method('post')

                            <div class="login__form-wrapper">
                                <div class="logo-img mb-5">
                                    <img src="{{ asset('assets/images/login-logo.png') }}">
                                </div>
                                <h1>SIGN UP WITH</h1>
                                <p>WELCOME TO NUTRACONNECT</p>

                                <div class="login__field-group">
                                    <label class="login__label" for="user-mame">Name</label>
                                    <input class="login__field mt-2 mb-3" id="user-name" name="name" type="text"
                                        placeholder="Enter Your Name">

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="login__field-group">
                                    <label class="login__label" for="user-email">Email</label>
                                    <input class="login__field mt-2 mb-3" id="user-email" name="email" type="email"
                                        placeholder="Enter Your Email">

                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="login__field-group mt-3">
                                    <label class="login__label" for="pass">Password</label>
                                    <input class="login__field mt-2 mb-3" id="user-pass" name="password"
                                        type="password " placeholder="Enter Your Password" name="pass">

                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="login__field-group mt-3">
                                    <label class="login__label" for="pass">Confirm Password</label>
                                    <input class="login__field mt-2 mb-3" id="user-confirm-pass" name="password_confirmation"
                                        type="password " placeholder="Confirm Password">

                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button class="login__btn mt-3 mb-3" type="submit" data-login="false">
                                    <span class="login__btn-label">Sign Up</span>
                                </button>

                                <div class="text-end login__field-group">
                                    <a href="{{ route('login') }}">Sign In</a>
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
