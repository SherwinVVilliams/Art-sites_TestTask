<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  @yield('header')
</head>

<body>
	<div class="color-bar-1"></div>
    <div class="color-bar-2 color-bg"></div>
    
    <div class="container main-container">
    
      <div class="row header"><!-- Begin Header -->
      
        @yield('navigation')

      </div><!-- End Header -->
     
    <!-- Blog Content
    ================================================== --> 
    <div class="row"><!--Container row-->

        @yield('content')

        @yield('sidebar')
    </div> <!-- End Container -->

	<div class="footer-container"><!-- Begin Footer -->
        @yield('footer')
    </div><!-- End Footer --> 

    <!-- Scroll to Top -->  
    <div id="toTop" class="hidden-phone hidden-tablet">Back to Top</div>
    
</body>
</html>
