<?php
function getContentBetween(string $content, string $start, string $end) {
    $result = explode($start, $content)[1];
    $result = explode($end, $result)[0];
    return $result;
}

function getConfig($i) {
    if (file_exists("../config.json")) {
        $config = json_decode(file_get_contents(".,/config.json"), true);
        return $config[$i];
    }
}
?>