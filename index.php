<?php

	session_start();
	
	require_once('vendor/autoload.php');
	require_once('App/Auth/Auth.php');
	
	

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Prueba Buses Hotspot</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
	<link rel="stylesheet" href="./css/style.css">

</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
				<div class="card card-signin my-5 rounded">
					<?php Auth::getUserAuth() ?>
					<div class="card-body">
						<h5 class="card-title text-center">Prueba Buses Hotspot</h5>
						<form class="form-signin">
							<div class="form-label-group"> <input type="email" id="inputEmail" class="form-control" placeholder="Correo Electronico" autofocus> <label for="inputEmail"></label> </div>
							<div class="form-label-group"> <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña"> <label for="inputPassword"></label> </div>
							<hr class="my-4"> 
							<a href="?login=Google" class="btn btn-lg btn-google btn-block text-uppercase"><i class="fab fa-google mr-2"></i> Ingresar con Google</a> 
							<a href="?login=Facebook" class="btn btn-lg btn-facebook btn-block text-uppercase"><i class="fab fa-facebook-f mr-2"></i> Ingresar con Facebook</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>