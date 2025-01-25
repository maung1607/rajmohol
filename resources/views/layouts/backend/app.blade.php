<!DOCTYPE html>
<html lang="en">
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Rajmohol - @yield('title')</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('backend/assets/css/app.min.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/bundles/datatables/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
  <!-- Custom style CSS -->
   <link rel="stylesheet" href="{{ asset('backend/assets/bundles/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/bundles/jquery-selectric/selectric.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/custom.css') }}">
  <link rel='shortcut icon' type='image/x-icon' href='{{ asset('backend/assets/img/favicon.ico') }}' />
</head>
<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
        @include('layouts.backend.includes.navbar')
        @include('layouts.backend.includes.sidebar')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
                @yield('content')
        </section>
      </div>
      @include('layouts.backend.includes.footer')
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>
  <!-- JS Libraies -->
  <script src="{{ asset('backend/assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('backend/assets/js/page/index.js') }}"></script>

  <script src="{{ asset('backend/assets/bundles/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('backend/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('backend/assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('backend/assets/js/page/datatables.js') }}"></script>


   <script src="{{ asset('backend/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('backend/assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/page/forms-advanced-forms.js') }}"></script>
  <!-- Template JS File -->
  <script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('backend/assets/js/custom.js') }}"></script>

  @stack('script')
</body>

</html>
