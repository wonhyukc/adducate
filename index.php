<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");

$location =  isset($_GET["location"])?$_GET["location"]:"";
$isLogin =  isset($_SESSION["isLogin"])?$_SESSION["isLogin"]:"";
$userNm =  isset($_SESSION["userNm"])?$_SESSION["userNm"]:"";
$sql = "SELECT * FROM classes";
$sql2 = "SELECT * FROM teams";
if($conn) {
    $result = mysqli_query($conn, $sql);
    $teams = mysqli_result_to_array(mysqli_query($conn, $sql2));
}else{
    //@TODO alert message when the connection is not connected
}
?>

<title>Adducate</title>
<link href="style.css" rel="stylesheet">
<script>
$(document).ready( function() {
    var location = '<?= $location ?>';
    var isLogin = '<?= $isLogin ?>';
    var userNm = '<?= $userNm ?>';
	loginYn(isLogin, userNm);
	if(location!=''){
	    if(location=='class'){
            doScrolling('#classContainer', 1000);
        }else if(location=='team'){
            doScrolling('#teamContainer', 1500);
        }else if(location=='about'){
            doScrolling('#aboutContainer', 2000);
        }
    }
    $('.carousel').slick({
        slidesToShow: 1,
        slidesToScroll: 1 ,
        dots:false,
        infinite: true,
        cssEase: 'linear',
        prevArrow: "<img class='bbtn_left_story slick-prev' style='margin-left: 50px; top: 20%; z-index: 1;' src='/img/scroll-btn(left).png' srcset='/img/scroll-btn(left)@2x.png 2x,/img/scroll-btn(left)@3x.png 3x' />",
        nextArrow: "<img class='bbtn_left_story slick-next' style='margin-right: 50px; top: 20%;' src='/img/scroll-btn(right).png' srcset='/img/scroll-btn(right)@2x.png 2x,/img/scroll-btn(right)@3x.png 3x' />"
    });
});

function getElementY(query) {
    return window.pageYOffset + document.querySelector(query).getBoundingClientRect().top
}

function doScrolling(element, duration) {
    var startingY = window.pageYOffset
    var elementY = getElementY(element)
    // If element is close to page's bottom then window will scroll only to some position above the element.
    var targetY = document.body.scrollHeight - elementY < window.innerHeight ? document.body.scrollHeight - window.innerHeight : elementY
    var diff = targetY - startingY
    // Easing function: easeInOutCubic
    // From: https://gist.github.com/gre/1650294
    var easing = function (t) { return t<.5 ? 4*t*t*t : (t-1)*(2*t-2)*(2*t-2)+1 }
    var start

    if (!diff) return

    // Bootstrap our animation - it will get called right before next frame shall be rendered.
    window.requestAnimationFrame(function step(timestamp) {
        if (!start) start = timestamp
        // Elapsed miliseconds since start of scrolling.
        var time = timestamp - start
        // Get percent of completion in range [0, 1].
        var percent = Math.min(time / duration, 1)
        // Apply the easing.
        // It can cause bad-looking slow frames in browser performance tool, so be careful.
        percent = easing(percent)

        window.scrollTo(0, startingY + diff * percent)

        // Proceed with animation as long as we wanted it to.
        if (time < duration) {
            window.requestAnimationFrame(step)
        }
    })
}

function openInNewTab(url) {
    var win = window.open(url, '_blank');
    win.focus();
}
</script>

</head>
<body>
<div id="temp1" style="display: none"> </div>
<div class="body" id="mainBody">
 	<div class="container" id="container-menu">
        <div class="container">
            <!-- container-header 필수 -->

            <div class="container-header">
                <div class="log">
                    <a href="/">
                        <img src="/img/logo_header.png" srcset="/img/logo_header@2x.png 2x, /img/logo_header@3x.png 3x" />
                    </a>
                </div>

                <div class="menu">
                    <ul class="menuUl">
                        <li class="menuLi"><span onclick="doScrolling('#classContainer', 1000)">Class</span></li>

                        <li class="menuLi"><span onclick="doScrolling('#teamContainer', 1500)">Team</span></li>

                        <li class="menuLi"><span onclick="doScrolling('#aboutContainer', 2000)">About</span></li>

                        <li class="menuLiBlue"><span>Download</span></li>

                        <li class="menuLiSignIn" onclick="myFunction()" id="signIn"><a>Sign in</a></li>
                        <li class="menuLiSignIn" onclick="myFunction1()" style="display: none" id="logout"><a></a></li>
                        <!--                <li class="menuLiID" onclick="myFunction1()" style="display: none" id="logout"><a></a></li>-->

                    </ul>
                </div>
                <div class="popup" id="popup" style="position: absolute;">
                    <input class="textbox1" type="text" placeholder="ID"  id="userId"/>
                    <input class="textbox2" type="password" placeholder="PW"  id="userPass"/>
                    <div class="content">
                        <span class="join"><a href="/join/step1">Join</a></span>
                        <span class="id_pw"><a href="/find">Find ID/PW</a></span>
                        <span class="ok"><a href="#" onclick="menuLogin()">OK</a></span>
                    </div>
                </div>
                <div class="popup_account" style="position: absolute;" >

                    <div class="content_account">
                        <span class="myclass"><a href="body.php?pageUrl=page20.html">My class</a></span>
                        <span class="signout"><a href="/logout">Sign out</a></span>
                    </div>
                </div>

                <script>
                    function myFunction() {
                        var popup = document.getElementsByClassName("popup");
                        if(popup[0].style.visibility == "visible")
                            popup[0].style.visibility = "hidden";
                        else {
                            popup[0].style.visibility = "visible";
                        }
                    }

                    function myFunction1() {
                        var popup = document.getElementsByClassName("popup_account");
                        if(popup[0].style.visibility == "visible"){
                            popup[0].style.visibility = "hidden";
                        }else {
                            popup[0].style.visibility = "visible";
                        }

                    }
                </script>

            </div>
        </div>
    </div>
    <div class="container" id="container-page">
        <div class="container-body-orange" id="mainContainer">
            <div class="mainLogo">
                <img
                        src="/img/logo_content.png"
                        srcset="/img/logo_content@2x.png 2x,/img/logo_content@3x.png 3x"/>
            </div>

            <div class="divBox1 textDefault">
                Adducate is designed to make learning more accessible and amusing for learners.
                From acquiring the sounds of each alphabet to understanding short stories, it stimulates children's' creativity. They will find learning fascinating and it will accelerate their growth.
                <br>
                Adducate will empower the children without resources.
            </div>

            <div class="mainDownload"><span>Download</span></div>

        </div>
        <br />
        <div class="container-body-white" id = "classContainer">
            <?php
            foreach($result as $row){
                echo "<a href='/class/".$row["url_name"]."'>";
                echo "<img class='".$row["css_name"]."' src='".'..'.$row["image1"]."' srcset='".'..'.$row["image2"]." 2x,".'..'.$row["image3"]." 3x' />";
                echo "</a>";
                echo "<div class='divBox2 textDefault' style='cursor: pointer;' onclick=\"location.href='/class/".$row["url_name"]."'\">".$row["description"]."</div>";
            }
            ?>
            <br />
            <img class="bbtn" style="cursor: pointer;" onclick="doScrolling('#teamContainer', 1000)" src="../img/scroll-btn.png" srcset="../img/scroll-btn@2x.png 2x,../img/scroll-btn@3x.png 3x" />
        </div>
        <br />
        <div class="container-body-blue" id="teamContainer">
            <div class="carousel" style="height: 80%; width: 100%">
                <?php
                    shuffle($teams);
                    for($i=0; $i<count($teams); ++$i){
                        echo "<div>";
                        if(strstr($teams[$i]["logo"] , "/")){
                            echo "<div class=\"mainPath\" style=\"background-image:url('/img/path.png'); width:500px;height:320px;\">";
                            echo "<img src='".$teams[$i]["logo"]."' style='width:244px; height:44px; margin-left:auto; margin-right:auto; margin-top: 80px;' />";
                            echo "<div style='margin-top:80px;font-size: 22px;'>";
                            echo $teams[$i]["name"];
                            echo "</div>";
                            echo "<div style='margin-top:10px;font-size: 20px;'>";
                            echo $teams[$i]["introduction"];
                            echo "</div>";
                            echo "</div>";
                        }else{
                            echo "<div class=\"mainPath\" style=\"background-image:url('/img/path.png'); width:500px;height:320px;\">";
                            echo "<div style='height:44px; margin-left:auto; margin-right:auto; margin-top: 80px; font-size: 32px;'>";
                            echo $teams[$i]["logo"];
                            echo "</div>";
                            echo "<div style='margin-top:80px;font-size: 22px;'>";
                            echo $teams[$i]["name"];
                            echo "</div>";
                            echo "<div style='margin-top:10px;font-size: 20px;'>";
                            echo $teams[$i]["introduction"];
                            echo "</div>";
                            echo "</div>";
                        }
                        echo "</div>";
                    }
                ?>
            </div>

            <img onclick="doScrolling('#aboutContainer', 1000)" style="cursor: pointer; padding-top: 10px"
                 class="bbtn_bottom"
                    src="/img/scroll-btn.png"
                    srcset="/img/scroll-btn@2x.png 2x,/img/scroll-btn@3x.png 3x"/>
        </div>
        <div class="Background_white" id="aboutContainer">

            <div class="divBox4">
                <div class="orangeBox textDefault f36 bold" style="cursor: pointer;" onclick="location.href='/manual'">
                    Class Manual
                </div>
                <div class="blueBox textDefault f36 bold" style="cursor: pointer;" onclick="location.href='/faq'">
                    FAQ
                </div>
                <div class="greenBox textDefault f36 bold" style="cursor: pointer;" onclick="openInNewTab('https://medium.com/@contact.adducate/what-is-adducate-3c00458d6c17')">
                    Blog
                </div>
            </div>

            <div class="email textDefault bluetext">
                contact@adducate.net
            </div>
            <br />
            <div class="scroll-top">
                <img onclick="doScrolling('#mainBody', 2000)" style="cursor: pointer;" src="/img/scroll-top.png" srcset="/img/scroll-top@2x.png 2x,/img/scroll-top@3x.png 3x">
            </div>
            <br />
            <br />
        </div>
    </div>
  <!-- content end -->
  
</div>

</body>


</html>