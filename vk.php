

<?php
    session_start(); // Токен храним в сессии
    include 'header.php';
    // Параметры приложения
    $clientId     = '51720359'; // ID приложения
    $clientSecret = 'OsaVSUDTTha0ywMubflF'; // Защищённый ключ
    $redirectUri  = 'http://localhost/task276authpdo/vk_auth.php'; // Адрес, на который будет переадресован пользователь после прохождения авторизации
     
    // Формируем ссылку для авторизации
    $params = array(
        'client_id'     => $clientId,
        'redirect_uri'  => $redirectUri,
        'response_type' => 'code',
        'v'             => '5.131', // (обязательный параметр) версиb API https://vk.com/dev/versions
     
        // Права доступа приложения https://vk.com/dev/permissions
        // Если указать "offline", полученный access_token будет "вечным" (токен умрёт, если пользователь сменит свой пароль или удалит приложение).
        // Если не указать "offline", то полученный токен будет жить 12 часов.
        'scope'         => 'photos,offline',
    );
     
    // Выводим на экран ссылку для открытия окна диалога авторизации
    echo '<a class="alink_vk" href="http://oauth.vk.com/authorize?' . http_build_query( $params ) . '">Авторизация через ВКонтакте</a>';

    ?>