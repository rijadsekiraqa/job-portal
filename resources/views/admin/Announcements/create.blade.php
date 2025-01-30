@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Regjistrimi i Shpalljeve</h4>
                </div>
                <div class="page-btn">
                    <x-link href="{{ route('announcements.index') }}" class="btn btn-added">
                        <img src="{{ asset('admin/assets/img/icons/return1.svg') }}" class="me-2" alt="img">Kthehu
                    </x-link>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Biznesi</label>
                                    <x-select name="name" id="company_select"
                                        class="select {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                        <option value="">Zgjidhni nje Biznes</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}" data-image="/storage/{{ $company->image }}"
                                                {{ old('name') == $company->id ? 'selected' : '' }}>
                                                {{ $company->name }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <x-input type="text" name="jobtitle" id="jobtitle" label="Titulli i Shpalljes"
                                        placeholder="Ju lutem shkruani titullin e punes" 
                                        value="{{ old('jobtitle') }}"
                                        class="form-control {{ $errors->has('jobtitle') ? 'is-invalid' : '' }}">
                                    </x-input>
                                    @if ($errors->has('jobtitle'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('jobtitle') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Kategoria</label>
                                    <x-select name="category"
                                        class="select {{ $errors->has('category') ? 'is-invalid' : '' }}">
                                        <option value="">Zgjidhni nje Kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                    @if ($errors->has('category'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('category') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Lokacioni</label>
                                    <x-select name="city" class="select {{ $errors->has('city') ? 'is-invalid' : '' }}">
                                        <option value="">Zgjidhni nje Qytet</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ old('city') == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                    @if ($errors->has('city'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('city') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Orari i Punes</label>
                                    <x-select name="work_schedule"
                                        class="select {{ $errors->has('work_schedule') ? 'is-invalid' : '' }}">
                                        <option value="">Zgjidhni nje Biznes</option>
                                        <option value="Full Time" {{ old('work_schedule') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                        <option value="Part Time" {{ old('work_schedule') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                    </x-select>
                                    @if ($errors->has('work_schedule'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('work_schedule') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="from_date">From Date</label>
                                    <x-input type="date" name="from_date" id="from_date"
                                        class="form-control {{ $errors->has('from_date') ? 'is-invalid' : '' }}"
                                        value="{{ now()->format('Y-m-d') }}" />
                                    <input type="hidden" name="from_date_full" value="{{ now()->format('Y-m-d H:i:s') }}" />
                                    @if ($errors->has('from_date'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('from_date') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="to_date">To Date</label>
                                    <x-input type="date" name="to_date" id="to_date"
                                        class="form-control {{ $errors->has('to_date') ? 'is-invalid' : '' }}" 
                                        value="{{ old('to_date') }}" />
                                        <input type="hidden" name="to_date_full" value="{{ old('to_date') ? old('to_date') . ' ' . old('to_date_time') : now()->addDay()->format('Y-m-d H:i:s') }}" />
                                    @if ($errors->has('to_date'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('to_date') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Pershkrimi i punes</label>
                                    <x-textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                        placeholder="Ju lutem pershkruani me pak fjale poziten e punes"
                                        name="description"
                                        value="{{ old('description') }}">
                                    </x-textarea>
                                    @if ($errors->has('description'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-8" id="requirements-container">
                                <div class="form-group">
                                    <label for="pergjegjesite">Detyrat dhe Përgjegjësitë</label>
                                    
                                    <!-- Initial input row with add button -->
                                    <div class="d-flex align-items-center mb-2 requirement-row">
                                        <x-input type="text" name="requirements[]" id="requirements_0"
                                        placeholder="Ju lutem shkruani kerkesat qe kerkohen per kete konkurs"
                                        class="me-2 form-control {{ $errors->has('requirements.0') ? 'is-invalid' : '' }}" 
                                        value="{{ old('requirements.0', '') }}">
                                        </x-input>
                                        <x-button type="button" id="add-more-requirements"
                                        class="btn btn-secondary px-3 d-flex align-items-center"> 
                                        <img src="{{ asset('admin/assets/img/icons/plus1.svg') }}" class="me-1" alt="img"> Shto
                                        </x-button>
                                    </div>
                            
                                    <!-- Validation for the first field -->
                                    @if ($errors->has('requirements.0'))
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $errors->first('requirements.0') }}
                                    </div>
                                    @endif
                            
                                    <!-- Loop through added fields and show validation only if the field is not empty -->
                                    @php
                                        $requirements = old('requirements', ['']);
                                    @endphp
                                    @foreach ($requirements as $index => $requirement)
                                        @if ($index > 0 && $requirement)
                                        <div class="d-flex align-items-center mb-2 requirement-row">
                                            <x-input type="text" 
                                            name="requirements[]" 
                                            id="requirements_{{ $index }}" 
                                            placeholder="Ju lutem shkruani kerkesat qe kerkohen per kete konkurs"
                                            class="me-2 form-control {{ $errors->has('requirements.' . $index) ? 'is-invalid' : '' }}" 
                                            value="{{ $requirement }}">
                                            </x-input>
                                            <x-button type="button" 
                                            class="btn btn-danger remove-requirements px-3 d-flex align-items-center" style="flex-shrink: 0;">
                                            <img src="{{ asset('admin/assets/img/icons/close-circle.svg') }}" class="me-1" alt="img"> Fshij
                                            </x-button>
                                        </div>
                            
                                        <!-- Validation for additional fields (only if they are not empty) -->
                                        @if ($requirement && $errors->has('requirements.' . $index))
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $errors->first('requirements.' . $index) }}
                                        </div>
                                        @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-lg-8" id="qualifications-container">
                                <div class="form-group">
                                    <label for="qualifications">Kualifikimet dhe Kriteret e nevojshme</label>
                                    <div class="d-flex align-items-center qualification-row">
                                        <x-input type="text" name="qualifications[]" id="qualifications_0"
                                            placeholder="Ju lutem shkruani kualifikimet qe kerkohen per kete konkurs"
                                            class="me-2 form-control {{ $errors->has('qualifications.0') ? 'is-invalid' : '' }}"
                                            value="{{ old('qualifications.0', '') }}">
                                        </x-input>
                                        <x-button type="button" class="btn btn-secondary px-3 d-flex align-items-center"
                                            id="add-more-qualifications" label="Shto">
                                            <img src="{{ asset('admin/assets/img/icons/plus1.svg') }}" class="me-1"
                                                alt="img" />
                                        </x-button>
                                    </div>
                                    @if ($errors->has('qualifications.0'))
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $errors->first('qualifications.0') }}
                                    </div>
                                    @endif
                                    @php
                                        $qualifications = old('qualifications', ['']);
                                    @endphp
                                    @foreach ($qualifications as $index => $qualification)
                                        @if ($index > 0 && $qualification)
                                        <div class="d-flex align-items-center mb-2 qualification-row">
                                            <x-input type="text" 
                                            name="qualifications[]" 
                                            id="qualifications_{{ $index }}" 
                                            placeholder="Ju lutem shkruani kerkesat qe kerkohen per kete konkurs"
                                            class="me-2 form-control {{ $errors->has('qualifications.' . $index) ? 'is-invalid' : '' }}" 
                                            value="{{ $qualification }}">
                                            </x-input>
                                            <x-button type="button" 
                                            class="btn btn-danger remove-qualifications px-3 d-flex align-items-center" style="flex-shrink: 0;">
                                            <img src="{{ asset('admin/assets/img/icons/close-circle.svg') }}" class="me-1" alt="img"> Fshij
                                            </x-button>
                                        </div>
                            
                                        <!-- Validation for additional fields (only if they are not empty) -->
                                        @if ($qualification && $errors->has('qualification.' . $index))
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $errors->first('qualification.' . $index) }}
                                        </div>
                                        @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="product-list">
                                    <ul class="row">
                                        <li>
                                            <div class="productviews" style="display: none;">
                                                <div class="productviewsimg">
                                                    <img id="uploaded_image" src="" alt="Uploaded Image">
                                                </div>
                                                <div class="productviewscontent">
                                                    <div class="productviewsname">
                                                        <h3 id="file_size">File Size</h3>
                                                    </div>
                                                    <a href="#" class="hideset" id="remove_image">x</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <x-button type="submit" class="btn btn-submit me-2 btn-danger"
                                    label="Ruaj"></x-button>
                                <x-link href="{{ route('announcements.index') }}" class="btn btn-cancel"
                                    label="Anulo"></x-link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('admin/assets/js/Announcement/addfield.js') }}"></script>
        <script src="{{ asset('admin/assets/js/Announcement/previewImageUpdate.js') }}"></script>
    @endpush
    @include('layouts.admin-footer')


    </body>

    </html>
@endsection
