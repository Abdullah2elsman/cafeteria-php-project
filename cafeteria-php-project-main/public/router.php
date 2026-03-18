<?php
// router.php for php built-in server
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|woff|woff2|ttf|svg|ico)$/', $_SERVER["REQUEST_URI"])) {
    return false; // serve the requested resource as-is.
} else { 
    $_GET['url'] = ltrim(explode('?', $_SERVER['REQUEST_URI'], 2)[0], '/');
    if(empty($_GET['url'])) {
        $_GET['url'] = 'home/index';
    }
    require_once __DIR__ . '/index.php';
}
