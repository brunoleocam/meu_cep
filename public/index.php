<?php

require_once '../core/router.php';

// Captura a URL digitada e transforma em array
$url = isset($_GET['url']) ? explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) : [];

Router::route($url);
