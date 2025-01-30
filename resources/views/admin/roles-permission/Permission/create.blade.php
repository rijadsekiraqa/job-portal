@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Regjistrimi i Lejeve</h4>
                </div>
                <div class="page-btn">
                    <x-link href="{{ route('permission.index') }}" class="btn btn-added">
                        <img src="{{ asset('admin/assets/img/icons/return1.svg') }}" class="me-2" alt="img">Kthehu
                    </x-link>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('permission.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <x-input type="text" name="name" id="name" label="Emri i Lejes"
                                        placeholder="Ju lutem shkruani nje leje" 
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
                            <div class="col-lg-12">
                                <x-button type="submit" class="btn btn-submit me-2 btn-danger" label="Ruaj" />
                                <x-link href="{{ route('permission.index') }}" class="btn btn-cancel" label="Anulo" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin-footer')
@endsection
