@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Perditesimi i Qyteteve</h4>
                    </div>
                    <div class="page-btn">
                        <x-link href="{{ route('cities.index') }}" class="btn btn-added">
                            <img src="{{ asset('admin/assets/img/icons/return1.svg') }}" class="me-2" alt="img">Kthehu
                        </x-link>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('cities.update',['city' => $city->id]) }}">
                            @csrf
                            @method("PUT")
                            <div class="row">
                                <div class="col-lg-12 col-sm-6 col-12">
                                    <div class="form-group">
                                        <x-input type="text" value="{{$city->name}}" name="name" id="name" label="Emri i Qytetit"
                                        placeholder="Ju lutem shkruani kategorine" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                        value="{{ old('name', $city->name) }}"> 
                                        </x-input>
                                        @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <x-button type="submit" class="btn btn-submit btn-danger me-2" label="Ruaj" />
                                    <x-link href="{{ route('cities.index') }}" class="btn btn-cancel" label="Anulo" />
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
