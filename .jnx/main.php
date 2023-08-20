<head>
    <script src="./.jnx/client.js"></script>
</head>
<?php
include("./router.php");
$response = loadPage($_SERVER['REQUEST_URI'], ".jnx/main.php");
$data = json_decode($response, true);

if ($data) {
    $app = $data['app'];
    $app = str_replace("%JNX-HEAD%", $data['head'], $app);
    $app = str_replace("%JNX-BODY%", $data['body'], $app);
    echo $app;
}
?>