<x-auth-layout>
    <main class="page-content">

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="card">

                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">Gallery</h6>
                        <p class="mb-0">Edit</p>
                    </div>

                    <div class="d-flex"></div>

                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('gallery.update',$gallery->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    <div class="form-group mb-3">
                                        <label for="">Title</label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ old('title',$gallery->title) }}">

                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="">Image</label>
                                            <input type="file" class="form-control" name="image">

                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <div class="instructions mt-2">
                                                @foreach (config('site.image_instructions') as $key => $value)
                                                    <strong class="text-danger">{{ $value }}</strong><br>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 mb-3">
                                            <label for="">Status</label>
                                            <select name="status" id="" class="form-control">
                                                <option value="">Select</option>
                                                @foreach (config('site.status') as $status)
                                                    <option value="{{ $status['value'] }}"
                                                        {{ old('status',$gallery->status) == $status['value'] ? 'selected' : '' }}>
                                                        {{ $status['name'] }}</option>
                                                @endforeach
                                            </select>

                                            @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
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
