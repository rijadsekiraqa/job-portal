@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Lista e Kategorive</h4>
                </div>
                @can('create-category')
                <div class="page-btn">
                    <x-link href="{{ route('categories.create') }}" class="btn btn-added">
                        <img src="{{ asset('admin/assets/img/icons/plus.svg') }}" class="me-1" alt="img">Regjistro Kategori
                    </x-link>
                </div>
                @endcan
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
                                    {{-- @can('delete-category') --}}
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all-category">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    {{-- @endcan --}}
                                    <th>ID</th>
                                    <th>Emri</th>
                                    @can('update-category')
                                    <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        {{-- @can('delete-category') --}}
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox" class="category-checkbox"
                                                    value="{{ $category->id }}">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        {{-- @endcan --}}
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        {{-- @canAny(['update-category', 'delete-category']) --}}
                                        <td>
                                            <x-link href="{{ route('categories.edit', $category->id) }}" class="me-3">
                                                <img src="{{ asset('admin/assets/img/icons/edit.svg') }}" alt="img">
                                            </x-link>
                                            <x-link href="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                                class="me-3 confirm-text"
                                                data-title="A jeni i sigurt qe deshironi te fshini kete kategori?"
                                                data-text="Ju nuk keni mundesi ta riktheni perseri!" 
                                                data-confirm="Po!"
                                                data-cancel="Jo">
                                                <img src="{{ asset('admin/assets/img/icons/delete.svg') }}" alt="img">
                                            </x-link>
                                        </td>
                                        {{-- @endcanAny --}}
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
