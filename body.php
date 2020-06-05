<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/header_config.php");

$_pageUrl =  isset($_GET["pageUrl"]) ? $_GET["pageUrl"]:"" ; //화면 명

$_loginYn =  isset($_SESSION["M_NAME"])?$_SESSION["M_NAME"]:"";


if( $_pageUrl == ""){
    $_pageUrl =  isset($_GET["pageUrl"]) ? $_GET["pageUrl"]:"" ; //화면 명
}



$_userNm =  isset($_GET["s_userNm"]) ? $_GET["s_userNm"]:"";
$_userPass =  isset($_GET["s_userPass"]) ? $_GET["s_userPass"]:"";
$_userSex =  isset($_GET["s_userSexs"]) ? $_GET["s_userSexs"]:"";
$_userContry =  isset($_GET["s_userContry"]) ? $_GET["s_userContry"]:"";

$_userMonth =  isset($_GET["s_userMonth"]) ? $_GET["s_userMonth"]:"";
$_userYear =  isset($_GET["s_userYear"]) ? $_GET["s_userYear"]:"";

$_userEmail =  isset($_GET["s_userEmail"]) ? $_GET["s_userEmail"]:"";
$_userEmailChk =  isset($_GET["s_userEmailChk"]) ? $_GET["s_userEmailChk"]:"";

?>
<!DOCTYPE html>
<html>

<head>
<title>Adducate Web App</title>
<link href="style.css" rel="stylesheet"> </link>
<link href="/stylesheets/menu.css" rel="stylesheet"></link>

<script>
var logSession = "<?= $_loginYn ?>";
//영상 플레이용 키
var playVal = "a";
var playCnt = 2;

$(document).ready( function() {      
	var pageList = ["menu.html","<?php echo $_pageUrl?>"];
	
	for( var i=0; i < pageList.length; i++ ){
		viewHtml( pageList[i] );
	}

	$("#pageUrl").val("<?php echo $_pageUrl;?>");
	$("#s_userNm").val("<?php echo $_userNm;?>");
	$("#s_userPass").val("<?php echo $_userPass;?>");
	$("#s_userSexs").val("<?php echo $_userSex;?>");
	$("#s_userContry").val("<?php echo $_userContry;?>");
	$("#s_userMonth").val("<?php echo $_userMonth;?>");
	$("#s_userYear").val("<?php echo $_userYear;?>");
	$("#s_userEmail").val("<?php echo $_userEmail;?>");
	$("#s_userEmailChk").val("<?php echo $_userEmailChk;?>");

	if( pageList[1] == "page10.html" ){
		var str = "";
		for( var i=0; i < isoCode.length; i++  ){
			str += "<option value="+isoCode[i][1]+">"+isoCode[i][0]+"</option>";
		}
		$("#uContry").html(str);
		
	}

	if( pageList[1] == "page11.html" ){
		var str = "<option>Month</option>";
		for( var i=0; i < dMonth.length; i++  ){
			str += "<option value="+dMonth[i][1]+">"+dMonth[i][0]+"</option>";
		}
		$("#uMonth").html(str);

		str = "";
		for( var i=iDate.getFullYear(); i > 2000 ; i--  ){
			str += "<option value="+i+">"+i+"</option>";
		}
		$("#uYear").html(str);
	}

	
	
	if( pageList[1] == "page20.html" ){
		b_list( 'fom',fn_abc );
	}

	if( pageList[1] == "page13.html" ){
		$("#loginId").html($("#s_userPass").val());
	}
		
	if( pageList[1] == "page21.html" ){
		document.getElementById('move_video').addEventListener('ended', function(){
			playLoadCheck();
		});
	}
	loginYn();

}); 


function viewHtml( var1 ){
	var iDate = new Date();
	$.ajax({
	    type : "GET", 
	    url : "pages/"+var1,
	    async : false,
	    dataType : "html",	
	    error : function(){
	        alert("메뉴 가져오기 실패"+var1);
	    },
	    success : function(Parse_data){
	    	$("#temp1").html(Parse_data);
	    	if( var1 == "menu.html" ){
	    		$("#container-menu").append( $("#temp1 .container").html() );
	    	}else{
	    		$("#container-page").append( 	$("#temp1 .container-body").html() );
	    	}

	    	$("#temp1").html("");
	    }
	     
	});

}



	
//abc 항목 리스트 불러오기
function fn_abc(data){
	var abcText = "";
	var storyText = "";
	var aliveText = "";
	var createText = "";
	var t1 = 0;
	var t2 = 0;
	var t3 = 0;
	var t4 = 0;

	
	for( var i=0; i < data.length; i++ ){

		if(data[i]["B_TITLE"].toUpperCase() == ("abc").toUpperCase()){
			if( t1 == 0 ){
				abcText += "<span class='selected'>"+data[i]["B_ADDRES"]+"</span>";
				t1++;
			}else{
				abcText += "<span>"+data[i]["B_ADDRES"]+"</span>";
			}
		}else if(data[i]["B_TITLE"].toUpperCase() == ("storybook").toUpperCase()){
			if( t2 == 0 ){
				storyText += "<span class='selected'>"+data[i]["B_ADDRES"]+"</span>";
				t2++;
			}else{
				storyText += "<span>"+data[i]["B_ADDRES"]+"</span>";
			}
			
		}else if(data[i]["B_TITLE"].toUpperCase() == ("alivebook").toUpperCase()){
			if( t3 == 0 ){
				aliveText += "<span class='selected'>"+data[i]["B_ADDRES"]+"</span>";
				t3++;
			}else{
				aliveText += "<span>"+data[i]["B_ADDRES"]+"</span>";
			}

			
		}else if(data[i]["B_TITLE"].toUpperCase() == ("creationstory").toUpperCase()){
			if( t4 == 0 ){
				createText += "<span class='selected'>"+data[i]["B_ADDRES"]+"</span>";
				t4++;
			}else{
				createText += "<span>"+data[i]["B_ADDRES"]+"</span>";
			}
			
		}

	}
	$("#abcPush").html( abcText );
	$("#storyPush").html( storyText );
	$("#alivePush").html( aliveText );
	$("#createPush").html( createText );

}


//패스워드 체크
function passCheck(var1){

	if( $("input:checkbox[id='priChk']").is(":checked") == false ){
		alert(" error : Privacy & Terms .. checked ");
		return false;
	}
	if( $("#userPass").val().length < 4 ){
		alert(" error :The password is more than four digits. ");
		return false;
	}

	if($("#userPass").val() != $("#userPass1").val()){
		alert( "Password Error." );
	}else{
		$("#s_userNm").val($("#userNm").val());
		$("#s_userPass").val($("#userPass").val());
		goUrl(var1);
	}
}
//성별 선택
function checkOnly( var1 ){
	var obj = document.getElementsByName("userSex");
	
	for( var i=0; i < obj.length; i++ ){
		if( obj[i] == var1 ){
			$("#s_userSexs").val($("#"+obj[i].id).val());
		}
		else{
			obj[i].checked=false;
		}
	}
}

//성별 선택
function contry( var1 ){
	$("#s_userContry").val($("#uContry").val());
	goUrl(var1);
}



//년도 체크
function yearMonths( var1 ){
	$("#s_userMonth").val( $("#uMonth").val() );
	$("#s_userYear").val( $("#uYear").val() );
	goUrl(var1);
}

//이메일
function email1( var1 ){

	$("#s_userEmail").val( $("#uEmail").val() );
	$("#s_userEmailChk").val( $("#uEmailChk").val() );

	login_insert('fom');

	goUrl(var1);
}


//페이지 이동
function goUrl(var1){
	$("#pageUrl").val( var1 );
	$("#fom").submit();
}

//로그인 찾기
function goLogin(){
	$("#s_type").val("select");
	$("#s_userNm").val($("#t_name").val());
	$("#s_userPass").val($("#t_pass").val());
	$("#s_userEmail").val($("#t_email").val());

	login('fom');
}


var move_img = "/content/01_abc/Alphabet_Images/";
var move_sound = "/content/01_abc/Alphabet_Image_TTS/";
var move_url = "/content/01_abc/Alphabet_Motion_300X300px_200419/";
//글자 클릭
function moveMp(var1,var2){
	
//리플레이 구분
	if( var2 == 1 ){
		playVal = var1;
	}
	$("#abcFont").html(playVal);
	playCnt=2;

	var move_src = "";
	var move_sound_url = "";
	for( var i = 0; i < moveArray.length; i++ ){
		if( moveArray[i][0] == playVal ){
			move_src = move_img+moveArray[i][1];
			move_sound_url = move_sound+moveArray[i][2];
			break;
		}
	}
	$("#move_img").attr("src",move_src);
//영상 변경
	$("#movie_src").attr("src", move_url+playVal+"_Motion.mp4");

	$("#audio").attr("src", move_sound_url);
	audioPlay();
	$("#move_video").load();
	$("#move_video").trigger("play");

	
	
}



function playLoadCheck(){

	
	if( playCnt < 5 ){
		var ii = 1;
		for( var i = 0; i < moveArray.length; i++ ){
			if( moveArray[i][0] == playVal ){
				if( ii == playCnt ){
					$("#move_img").attr("src",move_img+moveArray[i][1]);
					$("#audio").attr("src",move_sound+moveArray[i][2]);
					$("#move_video").trigger("play");
					audioPlay();
					playCnt++;
					break;
				}else{
					ii++;
				}
			}
		}
	}else{
		playCnt=2;
	}
}


function audioPlay(){

	var aud = document.getElementById("audio");
	aud.play();

}

</script>
</head>
<body>


<div id="temp1" style="display: none"> </div>  
   	<audio id="audio" src="/content/01_abc/Alphabet_Image_TTS/ant--_us_1.mp3">	</audio>
	
	<div class="body">
	  	<div class="container" id="container-menu"></div>
	    <div class="container" id="container-page"></div>
	  <!-- content end -->
	  
	</div>


</body>


</html>