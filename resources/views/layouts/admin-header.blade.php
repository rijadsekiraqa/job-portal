<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (request()->is('cities*'))
        <meta name="bulkDeleteUrl" content="{{ route('cities.bulkDelete') }}">
    @elseif(request()->is('categories*'))
        <meta name="bulkDeleteUrl" content="{{ route('categories.bulkDelete') }}">
    @elseif(request()->is('companies*'))
        <meta name="bulkDeleteUrl" content="{{ route('companies.bulkDelete') }}">
    @elseif(request()->is('announcements*'))
        <meta name="bulkDeleteUrl" content="{{ route('announcements.bulkDelete') }}">
    @endif
    <title>Dreams Pos admin template</title>

    <link rel="shortcut icon" type="image/x-icon" href="admin/assets/img/favicon.jpg">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/lobibox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/lightbox/glightbox.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/custom.css') }}">
    <style>
        .lobibox-notify .lobibox-body {
            text-align: left;
            /* Aligns text to the left */
            padding-left: 10px;
            /* Adjust padding as needed */
        }
    </style>
</head>

<body>
    {{-- <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div> --}}

    <div class="main-wrapper">

        <div class="header">

            <div class="header-left active">
                <a href="{{ route('dashboard') }}" class="logo">
                    <img src="{{ asset('admin/assets/img/logo.png') }}" alt="">
                </a>
                <a href="index.html" class="logo-small">
                    <img src="{{ asset('admin/assets/img/logo-small.png') }}" alt="">
                </a>
                <a id="toggle_btn" href="javascript:void(0);">
                </a>
            </div>

            <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <ul class="nav user-menu">
                <li class="nav-item dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown" id="notificationDropdown">
                        <img src="{{ asset('admin/assets/img/icons/notification-bing.svg') }}" alt="img">
                        @if ($unreadNotificationCount > 0)
                            <span class="badge rounded-pill" id="notificationBadge">{{ $unreadNotificationCount }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Njoftimet</span>
                            {{-- <a href="javascript:void(0)" class="clear-noti">Clear All</a> --}}
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                @forelse ($notifications as $notification)
                                    <li class="notification-message">
                                        <a href="{{ $notification->data['link'] ?? 'javascript:void(0)' }}">
                                            <div class="media d-flex">
                                                <span class="avatar flex-shrink-0">
                                                    <img alt="User Avatar"
                                                        src="{{ asset('admin/assets/img/profiles/avatar-02.jpg') }}">
                                                </span>
                                                <div class="media-body flex-grow-1">
                                                    <p class="noti-details">
                                                        <span class="noti-title">{{ $notification->data['title'] ?? 'Unknown User' }}</span>
                                                        {{ $notification->data['message'] ?? 'No Message' }}
                                                    </p>
                                                    <p class="noti-time">
                                                        <span class="notification-time">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <li class="notification-message">
                                        <span>Nuk ka njoftimet te reja</span>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="{{ route('notifications.index') }}">Shiko te gjitha njoftimet</a>
                        </div>
                    </div>
                </li>
                

                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-img"><img src="{{ asset('admin/assets/img/profiles/avator1.jpg') }}"
                                alt="">
                            <span class="status online"></span></span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img"><img
                                        src="{{ asset('admin/assets/img/profiles/avator1.jpg') }}" alt="">
                                    <span class="status online"></span></span>
                                <div class="profilesets">
                                    <h6>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h6>
                                    {{-- <h5>{{ Auth::user()->roles->name }}</h5> --}}
                                    @if (Auth::user()->roles->isNotEmpty())
                                        <h5>{{ Auth::user()->roles->first()->name }}</h5>
                                        <!-- This assumes the user has one role -->
                                    @else
                                        <h5>No Role Assigned</h5>
                                    @endif
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item" href="{{ route('userprofile') }}"> <i class="me-2"
                                    data-feather="user"></i>
                                Profili Im</a>
                            <hr class="m-0">
                            <a class="dropdown-item logout pb-0" href="#" onclick="logout()"><img
                                    src="{{ asset('admin/assets/img/icons/log-out.svg') }}" class="me-2"
                                    alt="img">Dil</a>
                        </div>
                    </div>
                </li>
            </ul>


            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="generalsettings.html">Settings</a>
                    <a class="dropdown-item" href="signin.html">Logout</a>
                </div>
            </div>

        </div>


        @yield('content')

        <script>
            function logout() {
                $.post('{{ route('logout') }}', {
                    _token: '{{ csrf_token() }}'
                }, function() {
                    window.location.href = '{{ route('login') }}';
                });
            }
        </script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    const notificationDropdown = document.getElementById('notificationDropdown');
    const notificationBadge = document.getElementById('notificationBadge');

    notificationDropdown.addEventListener('click', function () {
        fetch('{{ route('notifications.read') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                notificationBadge.style.display = 'none';
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>