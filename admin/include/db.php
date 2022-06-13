<?php

function sql_query($query) {
    $link = mysqli_connect('localhost','','','');
    return mysqli_query($link, $query);
}

function sql_fetch($result) {
    return mysqli_fetch_array($result);
}

function sql_count($result) {
    return mysqli_num_rows($result);
}
