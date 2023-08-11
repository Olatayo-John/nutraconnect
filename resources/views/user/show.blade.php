<x-auth-layout>

    @push('css')
        <!-- swiper css -->
        <link rel="stylesheet" href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}">
    @endpush

    <main class="page-content">

        <div class="container-fluid">

            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h6 class="mb-0">User</h6>
                <p class="mb-0">View</p>
            </div>

            <div class="d-flex"></div>

            <div class="row">
                <div class="col-xl-4">
                    <div class="card mt-n5">

                        <div class="text-end">
                            <div class="dropdown">
                                <a class="btn btn-link text-dark font-size-16 p-1 dropdown-toggle shadow-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="uil uil-ellipsis-h"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('user.edit',$user->id) }}">Edit</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="card-body text-center">
                            <div class="avatar-xl mx-auto mb-4">
                                <img src="{{ $user->profile ? asset('storage/' . $user->profile) : asset('storage/default/no_image.jpg') }}"
                                    alt="" class="rounded-circle img-thumbnail">
                            </div>
                            <h5 class="m-0">{{ $user->name }}</h5>
                            <p class="text-muted m-0">{{ $user->role->first() ? $user->role->first()->name : '' }}</p>
                            <p class="text-muted m-0">{{ $user->type }}</p>

                        </div>
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="pb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="font-size-20 text-primary flex-shrink-0 me-3">
                                            <i class="uil uil-globe"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-1 font-size-13">Website</p>
                                            <h6 class="mb-0 font-size-14">{{ $user->website }}</h6>
                                        </div>
                                    </div>
                                </li>
                                <!-- end li -->
                                <li class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="font-size-20 text-primary flex-shrink-0 me-3">
                                            <i class="uil uil-envelope-alt"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-1 font-size-13">E-mail</p>
                                            <h6 class="mb-0 font-size-14">{{ $user->email }}</h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="font-size-20 text-primary flex-shrink-0 me-3">
                                            <i class="uil uil-envelope-alt"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-1 font-size-13">Mobile</p>
                                            <h6 class="mb-0 font-size-14">{{ $user->mobile }}</h6>
                                        </div>
                                    </div>
                                </li>
                                <!-- end li -->
                                <li class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="font-size-20 text-primary flex-shrink-0 me-3">
                                            <i class="uil uil-map-marker"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="text-muted mb-1 font-size-13">Location</p>
                                            <h6 class="mb-0 font-size-14">{{ $user->location }}</h6>
                                        </div>
                                    </div>
                                </li>
                                <!-- end li -->
                            </ul>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-body">

                            <div>
                                <ul class="list-unstyled mb-0 text-muted">
                                    <li>
                                        <div class="d-flex align-items-center py-2">
                                            <div class="flex-grow-1">
                                                <i class="mdi mdi-github font-size-16 text-dark me-1"></i>
                                                Github
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div>{{ $user->github }}</div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center py-2">
                                            <div class="flex-grow-1">
                                                <i class="mdi mdi-twitter font-size-16 text-info me-1"></i>
                                                Twitter
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div>{{ $user->twitter }}</div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center py-2">
                                            <div class="flex-grow-1">
                                                <i class="mdi mdi-linkedin font-size-16 text-primary me-1"></i>
                                                Linkedin
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div>{{ $user->linkedin }}</div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center py-2">
                                            <div class="flex-grow-1">
                                                <i class="mdi mdi-pinterest font-size-16 text-danger me-1"></i>
                                                Pinterest
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div>{{ $user->pinterest }}</div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-xl-8">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">About</h5>

                                <p>{{ $user->description }}</p>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">News</h5>

                                <div data-simplebar style="max-height: 242px;">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($user->news as $blog)
                                            <li class="list-group-item py-3 px-0">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div>
                                                            <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('storage/default/no_image.jpg') }}"
                                                                alt="blog img" class="avatar-lg h-auto rounded">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <h5 class="font-size-14 mb-1 text-truncate"><a
                                                                href="{{ route('news.show', $blog->id) }}"
                                                                class="text-body">{{ $blog->title }}</a>
                                                        </h5>
                                                        <ul class="list-inline font-size-13 text-muted">
                                                            <li class="list-inline-item">
                                                                <a href="#" class="text-muted">
                                                                    <i class="uil uil-user me-1"></i>
                                                                    {{ $blog->user->name }}
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <i class="uil uil-calender me-1"></i>
                                                                {{ $blog->created_at }}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div><!-- end col -->
            </div>

        </div>
    </main>

    @push('script')
        <!-- swiper js -->
        <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
        <!-- profile init -->
        <script src="{{ asset('assets/js/pages/profile.init.js') }}"></script>
    @endpush



</x-auth-layout>
