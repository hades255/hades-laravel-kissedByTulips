<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon.png">
    <title>KBT</title>
    <link rel="stylesheet" type="text/css"
        href="/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <!-- Custom CSS -->
    <link href="/dist/css/style.min.css" rel="stylesheet">
    <link href="/dist/css/custom.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="/assets/node_modules/jsgrid/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="/assets/node_modules/jsgrid/jsgrid-theme.min.css" />
    <link href="/dist/css/pages/tab-page.css" rel="stylesheet">
    <script src="/assets/node_modules/jquery/dist/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <style>
     html body .m-t-40{
       margin-top:0px;
     }
     .dataTables_filter{
       margin-right: 38px;
     }
      tbody, td, tfoot, th, thead, tr  {
       border-style: none;
     }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="skin-default fixed-layout">
          <!-- ============================================================== -->
          <!-- Preloader - style you can find in spinners.css -->
          <!-- ============================================================== -->
          @include('dashboard.includes.loader')
          <!-- ============================================================== -->
          <!-- Main wrapper - style you can find in pages.scss -->
          <!-- ============================================================== -->
          <div id="main-wrapper">
              <!-- ============================================================== -->
              <!-- Topbar header - style you can find in pages.scss -->
              <!-- ============================================================== -->
          @include('dashboard.includes.header')

          @include('dashboard.includes.leftbar')
                @yield('content')
           @include('dashboard.includes.footer')
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
        </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->

    <script src="/assets/custom.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="/assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="/dist/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="/assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="/dist/js/custom.min.js"></script>
    <script src="/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- This is data table -->
    <script src="/assets/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <script src="/assets/node_modules/jsgrid/db.js"></script>
    <script type="text/javascript" src="/assets/node_modules/jsgrid/jsgrid.min.js"></script>
    <script src="/dist/js/pages/jsgrid-init.js"></script>

    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <!-- address auto complete js -->
    @yield("js")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script>
        $(function () {
            $('#myTable').DataTable();
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function (settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function () {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
            // responsive table
            $('#config-table').DataTable({
                responsive: true
            });
            $('#example23').DataTable({
                "displayLength": 50,
                dom: 'Bfrtip',
                buttons: [
                   {
                       extend:    'copyHtml5',
                       text:      '<i class="fa fa-files-o"></i>',
                       titleAttr: 'Copy'
                   },
                 {
                     extend:    'excelHtml5',
                     text:      '<i class="fa fa-file-excel-o"></i>',
                     titleAttr: 'Excel'
                 },
                 {
                     extend:    'csvHtml5',
                     text:      '<i class="fa fa-file-text-o"></i>',
                     titleAttr: 'CSV'
                 },
                 {
                     extend:    'pdfHtml5',
                     text:      '<i class="fa fa-file-pdf-o"></i>',
                     titleAttr: 'PDF'
                 }
              ]
            });

            $('.buttons-excel').html('<i class="fa fa-copy"/>');
            $('.buttons-pdf').html('<i class="fa fa-print"/>');
        });

        function form_alert(id, message) {
        swal({
            title: '{{"Are you sure?"}}',
            text: message,
            type: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $('#'+id).submit()
            }
        })
    }

    </script>
</body>

</html>
