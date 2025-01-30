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
                        <img src="{{ asset('admin/assets/img/icons/plus.svg') }}" class="me-1" alt="img">Regjistro Shpallje
                    </x-link>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if(auth()->user()->hasRole('super-admin'))
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
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
                    @endif
                    <div class="table-responsive">
                        <table class="table">
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
                                    @if(auth()->user()->hasRole('super-admin'))
                                    <th>Perdoruesi</th>
                                    @endif
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                            <x-link href="{{ optional($announcement->company)->id ? route('companies.edit', $announcement->company->id) : '#' }}">
                                                {{ optional($announcement->company)->name ?? 'Kompania eshte fshire' }}
                                            </x-link>
                                        </td>
                                        @if(auth()->user()->hasRole('super-admin'))
                                        <td>{{ $announcement->owner ? $announcement->owner->name . ' ' . $announcement->owner->lastname : 'Nuk ka pronar' }}</td>
                                        @endif
                                        <td>{{ optional($announcement->category)->name ?? 'Kjo Kategori eshte fshire' }}
                                        </td>
                                        <td>{{ optional($announcement->city)->name ?? 'Ky lokacion eshte fshire' }}</td>
                                        <td>{{ $announcement->job_title }}</td>
                                        <td>{{ \Carbon\Carbon::parse($announcement->from_date)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($announcement->to_date)->format('d/m/Y') }}</td>
                                        <td>
                                            @if (Auth::user()->hasRole('super-admin'))
                                                @if ($announcement->status === 'pending')
                                                    <x-link 
                                                        href="{{ route('updatestatus', ['announcement' => $announcement->id, 'status' => 'approved']) }}">
                                                        <span class="badges bg-lightgreen">Aprovo</span>
                                                    </x-link> |
                                                    <x-link 
                                                        href="{{ route('updatestatus', ['announcement' => $announcement->id, 'status' => 'canceled']) }}">
                                                        <span class="badges bg-lightred">Refuzo</span>
                                                    </x-link>
                                                @else
                                                    @if ($announcement->status === 'approved')
                                                        <span class="badges bg-lightgreen">Aprovuar</span>
                                                    @elseif ($announcement->status === 'canceled')
                                                        <span class="badges bg-lightred">Refuzuar</span>
                                                    @endif
                                                @endif
                                            @elseif (Auth::user()->hasRole('employee'))
                                                @if ($announcement->user_id === Auth::user()->id)
                                                    @if ($announcement->status === 'pending')
                                                        <span class="badges bg-lightyellow">Në pritje</span>
                                                    @elseif ($announcement->status === 'approved')
                                                        <span class="badges bg-lightgreen">Aprovuar</span>
                                                    @elseif ($announcement->status === 'canceled')
                                                        <span class="badges bg-lightred">Refuzuar</span>
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                     @if(auth()->user()->hasRole('super-admin'))
                                        <td>
                                            @if ($announcement->user)
                                                {{ $announcement->user->name }} {{ $announcement->user->lastname }}
                                                @if ($announcement->user->companies->isNotEmpty())
                                                    - {{ $announcement->user->companies->first()->name }}
                                                @else
                                                    - No Company
                                                @endif
                                            @else
                                                No User
                                            @endif
                                        </td>
                                    @endif
                                        <td class="text-center">
                                            <x-link href="javascript:void(0);" class="action-set" data-bs-toggle="dropdown"
                                                aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </x-link>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <x-link href="{{ route('announcements.view', $announcement->id) }}"
                                                        class="dropdown-item">
                                                        <img src="{{ asset('admin/assets/img/icons/eye1.svg') }}"
                                                            class="me-2" alt="img">
                                                        Shiko
                                                    </x-link>
                                                </li>
                                                @if (Auth::user()->hasRole('super-admin') && $announcement->status == 'pending' || 
                                                (Auth::user()->hasRole('employee') && $announcement->status =='pending'))
                                                <li>
                                                    <x-link href="{{ route('manage-announcements.edit', $announcement->id) }}"
                                                        class="dropdown-item">
                                                        <img src="{{ asset('admin/assets/img/icons/edit.svg') }}"
                                                            class="me-2" alt="img">
                                                        Perditeso
                                                    </x-link>
                                                </li>
                                                <li>
                                                    <x-link href="#edit-description/{{ $announcement->id }}" 
                                                        class="dropdown-item"
                                                        data-bs-toggle="modal" 
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
                                                    <x-link href="{{ route('announcements.destroy', $announcement->id) }}"
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
                                    @include('admin.announcements.edit-job-description')
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
        <script src="{{ asset('admin/assets/js/announcement/edit-description.js') }}"></script>
    @endpush

    @include('layouts.admin-footer')


    </body>

    </html>
@endsection
