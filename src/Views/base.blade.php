
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">    

    <title>Login Autonom Teszt</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/table.css" rel="stylesheet">
    @yield('styles')
  </head>

  <body>

    <header>        
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
          <a href="/" class="navbar-brand d-flex align-items-center">
            <img style="   width: 100px;margin-right: 20px;" src="https://login.hu/assets/frontend/images/logo/logo.svg" />
            <strong>Login Autonom Teszt</strong>
          </a>
        </div>
      </div>
    </header>

    <main role="main">

        @yield('content')

    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    @yield('scripts')
    
  </body>
</html>
