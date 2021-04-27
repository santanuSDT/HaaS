<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>HaaS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ url('/public') }}/icons/astr_2.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ url('/public') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ url('/public') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ url('/public') }}/assets/css/style.css" rel="stylesheet">
  <script src="{{ url('/public') }}/assets/js/jquery-1.7.1.js"></script>
  <!-- For year picker -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

  @yield('page_css')
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex flex-column align-items-center">

      <h1>HaaS</h1>
      <h2>HaaS is Horoscope ditector application conducted by world famous astrologer Lolita.</h2>
      <div class="subscribe" style="padding-bottom: 30px;">
        <h4>Choose a year & generate horoscope for all zodiac</h4>
        <form role="form" method="POST" class="form-horizontal" action="{{ url('/') }}/generate">
            {!! csrf_field() !!}
            <div class="subscribe-form">
            <input class="date-own form-control" name="year" style="width: 400px;border:none" type="text" @if(isset($data['year'])) value="{{ $data['year'] }}" @endif placeholder="Click to pick a year">
            <input type="submit" value="Generate Horoscope">
            </div>
          
        </form>
      </div>
      @yield('content')
      
      

    </div>
  </header><!-- End #header -->

  <main id="main">

    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Santanu</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/maundy-free-coming-soon-bootstrap-theme/ -->
        Designed by <a href="https://bootstrapmade.com/">Santanu</a>
      </div>
    </div>
  </footer><!-- End #footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ url('/public') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ url('/public') }}/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ url('/public') }}/assets/js/main.js"></script>
  <script type="text/javascript">
    $('.date-own').datepicker({

       minViewMode: 2,

       format: 'yyyy'

     });
  </script>

  @yield('page_js')
  
  

</body>

</html>