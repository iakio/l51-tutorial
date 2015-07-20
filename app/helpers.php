<?php
function full_title($page_title) {
    $base_title = "Laravel Tutorial Sample App";
    if (empty($page_title)) {
        return $base_title;
    }
    return $base_title . " | " . $page_title;
}
