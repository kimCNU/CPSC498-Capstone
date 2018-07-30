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
      <a class="navbar-brand page-scroll" href="index.html#page-top"><i class="fa fa-play fa-rotate-270"></i> Office Hours</a> 
  </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.html" class="page-scroll">Home</a></li>
        <li><a href="form.php#about" class="page-scroll">Start Form</a></li>
        <li><a href="index.html#about" class="page-scroll">About</a></li>
		
		<!--<li><a href="index.html#admin" class="page-scroll">Admin</a></li>-->
		<li><a href="results.php" class="page-scroll">Results</a></li>
		<li><a href="admin.php" class="page-scroll">Admin</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<header id="header">
  <div class="intro">
    <div class="container">
      <div class="row">
        <div class="intro-text">
          <h1>A Form Just for You</h1>
          <p>Fill out the form below, and we will add you to our application.</p>
      </div>
    </div>
  </div>
</div>
</header>

<!-- Completed by Kimberly Jimenez and Matthew Lupino -->
<div id="about" class="text-center">
 <div class="container">
    <div class="col-md-8 col-md-offset-2">
        <h2>Office Hours Form</h2>
      
      <form id = "info-form" action="submit.php" method="post"  >
            <div class="controls">
				<div class="row">
					<div class="col-xs-2">
						<div class="form-group">
							<label for="form_prefix">Prefix (Ex: Dr.) </label>
							<input id="Prefix" type="text" name="Prefix" class="form-control" maxlength="3" size="2" pattern="[MmRrSsDd.]+">
						</div>
					</div>
					
					<div class="col-md-5">
						<div class="form-group">
							<label for="form_firstName">First Name *</label>
							<input id="firstName" type="text" name="firstName" class="form-control" placeholder="Please enter your first name *" required="required" maxlength="20" data-error="First name is required." pattern="[A-Za-z ]+">
							<div class="help-block with errors"></div>
						</div>
					</div>
					
					<div class="col-md-5">
						<div class="form-group">
							<label for="form_lastName">Last Name *</label>
							<input id="lastName" type="text" name="lastName" class="form-control" placeholder="Please enter your last name *" required="required" maxlength="30" data-error="Last name is required." pattern="[A-Za-z ]+">
							<div class="help-block with errors"></div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6 ">
						<div class="form-group">
							<label for="form_email">Email * </label>
							<input id="email" type="email" name="email"  class="form-control" placeholder="Enter your CNU email (no numbers allowed)" required="required" pattern="[a-zA-Z.@-]+" data-error="Email is required.">
							<div class="help-block with errors"></div>
						</div>
					</div>
					
					<div class="col-xs-2">
						<div class="form-group">
							<label for="form_semester">Semester *</label>
							<input id="semester" type="text" name="semester" class="form-control" maxlength="6" size="2" placeholder="Fall/FA" required="required" data-error="Semester is required." pattern="[AFPSafpslringLRING]+">
							<div class="help-block with errors"></div>
						</div>
					</div>
					
					<div class="col-xs-2">
						<div class="form-group">
							<label for="form_year">Year *</label>
							<input id="year" type="text" name="year" class="form-control" maxlength="2" size="2" placeholder="18/19" required="required" data-error="Year is required." pattern="[0-9]+">
							<div class="help-block with errors"></div>
						</div>	
					</div>
					
					
				</div>
				
				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
							<label for="form_location">Office Building *</label>
							<input id="OfficeBuilding" type="text" name="OfficeBuilding" class="form-control" placeholder="Luter/MCM" required="required" maxlength="15" data-error="Location is required." pattern="[A-Za-z ]+">
							<div class="help-block with errors"></div>
					
						</div>
					</div>
					
					<div class="col-md-5">
						<div class="form-group">
							<label for="form_location">Office Number *</label>
							<input id="OfficeNumber" type="text" name="OfficeNumber" class="form-control" placeholder="Please enter your office number *" required="required" maxlength="5" data-error="Number is required.">
							<div class="help-block with errors"></div>
					
						</div>
					</div>					
				</div>
			
			
			
				<h3>Office Hours</h3>
					<table class="table table-condensed">
						<thead>
							<tr>
								<th>Day of Week</th>
								<th>Start Time</th>
								<th>End Time</th>
							</tr>
						</thead>
						
						<tbody>
							<tr>
								<td><input id="dayOfWeek1" type="text" name="dayOfWeek1" class="form-control" placeholder="MTWRF" maxlength="5" size="5" pattern="[MTWRF]+"></td>
								<td><input id="dowStart1" type="text" name="dowStart1" class="form-control" placeholder="11:00 / 11:00 AM" maxlength="" size="8" pattern="[AMP0-9: ]+"></td>
								<td><input id="dowEnd1" type="text" name="dowEnd1" class="form-control" placeholder="18:00 / 6:00 PM" maxlength="" size="8" pattern="[AMP0-9: ]+"></td>
							</tr>

							<tr>
								<td><input id="dayOfWeek2" type="text" name="dayOfWeek2" class="form-control" placeholder="MTWRF" maxlength="5" size="5" pattern="[MTWRF]+"></td>
								<td><input id="dowStart2" type="text" name="dowStart2" class="form-control" placeholder="11:00 / 11:00 AM" maxlength="" size="8" pattern="[AMP0-9: ]+"></td>
								<td><input id="dowEnd2" type="text" name="dowEnd2" class="form-control" placeholder="18:00 / 6:00 PM" maxlength="" size="8" pattern="[AMP0-9: ]+"></td>
							</tr>

							<tr>
								<td><input id="dayOfWeek3" type="text" name="dayOfWeek3" class="form-control" placeholder="MTWRF" maxlength="5" size="5" pattern="[MTWRF]+"></td>
								<td><input id="dowStart3" type="text" name="dowStart3" class="form-control" placeholder="11:00 / 11:00 AM" maxlength="" size="8" pattern="[AMP0-9: ]+"></td>
								<td><input id="dowEnd3" type="text" name="dowEnd3" class="form-control" placeholder="18:00 / 6:00 PM" maxlength="" size="8" pattern="[AMP0-9: ]+"></td>
							</tr>

							<tr>
								<td><input id="dayOfWeek4" type="text" name="dayOfWeek4" class="form-control" placeholder="MTWRF" maxlength="5" size="5" pattern="[MTWRF]+"></td>
								<td><input id="dowStart4" type="text" name="dowStart4" class="form-control" placeholder="11:00 / 11:00 AM" maxlength="" size="8" pattern="[AMP0-9: ]+"></td>
								<td><input id="dowEnd4" type="text" name="dowEnd4" class="form-control" placeholder="18:00 / 6:00 PM" maxlength="" size="8" pattern="[AMP0-9: ]+"></td>
							</tr>

							<tr>
								<td><input id="dayOfWeek5" type="text" name="dayOfWeek5" class="form-control" placeholder="MTWRF" maxlength="5" size="5" pattern="[MTWRF]+"></td>
								<td><input id="dowStart5" type="text" name="dowStart5" class="form-control" placeholder="11:00 / 11:00 AM" maxlength="" size="8" pattern="[AMP0-9: ]+"></td>
								<td><input id="dowEnd5" type="text" name="dowEnd5" class="form-control" placeholder="18:00 / 6:00 PM" maxlength="" size="8" pattern="[AMP0-9: ]+"></td>
							</tr>							
						</tbody>
						
				    </table>
						
			</div>
					
				<div class="col-sm-10 col-sm-offset-1">
					<input type="submit" value="Submit" class="btn btn-primary">
				</div>
		</form> 
		
      
    </div>
  </div>
</div> 
<!-- End of coding  -->

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