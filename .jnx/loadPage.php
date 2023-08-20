<?php
include('functions.php');
$input = file_get_contents('php://input');
$data = json_decode($input, true);
$link = $data['link'];

$app = "../src/app.html";
$dir = "../src/pages/" . $link . "/";
$page = $dir . getConfig("standard-file");

echo $page;
// Check if app.html exists
if (file_exists($app)) {
    // Check if directory exists
    if (file_exists($page)) {
        $app = file_get_contents($app);
        $page = file_get_contents($page);
        if ($page !== false) {
            // Check if file contains <head>
            if (str_contains($page, "<head>")) {
                $head = getContentBetween($page, "<head>", "</head>");
                $body = explode("</head>", $page)[1];
            } else {
                $head = "";
                $body = $page;
            }

            $style = $dir . getConfig("style-file");
            if (file_exists($style)) {
                $style = file_get_contents($style);
                $style = "<style>" . $style . "</style>";
                $head = $head . $style;
            }

            $script = $dir . getConfig("script-file");
            if (file_exists($script)) {
                $script = file_get_contents($script);
                $script = "<script>" . $script . "</script>";
                $head = $head . $script;
            }
            
            $body = preg_replace("<head>[^]*</head>", "", $page);
            echo $body;
            $app = str_replace("%JNX-HEAD%", $head, $app);
            $app = str_replace("%JNX-BODY%", $body, $app);
            $app = trim($app);
            echo $app;
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