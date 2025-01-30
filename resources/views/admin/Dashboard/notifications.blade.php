@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Njoftimet</h4>
                </div>
            </div>

            <div class="activity">
                <div class="activity-box">
                    <ul class="activity-list">
                        @forelse ($notifications as $notification)
                            <li class="notification-message">
                                <a href="{{ $notification->data['link'] ?? 'javascript:void(0)' }}">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img alt="User Avatar"
                                                src="{{ asset($notification->data['user_image'] ?? 'admin/assets/img/profiles/avatar-02.jpg') }}"
                                                class="img-fluid">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details">
                                                <span class="noti-title fw-normal">
                                                    {{ $notification->data['title'] ?? 'Unknown User' }}
                                                </span>
                                                {{ $notification->data['message'] ?? 'No Message' }}
                                            </p>
                                            <p class="noti-time">
                                                <span class="notification-time">
                                                    {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="notification-message">
                                <span>No new notifications</span>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.admin-footer')
@endsection
