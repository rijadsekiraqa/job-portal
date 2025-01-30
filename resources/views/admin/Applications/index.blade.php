@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Lista e Aplikimeve</h4>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <x-button id="delete-selected-categories" class="btn btn-danger px-3 align-items-center"
                                    style="display: none;">
                                    <img src="{{ asset('admin/assets/img/icons/close-circle.svg') }}" class="me-2"
                                        alt="img">Fshij te Selektuarat
                                </x-button>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img
                                        src="{{ asset('admin/assets/img/icons/search-white.svg') }}" alt="img"></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all-category">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Shpallja</th>
                                    <th>Emri</th>
                                    <th>Mbiemri</th>
                                    <th>Qyteti</th>
                                    <th>Email</th>
                                    <th>Telefoni</th>
                                    <th>CV</th>
                                    @if (Auth::user()->hasRole('super-admin'))
                                        <th>Perdoruesi</th>
                                    @endif
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applications as $application)
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox" class="category-checkbox"
                                                    value="{{ $application->id }}">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>

                                        <td>
                                            @if ($application->announcement)
                                                <a href="{{ route('announcements.show', $application->announcement_id) }}">
                                                    {{ $application->announcement->job_title }}
                                                </a>
                                            @else
                                                <span>No Announcement</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);">{{ $application->name }}</a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);">{{ $application->lastname }}</a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);">{{ $application->city }}</a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);">{{ $application->email }}</a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);">{{ $application->phone }}</a>
                                        </td>
                                        <td>
                                            @if ($application->resume)
                                                <a href="{{ asset('storage/' . $application->resume) }}" target="_blank">
                                                    <span class="badges bg-lightred">Shiko CV</span>
                                                </a>
                                            @else
                                                <span>No Resume</span>
                                            @endif
                                        </td>
                                            @if (Auth::user()->hasRole('super-admin'))
                                            <td>
                                                @if ($application->user)
                                                    <a href="{{ route('users.edit', $application->user_id) }}">
                                                        {{ $application->user->name }} {{ $application->user->lastname }}
                                                    </a>
                                                    @if ($application->user->companies->isNotEmpty())
                                                        - {{ $application->user->companies->first()->name }}
                                                    @else
                                                        - No Company
                                                    @endif
                                                @else
                                                    <span>No User</span>
                                                @endif
                                            </td>
                                        @endif
                                        <td>
                                            <x-link href="{{ route('applications.show', $application->id) }}" class="me-2">
                                                <img src="{{ asset('admin/assets/img/icons/eye1.svg') }}" alt="img">
                                            </x-link>
                                            <x-link href=""
                                                class="me-3 confirm-text"
                                                data-title="A jeni i sigurte qe doni te fshini kete kompani?"
                                                data-text="Ju nuk keni mundesi ta riktheni perseri!" data-confirm="Po!"
                                                data-cancel="Jo">
                                                <img src="{{ asset('admin/assets/img/icons/delete.svg') }}" alt="img">
                                            </x-link>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    @push('scripts')
        <script src="{{ asset('admin/assets/js/lobibox.min.js') }}"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @if (session('success'))
                    Lobibox.notify('success', {
                        // rounded: true,
                        delay: 3000,
                        icon: false,
                        sound: false, // If you want sound, set this to true
                        msg: "{{ session('success') }}"
                    });
                @endif
            });
        </script>
    @endpush

    @include('layouts.admin-footer')


    </body>

    </html>
@endsection
