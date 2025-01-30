@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Lista e Kompanive</h4>
                </div>
                <div class="page-btn">
                    <x-link href="{{ route('companies.create') }}" class="btn btn-added">
                        <img src="{{ asset('admin/assets/img/icons/plus.svg') }}" class="me-1" alt="img">Regjistro
                        Kompani
                    </x-link>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <x-button id="delete-selected-companies" class="btn btn-danger px-3 align-items-center"
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
                                    @can('bulkdelete-company')
                                        <th>
                                            <label class="checkboxs">
                                                <input type="checkbox" id="select-all-company">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </th>
                                    @endcan
                                    <th>Emri</th>
                                    @if (Auth::user()->hasRole('super-admin'))
                                        <th>Përdoruesi</th>
                                    @endif
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        @can('bulkdelete-company')
                                            <td>
                                                <label class="checkboxs">
                                                    <input type="checkbox" class="company-checkbox" value="{{ $company->id }}">
                                                    <span class="checkmarks"></span>
                                                </label>
                                            </td>
                                        @endcan
                                        <td>{{ $company->name }}</td>
                                        @if (Auth::user()->hasRole('super-admin'))
                                            @if ($company->user)
                                                <td>
                                                    {{ $company->user->name }} {{ $company->user->lastname }}
                                                </td>
                                            @else
                                                <td>No User Assigned</td>
                                            @endif
                                        @endif
                                        <td class="productimgname">
                                            <a href="#" class="product-img">
                                                <img src="{{ $company->image ? asset('storage/' . $company->image) : asset('admin/assets/img/product/noimage.png') }}"
                                                    alt="product" class="img-circle">
                                            </a>
                                        </td>
                                        <td>
                                            <x-link href="{{ route('companies.edit', $company->id) }}" class="me-3">
                                                <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="img">
                                            </x-link>
                                            <x-link href="{{ route('companies.destroy', ['company' => $company->id]) }}"
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
