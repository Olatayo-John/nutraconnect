<x-auth-layout>
    <main class="page-content">

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="card">

                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">Profile</h6>
                        <p class="mb-0">Edit</p>
                    </div>

                    <div class="d-flex"></div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <form action="{{ route('profile.update', $user->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    <div class="row">
                                        <div class="form-group col-md-4 mt-3">
                                            <label for="">Name</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Enter Name" value="{{ old('name', $user->name) }}">

                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4 mt-3">
                                            <label for="">Type</label>
                                            <input type="text" class="form-control"
                                                name="type" value="{{ old('type', $user->type) }}" readonly>

                                            @error('type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4 mt-3">
                                            <label for="">Profile Image</label>
                                            <input type="file" class="form-control" name="profile">

                                            @error('profile')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6 mt-3">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control" placeholder="Enter Email"
                                                name="email"value="{{ old('email', $user->email) }}" readonly>

                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 mt-3">
                                            <label for="">Mobile</label>
                                            <input type="number" class="form-control" placeholder="Enter Mobile"
                                                name="mobile"value="{{ old('mobile', $user->mobile) }}">

                                            @error('mobile')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6 mt-3">
                                            <label for="">Website</label>
                                            <input type="text" class="form-control" placeholder="Enter website"
                                                name="website"value="{{ old('website', $user->website) }}">

                                            @error('website')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 mt-3">
                                            <label for="">Location</label>
                                            <input type="text" class="form-control" placeholder="Enter Address"
                                                name="location"value="{{ old('location', $user->location) }}">

                                            @error('location')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-3 mt-3">
                                            <label for="">Twitter</label>
                                            <input type="text" class="form-control" placeholder="Enter Twitter"
                                                name="twitter"value="{{ old('twitter', $user->twitter) }}">

                                            @error('twitter')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3 mt-3">
                                            <label for="">Github</label>
                                            <input type="text" class="form-control" placeholder="Enter Github"
                                                name="github"value="{{ old('github', $user->github) }}">

                                            @error('github')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3 mt-3">
                                            <label for="">Pinterest</label>
                                            <input type="text" class="form-control" placeholder="Enter Pinterest"
                                                name="pinterest"value="{{ old('pinterest', $user->pinterest) }}">

                                            @error('pinterest')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-3 mt-3">
                                            <label for="">Linkedin</label>
                                            <input type="text" class="form-control" placeholder="Enter Linkedin"
                                                name="linkedin"value="{{ old('linkedin', $user->linkedin) }}">

                                            @error('linkedin')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" placeholder="Enter Description" name="description" rows="3">{{ old('description', $user->description) }}</textarea>

                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <button class="btn btn-success" type="submit">Update</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-auth-layout>
