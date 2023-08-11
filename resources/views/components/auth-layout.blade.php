<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-------------- Inter-font-family------------ -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="{{ asset('assets/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/light-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/header-colors.css') }}" rel="stylesheet" />

    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">
    <link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">
    @stack('css')

    <title>Nutraconnect</title>
</head>

<body>


    <!--start wrapper-->
    <div class="wrapper">
        <!--start top header-->
        <header class="top-header">
            <nav class="navbar navbar-expand gap-3 align-items-center">
                <div class="mobile-toggle-icon fs-3">
                    <i class="bi bi-list"></i>
                </div>
                <div class="dashboard-heading">
                    <h1 class="heading-dashboard"></h1>
                    <h6 class="m-0 p-0 text-danger">
                        {{ auth()->user()->role->first()? '': 'No Role assigned, contact Admin' }}</h6>
                </div>
                <form class="searchbar margin-left">
                    <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i
                            class="bi bi-search"></i></div>
                    <input class="form-control" type="text" placeholder=" search">
                    <div class="position-absolute top-50 translate-middle-y search-close-icon"><i
                            class="bi bi-x-lg"></i></div>
                </form>

                <div class="top-navbar-right ms-auto">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item search-toggle-icon">
                            <a class="nav-link" href="#">
                                <div class="">
                                    <i class="bi bi-search"></i>
                                </div>
                            </a>
                        </li>


                        <li class="nav-item dropdown dropdown-user-setting">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                                data-bs-toggle="dropdown">
                                <div class="user-setting d-flex align-items-center">
                                    <img src="{{ auth()->user()->profile ? asset('storage/' . auth()->user()->profile) : asset('storage/default/no_image.jpg') }}"
                                        class="user-img" alt=""> <span
                                        class="user-name-first">{{ auth()->user()->name }}</span>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ auth()->user()->profile ? asset('storage/' . auth()->user()->profile) : asset('storage/default/no_image.jpg') }}"
                                                alt="" class="rounded-circle" width="54" height="54">
                                            <div class="ms-3">
                                                <h6 class="mb-0 dropdown-user-name">{{ auth()->user()->name }}</h6>
                                                <small
                                                    class="mb-0 dropdown-user-designation text-secondary">{{ auth()->user()->role->first()? auth()->user()->role->first()->name: '' }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <div class="d-flex align-items-center">
                                            <div class=""><i class="bi bi-person-fill"></i></div>
                                            <div class="ms-3"><span>Profile</span></div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('password.change') }}">
                                        <div class="d-flex align-items-center">
                                            <div class=""><i class="bi bi-lock-fill"></i></div>
                                            <div class="ms-3"><span>Password Change</span></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('setting') }}">
                                        <div class="d-flex align-items-center">
                                            <div class=""><i class="bi bi-gear-fill"></i></div>
                                            <div class="ms-3"><span>Setting</span></div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-3">
                                            <form action="{{ route('logout') }}" method="post">@csrf
                                                @method('post')
                                                <button class="btn btn-danger"
                                                    type="submit"><span>Logout</span></button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!--end top header-->

        <!--start sidebar -->
        <aside class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div class="logo-background">
                    <img src="{{ asset('assets/images/logo.png') }}" class="logo-icon" alt="logo icon">
                </div>
                <!-- <div>
              <h4 class="logo-text">Snacked</h4>
            </div> -->
                <!-- anjani-toogle-button-anjni -->
                <!-- <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
            </div> -->
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="has-arrow">
                        <div class="parent-icon">
                            <i class="bi bi-house-fill"></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>

                @can('user_list')
                <li>
                    <a class="has-arrow" href="{{ route('user.index') }}">
                        <div class="parent-icon"><i class="bi bi-cloud-arrow-down-fill"></i>
                        </div>
                        <div class="menu-title">Users</div>
                    </a>
                </li>
                @endcan

                @can('role_permission_list')
                <li>
                    <a href="{{ route('role-permission') }}" class="has-arrow">
                        <div class="parent-icon"><i class="bi bi-basket2-fill"></i>
                        </div>
                        <div class="menu-title">Role & Permission</div>
                    </a>
                </li>
                @endcan

                @can('gallery_list')
                <li>
                    <a href="{{ route('gallery.index') }}" class="has-arrow">
                        <div class="parent-icon"><i class="fa fa-image"></i>
                        </div>
                        <div class="menu-title">Gallery</div>
                    </a>
                </li>
                @endcan

                @can('news_list')
                <li>
                    <a href="{{ route('news.index') }}">
                        <div class="parent-icon"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                        </div>
                        <div class="menu-title">News</div>
                    </a>
                </li>
                @endcan

                @can('setting_update')
                <li>
                    <a href="{{ route('setting') }}">
                        <div class="parent-icon"><i class="bi bi-gear-fill"></i>
                        </div>
                        <div class="menu-title">Setting</div>
                    </a>
                </li>
                @endcan

            </ul>
            <!--end navigation-->
        </aside>
        <!--end sidebar -->

        {{-- alert --}}
        @include('partials.alert')
        {{-- end alert --}}

        <!--start content-->
        {{ $slot }}
        <!--end page main-->

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

        <!--start switcher-->
        <div class="switcher-body">
            <!-- <button class="btn btn-primary btn-switcher shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-paint-bucket me-0"></i></button> -->
            <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true"
                data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Theme Customizer</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <h6 class="mb-0">Theme Variation</h6>
                    <hr>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="LightTheme"
                            value="option1">
                        <label class="form-check-label" for="LightTheme">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="DarkTheme"
                            value="option2">
                        <label class="form-check-label" for="DarkTheme">Dark</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="SemiDarkTheme"
                            value="option3" checked>
                        <label class="form-check-label" for="SemiDarkTheme">Semi Dark</label>
                    </div>
                    <hr>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="MinimalTheme"
                            value="option3">
                        <label class="form-check-label" for="MinimalTheme">Minimal Theme</label>
                    </div>
                    <hr />
                    <h6 class="mb-0">Header Colors</h6>
                    <hr />
                    <div class="header-colors-indigators">
                        <div class="row row-cols-auto g-3">
                            <div class="col">
                                <div class="indigator headercolor1" id="headercolor1"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor2" id="headercolor2"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor3" id="headercolor3"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor4" id="headercolor4"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor5" id="headercolor5"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor6" id="headercolor6"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor7" id="headercolor7"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor8" id="headercolor8"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end switcher-->

    </div>
    <!--end wrapper-->

    <!-- Bootstrap bundle JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
    <!-- Vector map JavaScript -->
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    {{-- bootstrap table --}}
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/mobile/bootstrap-table-mobile.min.js"></script>
    <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/export/bootstrap-table-export.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/print/bootstrap-table-print.min.js"></script>

    <!--app-->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script>
        new PerfectScrollbar(".review-list")
        new PerfectScrollbar(".chat-talk")
    </script>
    <script>
        // ---------------New-tabs------------
        const buttons = document.querySelectorAll('[role="tab"]');
        const tabPanels = Array.from(document.querySelectorAll('[role="tabpanel"]'));

        function toggleAttribute(elements, attribute, value) {
            elements.forEach((element) => {
                element.setAttribute(attribute, value);
            });
        }

        function showTabContent(e) {
            const id = this.id;

            toggleAttribute(tabPanels, "hidden", true);
            toggleAttribute(buttons, "aria-selected", false);
            toggleAttribute([this], "aria-selected", true);
            const tabPanel = tabPanels.find(
                (panel) => panel.getAttribute("aria-labelledby") === id
            );
            tabPanel.hidden = false;
        }

        buttons.forEach((button) => {
            button.addEventListener("click", showTabContent);
        });
    </script>
    <script>
        $(document).ready(function() {
            //reset searcxh box
            $('.testBtn').click(function() {
                $('#usersTable').bootstrapTable('resetSearch')
            })

            $(".tabs-menu").click(function() {
                $(".tabs-menu.active").removeClass('active')
                $(this).addClass('active')
            });

            //select or de-select all checkbox on any form
            $(document).on('change', '#allPermissions', function(e) {
                e.preventDefault();

                var isSelected = $(this).is(':checked');
                var onForm = $(this).attr('formName');

                if (isSelected === true) {
                    $('form#' + onForm + ' input[type="checkbox"]').prop('checked', true);
                } else {
                    $('form#' + onForm + ' input[type="checkbox"]').prop('checked', false);
                }

            });
        });
    </script>



    @stack('script')
</body>

</html>
