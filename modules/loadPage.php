<?php
include('functions.php');
$input = file_get_contents('php://input');
$data = json_decode($input, true);
$link = $data['link'];

$app = "../src/app.html";
$page = "../src/pages/" . substr_replace($link, '', 0, 1) . "/page.jnx";

if (file_exists($app)) {
    if (file_exists($page)) {
        $app = file_get_contents($app);
        $page = file_get_contents($page);
        if ($page !== false) {
            if (strpos($page, "<head>") !== false && strpos($page, "</head>") !== false) {
                $head = getContentBetween($page, "<head>", "</head>");
                $app = str_replace("%JNX-HEAD%", $head, $app);
                $body = explode("</head>", $page)[1];
            } else {
                $app = str_replace("%JNX-HEAD%", "", $app);
                $body = $page;
            }
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
    echo "App.html is missing.";
}
?>