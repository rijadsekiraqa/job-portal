@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Perditesimi i Roleve</h4>
                    </div>
                    <div class="page-btn">
                        <x-link href="{{ route('role.index') }}" class="btn btn-added">
                            <img src="{{ asset('admin/assets/img/icons/return1.svg') }}" class="me-2" alt="img">Kthehu
                        </x-link>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('role.update', ['role' => $role->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-12 col-sm-6 col-12">
                                    <div class="form-group">
                                        <x-input type="text" value="{{ $role->name }}" name="name" id="name"
                                            label="Emri" placeholder="Ju lutem shkruani rolin"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                        </x-input>
                                        @if ($errors->has('name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <div class="col-md-10">
                                            <label class="form-label mb-2">Lejet</label>
                                            <div class="row g-5">
                                                @foreach ($permissions->chunk(4) as $permissionChunk)
                                                    <!-- Ndani lejet në grupe me nga 4 për rresht -->
                                                    <div class="col-md-3"> <!-- Krijoni një kolonë për secilin grup -->
                                                        @foreach ($permissionChunk as $permission)
                                                            <div class="form-check mb-3">
                                                                <label class="form-check-label text-nowrap">
                                                                    <input type="checkbox" class="form-check-input me-2"
                                                                           name="permission[]" value="{{ $permission->id }}"
                                                                           @if (in_array($permission->id, old('permission', $rolePermissions))) checked @endif>
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                                @if ($errors->has('permission'))
                                                    <div class="invalid-feedback d-block">
                                                        {{ $errors->first('permission') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <x-button type="submit" class="btn btn-submit btn-danger me-2"
                                                label="Ruaj" />
                                            <x-link href="{{ route('role.index') }}" class="btn btn-cancel"
                                                label="Anulo" />
                                        </div>
                                    </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @include('layouts.admin-footer')
@endsection
