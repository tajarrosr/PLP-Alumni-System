<?php
// router.php - front controller para sa PHP built-in server

$uriPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uriPath === '' || $uriPath === '/') {
    $publicPath = '/home.php';
} else {
    $publicPath = $uriPath;
}

if ($publicPath[0] !== '/') {
    $publicPath = '/' . $publicPath;
}

$publicFile = __DIR__ . '/public' . $publicPath;

if (file_exists($publicFile)) {
    $ext = strtolower(pathinfo($publicFile, PATHINFO_EXTENSION));

    if ($ext === 'php') {
        $_SERVER['SCRIPT_NAME'] = $publicPath;
        $_SERVER['PHP_SELF']    = $publicPath;

        require $publicFile;
        return true;
    } else {
        $mimeTypes = [
            'css'  => 'text/css',
            'js'   => 'application/javascript',
            'png'  => 'image/png',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif'  => 'image/gif',
            'svg'  => 'image/svg+xml',
            'ico'  => 'image/x-icon',
            'woff' => 'font/woff',
            'woff2'=> 'font/woff2',
            'ttf'  => 'font/ttf',
            'eot'  => 'application/vnd.ms-fontobject',
        ];

        $contentType = $mimeTypes[$ext] ?? 'application/octet-stream';
        header('Content-Type: ' . $contentType);
        readfile($publicFile);
        return true;
    }
}

$rootFile = __DIR__ . $uriPath;

if ($uriPath !== '/' && file_exists($rootFile)) {
    return false;
}

http_response_code(404);
echo "Not Found\nThe requested resource {$uriPath} was not found on this server.";
return true;


