<?php

function sql_query($query) {
    $link = mysqli_connect('localhost','root','casanova1!@','panasonic'); //디비서버, 디비아이디, 디비비밀번호, 디비명
    return mysqli_query($link, $query); //쿼리문 실행
}

function sql_fetch($result) {
    return mysqli_fetch_array($result); //쿼리문 결과값 예쁘게 가공 (하나만)
}

function sql_count($result) {
    return mysqli_num_rows($result); //쿼리문의 결과값 갯수
}