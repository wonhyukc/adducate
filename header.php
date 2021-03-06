<?php
    session_start();
    $loc =  isset($_GET["location"])?$_GET["location"]:"";
    $isLogin =  isset($_SESSION["isLogin"])?$_SESSION["isLogin"]:"";
    $userNm =  isset($_SESSION["userNm"])?$_SESSION["userNm"]:"";
    $userId =  isset($_SESSION["userId"])?$_SESSION["userId"]:"";
?>
<html>
<title>Adducate</title>
<link href="/style.css" rel="stylesheet">
<link rel="shortcut icon" type="image/ico" href="/img/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="/slick/slick-theme.css"/>
<head>
    <meta charset="utf-8"></meta>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> </meta>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="/js/jquery-1.11.3.min.js?v=System.currentTimeMillis()"></script>
    <script src="/js/common.js"></script>
    <link rel="icon" href="../img/favicon.ico"/>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/slick/slick.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VVD6FR6YBR"></script>
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>-->
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-VVD6FR6YBR');
    </script>
</head>
<script>
    $(document).ready( function() {
        var loc = '<?= $loc ?>';
        var isLogin = '<?= $isLogin ?>';
        var userNm = '<?= $userNm ?>';
        loginYn(isLogin, userNm);
    });
</script>
</html>