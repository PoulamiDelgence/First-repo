 
<html>
<head>
<link rel="stylesheet" href="http://test.scampaigns.com/user_template/9185530d2381607810-roelpro/css/main.css" />
 <link rel="stylesheet" href="http://test.scampaigns.com/user_template/9185530d2381607810-roelpro/css/jquery.alerts.css"/> 
 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
   <script src="http://test.scampaigns.com/user_template/9185530d2381607810-roelpro/js/jquery.alerts.js"></script>
  <script type="text/javascript" src="http://test.scampaigns.com/user_template/9185530d2381607810-roelpro/js/html2canvas.js"></script>
<script type="text/javascript" src="http://test.scampaigns.com/user_template/9185530d2381607810-roelpro/js/jquery.plugin.html2canvas.js"></script>

         <script type="text/javascript">
      $(document).ready(function() {
            var uploadimg = $('#uploadimgtext').val();
            var getfbimg  = localStorage.getItem('facebookimg');
          //$('.img-cont').css('background',"url('"+takeimgname+"') no-repeat"); 
          //alert(getfbimg); 
         localStorage.setItem('imgupload',uploadimg);
         var takeimgname = localStorage.getItem('takeimgname');
         //alert(takeimgname);
            var imgupload = localStorage.getItem('imgupload');
            var lijfspreuk = localStorage.getItem('lijfspreuk');
        	//$('#target').css('visibility','hidden');
           // $('#target').fadeTo( 1000, 0 );
            //$("#target").animate({ opacity: 0 })
        $('#back-img').attr('src',takeimgname);
        //  $('#front-img').attr('src',getfbimg);
         // $('.info').html(lijfspreuk);
        
          //alert(uploadimg);
         //
   
       // 
        var takeimgnamesplit = takeimgname.split('/');
        gettakeimgsp = takeimgnamesplit[6];
        localStorage.setItem('gettakeimgsp',gettakeimgsp);
        if(gettakeimgsp == '3.png' || gettakeimgsp == '4.png'){
            $('.textbellow').remove();
        }
        
         if(gettakeimgsp == '1.png' || gettakeimgsp == '2.png'){
              $('.textup').remove();
        }
        var width = $('.width').val();
        width = parseInt(width);
        var height = $('.height').val();
        height = parseInt(height);
            //alert(width);
            

        if( width < 400 || height < 400){
           
            jAlert("Image size must be 400 or more. ");
             setTimeout(function(){
            window.history.back();
             }, 800);
           }
                 // Do something after 5 seconds
           
        	$('#target').html2canvas({
			onrendered: function (canvas) {
                //Set hidden field's value to image data (base-64 string)
				$('#img_val').val(canvas.toDataURL("image/png"));
                //Submit the form manually
			 $('form#myForm').submit();
               //window.location="//smartfanpage.com/screenshot/save.php";
			}
		});
        
        if($("#img_val").length)
          var val="";
         
          else{ 
           
            jAlert("Image is not well percept.Please upload another photo. ");
             setTimeout(function(){
              window.history.back();
            }, 800);
          }
        
         });
         
            
         
</script>
<?php
ini_set('memory_limit', '-1');
ini_set( 'display_errors', 1 );
error_reporting( E_ALL ^ E_NOTICE );
include "FaceDetect.php";
include "ImageManipulator.php";
$detector = new svay\FaceDetector('detection.dat');

    $fid = $_POST['getprflmg'];
    $img = file_get_contents($_POST['getprfId']);
    $file =  '/var/www/staging/public/facebook/pageTab/843/upload/'.$fid.'.jpg';
    file_put_contents($file, $img);
    $extn = $fid.'.jpg';
   

    // array of valid extensions
    $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
    // get extension of the uploaded file
    $fileExtension = strrchr($extn, ".");
    // check if file Extension is on the list of allowed ones
    if (in_array($fileExtension, $validExtensions)) {
        // we are renaming the file so we can upload files with the same name
        // we simply put current timestamp in fron of the file name
      
//            echo "File name: " . $_FILES['fileToUpload']['name'] . "<br />";
//    echo "File type: " . $_FILES['fileToUpload']['type'] . "<br />";
//    echo "File size: " . ($_FILES['fileToUpload']['size'] / 1024) . " Kb<br />";
//    echo "Temp path: " . $_FILES['fileToUpload']['tmp_name'];
$filename='upload/'.$fid.'.jpg';

 //$currentUrl = $_SERVER["SERVER_NAME"]; 
//$filename=$currentUrl.'/new/'.$filename;
$hold = $detector->faceDetect($filename);
$new_image_name = $filename;

$manipulator = new ImageManipulator($new_image_name);
        $x1 = $hold['x']; // 200 / 2
      $y1 = $hold['y']; // 130 / 2
       $x2 = $hold['x'] + $hold['w'] ; // 200 / 2
       $y2 = $hold['y'] + $hold['w']; // 130 / 2
      
      $height = $manipulator->getHeight();
    $width = $manipulator->getWidth();
    //echo $width."*".$height;
    
    $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
    
        // saving file to uploads folder
        $manipulator->save($new_image_name);   
        
//print_r($hold);
//exit;
//$detector->doDetectGreedyBigToSmall();

//$detector->toJpeg();

//
        
        

    } 

?>


</head>
<body style="position: inherit;">
 <div class="overlay_div" style="opacity: 0.40;">
        <img class="loading_img" src="http://test.scampaigns.com/user_template/9185530d2381607810-roelpro/712.GIF" />
  </div>
  <input type="hidden" class="width" value="<?php echo $width;?>"/>
  <input type="hidden" class="height" value="<?php echo $height;?>"/>
<form method="POST" enctype="multipart/form-data"  action="spreuk.php"id="myForm">
	<input type="hidden" name="img_val" id="img_val" value="" />
</form>

<div style="opacity: 0;">
 <div class="img-cont clearfix" id="target">
 
                <div class="front-img-cont textup"><img id="front-img" src="//test.scampaigns.com//facebook/pageTab/843/<?php echo $new_image_name;?> 
" /></div>
               <div class="front-img-cont textbellow"><img id="front-img" src="//test.scampaigns.com//facebook/pageTab/843/<?php echo $new_image_name;?> 
" /></div>
                <div class="back-img-cont">
                <img  id="back-img" src=""/></div>
                </div> </div>

<input type="hidden" id="uploadimgtext" value="//test.scampaigns.com//facebook/pageTab/843/<?php echo $new_image_name;?> "/>
</body>
</html>
