<?php

if (!function_exists("http_redirect")) {
    function http_redirect($url, $params = [], $session = false, $status = 0)
    {
        if ($session) {
            $params[session_name()] = session_id();
        }
        if ($params) {
            $url .= strstr($url, "?") ? "&" : "?";
            $url .= http_build_query($params);
        }
        header("Location: $url"); #, $status ? $status : 301);
        $url = htmlspecialchars($url, ENT_QUOTES, "UTF-8");
        print "Redirecting to <a href=\"$url\">$url</a>\n";
        print "<meta http-equiv=\"Location\" content=\"$url\" />\n";
        exit;
    }
}

class WrongEnvironmentException extends Exception
{
    protected $message = "This script can only be executed from the PHP CLI Server.";
}

if (php_sapi_name() !== 'cli-server') {
    throw new WrongEnvironmentException();
}

$requestUriParts = parse_url($_SERVER['REQUEST_URI']);
$requestPath = $requestUriParts['path'];
$realRequestPath = $_SERVER['DOCUMENT_ROOT'] . $requestUriParts['path'];
$queryParams = [];
if (isset($requestUriParts['query'])) {
    parse_str($requestUriParts['query'], $queryParams);
}

// Redirect trailing slash if not a directory.
if (substr($requestPath, -1) === "/" && !is_dir($realRequestPath)) {
    http_redirect(substr($requestPath, 0, -1), $queryParams);
}

// Load file if it exists and isn't hidden.
if (substr($requestPath, 0, 1) !== '.' && substr($requestPath, 0, 2) !== '/.' && is_file($realRequestPath)) {

    return false;
}

// Load default router.
include $_SERVER['DOCUMENT_ROOT'] . "/index.php";

error_log('::1:' . getmypid() . ' [' . http_response_code() . '] ' . $requestPath);
