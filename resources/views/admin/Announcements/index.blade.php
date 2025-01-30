@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Lista e Shpalljeve</h4>
                </div>
                <div class="page-btn">
                    <x-link href="{{ route('announcements.create') }}" class="btn btn-added">
                        <img src="{{ asset('admin/assets/img/icons/plus.svg') }}" class="me-1" alt="img">Regjistro
                        Shpallje
                    </x-link>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if(auth()->user()->hasRole('super-admin'))
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path d-inline-flex align-items-center">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="{{ asset('admin/assets/img/icons/filter.svg') }}" alt="img">
                                    <span><img src="{{ asset('admin/assets/img/icons/closes.svg') }}" alt="img"></span>
                                </a>
                                <x-button id="delete-selected-announcements" class="btn btn-danger px-3 align-items-center"
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
                    <div class="card mb-0" id="filter_inputs">
                        <div class="card-body pb-0">
                            <form method="GET" action="{{ route('announcements.index') }}" id="filterForm">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-lg col-sm-6 col-12">
                                                <div class="form-group">
                                                    <select name="company_id" class="select">
                                                        <option value="">Zgjidhni nje Biznes</option>
                                                        @foreach ($companies as $company)
                                                            <option value="{{ $company->id }}"
                                                                {{ request('company_id') == $company->id ? 'selected' : '' }}>
                                                                {{ $company->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg col-sm-6 col-12">
                                                <div class="form-group">
                                                    <x-select name="category_id" class="select">
                                                    <option value="">Zgjidhni nje Kategori</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach 
                                                    </x-select>
                                                </div>
                                            </div>
                                            <div class="col-lg col-sm-6 col-12">
                                                <div class="form-group">
                                                    <x-select name="city_id" class="select">
                                                        <option value="">Zgjidhni nje Qytet</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->id }}"
                                                                {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                                                {{ $city->name }}
                                                            </option>
                                                        @endforeach
                                                    </x-select>
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-filters ms-auto">
                                                        <img src="{{ asset('admin/assets/img/icons/search-whites.svg') }}"
                                                            alt="img">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
                    <div class="table-responsive">
                        <table class="table  datanew" id="filter-table">
                            <thead>
                                <tr>
                                @if(auth()->user()->hasRole('super-admin'))
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all-announcement">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                @endif
                                    <th>Emri i Biznesit</th>
                                    @if(auth()->user()->hasRole('super-admin'))
                                    <th>Pronari i Shpalljes</th>
                                    @endif
                                    <th>Kategoria</th>
                                    <th>Lokacioni</th>
                                    <th>Titulli i Shpalljes</th>
                                    <th>Data e Shpalljes</th>
                                    <th>Data e Perfundimit</th>
                                    <th>Statusi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($announcements->isEmpty())
                                    <tr>
                                        <td colspan="10" class="text-center">Nuk u gjetën rezultate për këtë filter.</td>
                                    </tr>
                                @else
                                    @foreach ($announcements as $announcement)
                                        <tr>
                                         @if(auth()->user()->hasRole('super-admin'))
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox" class="announcement-checkbox"
                                                        value="{{ $announcement->id }}">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                         @endif
                                            <td class="productimgname">
                                                <a href="#" class="product-img">
                                                    <img src="{{ $announcement->image ? asset('storage/' . $announcement->image) : asset('admin/assets/img/product/noimage.png') }}"
                                                        alt="product" class="img-circle">
                                                </a>
                                                <x-link
                                                    href="{{ optional($announcement->company)->id ? route('companies.edit', $announcement->company->id) : '#' }}">
                                                    {{ optional($announcement->company)->name ?? 'Kjo Kompani është fshirë' }}
                                                </x-link>
                                            </td>
                                            @if(auth()->user()->hasRole('super-admin'))
                                            <td>{{ $announcement->owner ? $announcement->owner->name . ' ' . $announcement->owner->lastname : 'No owner' }}</td>
                                            @endif
                                            <td>{{ optional($announcement->category)->name ?? 'Kjo Kategori është fshirë' }}
                                            </td>
                                            <td>{{ optional($announcement->city)->name ?? 'Ky lokacion është fshirë' }}
                                            </td>
                                            <td>{{ $announcement->job_title }}</td>
                                            <td>{{ \Carbon\Carbon::parse($announcement->from_date)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($announcement->to_date)->format('d/m/Y') }}</td>
                                            <td>
                                                @if ($announcement->status === 'approved')
                                                    <span class="badges bg-lightgreen">Aprovuar</span>
                                                @elseif ($announcement->status === 'canceled')
                                                    <span class="badges bg-lightred">Refuzuar</span>
                                                @elseif ($announcement->status === 'pending')
                                                    <span class="badges bg-lightyellow">Ne pritje</span>
                                                @elseif ($announcement->status === 'expired')
                                                    <span class="badges bg-lightgrey">Skaduar</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <x-link href="javascript:void(0);" class="action-set"
                                                    data-bs-toggle="dropdown" aria-expanded="true">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </x-link>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <x-link href="{{ route('announcements.show', $announcement->id) }}"
                                                            class="dropdown-item">
                                                            <img src="{{ asset('admin/assets/img/icons/eye1.svg') }}"
                                                                class="me-2" alt="img">
                                                            Shiko
                                                        </x-link>
                                                    </li>
                                                    @if (
                                                        (Auth::user()->hasRole('super-admin') && $announcement->status == 'approved') ||
                                                            (Auth::user()->hasRole('employee') && !in_array($announcement->status, ['approved', 'expired'])))
                                                        <li>
                                                            <x-link
                                                                href="{{ route('announcements.edit', $announcement->id) }}"
                                                                class="dropdown-item">
                                                                <img src="{{ asset('admin/assets/img/icons/edit.svg') }}"
                                                                    class="me-2" alt="img">
                                                                Përditëso
                                                            </x-link>
                                                        </li>
                                                        <li>
                                                            <x-link href="#edit-description/{{ $announcement->id }}"
                                                                class="dropdown-item" data-bs-toggle="modal"
                                                                data-bs-target="#editdescription"
                                                                data-announcement-id="{{ $announcement->id }}"
                                                                data-announcement-description="{{ $announcement->job_description }}">
                                                                <img src="{{ asset('admin/assets/img/icons/purchase1.svg') }}"
                                                                    class="me-2" alt="img">
                                                                Përditëso Përshkrimin e Punës
                                                            </x-link>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <x-link
                                                            href="{{ route('announcements.destroy', $announcement->id) }}"
                                                            class="dropdown-item me-3 confirm-text"
                                                            data-title="A jeni i sigurt që dëshironi të fshini këtë shpallje?"
                                                            data-text="Ju nuk keni mundësi ta riktheni përsëri!"
                                                            data-confirm="Po!" data-cancel="Anuloje">
                                                            <img src="{{ asset('admin/assets/img/icons/delete1.svg') }}"
                                                                class="me-2" alt="img">
                                                            Fshij
                                                        </x-link>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @include('admin.announcements.edit-job-description')
                                    @endforeach
                                @endif
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('admin/assets/js/announcement/edit-description.js') }}"></script>
        <script>
            var announcementsIndexUrl = @json(route('announcements.index'));
        </script>
        <script src="{{ asset('admin/assets/js/announcement/filterform.js') }}"></script>
        <script src="{{ asset('admin/assets/js/lobibox.min.js') }}"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @if (session('success'))
                    Lobibox.notify('success', {
                        // rounded: true,
                        delay: 3000,
                        icon: false,
                        sound: false,
                        msg: "{{ session('success') }}"
                    });
                @endif
            });
        </script>
    @endpush


    @include('layouts.admin-footer')
@endsection
