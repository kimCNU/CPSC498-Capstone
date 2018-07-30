<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Spectrum</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicons
    ================================================== -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

<!-- Stylesheet
    ================================================== -->
<link rel="stylesheet" type="text/css"  href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/nivo-lightbox/nivo-lightbox.css">
<link rel="stylesheet" type="text/css" href="css/nivo-lightbox/default.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/modernizr.custom.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<!-- Navigation
    ==========================================-->
<nav id="menu" class="navbar navbar-default navbar-fixed-top">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand page-scroll" href="#page-top"><i class="fa fa-play fa-rotate-270"></i> Office Hours</a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.html#header" class="page-scroll">Home</a></li>
        <li><a href="form.php#about" class="page-scroll">Start Form</a></li>
        <li><a href="index.html#about" class="page-scroll">About</a></li>
		<li><a href="results.php" class="page-scroll">Results</a></li> 
		<li><a href="admin.php" class="page-scroll">Admin</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<!-- Header -->
<header id="header">
  <div class="intro">
    <div class="container">
      <div class="row">
        <div class="intro-text">

      </div>
    </div>
  </div>
</header> 

<!-- Admin -->
<!-- Coded by Kimberly Jimenez and Matthew Lupino -->
<div id="admin" class="text-center">
	<div class="container">
    <div class="section-title center">
      <h2>Delete Record</h2>
    </div>	
	    <div class="container">
			<h3> If you enter only an email, you will delete <b>ALL</b> entries associated with that email.<br> <br>
				 If you enter an email, semester, and year, you will only delete the office hours associated with that email and semester.<h3> 
				<form id="delete-record" action="delete.php" method="post">
					<div class="row">
						<div class="col-md-6 ">
							<div class="form-group">
								<label for="form_email">Email * </label>
								<input id="email" type="email" name="email"  class="form-control" placeholder="Enter the email to be deleted" required="required" data-error="Email is required.">
								<div class="help-block with errors"></div>
							</div>
						</div>
					
						<div class="col-xs-2">
							<div class="form-group">
								<label for="form_semester">Semester </label>
								<input id="semester" type="text" name="semester" class="form-control" maxlength="6" size="2" placeholder="Fall/FA">
							</div>
						</div>
					
						<div class="col-xs-2">
							<div class="form-group">
								<label for="form_year">Year </label>
								<input id="year" type="text" name="year" class="form-control" maxlength="2" size="2" placeholder="18/19">
							</div>	
						</div>
		
					</div>
				
					<div class="col-sm-10 col-sm-offset-1">
						<input type="submit" value="Submit" class="btn btn-primary"><br></br>
					</div>

		
				</form>
		</div>
	
		</div>
	</div>
</div>
<!-- End of coding section -->

<div id="footer">
  <div class="container text-center">
    <div class="fnav">
      <p>Copyright &copy; 2016 Spectrum. Designed by <a href="http://www.templatewire.com" rel="nofollow">TemplateWire</a></p>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/jquery.1.11.1.js"></script> 
<script type="text/javascript" src="js/bootstrap.js"></script> 
<script type="text/javascript" src="js/SmoothScroll.js"></script> 
<script type="text/javascript" src="js/nivo-lightbox.js"></script> 
<script type="text/javascript" src="js/jquery.isotope.js"></script> 
<script type="text/javascript" src="js/jqBootstrapValidation.js"></script> 
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>