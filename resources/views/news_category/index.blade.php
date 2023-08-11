<x-auth-layout>
    <main class="page-content">

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="card">

                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">News Category</h6>
                        <p class="mb-0">Create</p>
                    </div>

                    <div class="d-flex pt-3">
                        <a href="{{ route('news-category.create') }}"><button
                                class="btn btn-success btn-sm">Add</button></a>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <table id="newsCategoryTable" class="table-sm table" data-search="true"
                                    data-toggle="table" data-pagination="true" data-show-export="true" data-buttons-prefix="btn-sm btn"
                                    data-buttons-align="right">
                                    <thead>
                                        <tr>
                                            <th data-field="name" data-sortable="true" scope="col">Name</th>
                                            <th data-field="status" data-sortable="true" scope="col">Status</th>
                                            <th data-field="action" style="width: 80px; min-width: 80px;">Action</th>
                                        </tr><!-- end tr -->
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @foreach ($category as $cat)
                                            <tr>
                                                <td>{{ $cat->name }}</td>
                                                <td>
                                                    {{ $cat->status === '1' ? 'Active' : 'Not Active' }}
                                                </td>
                                                <td class="w-25">
                                                    <div class="d-flex">
                                                        <a href="{{ route('news-category.edit', $cat->id) }}"
                                                            class="btn btn-sm">
                                                            <i class="fa fa-pencil text-primary"></i>
                                                        </a>
                                                        <form method="post"
                                                            action="{{ route('news-category.destroy', $cat->id) }}">
                                                            @csrf @method('delete')
                                                            <button class="btn btn-sm"><i
                                                                    class="fa fa-trash text-danger"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!-- end tr -->
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
