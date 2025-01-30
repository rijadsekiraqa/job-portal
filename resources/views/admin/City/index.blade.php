@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Lista e Qyteteve</h4>
                </div>
                <div class="page-btn">
                    <x-link href="{{ route('cities.create') }}" class="btn btn-added">
                        <img src="{{ asset('admin/assets/img/icons/plus.svg') }}" class="me-1" alt="img">Regjistro Qytet
                    </x-link>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <x-button id="delete-selected-cities" class="btn btn-danger" style="display: none;">
                                    <img src="{{ asset('admin/assets/img/icons/close-circle.svg') }}" class="me-2"
                                        alt="img">Fshij te Selektuarat
                                    {{-- <button id="delete-selected-cities" class="btn btn-danger" style="display: none;">Delete Selected</button> --}}
                                </x-button>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset">
                                    <img src="{{ asset('admin/assets/img/icons/search-white.svg') }}" alt="img">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all-city">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Emri</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cities as $city)
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox" class="city-checkbox" value="{{ $city->id }}">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td>{{ $city->name }}</td>
                                        <td>
                                            <x-link href="{{ route('cities.edit', $city->id) }}" class="me-3">
                                                <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="img">
                                            </x-link>
                                            <x-link href="{{ route('cities.destroy', ['city' => $city->id]) }}"
                                                class="me-3 confirm-text"
                                                data-title="A jeni i sigurt qe deshironi te fshini kete qytet?"
                                                data-text="Ju nuk keni mundesi ta riktheni perseri!"
                                                data-confirm="Po!"
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
    @push('scripts')
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
