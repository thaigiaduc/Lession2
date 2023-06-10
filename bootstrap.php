<?php 

define('_DIR_ROOT', __DIR__);
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $web_root = 'https://' . $_SERVER['HTTP_HOST'];
} else {
    $web_root = 'http://' . $_SERVER['HTTP_HOST'];
}

if (strpos(_DIR_ROOT, '/') !== false) {
    $folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), '', strtolower(_DIR_ROOT));
    $web_root = $web_root.$folder;
} elseif (strpos(_DIR_ROOT, '\\') !== false) {
    $url = str_replace('\\', '/', strtolower(_DIR_ROOT));
    $folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), '', $url);
    $web_root = $web_root.$folder;
} else {
    echo "Không tìm thấy dấu '/' hoặc '\\'";
}

define('_WEB_ROOT', $web_root);
$configs_dir = scandir('configs');
if (!empty($configs_dir)) {
    foreach($configs_dir as $item) {
        if ($item != '.' && $item != '..' && file_exists('configs/' . $item)) {
            require_once 'configs/' . $item;
        }
    }
}
require_once 'configs/routes.php';
require_once 'core/Route.php';
require_once 'app/App.php';
if (!empty($config['database'])) {
    if (!empty($config['database'])) {
        $db_config = $config['database'];
        require_once 'core/Connection.php';
        require_once 'core/Database.php';
    }
}
require_once 'core/Model.php';
require_once 'core/Controller.php';
