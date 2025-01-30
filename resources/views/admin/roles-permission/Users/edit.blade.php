@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')


    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Perditesimi i Perdoruesve</h4>
                </div>
                <div class="page-btn">
                    <x-link href="{{ route('users.index') }}" class="btn btn-added">
                        <img src="{{ asset('admin/assets/img/icons/return1.svg') }}" class="me-2" alt="img">Kthehu
                    </x-link>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.update',['user' => $user->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <x-input type="text" name="name" id="name"  label="Emri"
                                value="{{ old('name', $user->name) }}"
                                placeholder="Ju lutem shkruani emrin" 
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                </x-input>
                                @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <x-input type="text" name="lastname" id="lastname" label="Mbiemri"
                                value="{{ old('lastname', $user->lastname) }}"
                                placeholder="Ju lutem shkruani mbiemrin" 
                                class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}">
                                </x-input>
                                @if ($errors->has('lastname'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lastname') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <x-input type="text" name="email" id="email" label="Email"
                                value="{{ old('email', $user->email) }}"
                                placeholder="Ju lutem shkruani email" 
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                </x-input>
                                @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <x-input type="text" name="username" id="username" label="Emri Perdorues"
                                value="{{ old('username', $user->username) }}"
                                placeholder="Ju lutem shkruani emrin perdorues" 
                                class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}">
                                </x-input>
                                @if ($errors->has('username'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <div class="pass-group">
                                    <x-input type="password" class="pass-input" name="password" id="password" label="Password" />
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Role</label>
                                <x-select name="roles[]" class="select {{ $errors->has('roles') ? 'is-invalid' : '' }}">
                                    <option value="none">Zgjidhni nje Rol</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" {{ in_array($role, old('roles', $userRoles ?? [])) ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </x-select>
                                @if ($errors->has('roles'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('roles') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <x-button type="submit" class="btn btn-submit me-2 btn-danger" label="Ruaj" />
                            <x-link href="{{ route('users.index') }}" class="btn btn-cancel" label="Anulo" />
                        </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>
    @include('layouts.admin-footer')
    </body>

    </html>
@endsection
