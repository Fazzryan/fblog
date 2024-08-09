 <!-- All Jquery -->
 <!-- ============================================================== -->
 <script src="{{ asset('assets/be/libs/jquery/dist/jquery.min.js') }}"></script>
 <script src="{{ asset('assets/be/libs/popper.js/dist/umd/popper.min.js') }}"></script>
 <script src="{{ asset('assets/be/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
 <!-- apps -->
 <!-- apps -->
 <script src="{{ asset('assets/be/js/app-style-switcher.js') }}"></script>
 <script src="{{ asset('assets/be/js/feather.min.js') }}"></script>

 <!-- slimscrollbar scrollbar JavaScript -->
 <script src="{{ asset('assets/be/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
 <script src="{{ asset('assets/be/extra-libs/sparkline/sparkline.js') }}"></script>
 <script src="{{ asset('assets/be/js/sidebarmenu.js') }}"></script>
 <!--Custom JavaScript -->
 <script src="{{ asset('assets/be/js/custom.min.js') }}"></script>
 <script src="{{ asset('assets/be/js/tambahan/formatTanggal.js') }}"></script>
 {{-- toastr --}}
 <script src="{{ asset('assets/be/libs/toastr/toastr.min.js') }}" type="text/javascript"></script>

 <!-- Custom JS disini -->
 @stack('js')
