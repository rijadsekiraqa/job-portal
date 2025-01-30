@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')


    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Regjistrimi i Perdoruesve</h4>
                </div>
                <div class="page-btn">
                    <x-link href="{{ route('users.index') }}" class="btn btn-added">
                        <img src="{{ asset('admin/assets/img/icons/return1.svg') }}" class="me-2" alt="img">Kthehu
                    </x-link>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <x-input type="text" name="name" id="name" label="Emri"
                                        placeholder="Ju lutem shkruani emrin" 
                                        value="{{ old('name') }}"
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
                                        placeholder="Ju lutem shkruani mbiemrin"
                                        value="{{ old('lastname') }}"
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
                                    <x-input type="text" name="username" id="username" label="Emri Perdorues"
                                        placeholder="Ju lutem shkruani emrin perdorues"
                                        value="{{ old('username') }}"
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
                                    <x-input type="text" name="email" id="email" label="Email"
                                        placeholder="Ju lutem shkruani email"
                                        value="{{ old('email') }}"
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
                                    <div class="pass-group">
                                        <x-input type="password"  name="password" id="password" label="Password"
                                            placeholder="Ju lutem shkruani fjalekalimin"
                                            class="pass-input {{ $errors->has('password') ? 'is-invalid' : '' }}">                                           >
                                        </x-input>
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                        @if ($errors->has('password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <x-select name="roles" id="user_select" class="select {{ $errors->has('roles') ? 'is-invalid' : '' }}">
                                        <option value="">Zgjidhni një Rol</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}" {{ old('roles') == $role ? 'selected' : '' }}>{{ $role }}</option>
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
