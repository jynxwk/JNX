<?php
include('functions.php');
$input = file_get_contents('php://input');
$data = json_decode($input, true);
$path = $data['path'];

$app = "../src/app.html";
$dir = "../src/pages/" . $path . "/";
$page = $dir . getConfig("standard-file");

// Check if app.html exists
if (file_exists($app)) {
    // Check if directory exists
    if (file_exists($page)) {
        $app = file_get_contents($app);
        $page = file_get_contents($page);
        if ($page) {
            $head = "";
            $body = "";
            $style = "";
            $script = "";

            // Page Head
            if (str_contains($app, "<head>")) {
                $head = $head . getContentBetween($app, "<head>", "</head>");
            }
            if (str_contains($page, "<head>")) {
                $head = $head . getContentBetween($page, "<head>", "</head>");
            }
            
            // Style
            if (str_contains($page, "<style>")) {
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
            if (str_contains($page, "<script>")) {
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
            $response = array("head" => $head, "body" => $body);
            echo json_encode($response);
        } else {
            echo "Error reading page.";
        }
    } else {
        echo "Page not found.";
    }
} else {
    echo "app.html is missing.";
}
?>