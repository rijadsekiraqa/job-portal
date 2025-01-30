@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>  {{ $application->announcement->job_title }}</h4>
                    <h6>Detajet e Aplikimit</h6>
                </div>
                {{-- <div class="page-btn">
                    <x-link href="{{ route('announcements.index') }}" class="btn btn-added">
                        <img src="{{ asset('admin/assets/img/icons/return1.svg') }}" class="me-2" alt="img">Kthehu
                    </x-link>
                </div> --}}
            </div>

            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="productdetails">
                                <ul class="product-bar">
                                    <li>
                                        <h4>Shpallja</h4>
                                        <h6>  @if ($application->announcement)
                                            <a href="{{ route('announcements.show', $application->announcement_id) }}">
                                                {{ $application->announcement->job_title }}
                                            </a>
                                        @else
                                            <span>No Announcement</span>
                                        @endif</h6>
                                    </li>
                                    <li>
                                        <h4>Emri</h4>
                                        <h6>{{ $application->name }}</h6>
                                    </li>
                                    <li>
                                        <h4>Mbiemri</h4>
                                        <h6>{{ $application->lastname }}</h6>
                                    </li>
                                    <li>
                                        <h4>Qyteti</h4>
                                        <h6>{{ $application->city }}</h6>
                                    </li>
                                    <li>
                                        <h4>Email</h4>
                                        <h6>{{ $application->email }}</h6>
                                    </li>
                                    <li>
                                        <h4>Telefoni</h4>
                                        <h6>{{ $application->phone }}</h6>
                                    </li>
                                    
                                    <li>
                                        <h4>CV</h4>
                                        <h6> @if ($application->resume)
                                            <a href="{{ asset('storage/' . $application->resume) }}" target="_blank">
                                                <span class="badges bg-lightred">Shiko CV</span>
                                            </a>
                                        @else
                                            <span>No Resume</span>
                                        @endif</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('layouts.admin-footer')

</body>

</html>
@endsection
