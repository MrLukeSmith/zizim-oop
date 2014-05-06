
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Zizim URL Shortener</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/zizim.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="notification">
      <p></p>
    </div>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li><a href="api.php">API</a></li>
        </ul>
        <h3 class="text-muted">Zizim URL Shortener</h3>
      </div>

      <div class="jumbotron">
        <div class="shorten_form">
          <h1>Shorten a URL</h1>
          <p>Enter the URL you'd like to shorten in the field below.</p>
          <form id="shortening_form">
            <div class="form-group">
              <input class="form-control input-lg" name="url" placeholder="e.g. https://www.youtube.com/watch?v=p6TLzXzI_EU" />
            </div>
            <div class="form-group custom-alias-group">
              <p>Enter a custom alias below, if desired. If one isn't provided, we'll generate one.</p>
              <input class="form-control input-lg" name="alias" placeholder="customaliashere" />
            </div>
            <a href="/" class="btn btn-lg btn-primary" id="generate">Generate Shortened URL</a>
          </form>
        </div>
        <div class="processing">
          <h1>Generating...</h1>
          <p>We're generating your shortened URL, this shouldn't take long.</p>
        </div>
        <div class="generated_url">
          <h1>Your short URL</h1>
              <div class="form-group">
                <input class="form-control input-lg" name="short-url" value="http://ziz.im/shortenedURL" />
              </div>
              
              <a href="/" class="btn btn-lg btn-primary" id="generate_another">Generate Another</a>
        </div>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
          <h4>What is a URL Shortener?</h4>
          <p>A URL Shortener allows you to take a long URL like <em>http://www.ebuyer.com/shop/desktop-deals?utm_source=2014-05-05&utm_medium=campaign_email&utm_campaign=B2C_05-05-2014_All_FS</em> and turn it into something like <em>http://ziz.im/pKD1eX</em>.</p>
          
          <h4>What is an alias?</h4>
          <p>Zizim gives you the option to set an alias for your short url. Essentially, this means you can set what comes after our URL (if it isn't already in use). e.g. http://ziz.im/<em>customalias</em>. If one isn't provided, we'll generate you one of our own.</p>

          <h4>Why are they useful?</h4>
          <p>URL Shortening services are useful, because they allow you to monitor the number of people who visit your link. Zizim will be making the tracking aspect of the service public in the very near future, it's currently under development.</p>
        </div>

      </div>

      <div class="footer">
        <p>Copyright &copy; <a href="http://smithyy.co.uk" target="_blank">Luke Smith</a> 2014.</p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/zizim.js"></script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-50437310-1', 'ziz.im');
      ga('send', 'pageview');

    </script>

  </body>
</html>
