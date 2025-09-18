 <!-- script  -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
     integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
 </script>
 <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.0/gsap.min.js"></script>

 <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/slider.js') }}"></script>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

 @if (session('status'))
     <script>
         swal("{{ session('status') }}");
     </script>
 @endif()

 <script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_KEY') }}"></script>

 <script type="text/javascript">
     $('#contactUSForm').submit(function(event) {
         event.preventDefault();

         grecaptcha.ready(function() {
             grecaptcha.execute("{{ env('GOOGLE_RECAPTCHA_KEY') }}").then(function(token) {
                 $('#contactUSForm').prepend(
                     '<input type="hidden" name="g-recaptcha-response" value="' + token +
                     '">');
                 $('#contactUSForm').unbind('submit').submit();
             });;
         });
     });

     $('#onlineForm').submit(function(event) {
         event.preventDefault();

         grecaptcha.ready(function() {
             grecaptcha.execute("{{ env('GOOGLE_RECAPTCHA_KEY') }}").then(function(token) {
                 $('#onlineForm').prepend(
                     '<input type="hidden" name="g-recaptcha-response" value="' + token +
                     '">');
                 $('#onlineForm').unbind('submit').submit();
             });;
         });
     });
 </script>

 @stack('js')
 <!-- script end -->
