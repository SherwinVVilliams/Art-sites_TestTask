<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name = "csrf-token" content = "{{ csrf_token() }}">

    <title>SB Admin - Tables</title>

    <!-- Bootstrap core CSS-->
    <link href="{{ config('setting.admin_folder_name') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{ config('setting.admin_folder_name') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="{{ config('setting.admin_folder_name') }}/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ config('setting.admin_folder_name') }}/css/sb-admin.css" rel="stylesheet">

    <script src="{{ config('setting.admin_folder_name') }}/vendor/jquery/jquery.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" rel="stylesheet">
    

  </head>

  <body id="page-top">

    @yield('header')

    <div id="wrapper">

      <!-- Sidebar -->
     @yield('sidebar')

      <div id="content-wrapper">

        @if(count($errors)>0)
        <div class = 'alert alert-danger'>
            @foreach ($errors->all() as $error)
                
                  <p>{{ $error }}</p>
                
            @endforeach
        </div>
        @endif

        @yield('content')
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        @yield('footer')

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->

    <script src="{{ config('setting.admin_folder_name') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ config('setting.admin_folder_name') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="{{ config('setting.admin_folder_name') }}/vendor/datatables/jquery.dataTables.js"></script>
    <script src="{{ config('setting.admin_folder_name') }}/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ config('setting.admin_folder_name') }}/js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="{{ config('setting.admin_folder_name') }}/js/demo/datatables-demo.js"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

    <script src = "{{ config('setting.admin_folder_name') }}/js/my_ajax.js"></script>

  </body>

</html>
