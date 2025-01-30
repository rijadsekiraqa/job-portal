@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Lista e Perdoruesve</h4>
                </div>
                <div class="page-btn">
                    <x-link href="{{ route('users.create') }}" class="btn btn-added">
                        <img src="{{ asset('admin/assets/img/icons/plus.svg') }}" class="me-2" alt="img">Regjistro Perdorues
                    </x-link>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path d-inline-flex align-items-center">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="{{asset ('admin/assets/img/icons/filter.svg') }}" alt="img">
                                    <span><img src="{{asset ('admin/assets/img/icons/closes.svg') }}" alt="img"></span>
                                </a>
                                <x-button id="delete-selected-users" class="btn btn-danger px-3 align-items-center"
                                    style="display: none;">
                                    <img src="{{ asset('admin/assets/img/icons/close-circle.svg') }}" class="me-2"
                                        alt="img">Fshij te Selektuarat
                                </x-button>
                            </div>
                            {{-- <div class="search-input">
                                <a class="btn btn-searchset">
                                    <img src="{{asset ('admin/assets/img/icons/search-white.svg') }}" alt="img">
                                </a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card" id="filter_inputs">
                        <div class="card-body pb-0">
                            <form method="GET" action="{{ route('users.index') }}">
                            <div class="row">
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <x-input type="text" name="name" id="name" value="{{ request('name') }}"
                                        placeholder="Ju lutem shkruani emrin"></x-input>
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group">
                                        <x-input type="text" name="email" id="email" value="{{ request('email') }}"
                                        placeholder="Ju lutem shkruani email"></x-input>
                                    </div>
                                </div>
                                <div class="col-lg col-sm-6 col-12">
                                    <div class="form-group ">
                                        <x-select name="roles[]" id="user_select" class="select" multiple>
                                            <option value="">Zgjidhni nje Rol</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role }}" {{ in_array($role, request('roles', [])) ? 'selected' : '' }}>
                                                    {{ $role }}
                                                </option>
                                            @endforeach
                                        </x-select>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                    <div class="form-group">
                                  <x-button type="submit" class="btn btn-filters ms-auto">
                                    <img src="{{ asset('admin/assets/img/icons/search-whites.svg') }}"
                                            alt="img">
                                  </x-button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all-user">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Emri</th>
                                    <th>Mbiemri</th>
                                    <th>Emri Perdorues</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>
                                        <label class="checkboxs">
                                            <input type="checkbox" class="user-checkbox"
                                            value="{{ $user->id }}">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->lastname }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $rolename)
                                        <label class="badge badge-pill bg-primary mx-1">{{ $rolename }}</label>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <x-link href="{{ route('users.edit', $user->id) }}" class="me-3">
                                            <img src="{{asset ('admin/assets/img/icons/edit.svg') }}" alt="img">
                                        </x-link>
                                        <x-link href="{{ route('users.destroy', ['user' => $user->id]) }}" 
                                            class="me-3 confirm-text" 
                                            data-title="A jeni i sigurte qe doni te fshini kete perdorues?"
                                            data-text="Ju nuk keni mundesi ta riktheni perseri!"
                                            data-confirm="Po!"
                                            data-cancel="Jo">
                                            <img src="{{asset('admin/assets/img/icons/delete.svg')}}" alt="img">
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
                    sound: false,
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
