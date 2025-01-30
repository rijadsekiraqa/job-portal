@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Regjistrimi i Kompanive</h4>
                </div>
                <div class="page-btn">
                    <x-link href="{{ route('companies.index') }}" class="btn btn-added">
                        <img src="{{ asset('admin/assets/img/icons/return1.svg') }}" class="me-2" alt="img">Kthehu
                    </x-link>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <x-input type="text" name="name" id="name" 
                                        label="Emri"
                                        placeholder="Ju lutem shkruani kategorine" 
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
                                <div class="form-group">
                                    @if (Auth::user()->hasRole('super-admin'))
                                        <label>Perdoruesi</label>
                                        <x-select name="user_id" id="user_id"
                                                  class="select {{ $errors->has('user_id') ? 'is-invalid' : '' }}">
                                            <option value="">Zgjidhni nje Perdorues</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                        {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}  {{ $user->lastname }}
                                                </option>
                                            @endforeach
                                        </x-select>
                                        @error('user_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    @else
                                        <x-input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        </x-input>
                                    @endif
                                </div>
                            </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Pershkrimi i Kompanis</label>
                                        <x-textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                            placeholder="Ju lutem pershkruani me pak fjale kompanine"
                                            name="description"
                                            :value="old('description')">
                                        </x-textarea>
                                        @if ($errors->has('description'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('description') }}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <div class="image-upload">
                                        <x-input type="file" name="company_image" id="company_image" class="form-control {{ $errors->has('company_image') ? 'is-invalid' : '' }}">
                                        </x-input>
                                        <div class="image-uploads">
                                            <img id="image_preview" src="{{ asset('admin/assets/img/icons/upload.svg') }}" alt="img">
                                            <h4>Drag and drop a file to upload</h4>
                                        </div>
                                    </div>
                                    @if ($errors->has('company_image'))
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $errors->first('company_image') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="product-list">
                                    <ul class="row">
                                        <li  id="image_preview_item" style="display: none;">
                                            <div class="productviews">
                                                <div class="productviewsimg">
                                                    <img id="uploaded_image"
                                                        src="{{ asset('admin/assets/img/icons/noimage.png') }}"
                                                        alt="img" style="width: 100px; height: 100px;">
                                                </div>
                                                <div class="productviewscontent">
                                                    <div class="productviewsname">
                                                        <h3 id="file_size">File Size</h3>
                                                    </div>
                                                    <a href="javascript:void(0);" class="hideset" id="remove_image">x</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <x-button type="submit" class="btn btn-submit me-2 btn-danger" label="Ruaj" />
                                <x-link href="{{ route('companies.index') }}" class="btn btn-cancel" label="Anulo" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.admin-footer')

    <script>
        // Handle image file change event
        document.getElementById('company_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Display the new image preview
                    document.getElementById('uploaded_image').src = e.target.result;

                    // Make sure the preview item (li) is visible
                    const imagePreviewItem = document.getElementById('image_preview_item');
                    imagePreviewItem.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle remove image click event
        document.getElementById('remove_image').addEventListener('click', function() {
            // Hide the image preview and clear the src attribute
            document.getElementById('uploaded_image').src = '{{ asset('admin/assets/img/icons/noimage.png') }}';
            document.getElementById('image_preview_item').style.display = 'none';

            // Clear the input file value
            document.getElementById('company_image').value = '';
        });
    </script>
@endsection
