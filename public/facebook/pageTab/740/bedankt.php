<!--SFPPAGE-->
<?php
       include('../include.php');
          include_once('/var/www/staging/public/sfpApi.php');
       ?>
  <?php
     $sfp = new SmartfanPage();
   $data = 
    array(
    
    array(
     array('field'=>'fbid',
            'value'=>$_POST['uid']),
            array('field'=>'fbfirstname',
            'value'=>$_POST['fname']),
            array('field'=>'fblastname',
            'value'=>$_POST['lname']),
            array('field'=>'email',
            'value'=>$_POST['email']),
            array('field'=>'logintime',
            'value'=>date('Y/m/d H:i:s')
            )
            )
    
     );

  
   
    
 $datainsert =  array(
			'appId' => 'lNWyBR8YOcde4H9',
            'table' => 'roelpro_user',
            'field' => $data
            
            );
      

$sfp->insert_table($datainsert);


 ?>   
<?php
//Get the base-64 string from data
//echo $_POST['img_val'];
$filteredData=substr($_POST['img_val2'], strpos($_POST['img_val2'], ",")+1);
//echo $filteredData;
//Decode the string
$unencodedData=base64_decode($filteredData);

//Save the image
$imgs='img'.rand().'.png';
//echo($_SERVER['DOCUMENT_ROOT']);
file_put_contents("/var/www/staging/public/facebook/pageTab/740/upload/".$imgs, $unencodedData);
$imglink = "/var/www/staging/public/facebook/pageTab/740/upload/".$imgs;
//echo $imglink;
$imglink=explode('/',$imglink);
//print_r($imglink);
$imglinkadd = $imglink[5]."/".$imglink[6]."/".$imglink[7]."/".$imglink[8]."/".$imglink[9];

$fullpath = "http://test.scampaigns.com/".$imglinkadd;


?>        
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]--><head>
        <meta charset="utf-8">
        <title>Roel - Welcome to our Website!</title>
          <link rel="shortcut icon" type="image/x-icon" href="//test.scampaigns.com/user_template/65754ae959fba7ae5-roelpro/img/favicon.ico"> 
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="//test.scampaigns.com/user_template/65754ae959fba7ae5-roelpro/css/normalize.css">
        <link rel="stylesheet" href="//test.scampaigns.com/user_template/65754ae959fba7ae5-roelpro/css/bootstrap.min.css">
        <link rel="stylesheet" href="//test.scampaigns.com/user_template/65754ae959fba7ae5-roelpro//css/main.css">
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="//test.scampaigns.com/user_template/65754ae959fba7ae5-roelpro/js/html2canvas.js"></script>
        <script type="text/javascript" src="//test.scampaigns.com/user_template/65754ae959fba7ae5-roelpro/js/jquery.plugin.html2canvas.js"></script>   
       <script src="//test.scampaigns.com/user_template/65754ae959fba7ae5-roelpro/js/vendor/modernizr-2.6.2.min.js"></script>
       <script src="https://connect.facebook.net/nl_NL/all.js"></script>
         <script type="text/javascript">
         
         
          $(document).ready(function() {
         
         $('.overlay_div').css('display','block');
            
         $('#spreuk').removeClass('active');
        $('#Bedankt').addClass('active');
         
          $('#spreuk').attr('href','javascript: void(0)');
        
          var takeimgname = localStorage.getItem('takeimgname');
          var imgupload = localStorage.getItem('imgupload');
          var lijfspreuk = localStorage.getItem('lijfspreuk');
          
          //alert(lijfspreuk);
          var captureimg = localStorage.getItem('captureimg');
          //alert(captureimg)
          //$('.img-cont').css('background',"url('"+takeimgname+"') no-repeat"); 
          $('#back-img').attr('src',takeimgname);
          $('#front-img').attr('src',imgupload);
          $('.info').html(lijfspreuk);
          $('#capturesrc').attr('src',captureimg);
          //alert(takeimgname);
         // alert(imgupload);
          //alert(lijfspreuk);
          
         });
         
           FB.init({
          appId      : '1379012242401425',
          xfbml      : true,
          version    : 'v2.0'
        });
    function invite(){
    FB.ui({ method: 'apprequests', 
     message: 'My diaolog...'});
   } 
   
    $(window).bind("load", function() {
         $('.overlay_div').css('display','none');
         $('#triggerme').trigger( "click" );
   
          });   
          
   function timelinepost(){
        var img = $('#imgscreen').attr('src');
       // alert(img);
     FB.login(function(response) {
       if (response.authResponse) {
        // login success, then post a photo
        FB.api('me/photos',
               'post',
               {
                   message: '',
                   url: img
               },
               function(response) {
                 console.log(response);
                 if (!response || response.error) {
                     console.log('failed');
                 } else {
                     console.log('success');
                 }
               }
        );
    }
}, {scope: 'publish_actions'});
    
   }       
</script>
<style>





</style>
        
        
    </head>
    <body style="position: inherit;">
    
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="//browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <!--<p>Hello world! This is HTML5 Boilerplate.</p>-->
         <div class="overlay_div">
        <img class="loading_img" src="//test.scampaigns.com/user_template/65754ae959fba7ae5-roelpro/712.GIF" /> 
        </div> 
        
    <div class="main_wrapper">
        
         <div class="container-fluid top">
            	<div class="row roel-container">
                <div class="SFPTWO_IMAGEEDIT expl">
                	<img id="images1" src="//test.scampaigns.com/user_template/65754ae959fba7ae5-roelpro/img/logo.jpg" alt=""/><!-- end of logo -->
                   </div>
                      <div  class="explicit_edit"><a style="cursor: pointor;"  title="Nodig je vrienden uit" class="invite" onclick="invite()"><img src="//test.scampaigns.com/user_template/65754ae959fba7ae5-roelpro/img/facebook_icon.png" alt=""><span class="explicit_edit">Nodig je<br>vrienden uit</span></a><!-- end of invite -->
                    </div>
                </div><!-- end of container -->
            </div><!-- end of top -->
        	<div class="main_navigation">
             <div class="container-fluid">
            	<div class="roel-container row">
                	<ul>
                    	<li class="explicit_edit enteroff  SFPTWO_TAGEDIT"><a href="/facebook/pageTab/740/index.phpindex.php" class="" title="Kies je tegel en foto" id="Kies">1) Kies je tegel en foto</a></li>
                    	<li class="explicit_edit enteroff  SFPTWO_TAGEDIT"><a href="//test.scampaigns.com/spreuk.php" class="" id="spreuk" title="Persoonlijke spreuk">2) Persoonlijke spreuk</a></li>
                    	<li class="explicit_edit enteroff  SFPTWO_TAGEDIT"><a href="//test.scampaigns.com/bedankt.php" class="" id="Bedankt" title="Bedankt">3) Bedankt</a></li>
                    </ul>
                    </div>
                </div><!-- end of container -->
            </div><!-- end of top -->
            <div class="main_content">
            
            	<div class="container-fluid bedankt-wrap">
                <div class="col-lg-12">
                    <div class="SFPTWO_TEXTEDIT"><h2 class="SFPTWO_TAGEDIT explicit_edit ">Bedankt!</h2></div>
                    <div class="SFPTWO_TEXTEDIT"><h3 class="SFPTWO_TAGEDIT explicit_edit ">Je hebt zojuist je tegel gedeeld op Facebook.</h3></div>
                    </div>
                    <div class="clearfix"></div>
                <div class="img-cont clearfix">
                 
              <?php echo '<img id ="imgscreen" src="'.$fullpath.'" />'?>
               
                </div>
                </div>
                </div>
                <input type="button" id="triggerme" onclick="timelinepost()" style="display: none;"/>
                <!-- end of container -->
                <div class="btn_blog explicit_edit SFPTWO_TAGEDIT" style="cursor: pointer;">
                	<a style="cursor:pointor;width: 260px;" onclick="invite()"><strong>FACEBOOK VRIENDEN</strong><span>uitnodigen voor deze app</span></a>
                </div><!-- end of btn_blog -->
            </div><!-- end of main_content -->
            <div class="footer"></div><!-- end of footer -->
        </div><!-- end of main_wrapper -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script> window.jQuery || document.write('<script src="//test.scampaigns.com/user_template/65754ae959fba7ae5-roelpro/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="//test.scampaigns.com/user_template/65754ae959fba7ae5-roelpro/js/plugins.js"></script>
        <script src="//test.scampaigns.com/user_template/65754ae959fba7ae5-roelpro/js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <!--<script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>-->
    </body>
    
</html>
