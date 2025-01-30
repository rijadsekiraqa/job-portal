@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                @if(auth()->user()->hasRole('super-admin'))
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <a href="{{ route('categories.index') }}" class="text-decoration-none w-100 h-100">
                    <div class="dash-count">
                        <div class="dash-counts">
                            <h4>{{ $categoryCount }}</h4>
                            <h5>Kategorite</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="list"></i>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <a href="{{ route('cities.index') }}" class="text-decoration-none w-100 h-100">
                    <div class="dash-count das1">
                        <div class="dash-counts">
                            <h4>{{ $cityCount }}</h4>
                            <h5>Qytetet</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="map-pin"></i>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <a href="{{ route('companies.index') }}" class="text-decoration-none w-100 h-100">
                        <div class="dash-count das2">
                            <div class="dash-counts">
                                <h4>{{ $companyCount }}</h4>
                                <h5>Kompanite</h5>
                            </div>
                            <div class="dash-imgs">
                                <i data-feather="users"></i>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <a href="{{ route('announcements.index') }}" class="text-decoration-none w-100 h-100">
                    <div class="dash-count das5">
                        <div class="dash-counts">
                            <h4>{{ $announcements }}</h4>
                            <h5>Totali i Shpalljeve</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="bell"></i>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <a href="#" class="text-decoration-none w-100 h-100">
                    <div class="dash-count das3">
                        <div class="dash-counts">
                            <h4>{{ $announcementCount }}</h4>
                            <h5>Shpalljet e Aprovuara</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="check-circle"></i>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <a href="#" class="text-decoration-none w-100 h-100">
                    <div class="dash-count das-canceled">
                        <div class="dash-counts">
                            <h4>{{ $canceledAnnouncements }}</h4>
                            <h5 style="margin-left: -1px;">Shpalljet e Refuzuara</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="x-circle"></i>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <a href="#" class="text-decoration-none w-100 h-100">
                    <div class="dash-count das-pending">
                        <div class="dash-counts">
                            <h4>{{ $pendingAnnouncements }}</h4>
                            <h5>Shpalljet ne Pritje</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="pause"></i>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <a href="#expired-announcements" class="text-decoration-none w-100 h-100">
                    <div class="dash-count das-expired">
                        <div class="dash-counts">
                            <h4>{{ $expiredAnnouncementsCount }}</h4>
                            <h5>Shpalljet e Skaduara</h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="alert-triangle"></i>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            @if(auth()->user()->hasRole('super-admin'))
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">5 Kompanite me me se paku shpallje</h4>
                            <div class="dropdown">
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a href="productlist.html" class="dropdown-item">Product List</a>
                                    </li>
                                    <li>
                                        <a href="addproduct.html" class="dropdown-item">Product Add</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive dataview">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Kompania</th>
                                            <th>Nr.Shpalljeve</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($leastCompanies as $company)
                                            <tr>
                                                <td>{{ $company->id }}</td>
                                                <td class="productimgname">
                                                    <a href="{{ route('companies.edit', $company->id) }}" class="product-img">
                                                        <img src="{{ $company->image ? asset('storage/' . $company->image) : asset('admin/assets/img/product/noimage.png') }}" 
                                                             alt="{{ $company->name }}" 
                                                             class="img-circle" 
                                                             style="width: 50px; height: 50px; object-fit: cover;">
                                                    </a>
                                                    <a href="{{ route('companies.edit', $company->id) }}">{{ $company->name }}</a>
                                                </td>
                                                <td>{{ $company->announcements_count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">5 Kompanite me me se shumti shpallje</h4>
                            <div class="dropdown">
                               
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a href="productlist.html" class="dropdown-item">Product List</a>
                                    </li>
                                    <li>
                                        <a href="addproduct.html" class="dropdown-item">Product Add</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive dataview">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Kompania</th>
                                            <th>Nr.Shpalljeve</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topCompanies as $company)
                                            <tr>
                                                <td>{{ $company->id }}</td>
                                                <td class="productimgname">
                                                    <a href="{{ route('companies.edit', $company->id) }}" class="product-img">
                                                        <img src="{{ $company->image ? asset('storage/' . $company->image) : asset('admin/assets/img/product/noimage.png') }}" 
                                                             alt="{{ $company->name }}" 
                                                             class="img-circle" 
                                                             style="width: 50px; height: 50px; object-fit: cover;">
                                                    </a>
                                                    <a href="{{ route('companies.edit', $company->id) }}">{{ $company->name }}</a>
                                                </td>
                                                <td>{{ $company->announcements_count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="card mb-0" id="expired-announcements">
                <div class="card-body">
                    <h4 class="card-title">Shpalljet e Skaduara</h4>
                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                                <tr>
                                    <th>Emri i Biznesit</th>
                                    <th>Foto</th>
                                    <th>Lokacioni</th>
                                    <th>Titulli i Shpalljes</th>
                                    <th>Statusi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expiredAnnouncements as $expiredAnnouncement)
                                  <tr>
                                    <td>
                                        <x-link href="{{ optional($expiredAnnouncement->company)->id ? route('companies.edit', $expiredAnnouncement->company->id) : '#' }}">
                                            {{ optional($expiredAnnouncement->company)->name ?? 'No Company Assigned' }}
                                        </x-link>
                                    </td>
                                    <td class="productimgname">
                                        <a href="#" class="product-img">
                                            <img src="{{ $expiredAnnouncement->image ? asset('storage/' . $expiredAnnouncement->image) : asset('admin/assets/img/product/noimage.png') }}"
                                                alt="product" class="img-circle">
                                        </a>
                                    </td>
                                    <td>{{ optional($expiredAnnouncement->city)->name ?? 'Ky lokacion eshte fshire' }}</td>
                                    <td>{{ $expiredAnnouncement->job_title }}</td>
                                    <td>
                                        @if ($expiredAnnouncement->status === 'approved')
                                        <span class="badges bg-lightgreen">Approved</span>
                                        @elseif ($expiredAnnouncement->status === 'canceled')
                                        <span class="badges bg-lightred">Canceled</span>
                                        @elseif ($expiredAnnouncement->status === 'pending')
                                        <span class="badges bg-lightred">Pending</span>
                                        @elseif($expiredAnnouncement->status === 'approved' && $expiredAnnouncement->to_date < now())
                                        <span class="badges bg-lightgrey">Expired</span>
                                        @elseif ($expiredAnnouncement->status === 'expired')
                                        <span class="badges bg-lightgrey">Expired</span>
                                        @endif
                                   </td>
                                    <td class="text-center">
                                        <x-link href="javascript:void(0);" class="action-set" data-bs-toggle="dropdown"
                                            aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </x-link>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <x-link href="{{ route('announcements.show', $expiredAnnouncement->id) }}"
                                                    class="dropdown-item">
                                                    <img src="{{ asset('admin/assets/img/icons/eye1.svg') }}"
                                                        class="me-2" alt="img">
                                                    Shiko
                                                </x-link>
                                            </li>
                                            <li>
                                                <x-link href="{{ route('announcements.destroy', $expiredAnnouncement->id) }}"
                                                    class="dropdown-item me-3 confirm-text"
                                                    data-title="A jeni i sigurte qe deshironi te fshini kete shpallje?"
                                                    data-text="Ju nuk keni mundesi ta riktheni perseri!"
                                                    data-confirm="Po!" 
                                                    data-cancel="Anuloje">
                                                    <img src="{{ asset('admin/assets/img/icons/delete1.svg') }}"
                                                        class="me-2" alt="img">
                                                    Fshij
                                                </x-link>
                                            </li>
                                        </ul>
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
    @include('layouts.admin-footer')
    </body>
    </html>
@endsection
