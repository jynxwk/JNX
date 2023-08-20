<?php
include('functions.php');
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (isset($data['path'])) {
    echo loadPage($data['path']);
}

function loadPage($path = "", $self = ".jnx/router.php") {
    $app = "../src/app.html";
    $base = str_replace($self, "", $_SERVER['PHP_SELF']);
    $path = str_replace($base, "", $path);
    $dir = "../src/pages/" . $path . "/";
    $page = $dir . getConfig("standard-file");

    // Check if app.html exists
    if (file_exists($app)) {
        $app = file_get_contents($app);
        // Check if directory exists
        if (file_exists($page)) {
            $page = file_get_contents($page);
            if ($page) {
                $head = "";
                $body = "";
                $style = "";
                $script = "";
    
                // Page Head
                if (strpos($page, "<head>") !== false ) {
                    $head = $head . getContentBetween($page, "<head>", "</head>");
                }
                
                // Style
                if (strpos($page, "<style>") !== false)  {
                    $style = getContentBetween($page, "<style>", "</style>");
                    $style = "<style>".$style."</style>";
                    $head = $head . $style;
                }
    
                $style = $dir . getConfig("style-file");
                if (file_exists($style)) {
                    $style = file_get_contents($style);
                    $style = "<style>" . $style . "</style>";
                    $head = $head . $style;
                }
    
                // Script
                if (strpos($page, "<script>") !== false ) {
                    $script = getContentBetween($page, "<script>", "</script>");
                    $script = "<script>" . $script . "</script>";
                    $head = $head . $script;
                }
    
                $script = $dir . getConfig("script-file");
                if (file_exists($script)) {
                    $script = file_get_contents($script);
                    $script = "<script>" . $script . "</script>";
                    $head = $head . $script;
                }
                
                // Remove Tags from body
                $body = $page;
                $body = preg_replace("~<head>[^.]*</head>~", "", $body);
                $body = preg_replace("~<style>[^.]*</style>~", "", $body);
                $body = preg_replace("~<script>[^.]*</script>~", "", $body);
                
                // Return head & body as json
                $response = array("app" => $app, "head" => $head, "body" => $body);
                return json_encode($response);
            } else {
                echo "Error reading page.";
            }
        } else {
            echo "Page not found.";
        }
    } else {
        echo "app.html is missing.";
    }
}

?>