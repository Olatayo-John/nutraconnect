<x-auth-layout>

    <main class="page-content">

        <div class="row">
            <div class="col-xxl-12 col-lg-12">
                <div class="card">

                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">Setting</h6>
                        <p class="mb-0"></p>
                    </div>

                    <div class="d-flex"></div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">

                                <form method="post" action="{{ route('setting.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('post')

                                    <div class="row">
                                        <div class="col-md-4 form-group mt-3">
                                            <label for="">Site Name</label>
                                            <input type="text" class="form-control" name="site_name"
                                                value="{{ old('site_name', $keyedSettings['site_name']['meta_value']) }}">

                                            @error('site_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 form-group mt-3">
                                            <label for="">Site Keywords</label>
                                            <input type="text" class="form-control" name="site_keywords"
                                                value="{{ old('site_keywords', $keyedSettings['site_keywords']['meta_value']) }}">

                                            @error('site_keywords')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 form-group mt-3">
                                            <label for="">Site Logo</label>
                                            <input type="file" class="form-control" name="site_logo"
                                                value="{{ old('site_logo') }}">

                                            @error('site_logo')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            {{-- <div class="instructions mt-2">
                                                @foreach (config('site.image_instructions') as $key => $value)
                                                    <strong class="text-danger">{{ $value }}</strong><br>
                                                @endforeach
                                            </div> --}}
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="">Site Description</label>
                                        <textarea class="form-control" name="site_description" placeholder="Enter Description" rows="3">{{ old('site_description', $keyedSettings['site_description']['meta_value']) }}</textarea>

                                        @error('site_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-md-4 form-group mt-3">
                                            <label for="">Type</label>
                                            <input type="text" name="mail_type" class="form-control"
                                                id="mail-info-type-input" placeholder="Enter Mail Type e.g smtp"
                                                value="{{ old('mail_type', $keyedSettings['mail_type']['meta_value']) }}">

                                            @error('mail_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 form-group mt-3">
                                            <label for="">Host</label>
                                            <input type="text" name="mail_host" class="form-control"
                                                id="mail-info-host-input" placeholder="Enter Mail Host"
                                                value="{{ old('mail_host', $keyedSettings['mail_host']['meta_value']) }}">

                                            @error('mail_host')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 form-group mt-3">
                                            <label for="">Port</label>
                                            <input type="text" name="mail_port" class="form-control"
                                                id="mail-info-port-input" placeholder="Enter Mail Port"
                                                value="{{ old('mail_port', $keyedSettings['mail_port']['meta_value']) }}">

                                            @error('mail_port')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group mt-3">
                                            <label for="">Mail Username</label>
                                            <input type="email" name="mail_username" class="form-control"
                                                id="mail-info-username-input" placeholder="Enter Mail Username"
                                                value="{{ old('mail_username', $keyedSettings['mail_username']['meta_value']) }}">

                                            @error('mail_username')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group mt-3">
                                            <label for="">Mail Password</label>
                                            <input type="password" name="mail_password" class="form-control"
                                                id="mail-info-password-input" placeholder="Enter Mail Password"
                                                value="{{ old('mail_password', $keyedSettings['mail_password']['meta_value']) }}">

                                            @error('mail_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-group mt-3">
                                        <label for="">About Us</label>
                                        <textarea class="form-control" name="about_us" placeholder="Enter About Us" id="about-us-info-editor" rows="3">{{ old('about_us', $keyedSettings['about_us']['meta_value']) }}</textarea>

                                        @error('about_us')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="">Terms & Conditons</label>
                                        <textarea class="form-control" name="terms_condition" placeholder="Enter Terms & Conditions" id='tc-info-editor'
                                            rows="3">{{ old('terms_condition', $keyedSettings['terms_condition']['meta_value']) }}</textarea>

                                        @error('terms_condition')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="">Privacy Policy</label>
                                        <textarea class="form-control" name="privacy_policy" placeholder="Enter Privacy & Policy" id="pp-info-editor"
                                            rows="3">{{ old('privacy_policy', $keyedSettings['privacy_policy']['meta_value']) }}</textarea>

                                        @error('privacy_policy')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="text-end mt-3">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end form -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
    </main>


    @push('script')
        <script>
            ClassicEditor
                .create(document.querySelector('#about-us-info-editor'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor
                .create(document.querySelector('#tc-info-editor'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor
                .create(document.querySelector('#pp-info-editor'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</x-auth-layout>
