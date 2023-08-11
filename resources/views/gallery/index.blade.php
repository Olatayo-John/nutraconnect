<x-auth-layout>
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/libs/glightbox/css/glightbox.min.css') }}">
    @endpush

    <main class="page-content">

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="card">

                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">Gallery</h6>
                        <p class="mb-0">List</p>
                    </div>

                    <div class="d-flex pt-3">
                        <a href="{{ route('gallery.create') }}"><button class="btn btn-success btn-sm">Add</button></a>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">

                                <table id="galleryTable" class="table-sm table" data-search="true" data-toggle="table"
                                    data-pagination="true" data-show-export="true" data-buttons-prefix="btn-sm btn"
                                    data-buttons-align="right">
                                    <thead>
                                        <tr>
                                            <th data-field="name" data-sortable="true" scope="col">Name</th>
                                            <th data-field="status" data-sortable="true" scope="col">Status</th>
                                            <th data-field="action" style="width: 80px; min-width: 80px;">Action</th>
                                        </tr><!-- end tr -->
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @foreach ($galleries as $gallery)
                                            <tr>
                                                <td>
                                                    <img src="{{ $gallery->image ? asset('storage/' . $gallery->image) : asset('storage/default/no_image.jpg') }}"
                                                        class="avatar-sm rounded-circle me-2">
                                                    <a class="text-body fw-medium">{{ $gallery->title }}</a>
                                                </td>
                                                <td>{{ $gallery->status === '1' ? 'Active' : 'Not Active' }}</td>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        @can('gallery_update')
                                                        <a href="{{ route('gallery.edit', $gallery->id) }}"
                                                            class="btn btn-sm">
                                                            <i class="fa fa-pencil text-primary"></i>
                                                        </a>
                                                        @endcan

                                                        @can('gallery_delete')
                                                        <form method="post"
                                                            action="{{ route('gallery.destroy', $gallery->id) }}">
                                                            @csrf @method('delete')
                                                            <button class="btn btn-sm"><i
                                                                    class="fa fa-trash text-danger"></i></button>
                                                        </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr><!-- end tr -->
                                        @endforeach
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                                <!-- end row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @push('script')
        <script src="{{ asset('assets/libs/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/gallery.init.js') }}"></script>
    @endpush
</x-auth-layout>
