<x-auth-layout>
    <main class="page-content">

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="card">

                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">News Category</h6>
                        <p class="mb-0">Edit</p>
                    </div>

                    <div class="d-flex"></div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <form action="{{ route('news-category.update',$news_category->id) }}" method="post">
                                    @csrf
                                    @method('put')

                                    <div class="row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="">Category Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name',$news_category->name) }}" placeholder="Enter Category Name">

                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 mb-3">
                                            <label for="">Status</label>
                                            <select name="status" id="" class="form-control">
                                                <option value="">Select</option>
                                                @foreach (config('site.status') as $status)
                                                    <option value="{{ $status['value'] }}"
                                                        {{ old('status',$news_category->status) == $status['value'] ? 'selected' : '' }}>
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
