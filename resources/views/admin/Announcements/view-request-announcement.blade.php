@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>{{ $announcements->job_title }}</h4>
                    <h6>Detajet e Shpalljes</h6>
                </div>
                <div class="page-btn">
                    <x-link href="{{ route('announcements.manage') }}" class="btn btn-added">
                        <img src="{{ asset('admin/assets/img/icons/return1.svg') }}" class="me-2" alt="img">Kthehu
                    </x-link>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="productdetails">
                                <ul class="product-bar">
                                    <li>
                                        <h4>Emri i Biznesit</h4>
                                        <h6>{{ optional($announcements->company)->name ?? 'Kjo Kompani eshte fshire' }}</h6>
                                    </li>
                                    <li>
                                        <h4>Kategoria</h4>
                                        <h6>{{ optional($announcements->category)->name ?? 'Kjo Kategori eshte fshire' }}</h6>
                                    </li>
                                    <li>
                                        <h4>Qyteti</h4>
                                        <h6>{{ optional($announcements->city)->name ?? 'Ky Qytet eshte fshire' }}</h6>
                                    </li>
                                    <li>
                                        <h4>Titulli i Shpalljes</h4>
                                        <h6>{{ $announcements->job_title }}</h6>
                                    </li>
                                    <li>
                                        <h4>Orari i Punes</h4>
                                        <h6>{{ $announcements->work_schedule }}</h6>
                                    </li>
                                    <li>
                                        <h4>Data e Shpalljes se Konkursit</h4>
                                        <h6>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $announcements->from_date)->format('d/m/Y H:i') }}</h6>
                                    </li>
                                    <li>
                                        <h4>Data e Perfundimit se Konkursit</h4>
                                        <h6>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $announcements->to_date)->format('d/m/Y H:i') }}</h6>
                                    </li>
                                    <li>
                                        <h4>Pershkrimi i Punes</h4>
                                        <h6>{{ $announcements->job_description }}</h6>
                                    </li>
                                    <li>
                                        <h4>Kerkesat</h4>
                                        <h6>@if (!empty($announcements->requirements))
                                            @foreach (json_decode($announcements->requirements) as $requirement)
                                                {{ $requirement }}<br>
                                            @endforeach
                                        @endif</h6>
                                    </li>
                                    <li>
                                        <h4>Kualifikimet</h4>
                                        <h6>@if (!empty($announcements->qualifications))
                                            @foreach (json_decode($announcements->qualifications) as $qualification)
                                                {{ $qualification }}<br>
                                            @endforeach
                                        @endif</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="slider-product-details">
                                <div class="slider-product">
                                    <img src="{{ $announcements->image ? asset('storage/' . $announcements->image) : asset('admin/assets/img/product/noimage.png') }}"
                                    alt="announcement image">
                                    <h4>{{ $announcements->image_name }}</h4>
                                    <h6>{{ $announcements->image_size }}</h6>
                                </div>
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
