<?php

// Include configuration file 
require_once 'config.php'; 
 
// Include User library file 
require_once 'App/User.php'; 
 
if(isset($_GET['code'])){ 
    $gClient->authenticate($_GET['code']); 
    $_SESSION['token'] = $gClient->getAccessToken(); 
    header('Location: ' . filter_var(GOOGLE_REDIRECT_URL, FILTER_SANITIZE_URL)); 
} 
 
if(isset($_SESSION['token'])){ 
    $gClient->setAccessToken($_SESSION['token']); 
} 
 
if($gClient->getAccessToken()){ 
    // Get user profile data from google 
    $gpUserProfile = $google_oauthV2->userinfo->get(); 
     
    // Initialize User class 
    $user = new User(); 
     
    // Getting user profile info 
    $gpUserData = array(); 
    $gpUserData['oauth_uid']  = !empty($gpUserProfile['id'])?$gpUserProfile['id']:''; 
    $gpUserData['first_name'] = !empty($gpUserProfile['given_name'])?$gpUserProfile['given_name']:''; 
    $gpUserData['last_name']  = !empty($gpUserProfile['family_name'])?$gpUserProfile['family_name']:''; 
    $gpUserData['email']       = !empty($gpUserProfile['email'])?$gpUserProfile['email']:''; 
    $gpUserData['gender']       = !empty($gpUserProfile['gender'])?$gpUserProfile['gender']:''; 
    $gpUserData['locale']       = !empty($gpUserProfile['locale'])?$gpUserProfile['locale']:''; 
    $gpUserData['picture']       = !empty($gpUserProfile['picture'])?$gpUserProfile['picture']:''; 
     
    // Insert or update user data to the database 
    $gpUserData['oauth_provider'] = 'google'; 
    $userData = $user->checkUser($gpUserData); 
     
    // Storing user data in the session 
    $_SESSION['userData'] = $userData; 
     
    // Render user profile data 
    if(!empty($userData)){ 
        $output  = '<h2>Google Account Details</h2>'; 
        $output .= '<div class="ac-data">'; 
        $output .= '<img src="'.$userData['picture'].'">'; 
        $output .= '<p><b>Google ID:</b> '.$userData['oauth_uid'].'</p>'; 
        $output .= '<p><b>Name:</b> '.$userData['first_name'].' '.$userData['last_name'].'</p>'; 
        $output .= '<p><b>Email:</b> '.$userData['email'].'</p>'; 
        $output .= '<p><b>Gender:</b> '.$userData['gender'].'</p>'; 
        $output .= '<p><b>Locale:</b> '.$userData['locale'].'</p>'; 
        $output .= '<p><b>Logged in with:</b> Google Account</p>'; 
        $output .= '<p>Logout from <a href="logout.php">Google</a></p>'; 
        $output .= '</div>'; 
    }else{ 
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>'; 
    } 
}else{ 
    // Get login url 
    $authUrl = $gClient->createAuthUrl(); 
     
    // Render google login button 
    $output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/google-sign-in-btn.png" alt=""/></a>'; 
} 
	
	

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
					<div class="card-body">
					<div class="container">
						<!-- Display login button / Google profile information -->
						<?php echo $output; ?>
					</div>
						<h5 class="card-title text-center">Prueba Buses Hotspot</h5>
						<form class="form-signin">
							<div class="form-label-group"> <input type="email" id="inputEmail" class="form-control" placeholder="Correo Electronico" autofocus> <label for="inputEmail"></label> </div>
							<div class="form-label-group"> <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña"> <label for="inputPassword"></label> </div>
							<hr class="my-4"> 
							<a href="?login=Facebook" class="btn btn-lg btn-primary btn-block text-uppercase">Ingresar con Correo</a>
							<a href="?login=Google" class="btn btn-lg btn-google btn-block text-uppercase"><i class="fab fa-google mr-2"></i> Ingresar con Google</a> 
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