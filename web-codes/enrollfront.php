<!DOCTYPE html>
<html lang="en">
<?php  
	$server="127.0.0.1";
	$userid ="admin";
	$Password = "123321";
	$myDB = "Attendance";

   $con = mysqli_connect($server,$userid,$Password,$myDB);

	if (mysqli_connect_errno()) {
		# code...
		 echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
 

?>
<head>
	<title>Contact V4</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/icon.css">
<!--===============================================================================================-->
</head>
<body>


	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" action="enroll.php">
				<span class="contact100-form-title">
					Enroll
				</span>

				<div class="wrap-input100 validate-input" data-validate="Name is required">
					<span class="label-input100">Name</span>
					<input class="input100" type="text" name="name" placeholder="Enter name">
					<span class="focus-input100"></span>
				</div>

				
				<div class="wrap-input100 input100-select">
					<span class="label-input100">Category</span>
					<div>
						<select class="selection-2" name="category">
							<option value="student">Student</option>
							<option value="teacher">Teacher</option>
							<option value="staff">Staff</option>
							<option value="admin">Administrator</option>
							
						</select>
				</div></div>
					<div class="wrap-input100 input100-select">
					<span class="label-input100">Class</span>
					<div>
						<select class="selection-2" name="class">
						<option value="12">12</option>	
<option value="11">11</option>

<option value="10">10</option>

<option value="9">9</option>

<option value="8">8</option>
<option value="7">7</option>
<option value="6">6</option>
<option value="5">5</option>
<option value="4">4</option>
<option value="3">3</option>
<option value="2">2</option>
<option value="1">1</option>
							
							
							
							
							
							
							
							
							
							
							
							
						</select>
				</div>

				</div>

				<div class="wrap-input100 input100-select">
					<span class="label-input100">Zone</span>
					<div>
						<select class="selection-2" name="zone">
								<option>Select</option>
				<?php 

					$sqli = "SELECT * FROM punch_time";
					$result = mysqli_query($con, $sqli);
					 while ($row = mysqli_fetch_array($result)) {
					 		# code...
					 	echo '<option value='.$row['zone'].'>'.' '.$row['zone'].'</option>';
					 }	
 

					?>
						</select>
				
							
							
				</div>
				</div>
				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn">
							<span>
								Submit
								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</div>
			</form>
<br>
<style type="text/css">
    .btn {
        background-color:orange;
        cursor:pointer;
    }
</style>
<br>
<button class="btn" onclick="window.location.href = 'index.html';"><i class="fa fa-home"></i><span style="font-weight:bold">&nbspHome</span></button>
<button class="btn" onclick="window.location.href = 'zonesetting';"><i class="fa fa-cog"></i><span style="font-weight:bold">&nbspZone Settings</span></button>
		</div>

	
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

</body>
</html>
