<?php
    $request = $_SERVER['REQUEST_URI'];
    include './src/php/action/database.php';
    echo ' <link rel="stylesheet" href="../css/form.css">';
    echo '<link rel="stylesheet" href="../css/app.css">';
    echo '<link rel="stylesheet" href="../css/table.css">';
    echo '<link rel="stylesheet" href="../css/search_res.css">';

    $regex = '/[0-9]+/';
    switch ($request) {
        case '/' :
            require __DIR__ . '/src/php/login.php';
            break;
        case '' :
            require __DIR__ . '/src/php/login.php';
            break;
        case '/login':
            require __DIR__ . '/src/php/login.php';
            break;
        case '/register':
            require __DIR__ . '/src/php/register.php';
            break; 
        case '/homepage' :
            require __DIR__ . '/src/php/homepage.php';
            break;
        case '/add' :
            require __DIR__ . '/src/php/addChocolate.php';
            break;
        case '/logout' :
            require __DIR__ . '/src/php/logout.php';
            break;
        case '/history' :
            require __DIR__ . '/src/php/history.php';
            break;
        case '/search_result' :
            require __DIR__ . '/src/php/search_result.php';
            break;
        case '/details/' + $regex:
            $_GET['id'] = parse($request);
            require_once __DIR__ . '/src/php/details.php';
            break;
        default:
            http_response_code(404);
            require __DIR__ . '/php/404.php';
            break;
    }
    function parse($path){
        return basename($path);
    }
?>