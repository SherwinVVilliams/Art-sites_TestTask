

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          @if(url()->current() != route('admin.home'))
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{route('admin.home')}}">Home</a>
              </li>
              <li class="breadcrumb-item active">Overview</li>
            </ol>
          @else
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="{{route('admin.home', ['table' => 'article'])}}">Article</a>
                </li>
                <li class="breadcrumb-item">
                  <a href="{{route('admin.home', ['table' => 'category'])}}">Category</a>
                </li>
            </ol>
          @endif

         
          <!-- DataTables Example -->
        {!! $table ? $table : ''!!}
          
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->

