<?php
function getContentBetween(string $content, string $start, string $end) {
    $result = explode($start, $content)[1];
    $result = explode($end, $result)[0];
    return $result;
}
?>