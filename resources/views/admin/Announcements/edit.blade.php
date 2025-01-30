@extends('layouts.admin-header')

@section('content')
    @include('layouts.admin-sidebar')

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Perditesimi i Shpalljes</h4>
                </div>
                <div class="page-btn">
                    <x-link href="{{ route('announcements.index') }}" class="btn btn-added">
                        <img src="{{ asset('admin/assets/img/icons/return1.svg') }}" class="me-2" alt="img">Kthehu
                    </x-link>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('announcements.update', ['announcement' => $announcement->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Biznesi</label>
                                    <x-select name="company_id" id="company_select"
                                    class="select {{ $errors->has('company_id') ? 'is-invalid' : '' }}">
                                    <option value="">Zgjidhni një Biznes</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}"
                                            data-image="{{ asset('storage/' . $company->image) }}"
                                            {{ $company->id == old('company_id', $announcement->company_id) ? 'selected' : '' }}>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </x-select>
                                    @if ($errors->has('company_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('company_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <x-input type="text" name="jobtitle" id="jobtitle"
                                        value="{{ $announcement->job_title }}" label="Titulli i Punes"
                                        placeholder="Ju lutem shkruani titullin e punes"
                                        class="custom-class {{ $errors->has('jobtitle') ? 'is-invalid' : '' }}">
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
                                    <x-select name="category_id"
                                        class="select {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                                        <option value="">Zgjidhni nje Kategori</option>
                                        @foreach (\App\Models\Category::all() as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $announcement->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                    @if ($errors->has('category_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('category_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Lokacioni</label>
                                    <x-select name="city_id"
                                        class="select {{ $errors->has('city_id') ? 'is-invalid' : '' }}">
                                        <option value="">Zgjidhni nje Qytet</option>
                                        @foreach (\App\Models\City::all() as $city)
                                            <option value="{{ $city->id }}"
                                                {{ $city->id == $announcement->city_id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                    @if ($errors->has('city_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('city_id') }}
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
                                        <option value="Full Time"
                                            {{ $announcement->work_schedule == 'Full Time' ? 'selected' : '' }}>Full Time
                                        </option>
                                        <option value="Part Time"
                                            {{ $announcement->work_schedule == 'Part Time' ? 'selected' : '' }}>Part Time
                                        </option>
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
                                    <x-input type="date" value="{{ \Carbon\Carbon::parse($announcement->from_date)->format('Y-m-d') }}" name="from_date"
                                        id="from_date"
                                        class="form-control {{ $errors->has('from_date') ? 'is-invalid' : '' }}">
                                    </x-input>
                                    <!-- Hidden input for the time part, keeping the original time from the database -->
                                    <input type="hidden" name="from_date_time" value="{{ \Carbon\Carbon::parse($announcement->from_date)->format('H:i:s') }}">
                            
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
                                    <x-input type="date" value="{{ \Carbon\Carbon::parse($announcement->to_date)->format('Y-m-d') }}" name="to_date"
                                        id="to_date"
                                        class="form-control {{ $errors->has('to_date') ? 'is-invalid' : '' }}">
                                    </x-input>
                                    <!-- Hidden input for the time part, keeping the original time from the database -->
                                    <input type="hidden" name="to_date_time" value="{{ \Carbon\Carbon::parse($announcement->to_date)->format('H:i:s') }}">
                            
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
                                    <x-textarea class="form-control" value="{{ $announcement->job_description }}"
                                        placeholder="Ju lutem pershkruani me pak fjale poziten e punes" name="description"
                                        readonly></x-textarea>
                                </div>
                            </div>
                            <div class="col-lg-12" id="requirements-container">
                                <div class="form-group">
                                    <label for="pergjegjesite">Detyrat dhe Përgjegjësitë</label>
                                    @if (is_array(json_decode($announcement->requirements, true)))
                                        @foreach (json_decode($announcement->requirements, true) as $index => $requirement)
                                            <div class="form-group d-flex align-items-center mt-2">
                                                <x-input type="text" name="requirements[]" id="requirements"
                                                    value="{{ $requirement }}"
                                                    placeholder="Ju lutem shkruani kerkesat qe kerkohen per kete konkurs"
                                                    class="form-control me-2">
                                                </x-input>

                                                @if ($index == 0)
                                                    <x-button type="button"
                                                        class="btn btn-secondary px-3 d-flex align-items-center "
                                                        id="add-more-requirements" label="Shto">
                                                        <img src="{{ asset('admin/assets/img/icons/plus1.svg') }}"
                                                            class="me-1" alt="img" />
                                                    </x-button>

                                                    <x-button type="button"
                                                        class="btn btn-danger remove-requirements px-3 d-flex align-items-center ms-2"
                                                        label="Fshij" style="flex-shrink: 0;">
                                                        <img src="http://127.0.0.1:8000/admin/assets/img/icons/close-circle.svg"
                                                            class="me-2" alt="img">
                                                    </x-button>
                                                @else
                                                    <x-button type="button"
                                                        class="btn btn-danger px-3 d-flex align-items-center remove-requirements"
                                                        label="Fshij" style="flex-shrink: 0;">
                                                        <img src="http://127.0.0.1:8000/admin/assets/img/icons/close-circle.svg"
                                                            class="me-2" alt="img">
                                                    </x-button>
                                                @endif
                                            </div>
                                            @if ($errors->has('requirements.' . $index))
                                                <div class="text-danger mt-1">
                                                    {{ $errors->first('requirements.' . $index) }}
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="form-group d-flex align-items-center mt-2">
                                            <x-input type="text" name="requirements[]" id="requirements"
                                                placeholder="Ju lutem shkruani kerkesat qe kerkohen per kete konkurs"
                                                class="form-control me-2">
                                            </x-input>
                                            <x-button type="button"
                                                class="btn btn-secondary px-3 d-flex align-items-center"
                                                id="add-more-requirements" label="Shto">
                                                <img src="{{ asset('admin/assets/img/icons/plus1.svg') }}" class="me-1"
                                                    alt="img" />
                                            </x-button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-lg-12" id="qualifications-container">
                                <div class="form-group">
                                    <label for="qualifications">Kualifikimet dhe Kriteret e nevojshme</label>
                                    @if (is_array(json_decode($announcement->qualifications, true)))
                                        @foreach (json_decode($announcement->qualifications, true) as $index => $qualification)
                                            {{-- Add $index --}}
                                            <div class="form-group d-flex align-items-center">
                                                <x-input type="text" name="qualifications[]" id="qualifications"
                                                    value="{{ $qualification }}"
                                                    placeholder="Ju lutem shkruani kualifikimet qe kerkohen per kete konkurs"
                                                    class="form-control me-2">
                                                </x-input>

                                                @if ($index == 0)
                                                    <x-button type="button"
                                                        class="btn btn-secondary px-3 d-flex align-items-center"
                                                        id="add-more-qualifications" label="Shto">
                                                        <img src="{{ asset('admin/assets/img/icons/plus1.svg') }}"
                                                            class="me-1" alt="img" />
                                                    </x-button>

                                                    <x-button type="button"
                                                        class="btn btn-danger remove-qualifications px-3 d-flex align-items-center ms-2"
                                                        label="Fshij" style="flex-shrink: 0;">
                                                        <img src="http://127.0.0.1:8000/admin/assets/img/icons/close-circle.svg"
                                                            class="me-2" alt="img">
                                                    </x-button>
                                                @else
                                                    <x-button type="button"
                                                        class="btn btn-danger px-3 d-flex align-items-center remove-qualifications"
                                                        label="Fshij" style="flex-shrink: 0;">
                                                        <img src="http://127.0.0.1:8000/admin/assets/img/icons/close-circle.svg"
                                                            class="me-2" alt="img">
                                                    </x-button>
                                                @endif
                                            </div>
                                            @if ($errors->has('qualifications.' . $index))
                                            <div class="text-danger mt-1">
                                                {{ $errors->first('qualifications.' . $index) }}
                                            </div>
                                        @endif
                                        @endforeach
                                    @else
                                        <div class="form-group d-flex align-items-center mt-2">
                                            <x-input type="text" name="qualifications[]" id="qualifications"
                                                placeholder="Ju lutem shkruani kualifikimet qe kerkohen per kete konkurs"
                                                class="form-control me-2">
                                            </x-input>
                                            <x-button type="button"
                                                class="btn btn-secondary px-3 d-flex align-items-center"
                                                id="add-more-qualifications" label="Shto">
                                                <img src="{{ asset('admin/assets/img/icons/plus1.svg') }}" class="me-1"
                                                    alt="img" />
                                            </x-button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 ms-3" id="preview_container">
                                <div class="product-list">
                                    <ul class="row">
                                        <li class="ps-0" id="image_preview_item">
                                            <div class="productviews">
                                                <div class="productviewsimg">
                                                    <img id="uploaded_image"
                                                        src="{{ $announcement->image ? asset('storage/' . $announcement->image) : asset('admin/assets/img/icons/noimage.png') }}"
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
                                <x-button type="submit" class="btn btn-submit me-2 btn-danger"
                                    label="Ruaj">
                                </x-button>
                                <x-link href="{{ route('announcements.index') }}" class="btn btn-cancel"
                                    label="Anulo">
                                </x-link>
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
