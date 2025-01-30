@extends('layouts.header')

@section('content')

        <div class="container-fluid p-0">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('img/carousel-1.jpg')}}" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Gjeni punen tuaj perfekte te cilen e meritoni</h1>
                                    <a href="#jobs-filter-form" class="btn btn-primary py-md-3 px-md-5 w-50 me-3 rounded-custom animated slideInLeft">Kerko Pune</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset('img/carousel-2.jpg')}}" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Gjeni mundësitë më të mira të punës për ju</h1>
                                    <a href="#jobs-filter-form" class="btn btn-primary py-md-3 px-md-5 w-50 rounded-custom me-3 animated slideInLeft">Kerko Pune</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;" id="jobs-filter-form">
            <div class="container">
                <form id="filter-form" action="{{ route('landingpage.filterJobs') }}" method="GET">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <x-select :options="$categories" name="category" class="form-select border-0 py-3 rounded-custom">
                                    <option value="">Zgjidhni nje Kategori</option>
                                </x-select>
                            </div>
                            <div class="col-md-6">
                                <x-select :options="$cities" name="city" class="form-select border-0 py-3 rounded-custom">
                                    <option value="">Zgjidhni nje Qytet</option>
                                </x-select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-custom border-0 w-100 py-3 rounded-custom">Kerko</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Listimi i Shpalljeve</h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            @if($jobs->isEmpty())
                                <div class="alert alert-warning" role="alert">
                                    <strong>Asnjë shpallje nuk u gjet</strong> bazuar në filtrat e zgjedhur. Ju lutemi provoni filtra të ndryshëm ose kontrolloni më vonë.
                                </div>
                            @else
                                @foreach($jobs as $job)
                                    <div class="job-item p-4 mb-4">
                                        <div class="row g-4">
                                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                                <img class="flex-shrink-0 img-fluid border rounded"
                                                     src="{{ $job->image ? asset('storage/' . $job->image) : asset('admin/assets/img/annoucement/noimage.png') }}"
                                                     alt="Job Image"
                                                     style="width: 80px; height: 80px;">
                                                <div class="text-start ps-4">
                                                    <h5 class="mb-3">{{ $job->job_title }}</h5>
                                                    <span class="text-truncate me-3">
                                                        <i class="far fa-building text-primary me-2"></i>{{ optional($job->company)->name }}
                                                    </span>
                                                    <span class="text-truncate me-3">
                                                        <i class="fa fa-map-marker-alt text-primary me-2"></i>{{ optional($job->city)->name }}
                                                    </span>
                                                    <span class="text-truncate me-0">
                                                        <i class="far fa-clock text-primary me-2"></i>
                                                        @php
                                                            $now = now();
                                                            $toDate = \Carbon\Carbon::parse($job->to_date);
                                                            $diff = $now->diff($toDate);
                                                    
                                                            if ($now < $toDate) {
                                                                echo "{$diff->d} Dite ";
                                                            } else {
                                                                echo "0 Dite";
                                                            }
                                                        @endphp
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                                <div class="d-flex">
                                                    <a class="btn btn-primary px-4 py-3 rounded-custom" href="{{ route('job-detail', $job->id) }}">Apliko Ketu</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Klientët tanë</h1>
                <div class="row g-4">
                    @foreach($companies as $company) 
                        <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                            <a class="cat-item rounded p-4" href="">
                                @if($company->image)
                                    <img src="{{ asset('storage/' . $company->image) }}" alt="Company Image" class="img-fluid mb-4">
                                @else
                                    <img src="default-image.jpg" alt="Company Image" class="img-fluid mb-4">
                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="row g-0 about-bg rounded overflow-hidden">
                            <div class="col-6 text-start">
                                <img class="img-fluid w-100" src="{{asset('img/about-1.jpg')}}">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid" src="{{asset('img/about-2.jpg')}}" style="width: 85%; margin-top: 15%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid" src="{{asset('img/about-3.jpg')}}" style="width: 85%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid w-100" src="{{asset('img/about-4.jpg')}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">Ne ndihmojmë për të marrë punën më të mirë dhe për të gjetur një talent</h1>
                        <p class="mb-4">Ne jemi partneri juaj në gjetjen e mundësive më të mira dhe zhvillimin e talenteve</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Ne ndihmojmë në gjetjen e mundësive që i përshtaten aftësive dhe talentit tuaj.</p> 
                        <p><i class="fa fa-check text-primary me-3"></i>Me mbështetje të vazhdueshme, mund të arrini qëllimet dhe të bëni ndryshimin në karrierën tuaj.</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Jemi këtu për t'ju ndihmuar të arrini suksesin.</p>
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
            <script>
                $(document).ready(function () {
                    $('#filter-form').on('submit', function (e) {
                        e.preventDefault(); 
                
                        let formData = $(this).serialize(); 
                
                        $.ajax({
                            url: $(this).attr('action'),
                            type: 'GET',
                            data: formData,
                            beforeSend: function () {
                            },
                            success: function (response) {
                                $('.tab-content').html($(response).find('.tab-content').html());
                            },
                            error: function () {
                                alert('Something went wrong. Please try again.');
                            }
                        });
                    });
                });
            </script>
        @endpush
           @include('layouts.footer')

    </div>

 
        
</body>

</html>



@endsection