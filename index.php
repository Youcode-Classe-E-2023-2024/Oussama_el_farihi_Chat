<?php

include_once '_config/config.php';
include_once '_functions/functions.php';
include_once '_config/db.php';
include_once '_classes/Room.php';
include_once '_classes/User.php';
include_once '_classes/UserRoom.php';

spl_autoload_register(function ($class) {
    include_once '_classes/' . $class . '.php';
});

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = trim(strtolower($_GET['page']));
} else {
    $page = 'login';
}

$all_pages = scandir('controllers');

if (in_array($page . '_controller.php', $all_pages)) {
    include_once 'models/' . $page . '_model.php';
    include_once 'controllers/' . $page . '_controller.php';
    include_once 'views/_layout.php';
} else {
    header('Location: 404.php');
}
?>