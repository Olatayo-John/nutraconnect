<x-auth-layout>
    <main class="page-content">

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="card">

                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">Passowrd</h6>
                        <p class="mb-0"></p>
                    </div>

                    <div class="d-flex"></div>

                    <div class="card-body">
                        
                        <form action="{{ route('password.update') }}" method="post">
                            @csrf
                            @method('put')

                            <div class="form-group mt-3">
                                <label for="">Current Password</label>
                                <input type="password" class="form-control" name="current_password">

                                @error('current_password', 'updatePassword')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password">

                                @error('password', 'updatePassword')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation">

                                @error('password_confirmation', 'updatePassword')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mt-3 text-end">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-auth-layout>
