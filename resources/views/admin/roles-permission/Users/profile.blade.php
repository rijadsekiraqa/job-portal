@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Profili i Perdoruesit</h4>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('updateuserprofile', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                    <div class="profile-set">
                        <div class="profile-top">
                            <div class="profile-content">
                                <div class="profile-contentimg">
                                    <img src="{{asset ('admin/assets/img/customer/user-avatar.png') }}" alt="img" id="blah">
                                </div>
                                <div class="profile-contentname">
                                    <h2>{{ $user->name }} {{ $user->lastname }}</h2>
                                    <h4>Te dhenat personale te profilit</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Emri</label>
                                <x-input type="text" name="name" 
                                value="{{ old('name', $user->name) }}"
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                </x-input>
                                @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Mbiemri</label>
                                <x-input type="text" name="lastname" 
                                value="{{ old('lastname', $user->lastname) }}"
                                class="form-control {{ $errors->has('lastname') ? 'is-invalid' : '' }}">
                                </x-input>
                                @if ($errors->has('lastname'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lastname') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
                                <x-input type="text" name="email" 
                                value="{{ old('email', $user->email) }}"
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                </x-input>
                                @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Emri Perdorues</label>
                                <x-input type="text" name="username" value="{{ $user->username }}"
                                class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}">
                                </x-input>
                                @if ($errors->has('username'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Password</label>
                                <div class="pass-group">
                                    <x-input type="password" name="password" class="pass-input">
                                    </x-input>
                                    <span class="fas toggle-password fa-eye-slash position-absolute top-50 translate-middle-y"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
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
