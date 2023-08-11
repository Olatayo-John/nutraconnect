<x-auth-layout>
    <main class="page-content">

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="card">

                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">News</h6>
                        <p class="mb-0">List</p>
                    </div>

                    <div class="d-flex pt-3">
                        <a href="{{ route('news.create') }}"><button class="btn btn-success btn-sm">Add</button></a>
                        <a href="{{ route('news-category.index') }}" class="px-2">
                            <button class="btn btn-success btn-sm">News Category</button>
                        </a>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <table id="newsTable" class="table-sm table" data-search="true" data-toggle="table" data-pagination="true"
                                    data-show-export="true" data-buttons-prefix="btn-sm btn" data-buttons-align="right">
                                    <thead>
                                        <tr>
                                            <th data-field="title" data-sortable="true" scope="col">Title</th>
                                            <th data-field="category" data-sortable="true" scope="col">Category</th>
                                            {{-- <th data-field="description" data-sortable="true" scope="col">Description</th> --}}
                                            <th data-field="status" data-sortable="true" scope="col">Status</th>
                                            <th data-field="date" data-sortable="true" scope="col">Date</th>
                                            <th data-field="action" style="width: 80px; min-width: 80px;">Action</th>
                                        </tr><!-- end tr -->
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @foreach ($newsList as $news)
                                            <tr>
                                                <td>
                                                    <img src="{{ $news->image ? asset('storage/' . $news->image) : asset('storage/default/no_image.jpg') }}"
                                                        class="avatar-sm rounded-circle me-2">
                                                    <a href="{{ route('news.show', $news->id) }}"
                                                        class="text-body fw-medium">{{ $news->title }}</a>
                                                </td>
                                                <td>{{ $news->news_category->name }}</td>
                                                {{-- <td>{!! $news->description !!}</td> --}}
                                                <td>{{ $news->status === '1' ? 'Active' : 'Not Active' }}</td>
                                                <td class="text-danger">{{ $news->created_at }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('news.edit', $news->id) }}"
                                                            class="btn btn-sm">
                                                            <i class="fa fa-pencil text-primary"></i>
                                                        </a>
                                                        <form method="post"
                                                            action="{{ route('news.destroy', $news->id) }}">
                                                            @csrf @method('delete')
                                                            <button class="btn btn-sm"><i
                                                                    class="fa fa-trash text-danger"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr><!-- end tr -->
                                        @endforeach
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-auth-layout>
