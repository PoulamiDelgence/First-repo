<!--SFPPAGE-->
<!--PHP session_start(); PHP-->
<?php  $resultCurrent[0]['watermarkImage']="";?>
<!--PHP
    /*PHP DBCONNECT PHP*/
    PHP-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>H &amp; M</title>
		<meta name="description" content="Learn how to resize images using JavaScript and the HTML5 Canvas element using controls, commonly seen in photo editing applications." />
		<meta name="keywords" content="canvas, javascript, HTML5, resizing, images" />
		<meta name="author" content="Codrops" />
<!--SFPhide <link rel="shortcut icon" type="image/x-icon" href="SFPURLLINK/images/favicon.ico"> SFPhide-->

<link type="text/css" rel="stylesheet" href="SFPURLLINK/css/style.css" />
<!--SFPScript  type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></SFPScript-->

<!--[if lt IE 9]>
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->
</head>
<!--PHP

	$sfp = new SmartfanPage();
	$lastId = $_SESSION['lastId'];
	//echo $lastId;
	if($lastId =="")
	{
	header("Location: SFP_index");
	}
	$selectAllRow = 'id,imagePath,date,watermarkImage,fbName';
	$data = array(
			array( 'selected'=>'id',
					'value'=> $lastId
	
			)
	
	);
	$dataselect =  array(
			'appId' => 'lNWyBR8YOcde4H9',
			'table' => 'PhotoHMContest',
			'field'=>$selectAllRow,
			'value' => $data
	
	); 
	
	
	$resultCurrent =  $sfp->select_table($dataselect);
	//print_r($resultCurrent);
	//$rowFetchCurrent = mysql_fetch_assoc($resultCurrent); 
	
//echo "SFP_Link/". $rowFetchCurrent['imagePath'];
session_unset();  PHP-->
<body>
<div id="fb-root"></div>
<!--SFPScript>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=781449978532230";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</SFPScript-->
<div class="container SFPTWO_BACKGROUND">
<div class="top_section">
        <div class="SFPTWO_IMAGEEDIT logo"><a href="SFP_index" title="H &amp; M"><img src="SFPURLLINK/images/logo.png" alt="" /></a></div><!-- end of logo -->
        <div class="SFPTWO_IMAGEEDIT top_banner"><img src="SFPURLLINK/images/top_banner.jpg" alt="" /></div><!-- end of top_banner -->
        </div>
        <div class="contest">
        
        <div class="SFPTWO_TEXTEDIT text three">
            	<p class="SFPTWO_TAGEDIT explicit_edit">Bedankt voor je deelname!</p>
                <span class="SFPTWO_TAGEDIT explicit_edit">Onderstaande foto is toegevoegd aan de wedstrijd</span>
            </div><!-- end of text/three -->
            </div>
<div class="thanks">
        <img src="<?php if($resultCurrent[0]['watermarkImage']==""){echo "SFPURLLINK/images/thanks_img.jpg";}else{ echo "SFP_Link/". $resultCurrent[0]['watermarkImage'];}?>"  id="ImgCanvas">
        	<div class="SFPTWO_TEXTEDIT">
                        <p class="SFPTWO_TAGEDIT explicit_edit">Foto door: <!--PHP echo $resultCurrent[0]['fbName'];  PHP--></p></div>
            <div class="advertise">
            	<div>
            	<div class="SFPTWO_TEXTEDIT" >
                    <span class="SFPTWO_TAGEDIT explicit_edit">Maak reclame<br />voor je eigen foto.<br />Like en deel hem op<br />je tijdlijn.</span>
                    </div>
                <div class="FacebookLike"><div class="fb-like" data-href="<?php if($resultCurrent[0]['watermarkImage']==""){echo "";}else{ echo "SFP_Link/". $resultCurrent[0]['watermarkImage'];}?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></div>
                </div>
            </div><!-- end of advertise -->
        </div><!-- end of thanks -->
        
            <div class="footer">
        <div class="SFPTWO_TEXTEDIT">
        <div class="SFPTWO_TAGEDIT explicit_edit">
        	<p>Deze actie loopt van mei 2014 tot en met september 2014. Wij verloten in deze periode elke maand<br />een waardebon van 100,- tussen de meest creatieve inzendingen. H&amp;M bepaalt naar eigen maatstaven deze<br />creativiteit en over de uitslag kan niet worden gecorrespondeerd. Deelnemers ontvangen uiterlijk op de eerste<br />van de nieuwe maand per email bericht.</p>
            <span>Powered by</span></div></div>
            <div class="SFPTWO_IMAGEEDIT"><a href="#"><img src="SFPURLLINK/images/footer_logo.png" alt="" /></a></div>
        </div>
        </div>
        </body>
        </html>