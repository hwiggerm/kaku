<?php
if ( isset($_POST['button']) ) {
	shell_exec('/usr/bin/python /home/pi/kaku/klik.py  '.$_POST["button"].'');
}
exec("pgrep -c python", $output, $return);
if ($return == 2 ) {
    echo "Ok, process is running\n";
}
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>DorskamPi</title>
	<meta name="description" content="Homeautomation">
	<meta name="author" content="HWI">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="stylesheets/base.css">
	<link rel="stylesheet" href="stylesheets/skeleton.css">
	<link rel="stylesheet" href="stylesheets/layout.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/light.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/light.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/light.png">

</head>
<body>

<?php
	$con=mysqli_connect("localhost","testuser","test623","testdb");
	// Check connection
	if (mysqli_connect_errno())
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}

	$result = mysqli_query($con,"select * from  tempsensor where mdate = (select max(mdate) from tempsensor) ");

	while($row = mysqli_fetch_array($result))
  	{
	  	echo "Tijd :" . $row['mdate'] . "Temperatuur:" . $row['temp'] . "C  " . " Vochtigheid:" . $row['humid'] . "%" . " Buitentemp:" . $row['extemp'] . "C  " ;
  		echo "<br>";
  	}

	mysqli_close($con);
?>


	<!-- Primary Page Layout
	================================================== -->

	<!-- Delete everything in this .container and get started on your own site! -->

	<!-- 
	#kroonl 2
	#bib 4
	#woonkamer 3
	#boven-overloop	5
	#buiten 7
	#vijver	6 
	-->

	
	
	<div class="container">
		<div class="sixteen columns">
			<h1 class="remove-bottom" style="margin-top: 40px"><img src="./images/light.png"> DorskamPi</h1>
			<h5>Version 0.3</h5>
			<hr/>
				<h3>Beneden</h3>
				     	<legend>Woonkamer-verlichting</legend>
						  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				         		<button class="button" type="submit" name="button" value="3 1" />aan</button>
				         		<button class="button" type="submit" name="button" value="3 0" />uit</button>
						  </form>


						<legend>Kerstboom</legend>
						  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				         		<button class="button" type="submit" name="button" value="8 1" />aan</button>
				         		<button class="button" type="submit" name="button" value="8 0" />uit</button>
						  </form>



						<legend>Bibliotheek</legend>
						  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				         		<button class="button" type="submit" name="button" value="4 1" />aan</button>
				         		<button class="button" type="submit" name="button" value="4 0" />uit</button>
						  </form>

			<hr/>
			
				<h3>Boven</h3>
				     	<legend>Hal-kroonluchter</legend>
						  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				         	<button class="button" type="submit" name="button" value="1 1" />aan</button>
				         	<button class="button" type="submit" name="button" value="1 0" />uit</button>
						  </form>
						
						<legend>Overloop-Jongens</legend>
						  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				         		<button class="button" type="submit" name="button" value="5 1" />aan</button>
				         		<button class="button" type="submit" name="button" value="5 0" />uit</button>
						  </form>

						<legend>Kamer Marc</legend>
						  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				         		<button class="button" type="submit" name="button" value="11 1" />aan</button>
				         		<button class="button" type="submit" name="button" value="11 0" />uit</button>
						  </form>




			<hr/>
				<h3>Buiten</h3>
						
						<legend>Vijver</legend>
						  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				         		<button class="button" type="submit" name="button" value="6 1" />aan</button>
				         		<button class="button" type="submit" name="button" value="6 0" />uit</button>
						  </form>
						
						<legend>Buitenlamp Garage</legend>
						  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				         		<button class="button" type="submit" name="button" value="7 1" />aan</button>
				         		<button class="button" type="submit" name="button" value="7 0" />uit</button>
						  </form>

						<legend>Serre</legend>
						  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				         		<button class="button" type="submit" name="button" value="2 1" />aan</button>
				         		<button class="button" type="submit" name="button" value="2 0" />uit</button>
						  </form>

			<hr/>
				<h3>Kerst</h3>
						
	
						<legend>Kerst_lampjes_huis</legend>
						  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				         		<button class="button" type="submit" name="button" value="-3 1" />aan</button>
				         		<button class="button" type="submit" name="button" value="-3 0" />uit</button>
						  </form>

						<legend>Kerst_lampjes_garage</legend>
						  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				         		<button class="button" type="submit" name="button" value="-1 1" />aan</button>
				         		<button class="button" type="submit" name="button" value="-1 0" />uit</button>
						  </form>


						<legend>Sleep</legend>
						  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				         		<button class="button" type="submit" name="button" value="99 1" />uit</button>
						  </form>






						<hr/>
						<a href="db.php">DB</a> - 
                                          <a href="weight.php">Weight </a>- 
                                          <a href="energy.php">Energy</a>-
                                          <a href="g.htm" target="blank">Graph</a>
 
		</div>
		

	</div><!-- container -->


<!-- End Document
================================================== -->
</body>
</html>
