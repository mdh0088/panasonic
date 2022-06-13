<?php 
    require_once("wp-load.php");
    get_header(); 
?>
<style>
#error{
    display:flex;
    align-items:center;
    justify-content:center;
    padding:10% 0 12%;
    position:relative;
}    
#error:before{
    content:'';
    width:57%; height:230px;
    position:absolute;
    top:50%; right:0;
    margin-top:-230px;
    background:url(/img/main_bg_line.png) top left repeat-x;
}
#error:after{
    content:'';
    width:245px; height:250px;
    background:#f5f5f7;
    position:absolute;
    top:47%; left:23%;
}
.error-wrap{
    background:#fff;
    padding:65px;
    position:relative;
    text-align:center;
    width: 50%;
    max-width: 900px;
    z-index:2;
}
.error-wrap:before{
    content:'';
    width:215px; height:215px;
    background:url(/img/dot_bg.png) center center no-repeat;
    background-size:100%;
    position:absolute;
    top:9%; left:11%;
}
.error-wrap h1{
    color: #343434;
    font-weight: 200;
    background: url(/img/icon_error.png) center top no-repeat;
    background-size: 51px;
    padding-top: 70px;
}
.error-wrap p{
    white-space: pre-line;
    line-height: 1.8;
}
@media only screen and (max-width:1279px){
    .error-wrap{
        padding:40px;
        width:80%;
    }
    #error:before{
        width:64%; height:150px;
        margin-top:-190px;
    }
    #error:after{
        width:165px; height:160px;
        top:55%; left:4%;
    }
}
@media only screen and (max-width: 767px){
    .error-wrap {
        padding: 30px;
        width: 90%;
    }
    .error-wrap h1{
        background-size:42px;
        padding-top:55px;
    }
    .error-wrap p{
        line-height:1.6;
        margin:0;
    }
    .error-wrap:before{
        width:140px; height:140px;
        top:6%; left:2%;
    }
    #error:before{
        width:72%;
    }
    #error:after {
        width: 130px;
        height: 128px;
        top: 55%;
        left: 0;
    }
}
</style>

<div id="error">
    <div class="error-wrap">
        <h1>서비스가 <strong>원활하지 않습니다.</strong></h1>
        <p>서비스 이용에 불편을 끼쳐드려 죄송합니다.
요청하신 서비스가 정상 처리되지 않았습니다.
빠른 시간안에 조치하여 보다 편리한 서비스를 제공할 수 있도록 최선을 다하겠습니다.</p>
    </div>
</div>

<?php get_footer(); ?>