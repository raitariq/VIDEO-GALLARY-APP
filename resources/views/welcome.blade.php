<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css') }}">
        <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css')}}">
        <!-- Styles / Scripts -->
        {{-- @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
           
        @endif --}}
    </head>
    <body class="nk-body bg-lighter npc-general has-sidebar ">
        <div class="nk-app-root">
            <!-- main @s -->
            <div class="nk-main ">
                <!-- sidebar @s -->
                <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                    <div class="nk-sidebar-element nk-sidebar-head">
                        <div class="nk-menu-trigger">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-sidebar-brand">
                            <a href="html/index.html" class="logo-link nk-sidebar-logo">
                                <img class="logo-light logo-img" src="{{ asset('assets/images/logo.png') }}" srcset="./images/logo2x.png 2x" alt="logo">
                                <img class="logo-dark logo-img" src="{{ asset('assets/images/logo-dark.png') }}" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                            </a>
                        </div>
                    </div><!-- .nk-sidebar-element -->
                    <div class="nk-sidebar-element nk-sidebar-body">
                        <div class="nk-sidebar-content">
                            <div class="nk-sidebar-menu" data-simplebar>
                                <ul class="nk-menu">
                                    <li class="nk-menu-heading">
                                        <h6 class="overline-title text-primary-alt">Dashboards</h6>
                                    </li><!-- .nk-menu-item -->
                                    <li class="nk-menu-item">
                                        <a href="html/index.html" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                                            <span class="nk-menu-text">Default Dashboard</span>
                                        </a>
                                    </li><!-- .nk-menu-item -->
                                   
                                </ul><!-- .nk-menu -->
                            </div><!-- .nk-sidebar-menu -->
                        </div><!-- .nk-sidebar-content -->
                    </div><!-- .nk-sidebar-element -->
                </div>
                <!-- sidebar @e -->
                <!-- wrap @s -->
                <div class="nk-wrap ">
                    <!-- main header @s -->
                    <div class="nk-header nk-header-fixed is-light">
                        <div class="container-fluid">
                            <div class="nk-header-wrap">
                                <div class="nk-menu-trigger d-xl-none ms-n1">
                                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                                </div>
                                <div class="nk-header-brand d-xl-none">
                                    <a href="html/index.html" class="logo-link">
                                        <img class="logo-light logo-img" src="{{ asset('assets/images/logo.png')}}" srcset="./images/logo2x.png 2x" alt="logo">
                                        <img class="logo-dark logo-img" src="{{ asset('assets/images/logo-dark.png')}}" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                                    </a>
                                </div><!-- .nk-header-brand -->
                                <div class="nk-header-news d-none d-xl-block">
                                    <div class="nk-news-list">
                                    
                                    </div>
                                </div><!-- .nk-header-news -->
                                <div class="nk-header-tools">
                                    <ul class="nk-quick-nav">
                                        
                                        <li class="dropdown user-dropdown">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <div class="user-toggle">
                                                    <div class="user-avatar sm">
                                                        <em class="icon ni ni-user-alt"></em>
                                                    </div>
                                                    <div class="user-info d-none d-md-block">
                                                        <div class="user-status">Administrator</div>
                                                        <div class="user-name dropdown-indicator">Abu Bin Ishityak</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                                                <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                    <div class="user-card">
                                                        <div class="user-avatar">
                                                            <span>AB</span>
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="lead-text">Abu Bin Ishtiyak</span>
                                                            <span class="sub-text">info@softnio.com</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown-inner">
                                                    <ul class="link-list">
                                                        <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                        <li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                        <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                                        <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="dropdown-inner">
                                                    <ul class="link-list">
                                                        <li><a href="#"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li><!-- .dropdown -->
                                        
                                    </ul><!-- .nk-quick-nav -->
                                </div><!-- .nk-header-tools -->
                            </div><!-- .nk-header-wrap -->
                        </div><!-- .container-fliud -->
                    </div>
                    <!-- main header @e -->
                    <!-- content @s -->
                    <div class="nk-content ">
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Sales Overview</h3>
                                                <div class="nk-block-des text-soft">
                                                    <p>Welcome to DashLite Dashboard Template.</p>
                                                </div>
                                            </div><!-- .nk-block-head-content -->
                                            <div class="nk-block-head-content">
                                                <div class="toggle-wrap nk-block-tools-toggle">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                                    <div class="toggle-expand-content" data-content="pageMenu">
                                                        <ul class="nk-block-tools g-3">
                                                            <li>
                                                                <div class="dropdown">
                                                                    <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-bs-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span class="d-none d-md-inline">Last</span> 30 Days</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a href="#"><span>Last 30 Days</span></a></li>
                                                                            <li><a href="#"><span>Last 6 Months</span></a></li>
                                                                            <li><a href="#"><span>Last 1 Years</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-block-head-content -->
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="row g-gs">
                                            <div class="col-xxl-6">
                                                <div class="row g-gs">
                                                    <div class="col-lg-6 col-xxl-12">
                                                        <div class="card card-bordered">
                                                            <div class="card-inner">
                                                                <div class="card-title-group align-start mb-2">
                                                                    <div class="card-title">
                                                                        <h6 class="title">Sales Revenue</h6>
                                                                        <p>In last 30 days revenue from subscription.</p>
                                                                    </div>
                                                                    <div class="card-tools">
                                                                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Revenue from subscription"></em>
                                                                    </div>
                                                                </div>
                                                                <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                                                    <div class="nk-sale-data-group flex-md-nowrap g-4">
                                                                        <div class="nk-sale-data">
                                                                            <span class="amount">14,299.59 <span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>16.93%</span></span>
                                                                            <span class="sub-title">This Month</span>
                                                                        </div>
                                                                        <div class="nk-sale-data">
                                                                            <span class="amount">7,299.59 <span class="change up text-success"><em class="icon ni ni-arrow-long-up"></em>4.26%</span></span>
                                                                            <span class="sub-title">This Week</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="nk-sales-ck sales-revenue">
                                                                        <canvas class="sales-bar-chart" id="salesRevenue"></canvas>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- .col -->
                                                   
                                                </div><!-- .row -->
                                            </div><!-- .col -->
                                           
                                        </div><!-- .row -->
                                    </div><!-- .nk-block -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content @e -->
                    <!-- footer @s -->
                    <div class="nk-footer">
                        <div class="container-fluid">
                            <div class="nk-footer-wrap">
                                <div class="nk-footer-copyright"> &copy; 2023 DashLite. Template by <a href="https://softnio.com" target="_blank">Softnio</a>
                                </div>
                                <div class="nk-footer-links">
                                    <ul class="nav nav-sm">
                                        <li class="nav-item dropup">
                                            <a href="#" class="dropdown-toggle dropdown-indicator has-indicator nav-link text-base" data-bs-toggle="dropdown" data-offset="0,10"><span>English</span></a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                <ul class="language-list">
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <span class="language-name">English</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <span class="language-name">Español</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <span class="language-name">Français</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <span class="language-name">Türkçe</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a data-bs-toggle="modal" href="#region" class="nav-link"><em class="icon ni ni-globe"></em><span class="ms-1">Select Region</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- footer @e -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- main @e -->
        </div>
        <!-- app-root @e -->
        <!-- select region modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="region">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-md">
                        <h5 class="title mb-4">Select Your Country</h5>
                        <div class="nk-country-region">
                            <ul class="country-list text-center gy-2">
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/arg.png" alt="" class="country-flag">
                                        <span class="country-name">Argentina</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/aus.png" alt="" class="country-flag">
                                        <span class="country-name">Australia</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/bangladesh.png" alt="" class="country-flag">
                                        <span class="country-name">Bangladesh</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/canada.png" alt="" class="country-flag">
                                        <span class="country-name">Canada <small>(English)</small></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/china.png" alt="" class="country-flag">
                                        <span class="country-name">Centrafricaine</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/china.png" alt="" class="country-flag">
                                        <span class="country-name">China</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/french.png" alt="" class="country-flag">
                                        <span class="country-name">France</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/germany.png" alt="" class="country-flag">
                                        <span class="country-name">Germany</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/iran.png" alt="" class="country-flag">
                                        <span class="country-name">Iran</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/italy.png" alt="" class="country-flag">
                                        <span class="country-name">Italy</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/mexico.png" alt="" class="country-flag">
                                        <span class="country-name">México</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/philipine.png" alt="" class="country-flag">
                                        <span class="country-name">Philippines</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/portugal.png" alt="" class="country-flag">
                                        <span class="country-name">Portugal</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/s-africa.png" alt="" class="country-flag">
                                        <span class="country-name">South Africa</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/spanish.png" alt="" class="country-flag">
                                        <span class="country-name">Spain</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/switzerland.png" alt="" class="country-flag">
                                        <span class="country-name">Switzerland</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/uk.png" alt="" class="country-flag">
                                        <span class="country-name">United Kingdom</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="country-item">
                                        <img src="./images/flags/english.png" alt="" class="country-flag">
                                        <span class="country-name">United State</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- .modal-content -->
            </div><!-- .modla-dialog -->
        </div><!-- .modal -->
        <!-- JavaScript -->
        <script src="{{ asset('assets/js/bundle.js')}}"></script>
        <script src="{{ asset('assets/js/scripts.js')}}"></script>
    </body>
</html>
