<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.Name', 'V-Beauty')}}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('vendors/dist/css/adminlte.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('vendors/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <style>
    .info {
      font-size: 20px;
      font-weight: bold;
    }
  </style>
  @yield('style')
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- 1 . Top Menu -->
    @include('layouts.navbar')

    <!-- 2. Left Menu -->
    @include('layouts.sidebar')

    <!-- 3. Main Content (Body) -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>@yield('header')</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">@yield('header')</li>
              </ol>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        
        <div class="container-fluid">
        @yield('card')
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Table</h3>
                </div>
                <div class="card-body">
                  @yield('info')
                  <table id="example1" class="table table-bordered table-striped">
                    @yield('content')
                  </table>
                </div>
              </div>
            </div>
          </div>
      </section>
    </div>


    <!-- 5. Footer -->
    @include('layouts.footer')

  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{ asset('vendors/plugins/jquery/jquery.min.js') }}"></script>
  <!-- jquery-validation -->
  <script src="{{ asset('vendors/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('vendors/plugins/jquery-validation/additional-methods.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('vendors/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('vendors/dist/js/adminlte.min.js') }}"></script>
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('vendors/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('vendors/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('vendors/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('vendors/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('vendors/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('vendors/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('vendors/plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('vendors/plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('vendors/plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('vendors/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('vendors/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('vendors/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('vendors/dist/js/adminlte.min.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('vendors/dist/js/demo.js') }}"></script>
  <!-- Page specific script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        initComplete: function() {
          this.api()
            .columns()
            .every(function() {
              var column = this;
              var select = $('<select><option value=""></option></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function() {
                  var val = $.fn.dataTable.util.escapeRegex($(this).val());

                  column.search(val ? '^' + val + '$' : '', true, false).draw();
                });

              column
                .data()
                .unique()
                .sort()
                .each(function(d, j) {
                  select.append('<option value="' + d + '">' + d + '</option>');
                });
            });
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "lengthMenu": [
          [30, 50, 100, -1],
          [30, 50, 100, "All"]
        ],
        "buttons": ["copy", "csv", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  @yield('script')
</body>

</html>