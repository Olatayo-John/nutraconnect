<x-auth-layout>
    <main class="page-content">

        <div class="row">
            <div class="col-12 col-lg-12 col-xl-12">
                <div class="card">

                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h6 class="mb-0">News</h6>
                        <p class="mb-0">Show</p>
                    </div>

                    <div class="d-flex"></div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-md-2">
                                            <img class="card-img img-fluid"
                                                src="{{ $news->image ? asset('storage/' . $news->image) : asset('storage/default/no_image.jpg') }}"
                                                alt="Card image">
                                        </div>

                                        <div class="col-md-10">
                                            <div class="card-body">
                                                <h5 class="card-title mb-1 text-center">{{ $news->title }}</h5>

                                                <p>{!! $news->description !!}</p>

                                                <ul class="list-inline font-size-13 text-muted text-end">
                                                    <li class="list-inline-item">
                                                        {{ $news->user->name }}
                                                    </li>
                                                    <li class="list-inline-item text-danger">
                                                        {{ $news->created_at }}
                                                    </li>
                                                </ul>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card -->
                            </div>
                        </div>

                        @auth
                            @if (auth()->user()->igd === $news->user_id)
                                <div class="d-flex">
                                    <a href="{{ route('news.edit', $news->id) }}" class="btn btn-dark btn-sm">Edit</a>
                                    <form action="{{ route('news.destroy', $news->id) }}" method="post">@csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            @endif
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </main>
</x-auth-layout>
