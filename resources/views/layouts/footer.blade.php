    <div class="container-fluid bg-dark text-white-50 footer mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#"></a>Te gjitha te drejtat e rezervuara. 
                   <a class="border-bottom" href="{{ route('landing.page') }}">Portal Pune</a>
                </div>
            </div>
        </div>
    </div>
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top rounded-custom"><i class="bi bi-arrow-up"></i></a>

 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
 <script src="{{asset('lib/wow/wow.min.js')}}"></script>
 <script src="{{asset('lib/easing/easing.min.js')}}"></script>
 <script src="{{asset('lib/waypoints/waypoints.min.js')}}"></script>
 <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>

 <script src="{{asset('js/main.js')}}"></script>
 @stack('scripts') 
