<!--SFPPAGE-->
<?php
       include('../include.php');
       include_once('/var/www/staging/public/sfpApi.php');
      
       

//Get the base-64 string from data
//echo $_POST['img_val'];
$filteredData=substr($_POST['img_val'], strpos($_POST['img_val'], ",")+1);
//echo $filteredData;
//Decode the string
$unencodedData=base64_decode($filteredData);

//Save the image
$imgs='img'.rand().'.png';
//echo($_SERVER['DOCUMENT_ROOT']);
file_put_contents($_SERVER['DOCUMENT_ROOT']."/publish/uid-gicpksbri7vpiu7171vl63df82//upload/".$imgs, $unencodedData);
$imglink = $_SERVER['DOCUMENT_ROOT']."/publish/uid-gicpksbri7vpiu7171vl63df82//upload/".$imgs;
$imglink=explode('/',$imglink);
$imglinkadd = $imglink[5]."/".$imglink[6]."/".$imglink[8]."/".$imglink[9];
$imglinkaddme = 'https://'.$_SERVER['SERVER_NAME']."/".$imglinkadd;
//echo $imglink;
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Roel - Welcome to our Website!</title>
        <link rel="shortcut icon" type="image/x-icon" href="//test.scampaigns.com/user_template/50-roelpro/img/favicon.ico">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="//test.scampaigns.com/user_template/50-roelpro/css/normalize.css">
        <link rel="stylesheet" href="//test.scampaigns.com/user_template/50-roelpro/css/bootstrap.min.css">
        <link rel="stylesheet" href="//test.scampaigns.com/user_template/50-roelpro/css/jquery.alerts.css"> 
        <link rel="stylesheet" href="//test.scampaigns.com/user_template/50-roelpro/css/main.css">
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
           <script src="//test.scampaigns.com/user_template/50-roelpro/js/plugins.js"></script>
        <!-- </script> -->
        <script src="//test.scampaigns.com/user_template/50-roelpro/js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="//test.scampaigns.com/user_template/50-roelpro/js/jquery.alerts.js"></script>
         <script src="https://connect.facebook.net/nl_NL/all.js"></script>
         <script type="text/javascript" src="//test.scampaigns.com/user_template/50-roelpro/js/html2canvas.js"></script>
        <script type="text/javascript" src="//test.scampaigns.com/user_template/50-roelpro/js/jquery.plugin.html2canvas.js"></script>
      
         <script type="text/javascript">
        
       
        
          function check() {
                
               var x = document.forms["lijfspreuk1"]["litext"].value;
    if (x == null || x == "") {
        jAlert('Voer de naam', 'kennisgeving');
        return false;
    
    }
    }
    
       FB.init({ 
       appId:'502186369918571', cookie:true, 
       status:true, xfbml:true 
   });
 function invite(){
  FB.ui({ method: 'apprequests', 
   message: 'Choose Your Friends...'});
 }    
         
  $(document).ready(function() {
             
           $('#email').val(localStorage.getItem('email'));
           $('#uid').val(localStorage.getItem('uid'));
           $('#fname').val(localStorage.getItem('fname'));
           $('#lname').val(localStorage.getItem('lname')); 
           $('#spreuk').addClass('active');
           $('#Bedankt').attr('href','javascript: void(0)');
           $('#Kies').attr('href','javascript: void(0)');
    
     $('#lijfspreuk').keyup(function() {
              var lijfspreuk = $('#lijfspreuk').val();  
              
     localStorage.setItem('lijfspreuk',lijfspreuk); 
        $('#litext').val(lijfspreuk);
         $('#mepreview').html(lijfspreuk);
    });
 
          var takeimgname = localStorage.getItem('takeimgname');
          var imgupload = localStorage.getItem('imgupload');
          var captureimg = $('#captureimg').val();
           localStorage.setItem('captureimg');
          
          });
         
          $(window).bind("load", function() {
          // alert('dfs');
             $('.overlay_div').css('display','none'); 
         $
          });
          
      
        FB.init({
          appId      : '502186369918571',
          xfbml      : true,
          version    : 'v2.0'
        });
  
          
          
  function canvas()
  {
    
     var x = $('#lijfspreuk').val();  
    if (x == null || x == "" || x == 'Jouw lijfspreuk') {
        jAlert('Voer de naam', 'kennisgeving');
        return false;
    
    }
    else{
        
    
      var abc = $('#target').html();
      //alert(abc);
    
    	$('#target').html2canvas({
			onrendered: function (canvas) {
				$('#img_val2').val(canvas.toDataURL("image/png"));
               // alert(canvas.toDataURL("image/png"));
                $('.overlay_div').css('display','block'); 
              
			}
            });
            
           setTimeout(function(){ $('form#frms').submit(); }, 1500);
       }     
		
  }        
</script> 
    </head>
    <body style="position: inherit;">
<div id="fb-root">

    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="//browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <!--<p>Hello world! This is HTML5 Boilerplate.</p>-->
      
         <!--SFPhide  <div class="overlay_div">
        <img class="loading_img" src="//test.scampaigns.com/user_template/50-roelpro/712.GIF" /> 
        </div> SFPhide-->
              
        <div class="main_wrapper">
         <?php include("menu.php");?>
         
            <div class="main_content">
            	<div class="container-fluid bedankt-wrap">
                 <div class="col-lg-12">
                    <div class="SFPTWO_TEXTEDIT"><h2 class="SFPTWO_TAGEDIT explicit_edit">Voer je spreuk in ...</h2></div>
                      <div  style="margin: 80px 0px 0px;">
        <div id="target" class="img-cont" >
            
              <?php echo '<img id ="imgscreen" src="'.$imglinkaddme.'" />'?>
             <p class="info" id="mepreview"></p>
          </div>
          </div>
                    <div class="SFPTWO_TEXTEDIT"><h3 class="SFPTWO_TAGEDIT explicit_edit">Wat is jouw lijfspreuk als professional?</h3></div>
                </div>
                </div><!-- end of container -->
                <form enctype="multipart/form-data" action="bedankt.php" id="frms" name="lijfspreuk1" method="post" class="lijfspreuk"  >
                	<input type="text" name="lijfspreuk" class="meljf" id="lijfspreuk" maxlength="25" value="Jouw lijfspreuk" onBlur="if(this.value=='') this.value='Jouw lijfspreuk';" onFocus="if(this.value=='Jouw lijfspreuk') this.value='';" />
                    <span>Maximaal 25 karakters</span>
                	<input type="hidden" name="captureimg" id="captureimg" value="<?php echo $_POST['img_val']; ?>"/>
                    <input type="hidden" name="litext" id="litext" value=""/>
                    <input type="hidden" id="uid" name="uid" value=""/>
                    <input type="hidden" id="fname" name="fname" value=""/>
                    <input type="hidden" id="lname" name="lname" value=""/>
                    <input type="hidden" id="email" name="email" value=""/>
                    <input type="text" name="img_val2" id="img_val2" value="" style="display: none;" />
                    
                </form>
               <p class="explicit_edit"><input type="button" name="submit" class="spreuk_val" value="Deel je tegel op Facebook" onclick="canvas()" contenteditable="true" />
                </p>
            </div><!-- end of main_content -->
            <div class="footer"></div><!-- end of footer -->
        </div><!-- end of main_wrapper -->

       
     
        
       
        
        
        

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
