<!-- -------modal-user -->
<div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="my-3">
                                <input type="radio" id="tab1" name="tab" value="Principle" checked>
                                <label for="tab1">Principle</label>
                                <input type="radio" id="tab2" name="tab" value="Distributor">
                                <label for="tab2">Distributor</label>
                            </div>
                        </div>

                        <article id="Principle">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter Name" data-last-active-input="">

                                    <span class="text-danger err" id="nameErr"></span>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Role</label>
                                    <select name="role" id="role" userId="" class="form-control">
                                        <option value=""></option>
                                        @foreach ($roleList as $key => $value)
                                            <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                        @endforeach
                                    </select>

                                    <span class="err text-danger" id="roleErr"></span>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Enter Email" data-last-active-input="">
                                <span class="text-danger err" id="emailErr"></span>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label class="form-label">Phone No</label>
                                <input type="tel" name="mobile" id="mobile" class="form-control"
                                    placeholder="Enter Phone No" data-last-active-input="">
                                <span class="text-danger err" id="mobileErr"></span>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter Password" data-last-active-input="">
                                <span class="text-danger err" id="passwordErr"></span>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="Confirm Password" data-last-active-input="">
                            </div>
                        </article>

                        <article id="Distributor">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Name Anjani</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter Name" data-last-active-input="">

                                    <span class="text-danger err" id="nameErr"></span>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Role Anjani</label>
                                    <select name="role" id="role" userId="" class="form-control">
                                        <option value=""></option>
                                        @foreach ($roleList as $key => $value)
                                            <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                        @endforeach
                                    </select>

                                    <span class="err text-danger" id="roleErr"></span>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-3">
                                <label class="form-label">Email Anjani</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Enter Email" data-last-active-input="">
                                <span class="text-danger err" id="emailErr"></span>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label class="form-label">Phone No Anjani</label>
                                <input type="tel" name="mobile" id="mobile" class="form-control"
                                    placeholder="Enter Phone No" data-last-active-input="">
                                <span class="text-danger err" id="mobileErr"></span>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label class="form-label">Password Anjani</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter Password" data-last-active-input="">
                                <span class="text-danger err" id="passwordErr"></span>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label class="form-label">Confirm Password Anjani</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="Confirm Password" data-last-active-input="">
                            </div>
                        </article>

                        <div class="col-lg-12 mx-auto my-4 text-end">
                            <button type="button" class="btn btn-success btn-lg" id="addUserBtn">Save</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- -------modal-user -->


@push('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#addUserBtn', function() {
                var uType = $('input[name="tab"]:checked').val();
                var name = $('article#' + uType + ' input#name').val();
                var role = $('article#' + uType + ' select#role').val();
                var email = $('article#' + uType + ' input#email').val();
                var mobile = $('article#' + uType + ' input#mobile').val();
                var password = $('article#' + uType + ' input#password').val();
                var password_confirmation = $('article#' + uType + ' input#password_confirmation').val();

                $.ajax({
                    url: "{{ route('user.store') }}",
                    method: "post",
                    dataType: "json",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        '_method': 'post',
                        'type': uType,
                        'name': name,
                        'role': role,
                        'email': email,
                        'mobile': mobile,
                        'password': password,
                        'password_confirmation': password_confirmation,
                    },
                    beforeSend: function() {
                        //clear prev. error on curerent tab
                        $('article#' + uType + ' span.err').text('').hide();

                        //clear prev. error on all tabs
                        // $('span.err').text('').hide();
                    },
                    success: function(res) {
                        if (res == true) {
                            alert('User Created');
                            window.location.reload();
                        }
                    },
                    error: function(eRes) {
                        const errorKeys = ['name', 'role', 'email', 'mobile', 'password'];
                        const errors = eRes.responseJSON.errors;

                        $(errorKeys).each(function(key, value) {
                            var errValue = errors['' + value + ''];

                            if ((errValue) && (errValue !== "") && (errValue !==
                                    null) && (errValue !== undefined)) {
                                $('article#' + uType + ' span#' + value + 'Err')
                                    .text(errValue[0]).show();
                            }
                        });
                    }
                });


            });
        });
    </script>
@endpush
