<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- Vendor JS Files -->
<script src="{{ asset('backend/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('backend/assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('backend/assets/js/main.js') }}"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if (Session::has('success_message'))
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
        toastr.success("{{ Session::get('success_message') }}");
    </script>
@elseif (Session::has('error_message'))
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
        toastr.error("{{ Session::get('error_message') }}");
    </script>
@endif

{{-- Preview Image while upload --}}
<script>
    $('.custom-file-input').on('change', function() {
        var file = $(this).get(0).files[0];
        var myThis = $(this);
        if (file) {
            var reader = new FileReader();

            reader.onload = function() {

                myThis.closest('.image').find('.previewImage').attr("src", reader.result);


                // $(".previewImage").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    })
</script>


<script src="{{ asset('ckeditor/build/ckeditor.js') }}"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor100'))
        .catch(error => {
            console.error(error);
        });
</script>

@if (isset($data['posts']))
    <script>
        for (let i = 0; i < {{ $data['posts']->count() }}; i++) {
            ClassicEditor
                .create(document.querySelector('#editor' + i))
                .catch(error => {
                    console.error(error);
                });
        }
    </script>
@endif

@if (isset($data['posts']))
    <script>
        for (let i = 0; i < {{ $data['posts']->count() }}; i++) {
            ClassicEditor
                .create(document.querySelector('#editor1' + i))
                .catch(error => {
                    console.error(error);
                });
        }
    </script>
@endif
@stack('js')
