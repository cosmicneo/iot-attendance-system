<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
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
<script>
        function empty() {
    var x;
    x = document.getElementById("id").value;
    if (x == "") {
        alert("Enter a Valid id");
        return false;
    }
}
    </script>

</head>
<body>
<?php
    if (isset($_SESSION['message']) && $_SESSION['message'])
    {
      printf('<b>%s</b>', $_SESSION['message']);
      unset($_SESSION['message']);
    }
  ?>


	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" method="POST" action="upload.php" enctype="multipart/form-data">
				<span class="contact100-form-title">
					Upload Bell Sounds
				</span>

				<div class="wrap-input100 validate-input" data-validate="ID is required">
					
					<input class="input100" type="file" name="uploadedFile" placeholder="Enter FingerPrint ID">
					<span class="focus-input100"></span>
				</div>
<div class="wrap-input100 validate-input" data-validate="ID is required">
					
					<input class="input100" type="time" name="belltime">
					<span class="focus-input100"></span>
				</div>
				
				
				
				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn"  >
							<span >
								Submit
								<input type="submit" name="uploadBtn" value="" />
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
<button class="btn" onclick="window.location.href = 'index.html';"><i class="fa fa-home"></i><span style="font-weight:bold">&nbsp Home</span></button>
<button class="btn" onclick="window.location.href = 'bell';"><i class="fa fa-arrow-left"></i><span style="font-weight:bold">&nbsp Back</span></button>
	
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

