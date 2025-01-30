@extends('layouts.header')

@section('content')


    <!-- Header End -->
    <div class="container-xxl py-5 bg-dark page-header mb-5">
        <div class="container my-5 pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Job Detail</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item"><a href="{{ route('landing.page') }}">Kryefaqja</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Detajet e Shpalljes</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Header End -->


    <!-- Job Detail Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gy-5 gx-4">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center mb-5">
                        <img class="flex-shrink-0 img-fluid border rounded"
                            src="{{ $announcements->image ? asset('storage/' . $announcements->image) : asset('admin/assets/img/annoucement/noimage.png') }}"
                            alt="" style="width: 80px; height: 80px;">
                        <div class="text-start ps-4">
                            <h3 class="mb-3">{{ $announcements->job_title }}</h3>
                            <span class="text-truncate me-3"><i
                                    class="fa fa-building text-primary me-2"></i>{{ $announcements->company->name }}</span>
                            <span class="text-truncate me-3"><i
                                    class="fa fa-map-marker-alt text-primary me-2"></i>{{ $announcements->city->name }}</span>
                            <span class="text-truncate me-3"><i
                                    class="far fa-clock text-primary me-2"></i>{{ $announcements->work_schedule }}</span>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h4 class="mb-3">Pershkrimi i Punes</h4>
                        <p class="text-break">{{ $announcements->job_description }}</p>
                        <h4 class="mb-3">Detyrat dhe Përgjegjësitë</h4>
                        <ul class="list-unstyled">
                            @if (!empty($responsibilities))
                                @foreach ($responsibilities as $responsibility)
                                    <li><i class="fa fa-angle-right text-primary me-2"></i>{{ $responsibility }}</li>
                                @endforeach
                            @else
                                <li>No responsibilities available</li>
                            @endif
                        </ul>
                        <h4 class="mb-3">Kualifikimet</h4>
                        <ul class="list-unstyled">
                            @if (!empty($qualifications))
                                @foreach ($qualifications as $qualification)
                                    <li><i class="fa fa-angle-right text-primary me-2"></i>{{ $qualification }}</li>
                                @endforeach
                            @else
                                <li>No responsibilities available</li>
                            @endif
                        </ul>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="">
                        <h4 class="mb-4">Apliko per kete Pune</h4>
                        <form action="{{ route('applications.apply', ['id' => $announcements->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row g-3">
                                <x-input type="hidden" name="announcement_id" value="{{ $announcements->id }}"></x-input>
                                <x-input type="hidden" name="user_id" value="{{ $announcements->user_id }}"></x-input>
                                <div class="col-12 col-sm-6">
                                    <x-input type="text" name="name" class="form-control rounded-custom py-2"
                                        placeholder="Emri"></x-input>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <x-input type="text" name="lastname" class="form-control rounded-custom py-2"
                                        placeholder="Mbiemri"></x-input>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <x-input type="text" name="city" class="form-control rounded-custom py-2"
                                        placeholder="Qyteti"></x-input>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <x-input type="email" name="email" class="form-control rounded-custom py-2"
                                        placeholder="Email"></x-input>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <x-input type="text" name="phone" class="form-control rounded-custom py-2"
                                        placeholder="Numri i telefonit"></x-input>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <x-input type="file" name="resume"
                                        class="form-control rounded-custom py-2 bg-white"></x-input>
                                </div>
                                <div class="col-12">
                                    <x-button type="submit" class="btn btn-primary w-100 rounded-custom py-3">Apliko
                                        Tani</x-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bg-light rounded py-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                        <h5 class="mb-4 ms-5">Permbledhja e Shpalljes</h5>
                        <p class="ms-4"><i class="fa fa-angle-right text-primary me-2"></i>Kompania: {{ optional($announcements->company)->name }}
                        </p>
                        <p class="ms-4"><i class="fa fa-angle-right text-primary me-2"></i>Kategoria:
                            {{ optional($announcements->category)->name }}</p>
                            <p class="ms-4"><i class="fa fa-angle-right text-primary me-2"></i>Data e Shpalljes :
                            {{ \Carbon\Carbon::parse($announcements->from_date)->format('d/m/Y') }}</p>
                            <p class="ms-4"><i class="fa fa-angle-right text-primary me-2"></i>Data e Perfundimit :
                            {{ \Carbon\Carbon::parse($announcements->to_date)->format('d/m/Y') }}</p>
                            <p class="ms-4"><i class="fa fa-angle-right text-primary me-2"></i>Orari: {{ $announcements->work_schedule }}
                        </p>
                        <p class="ms-4"><i class="fa fa-angle-right text-primary me-2"></i>Lokacioni: {{ optional($announcements->city)->name }}
                        </p>
                    </div>
                    <div class="bg-light rounded p-5 wow slideInUp" data-wow-delay="0.1s">
                        <h5 class="mb-4">Pershkrimi i Kompanis</h5>
                        <div class="overflow-hidden">
                            <p class="m-0 text-wrap" style="overflow-wrap: break-word;">
                                {{ optional($announcements->company)->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Job Detail End -->


    @include('layouts.footer')
    </body>

    </html>


@endsection
