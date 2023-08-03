<?php
    

    include 'header.php';
    $clientId     = '51720359'; // ID приложения
    $clientSecret = 'OsaVSUDTTha0ywMubflF'; // Защищённый ключ
    $redirectUri  = 'http://localhost/task276authpdo/vk_auth.php'; // Адрес, на который будет переадресован пользователь после прохождения авторизации
    //To do - Пока не совсем так, после прохождения авторизации на VK пока приходится убирать localhost в адресной строке и тогда всё работает


    $params = array(
		'client_id'     => $clientId,
		'client_secret' => $clientSecret,
		'code'          => $_GET['code'],
		'redirect_uri'  => $redirectUri
	);
 
	if (!$content = @file_get_contents('https://oauth.vk.com/access_token?' . http_build_query($params))) {
		$error = error_get_last();
		throw new Exception('HTTP request failed. Error: ' . $error['message']);
	}
 
	$response = json_decode($content);
 
	// Если при получении токена произошла ошибка
	if (isset($response->error)) {
		throw new Exception('При получении токена произошла ошибка. Error: ' . $response->error . '. Error description: ' . $response->error_description);
	}
    //А вот здесь выполняем код, если все прошло хорошо
	$token = $response->access_token; // Токен
	$expiresIn = $response->expires_in; // Время жизни токена
	$userId = $response->user_id; // ID авторизовавшегося пользователя
 
	// Сохраняем токен в сессии
	$_SESSION['token'] = $token;
    $_SESSION["isauth"] = true;
    echo '<h3>Вы вошли в систему</h3>';

    //header('Location: index.php');

    header ('Location: for_authorized_users.php');

?>