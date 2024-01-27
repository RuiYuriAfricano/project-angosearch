<?php 
session_start();
//unset($_SESSION['face_access_token']);
require_once 'lib/Facebook/autoload.php';
include_once 'include/conexao.php';
$con=conecta();
$fb = new \Facebook\Facebook([
  'app_id' => '462069667769536',
  'app_secret' => '8343725c6b9776e3b60271e6211110da',
  'default_graph_version' => 'v2.9',
  //'default_access_token' => '{access-token}', // optional
]);

$helper = $fb->getRedirectLoginHelper();
//var_dump($helper);
$permissions = ['email']; // Optional permissions

try {
	if(isset($_SESSION['face_access_token'])){
		$accessToken = $_SESSION['face_access_token'];
	}else{
		$accessToken = $helper->getAccessToken();
	}
	
} catch(Facebook\Exceptions\FacebookResponseException $e) {
	// When Graph returns an error
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}

if (! isset($accessToken)) {
	$url_login = 'http://localhost/Projecto Final - Loide Laura/php/face.php';
	$loginUrl = $helper->getLoginUrl($url_login, $permissions);
}else{
	$url_login = 'http://localhost/Projecto Final - Loide Laura/php/face.php';
	$loginUrl = $helper->getLoginUrl($url_login, $permissions);
	//Usuário ja autenticado
	if(isset($_SESSION['face_access_token'])){
		$fb->setDefaultAccessToken($_SESSION['face_access_token']);
	}//Usuário não está autenticado
	else{
		$_SESSION['face_access_token'] = (string) $accessToken;
		$oAuth2Client = $fb->getOAuth2Client();
		$_SESSION['face_access_token'] = (string) $oAuth2Client->getLongLivedAccessToken($_SESSION['face_access_token']);
		$fb->setDefaultAccessToken($_SESSION['face_access_token']);	
	}
	
	try {
		// Returns a `Facebook\FacebookResponse` object
		$response = $fb->get('/me?fields=name, picture, email');
		$user = $response->getGraphUser();
		//var_dump($user);
		$resultado_usuario = $con->query("SELECT nome_completo,email FROM utilizador WHERE email='".$user['email']."'
		LIMIT 1");

		if(mysqli_num_rows($resultado_usuario) > 0){
			$row_usuario = mysqli_fetch_assoc($resultado_usuario);

			$_SESSION['utilizador'] = $row_usuario['nome_completo'];

			header("Location: angosearch/utilizador/index.php");
		}else{
            header("Location: login-usuario.php");
        }
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
	}
}

?>

