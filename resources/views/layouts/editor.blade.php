<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skills Job Match - Editor Panel</title>

    @include('partials.styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('partials.navbar')

    <!-- Main Sidebar Container -->
    @include('partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    {{--    @include('layouts.partials.footer')--}}
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

@include('partials.scripts')
<script type="text/javascript">

    $('tr').click(function(event){
        if(event.target.type !== 'checkbox'){
            //$(':checkbox', this).trigger('click');
            // Change property instead
            $(':checkbox', this).prop('checked', true);
            $(this).addClass('tbl_select_change_color');

        }
    });

    $(document).on('click','.deleteUser',function(){
        var userID=$(this).attr('data-userid');
        $('#app_id').val(userID);
        $('#moduleDeleteModal').modal('show');
    });



    $(document).ready(function() {
        $('#data_table_tb').DataTable( {
            "pageLength": 50,
        });

        $('#data_table_programmes').DataTable( {
            "paging": false,
            "searching": false,
        });
    } );

</script>
</body>
</html>
