<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">




    <!--favicon-->
    <link rel="icon" href="{{ asset('frontend/images/favicon.png') }}" type="image/png" />
    <!--plugins-->


    
    <link href="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }} " rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/simplebar/css/simplebar.css') }} " rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }} " rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/metismenu/css/metisMenu.min.css') }} " rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('/backend/assets/css/pace.min.css') }} " rel="stylesheet" />
    <script src="{{ asset('/backend/assets/js/pace.min.js') }} "></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('/backend/assets/css/bootstrap.min.css') }} " rel="stylesheet">
    <link href="{{ asset('/backend/assets/css/bootstrap-extended.css') }} " rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('/backend/assets/css/app.css') }} " rel="stylesheet">
    <link href="{{ asset('/backend/assets/css/icons.css') }} " rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('/backend/assets/css/dark-theme.css') }} " />
    <link rel="stylesheet" href="{{ asset('/backend/assets/css/semi-dark.css') }} " />
    <link rel="stylesheet" href="{{ asset('/backend/assets/css/header-colors.css') }} " />


    {{-- data table --}}
    <link href="{{ asset('backend/assets/dark-modeplugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <title>Instructor Dashboard</title>
    @vite(['resources/js/app.js'])
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('instructor.layout.sidebar')
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('instructor.layout.topbar')
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            @yield('instructor')
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

        @include('instructor.layout.footer')
    </div>
    <!--end wrapper-->



    <!-- Bootstrap JS -->
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }} "></script>
    <!--plugins-->
    <script src="{{ asset('backend/assets/js/jquery.min.js') }} "></script>
    <script src="{{ asset('backend/assets/plugins/simplebar/js/simplebar.min.js') }} "></script>
    <script src="{{ asset('backend/assets/plugins/metismenu/js/metisMenu.min.js') }} "></script>
    <script src="{{ asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }} "></script>
    <script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }} "></script>
    <script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }} "></script>
    <script src="{{ asset('backend/assets/plugins/chartjs/js/chart.js') }} "></script>
    <script src="{{ asset('backend/assets/js/index.js') }} "></script>
    <script src="{{ asset('backend/assets/js/validate.min.js') }} "></script>

{{-- chart  scrollbar for replay instructor  --}}
    <script>
        new PerfectScrollbar('.chat-list');
        new PerfectScrollbar('.chat-content');
    </script>



    <!--app JS-->
    <script src="{{ asset('backend/assets/js/app.js') }} "></script>
    <script>
        new PerfectScrollbar(".app-container")
    </script>

<script src="{{ asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- sweet alaert --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="{{ asset('backend/assets/js/code.js') }}"></script>


<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include TinyMCE -->
<script src="https://cdn.tiny.cloud/1/nhv07sf4mtfp3nemhg4xfaemxx4nojgj1k9jgtv0lhiilu85/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<!-- Include TinyMCE jQuery Plugin -->
<script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script>

<script>
  tinymce.init({
    selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
    plugins: 'code table lists',
    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
  });
</script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
          } );
    </script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>
   
</body>

</html>
