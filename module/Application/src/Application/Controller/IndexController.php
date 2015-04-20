<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;
use Zend\Mvc\Controller\AbstractActionController;

use Application\Model\homepagetable;
use Application\Model\homepagetableTable;
use Application\Model\homepageslidertableTable;
use Application\Model\homepagewalloffameTable;
use Application\Model\faqContainerTable;
use Application\Model\templatestoretbleTable;
use Application\Model\templateimagesTable;
use Application\Model\howsworkpagetbleTable;
use Application\Model\howsworkstepstbleTable;
use Application\Model\becomepublisherTable;
use Application\Model\casestudiesTable;
use Application\Model\becomepublisherbannerTable;
use Application\Model\becomepublisherstudioTable;
use Application\Model\blogdetailssTable;
use Application\Model\blogarchiveHeaderTable;
use Application\Model\blogoverviewHeaderTable;
use Application\Model\blogDetailsHeaderTable;
use Application\Model\blogoverviewTable;
use Application\Model\templateTable;
use Application\Model\DeveloperTable;
use Application\Model\fbuserTable;
use Application\Model\termsserviceTable;
use Application\Model\disclaimerTable;
use Application\Model\publisherTable;
use Application\Model\privacypolicyTable;
use Application\Model\userComment;
use Application\Model\userCommentTable;
use Application\Model\rating;
use Application\Model\ratingTable;
use Application\Model\animatedImageTable;
use Application\Model\animatedImage;
use Application\Model\promote;
use Application\Model\screenshots;
use Application\Model\contact;
use Application\Model\aboutUsHeaderTable;
use Application\Model\aboutUsImagesTable;
use Application\Model\accessCode;
use Application\Model\accessCodeTable;
use Application\Model\pagesheader;
use Application\Model\privacypolicydeveloper;
use Application\Model\privacypolicydeveloperTable;
use Application\Model\developerdisclaimer;
use Application\Model\developerdisclaimerTable;
use Application\Model\developerpagesheader;
use Application\Model\developerpagesheaderTable;
use Application\Model\developertermsservice;
use Application\Model\developertermsserviceTable;
use Application\Model\pagesheaderTable;
use Application\Form\contactForm;
use Zend\View\Model\ViewModel;
use Zend\Http\PhpEnvironment\Request;
use Zend\Session\Container;
use Zend\Mail;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mail\Transport\SmtpOptions; 

class IndexController extends AbstractActionController
{
protected $becomepublisherTable,$blogoverviewHeaderTable,$blogoverviewTable,$blogarchiveHeaderTable,$becomepublisherbannerTable;
protected $homepagetableTable,$homepageslidertable,$templateimagesTable,$homepagewalloffameTable,$templatestoretbleTable;
protected $howsworkpagetbleTable,$casestudiesTable,$howsworkstepstbleTable,$blogDetailsHeaderTable,$userTemplateTable;
protected $DeveloperTable,$userCommentTable,$faqbannerTable,$faqpagesTable,$faqsfpTable,$faqpublisherTable;
protected $faqpricingTable,$faqtechnicalTable,$contactheaderTable,$addressTable,$contactTable,$becomepublisherstudioTable;
protected $templateTable,$blogdetailssTable,$termsserviceTable,$disclaimerTable,$privacypolicyTable,$publisherTable;
protected $fbuserTable,$promoteTable,$screenshotsTable,$rating,$aboutUsHeaderTable,$aboutUsImagesTable,$animatedImageTable;
protected $faqContainerTable,$pagesheaderTable; 
protected $accessCodeTable,$requestemailTable; 
protected $developerpagesheaderTable;
protected $developerdisclaimerTable;
protected $privacypolicydeveloperTable;
protected $developertermsserviceTable;

public function indexAction()
{
    
	$this->layout('layout/indexlayout.phtml'); 
    $user_session = new Container('loginId');
    $sid = $user_session->offsetGet('loginId');
    
    $contentone =$this->getpublisherTable()->selectUser1($sid);
    
    $protocol = '';
    if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
        $protocol = 'https://';
    }
    else {
        $protocol = 'http://';
    }
    // echo $_SERVER['SERVER_PROTOCOL'].$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $dynamicPath = $protocol.$_SERVER["SERVER_NAME"];
    
    if($sid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
    }
    $slideimage =$this->gethomepageslidertableTable()->fetchAll();
    $walloffameimage=$this->gethomepagewalloffameTable()->fetchAll();
    $animationresult=$this->getanimatedImageTable()->selectAll();
    
    $template = $this->getTemplateTable()->fetchTemplate();
    $templates = $this->getTemplateTable()->fetchTemplate();
    $mytemplates = $this->getTemplateTable()->fetchTemplate();
    $template_mob = $this->getTemplateTable()->fetchTemplate();
    $contents = $this->gethomepagetableTable()->fetchAll('1');
    $i = 0;
    foreach($animationresult as $animate)
    {
    $array[$i] =$animate->imagePath; 
   
    $i++;
    }
   
    return new ViewModel(array('content'=>$contents,'dynamicPath'=>$dynamicPath, 'animation'=>$array,'slideImage'=> $slideimage,'wallofFame'=>$walloffameimage,'template'=>$template,'tempdesign'=>$template_mob,'templates'=>$templates,'mytemplates'=>$mytemplates,'sid'=>$sid));       
}
    
public function searchtempcategoryAction()
{
$template = $_POST['value'];
$templates = $this->getTemplateTable()->searchtempcategory($template);
$searchcategory ="";
foreach($templates as $dev)
    {
        $searchcategory .= $dev->templateName."|-|".$dev->scImage."|/|";
    }
echo $searchcategory;
exit;
}

public function publishersearchtempcategoryAction()
{
$template = $_POST['value'];
$templates = $this->getTemplateTable()->searchtempcategory1($template);
$arr = array();
$res = "";
foreach($templates as $dev)
    {
    $contentone=$this->getDeveloperTable()->selectrow($dev->devId);
    if(!in_array($contentone->id,$arr))
        {
            $arr[] =$contentone->id; 
            $res .= $contentone->fName."|-|".$contentone->lName."|-|".$contentone->cdesc."|-|".$contentone->cimage."[|]";
        }
    }
echo $res;
exit;
}
   
public function searchallAction()
{
$templates = $this->getTemplateTable()->searchall();
$searchcategory ="";
foreach($templates as $dev)
    {
        $searchcategory .= $dev->templateName."|-|".$dev->scImage."|/|";
    }
echo $searchcategory;
exit;
}
       
public function searchalldevAction()
{
$contentone=$this->getDeveloperTable()->fetchAll(); 
$res = "";  
foreach($contentone as $dev)
    {
        $res .= $dev->fName."|-|".$dev->lName."|-|".$dev->cdesc."|-|".$dev->cimage."[|]";
    }
echo $res;
exit;  
}
    
public function storeAction()
{
	/*$config = $this->getServiceLocator()->get('Config');
print_r ($config['pathName']['path']);exit;*/
	$this->layout('layout/indexlayout.phtml');
if($this->getRequest()->getPost('templateCat'))
{
           $protocol = '';
        if (isset($_SERVER['HTTPS']) &&
       ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'HTTPS') {
         $protocol = 'https://';
        }
        else {
        $protocol = 'http://';
           }
$dynamicPath = $protocol.$_SERVER["SERVER_NAME"];    
$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');
$contentone =$this->getpublisherTable()->selectUser1($sid);
    if($sid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
    } 
  $request = $this->getRequest();
$template = $request->getPost('standard-dropdown'); 
$templates = $this->getTemplateTable()->searchtempcategory($template);
//$Author=$this->getdeveloperTable()->getDeveloperWithId($templates->devId);
$template_mob = $this->getTemplateTable()->searchtempcategory($template);
$contents = $this->gettemplatestoretbleTable()->fetchAll('2');

//if(count($templates)>0){
return new ViewModel(array('content'=>$contents,'template'=>$templates,'tempdesign'=>$template_mob,'sid'=>$sid));
//}

}
elseif($this->getRequest()->getPost('allSearch'))
{
        $protocol = '';
        if (isset($_SERVER['HTTPS']) &&
       ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'HTTPS') {
         $protocol = 'https://';
        }
        else {
        $protocol = 'http://';
           }
$dynamicPath = $protocol.$_SERVER["SERVER_NAME"];    
$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');
$contentone =$this->getpublisherTable()->selectUser1($sid);
    if($sid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
    } 
$request = $this->getRequest();
$srch = $request->getPost('srchItem');

if(stristr("neon",$srch))
    {
        $srch = "epic";
    }
 $srch = trim($srch);
 $srch = str_replace(" ","_",$srch);   
$devsearch = $this->getTemplateTable()->searchcategory($srch);

$devsearch1 = $this->getTemplateTable()->searchtemplname($srch); 

$searchcategory = "";
$searchtemplname = "";
$search_arry = array();
$searchresults = array();
$i=0;
foreach($devsearch as $searchq)
{
	// echo $searchq->id;
     $search_arry[] = $searchq->id;
}
foreach($devsearch1 as $searcha)
{
    
    $searchresults[$i]=$searcha;
    $i++;
    
}


$k=0;
$template_mob=array();

if(count($search_arry)!=0){
foreach($search_arry as $srchs)
{
$searchResult = $this->getTemplateTable()->getsearchresult($srchs);
//$Author=$this->getdeveloperTable()->getDeveloperWithId($searchResult->devId);
$searchresults[$i]=$searchResult;
$i++;
$template = $this->getTemplateTable()->getsearchresult($srchs);

$template_mob[$k]=$template;
$k++;

}
}
else { $template_mob=$this->getTemplateTable()->searchtemplname($srch);}
$contents = $this->gettemplatestoretbleTable()->fetchAll('2');
foreach ($template_mob as $res){
	$holdItemplateId ="";
	$holdItemplateId = $this->encrypt_decrypt('encrypt', $res->id);
	$holdItemplateId = str_replace("/","encoded",$holdItemplateId);

	$array[] = array(
			'approval' => $res->approval,
			'disableDeveloper' => $res->disableDeveloper,
			'tempFoldName'=>$res->tempFoldName,
			'id'=> $res->id,
			'desktopImage'=>$res->desktopImage,
			'mobileImage'=>$res->mobileImage,
			'encryptedTempid'=> $holdItemplateId,
			'templateName'=>$res->templateName,
			'templateDesc'=>$res->templateDesc,


	);

}

//$Author=$this->getdeveloperTable()->getDeveloperWithId($templates->devId);
return new ViewModel(array('content'=>$contents,'template'=>$searchresults,'tempdesign'=>$array,'sid'=>$sid));
}
else
{

$protocol = '';
        if (isset($_SERVER['HTTPS']) &&
       ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'HTTPS') {
         $protocol = 'https://';
        }
        else {
        $protocol = 'http://';
           }
       // echo $_SERVER['SERVER_PROTOCOL'].$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $dynamicPath = $protocol.$_SERVER["SERVER_NAME"];    
$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');
$contentone =$this->getpublisherTable()->selectUser1($sid);
if($sid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
       if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
    }

$contents = $this->gettemplatestoretbleTable()->fetchAll('2');
$slideimage = $this->gettemplateimagesTable()->getResult('1');
$slideimage1 = $this->gettemplateimagesTable()->getResult('2');
$template = $this->getTemplateTable()->getAuthor(1);
$templates = $this->getTemplateTable()->getAuthor(1);
$mytemplates = $this->getTemplateTable()->getAuthor(1);
$template_mob = $this->getTemplateTable()->getAuthor(1);

foreach ($template_mob as $res){
	$holdItemplateId ="";
	$holdItemplateId = $this->encrypt_decrypt('encrypt', $res->id);
	$holdItemplateId = str_replace("/","encoded",$holdItemplateId);

	$array[] = array(
			'approval' => $res->approval,
			'disableDeveloper' => $res->disableDeveloper,
			'tempFoldName'=>$res->tempFoldName,
			'id'=> $res->id,
			'desktopImage'=>$res->desktopImage,
			'mobileImage'=>$res->mobileImage,
			'encryptedTempid'=> $holdItemplateId,
			'templateName'=>$res->templateName,
			'templateDesc'=>$res->templateDesc,
				

	);

}
 
return new ViewModel(array('templateimage'=>$slideimage,'templateimage1'=>$slideimage1,'content'=>$contents,'template'=>$template,'tempdesign'=>$array,'templates'=>$templates,'mytemplates'=>$mytemplates,'sid'=>$sid,'dynamicPath'=>$dynamicPath));

}
}    
public function howsworkAction()
{
$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');
$contentone =$this->getpublisherTable()->selectUser1($sid);
if($sid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
    }
$contents=$this->gethowsworkpagetbleTable()->fetchAll('3');
$contentone=$this->gethowsworkstepstbleTable()->fetchAll();
return new ViewModel(array('content'=>$contents,'contentpass'=>$contentone));
}
    
public function casestudiesAction()
{
    $user_session = new Container('loginId');
    $sid = $user_session->offsetGet('loginId');
    if($sid != "")
    {
       $this->layout('layout/layoutsession.phtml'); 
    }
    $contentone=$this->getcasestudiesTable()->fetchAll();
    return new ViewModel(array('contentpass'=>$contentone));
}
    
public function faqAction()
{ 
    $this->layout('layout/faq1.phtml');
   // echo $this->getRequest()->getPost('submit');
if($this->getRequest()->getPost('submit')){
    //echo 'anima'; exit;
     $this->layout('layout/faq1.phtml');
$j=0;
$k=0;
$l=0;
$m=0;
$arrayOne=array();
$arrayTwo=array();
$arrayThree=array();
$arrayFour=array();
$resultfaqsfp=array();
$resultfaqpublisher=array();
$resultfaqpricing=array();
$resultfaqtechnical=array();
$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');
//$contentone =$this->getfbuserTable()->selectUser1($sid);
$contentone =$this->getpublisherTable()->selectUser1($sid);
if($sid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
    }

$request = $this->getRequest();
$srch = $request->getPost('srchTerm');
$searchQues = $this->getfaqContainerTable()->searchingques($srch);
$searchAns = $this->getfaqContainerTable()->searchingans($srch); 
$search_arry = array();
foreach($searchQues as $searchq)
{
     $search_arry[] = $searchq->id;
}
foreach($searchAns as $searcha)
{
    if(!in_array($searcha->id,$search_arry))
    {
       $search_arry[] = $searcha->id; 
    }
}
   //$searchresults = "";
$searchresults = array();
$i=0;
foreach($search_arry as $srchs)
{
$searchResult = $this->getfaqContainerTable()->getsearchresult($srchs);
       // $searchresults .= $searchResult->referenceId."|-|".$searchResult->question."|-|".$searchResult->answer."|/|";

//   echo $searchresults;
//    exit;
$searchresults[$i]=$searchResult;
$i++;
}
//print_r($searchresults);exit;
foreach($searchresults as $search)
 {
     if($search->referenceId == 1)
     {
       
       $resultfaqsfp[$j]=$search;
        $j++;
     }
      if($search->referenceId == 2)
     {
        
        $resultfaqpublisher[$k]=$search;
        $k++;
     }
      if($search->referenceId == 3)
     {
      
       $resultfaqpricing[$l]=$search;
        $l++;
     }
     if($search->referenceId == 4)
     {
        
        $resultfaqtechnical[$m]=$search;
        $m++;
     }
     
 }
 //print_r($resultfaqsfp); 
// print_r($resultfaqpublisher);exit;
 $contentbanner=$this->getfaqbannerTable()->fetchAll('1');
 return new ViewModel(array('sid'=>$sid,'banner'=>$contentbanner,'smartFan'=>$resultfaqsfp,'Publisher'=>$resultfaqpublisher,'Pricing'=>$resultfaqpricing,'faqtechnical'=>$resultfaqtechnical));
}
else
{
    $user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');
$contentone =$this->getpublisherTable()->selectUser1($sid);
if($sid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
    }
$resultfaqsfp=$this->getfaqContainerTable()->getResult('1');
$resultfaqpublisher=$this->getfaqContainerTable()->getResult('2');
$resultfaqpricing=$this->getfaqContainerTable()->getResult('3');
$resultfaqtechnical=$this->getfaqContainerTable()->getResult('4');
$contentbanner=$this->getfaqbannerTable()->fetchAll('1');
//$aboutsfp=$this->getfaqsfpTable()->fetchAll();
//$publisher=$this->getfaqpublisherTable()->fetchAll();
//$pricing=$this->getfaqpricingTable()->fetchAll();
//$technical=$this->getfaqtechnicalTable()->fetchAll();
//echo sizeof($resultfaqsfp);exit;
return new ViewModel(array('sid'=>$sid,'banner'=>$contentbanner,'contentsfp'=>$resultfaqsfp,'contentpub'=>$resultfaqpublisher,'contentprice'=>$resultfaqpricing,'contenttech'=>$resultfaqtechnical));

}
 }   
public function aboutusAction()
{
$this->layout('layout/aboutuslayout.phtml');	
$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');

$contentone =$this->getpublisherTable()->selectUser1($sid);
if($sid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
    }
    $sec =2;
    $fiv =5;
    $i=0;
    $j=0;
    $copy = array();
    $copy_next =array();
    $contentbanner=$this->getaboutUsHeaderTable()->fetchAll('1');
    $content_one=$this->getaboutUsImagesTable()->fetchAll('1');
    $content_two=$this->getaboutUsImagesTable()->fetchAll('2');
    $content_three=$this->getaboutUsImagesTable()->fetchAll('3');
    $content_four=$this->getaboutUsImagesTable()->fetchAll('4');
    $content_five = $this->getaboutUsImagesTable()->fetchAll('5');
    $content_six = $this->getaboutUsImagesTable()->fetchAll('6');
    $content_seven = $this->getaboutUsImagesTable()->fetchAll('7');
    $content_eight = $this->getaboutUsImagesTable()->fetchAll('8');
    
    //print_r($content_two);exit;
    
    return new ViewModel(array('banner'=>$contentbanner,'result_one'=>$content_one,
    'result_two'=>$content_two,
    'result_three'=>$content_three,
    'result_four'=>$content_four,
    'result_five'=>$content_five,
    'result_six'=>$content_six,
    'result_seven'=>$content_seven,
    'result_eight'=>$content_eight,
	'sid'=>$sid,
  
    ));
}
    
public function contactAction()
{ 
$this->layout('layout/indexlayout.phtml'); 
$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');
$contentone =$this->getpublisherTable()->selectUser1($sid);
if($sid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
    }
$headerpart=$this->getcontactheaderTable()->fetchAll('1');  
$addresspart=$this->getaddressTable()->fetchAll('1');
$id = $this->getEvent()->getRouteMatch()->getParam('id');
$result = $this->getcontactTable()->getResult($id);
$form = new contactForm();
$request = $this->getRequest();
$files =  $request->getFiles()->toArray();
$subject = $request->getPost('subject');
$message = $request->getPost('message');
$name = $request->getPost('name');
$phone = $request->getPost('phone');
$email = $request->getPost('email');
if ($request->isPost()) 
    {  
    if (preg_match('/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i', $email)) 
        {
            $date = date('Y-m-d H:i:s');
            $broken_array = explode(" ",$date);
            $date = $broken_array[0];
            $time = $broken_array[1];
            $getdata = $this->getcontactTable()->insertcontact($subject,$message,$name,$phone,$email,$date,$time);
            $getMessage=$message;
            $message = new Message();
            $message->addTo($email)
            ->addFrom('info@smartfanpage.com')
            ->setSubject('Greetings From SmartFanPage!')
            ->setBody("Thank you for your message,will get back to you shortly");
            $smtpOptions = new \Zend\Mail\Transport\SmtpOptions();
            $smtpOptions->setHost('smtp.mandrillapp.com')
            ->setConnectionClass('login')
            ->setName('smtp.mandrillapp.com')
            ->setConnectionConfig(array(
            'username' => 'info@smartfanpage.com',
            'password' => 'fv7M_K1TFO9LgCaEdIVhgw',
            'ssl' => 'tls',
            'port'=>587,
            ));
            $transport = new \Zend\Mail\Transport\Smtp($smtpOptions);
            $transport->send($message);
            if($getdata==1)
            {
                
               
                $body = '<table rules="all" style="border-color: #666;" cellpadding="10">';
                $body .= "<tr ><td><strong>Subject</strong> </td><td>" . $subject . "</td></tr>";
                $body .= "<tr><td><strong>Message </strong> </td><td>" . $getMessage  . "</td></tr>";
                $body .= "<tr><td><strong>Name    </strong> </td><td>" . $name . "</td></tr>";
                $body .= "<tr><td><strong>Phone   </strong> </td><td>" . $phone . "</td></tr>";
                $body .= "<tr><td><strong>Email   </strong> </td><td>" . $email . "</td></tr>";
                $body .= "</table>";
                
                
                $message = new Message();
                $target_email='info@smartfanpage.com';
                $message->addTo($target_email)
                ->addFrom('info@smartfanpage.com')
                ->setSubject('USER INFORMATION');
                
                /*$smtpOptions = new \Zend\Mail\Transport\SmtpOptions();
                $smtpOptions->setHost('smtp.mandrillapp.com')
                ->setConnectionClass('login')
                ->setName('smtp.mandrillapp.com')
                ->setConnectionConfig(array(
                'username' => 'info@smartfanpage.com',
                'password' => 'fv7M_K1TFO9LgCaEdIVhgw',
                'ssl' => 'tls',
                'port'=>587,
                ));*/
                $transport = new SmtpTransport();
                $options = new SmtpOptions(array(
                'host' => 'smtp.mandrillapp.com',
                'connection_class' => 'login',
                'connection_config' => array(
                'ssl' => 'tls',
                'username' => 'info@smartfanpage.com',
                'password' => 'fv7M_K1TFO9LgCaEdIVhgw'
                ),
                'port' => 587,
                ));
                $html = new MimePart($body);
                $html->type = "text/html"; 
                $bodyMessage = new MimeMessage();
                $bodyMessage->addPart($html);
                $message->setBody($bodyMessage); 
                $transport->setOptions($options);
                $transport->send($message);   
            }
            $this->flashMessenger()->addMessage('THANK YOU');
            $this->redirect()->toRoute('application/default',array('controller'=>'index','action'=>'contact'));
        }
    else
        {
            $this->flashMessenger()->addMessage('PLEASE INSERT YOUR EMAIL');
            $this->redirect()->toRoute('application/default',array('controller'=>'index','action'=>'contact'));
        }
    }
return new ViewModel(array('contentheader'=>$headerpart,'contentadr'=>$addresspart,'id'=>$id,'form'=>$form,'sid'=>$sid)); 
}
    
public function termsconditionAction()
{
$this->layout('layout/indexlayout.phtml'); 	
$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');
$fetchid = 1;
$result = $this->getdeveloperpagesheaderTable()->fetchAll($fetchid);
$contentone =$this->getpublisherTable()->selectUser1($sid);
if($sid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
       if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
    }
$contentone=$this->gettermsserviceTable()->fetchAll();
return new ViewModel(array('contentpass'=>$contentone,'sid'=>$sid,'results'=>$result));
}
/**************************FOR DEVELOPER TERMS AND CONDITIONS**********/
public function termsconditiondeveloperAction()
{
	$this->layout('layout/layout5.phtml');
	$user_session = new Container('devId');
	$sid = $user_session->offsetGet('devId');
	
	if($sid != '' || $sid != NULL){
	$resultdeveloper = $this->getDeveloperTable()->getDeveloperWithId($sid);
	$developerIdEncrypted =  $this->encrypt_decrypt('encrypt', $sid);
	$developerParameter =str_replace("/","encoded",$developerIdEncrypted);
	}
	
	//print_r($resultdeveloper);exit;
	/*$user_session = new Container('loginId');
	$sid = $user_session->offsetGet('loginId');*/
	$fetchid = 1;
	$result = $this->getdeveloperpagesheaderTable()->fetchAll($fetchid);
	/*$contentone =$this->getpublisherTable()->selectUser1($sid);
	if($sid != "")
	{
		$user_session = new Container('sfpName');
		$sids = $user_session->offsetGet('sfpName');
		if($contentone[0]['fbName']!=""){
			$this->layout()->setVariables(array(
					'uname' => $contentone[0]['fbName'],
					'sfpuname' => $contentone[0]['fname'],
					'city' => $contentone[0]['hometown'],
					'fbuser'=>$contentone[0]['fbuser'],
					'sfpuser'=>$contentone[0]['sfpuser'],
					'sfpnm'=>$sids
			));
		}
		else{
			$this->layout()->setVariables(array(
					'uname' => $contentone[0]['fname'],
					'sfpuname' => $contentone[0]['fname'],
					'city' => $contentone[0]['hometown'],
					'fbuser'=>$contentone[0]['fbuser'],
					'sfpuser'=>$contentone[0]['sfpuser'],
					'sfpnm'=>$sids
			));
		}
	}*/
	$contentone=$this->getdevelopertermsserviceTable()->fetchAll();
	
	return new ViewModel(array('contentpass'=>$contentone,'sid'=>$sid,'results'=>$result,'resultdeveloper'=>$resultdeveloper,'encryptedSid'=>$developerParameter,));
	
	
	}   
/***************************FOR DISCLAIMER OF DEVELOPER***************************************************************/
public function disclaimerdeveloperAction()
{
$this->layout('layout/layout5.phtml'); 
/*$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');*/
$fetchid = 2;
$result = $this->getdeveloperpagesheaderTable()->fetchAll($fetchid);
$user_session = new Container('devId');
$sid = $user_session->offsetGet('devId');

if($sid != '' || $sid != NULL){
	$resultdeveloper = $this->getDeveloperTable()->getDeveloperWithId($sid);
	$developerIdEncrypted =  $this->encrypt_decrypt('encrypt', $sid);
	$developerParameter =str_replace("/","encoded",$developerIdEncrypted);
}
/*$contentone =$this->getpublisherTable()->selectUser1($sid);
if($sid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
    }*/
$contentone=$this->getdeveloperdisclaimerTable()->fetchAll();
return new ViewModel(array('contentpass'=>$contentone,'results'=>$result,'sid'=>$sid,'resultdeveloper'=>$resultdeveloper,'encryptedSid'=>$developerParameter,));
/*$this->layout('layout/indexlayout.phtml');
$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');
$fetchid = 2;
$result = $this->getpagesheaderTable()->fetchAll($fetchid);
$contentone =$this->getpublisherTable()->selectUser1($sid);
if($sid != "")
{
	$user_session = new Container('sfpName');
	$sids = $user_session->offsetGet('sfpName');
	if($contentone[0]['fbName']!=""){
		$this->layout()->setVariables(array(
				'uname' => $contentone[0]['fbName'],
				'sfpuname' => $contentone[0]['fname'],
				'city' => $contentone[0]['hometown'],
				'fbuser'=>$contentone[0]['fbuser'],
				'sfpuser'=>$contentone[0]['sfpuser'],
				'sfpnm'=>$sids
		));
	}
	else{
		$this->layout()->setVariables(array(
				'uname' => $contentone[0]['fname'],
				'sfpuname' => $contentone[0]['fname'],
				'city' => $contentone[0]['hometown'],
				'fbuser'=>$contentone[0]['fbuser'],
				'sfpuser'=>$contentone[0]['sfpuser'],
				'sfpnm'=>$sids
		));
	}
}
$contentone=$this->getdisclaimerTable()->fetchAll();
return new ViewModel(array('contentpass'=>$contentone,'results'=>$result,'sid'=>$sid));*/
	}
/************************PRIVACY POLICY BY DEVELOPER**************************/

	public function privacypolicydeveloperAction()
	{
		$this->layout('layout/layout5.phtml');
		/*$user_session = new Container('loginId');
		$sid = $user_session->offsetGet('loginId');*/
		$fetchid= 3;
		$result = $this->getdeveloperpagesheaderTable()->fetchAll($fetchid);
		$user_session = new Container('devId');
		$sid = $user_session->offsetGet('devId');
		
		if($sid != '' || $sid != NULL){
			$resultdeveloper = $this->getDeveloperTable()->getDeveloperWithId($sid);
			$developerIdEncrypted =  $this->encrypt_decrypt('encrypt', $sid);
			$developerParameter =str_replace("/","encoded",$developerIdEncrypted);
		}
		/*$contentone =$this->getpublisherTable()->selectUser1($sid);
		if($sid != "")
		{
			$user_session = new Container('sfpName');
			$sids = $user_session->offsetGet('sfpName');
			if($contentone[0]['fbName']!=""){
				$this->layout()->setVariables(array(
						'uname' => $contentone[0]['fbName'],
						'sfpuname' => $contentone[0]['fname'],
						'city' => $contentone[0]['hometown'],
						'fbuser'=>$contentone[0]['fbuser'],
						'sfpuser'=>$contentone[0]['sfpuser'],
						'sfpnm'=>$sids
				));
			}
			else{
				$this->layout()->setVariables(array(
						'uname' => $contentone[0]['fname'],
						'sfpuname' => $contentone[0]['fname'],
						'city' => $contentone[0]['hometown'],
						'fbuser'=>$contentone[0]['fbuser'],
						'sfpuser'=>$contentone[0]['sfpuser'],
						'sfpnm'=>$sids
				));
			}
		}*/
		$contentone=$this-> getprivacypolicydeveloperTable()->fetchAll();
		 
	
		return new ViewModel(array('contentpass'=>$contentone,'sid'=>$sid,'results'=>$result,'resultdeveloper'=>$resultdeveloper,'encryptedSid'=>$developerParameter,));
		 
	}

public function disclaimerAction()
{
	
$this->layout('layout/indexlayout.phtml');
$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');
$fetchid = 2;
$result = $this->getpagesheaderTable()->fetchAll($fetchid);
$contentone =$this->getpublisherTable()->selectUser1($sid);
if($sid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
    }
$contentone=$this->getdisclaimerTable()->fetchAll();
return new ViewModel(array('contentpass'=>$contentone,'results'=>$result,'sid'=>$sid));
}

public function accountsigninAction()
{ 
	$this->layout('layout/indexlayout.phtml');
$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');
$contentone =$this->getpublisherTable()->selectUser1($sid);
if($sid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
    } 
}
    
public function accountsignupAction()
{ 
$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');
$contentone =$this->getpublisherTable()->selectUser1($sid);
if($sid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
    } 
}
   
public function createpasswordAction()
{
	$this->layout('layout/indexlayout.phtml');
$pass = $this->getEvent()->getRouteMatch()->getParam('id'); 
$pass = substr($pass,0,-8);
$contentone =$this->getpublisherTable()->selectpass($pass);
if($contentone == "")
    {
        $this->redirect()->toRoute('application/default',array('controller'=>'Error','action'=>'index'));
        exit;
    }
return new ViewModel(array('contentpass'=>$contentone));
}
   
public function loginpublisherAction()
{
$uname = $_POST['email'];
//$chkemail =$this->getpublisherTable()->selectemails($uname);
$chkemail =$this->getpublisherTable()->selectEmail($uname);
if(!empty($chkemail) && $chkemail[0]['fbuser'] != '1' && $chkemail[0]['password'] == "" )
    {
        echo "3";
        exit;                
    }                    
$pass = $_POST['pass'];
$pass = $this->encrypt_decrypt('encrypt',$pass);
//echo $pass;exit;
if($pass == "")
    {
        $pass = "@#$%";
    }
$contentone =$this->getpublisherTable()->selectUseremail($uname,$pass);
//print_r($contentone);exit;
if(!empty($contentone))
    {
       // $user_session = new Container('loginId');
        //echo $contentone[0]['uId'];
        //$user_session->loginId= $contentone[0]['uId']; 
        $user_session = new Container('loginId');
        $user_session->loginId = $contentone[0]['id'];
        echo "1";
    }
else
    {
        echo "2";
    }
exit;
}
   

public function updatepassAction()
{
$email = $_POST['eid'];
$pass = $_POST['pass'];
$pass = $this->encrypt_decrypt('encrypt', $pass);
//$chkemail=$this->getpublisherTable()->selectemails($email);
$chkemail=$this->getpublisherTable()->selectEmail($email);
$user_session = new Container('loginId');
$user_session->loginId = $chkemail[0]['id']; 
$contentone =$this->getpublisherTable()->updatepassword($pass,$email);
print_r($contentone);exit;
//echo $contentone;
//exit;                    
}
 public function encrypt_decrypt($action, $string) {
   $output = false;
   $key = '5faNIYoC17eL9G8ph6gvS7e2p625m9zN';
   $iv = md5(md5($key));
   if( $action == 'encrypt' ) {
       $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, $iv);
       $output = base64_encode($output);
   }
   else if( $action == 'decrypt' ){
       $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
       $output = rtrim($output, "");
   }
   return $output;
} 
public function emailsignupfacebookAction()             /************* edited by Poulami ***************/
{
    $email = $_POST['eid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pass1 = md5($email);
    $pass = $pass1."abcd1234";
    
    $protocol = '';
    if (isset($_SERVER['HTTPS']) &&
       ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'HTTPS') {
         $protocol = 'https://';
        }
        else {
        $protocol = 'http://';
           }
    // echo $_SERVER['SERVER_PROTOCOL'].$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    
    $url = $protocol.$_SERVER["SERVER_NAME"];
    $body = "Dear ".$fname." ,
    
    Thank you for signing up for Smartfanpage. It's great to have you on board.
    
    To get started with publishing campaigns, please go to the following link: ".$url."/index/createpassword/".$pass." .
    
    After you have succesfully signed you can start with:
    
        Creating campaigns offered by the Smartfanpage community
        Start getting useful user data to increase your sales
        Ask developers from the community to develop one of your great ideas for a brand new campaign.
    
    If you are interested for more info or you just need a live demo to get started. Please reply to this e-mail.
    
    Kind regards,
    Koen van de Wetering
    
    Logo Smartfanpage
    
    Founder | Smartfanpage.com
    +31 88 1415 001 | Liessentstraat 9a - 5505 AH - Uden";    
    
    $message = new Message();
    $message->addTo($email)
    ->addFrom('info@smartfanpage.com')
    ->setSubject('smartfanpage Create Password')
    ->setBody($body);
    $smtpOptions = new \Zend\Mail\Transport\SmtpOptions();      
    $smtpOptions->setHost('smtp.mandrillapp.com')
    ->setConnectionClass('login')
    ->setName('smtp.mandrillapp.com')
    ->setConnectionConfig(array(
    'username' => 'info@smartfanpage.com',
    'password' => 'fv7M_K1TFO9LgCaEdIVhgw',
    'ssl' => 'tls',
    'port'=>587,
    ));      
    $transport = new \Zend\Mail\Transport\Smtp($smtpOptions);
    $transport->send($message);
    
    $contentone=$this->getpublisherTable()->updateDetails($email,$pass1,$fname,$lname);
    
    echo $contentone;
    exit;
}
   
public function emailsignupAction()
{
    $email = $_POST['eid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    $protocol = '';
    
    if (isset($_SERVER['HTTPS']) &&
       ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'HTTPS') {
         $protocol = 'https://';
        }
        else {
        $protocol = 'http://';
           }
    // echo $_SERVER['SERVER_PROTOCOL'].$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $url       = $protocol.$_SERVER["SERVER_NAME"];      
    $chkemail  = $this->getpublisherTable()->selectEmail($email);
    $pass1     = md5($email);
    $pass      = $pass1."abcd1234";
    
    if($chkemail[0]['password'] != "")
    {
        echo "2";
        exit;
    }
    else if(!empty($chkemail) && $chkemail[0]['fbuser'] == "1")
    {
     echo "3";
     exit;          
    } 
    
    else
    {
        $body = "Dear ".$fname." ,
    
        Thank you for signing up for Smartfanpage. It's great to have you on board.
        
        To get started with publishing campaigns, please go to the following link:". $url."/index/createpassword/".$pass." .
        
        After you have succesfully signed you can start with:
        
            Creating campaigns offered by the Smartfanpage community
            Start getting useful user data to increase your sales
            Ask developers from the community to develop one of your great ideas for a brand new campaign.
        
        If you are interested for more info or you just need a live demo to get started. Please reply to this e-mail.
        
        Kind regards,
        Koen van de Wetering
        
        Logo Smartfanpage
        
        Founder | Smartfanpage.com
        +31 88 1415 001 | Liessentstraat 9a - 5505 AH - Uden";               
        
        $message = new Message();
        $message->addTo($email)
        ->addFrom('info@smartfanpage.com')
        ->setSubject('smartfanpage Create Password')
        ->setBody($body);
        $smtpOptions = new \Zend\Mail\Transport\SmtpOptions();
        $smtpOptions->setHost('smtp.mandrillapp.com')
        ->setConnectionClass('login')
        ->setName('smtp.mandrillapp.com')
        ->setConnectionConfig(array(
        'username' => 'info@smartfanpage.com',
        'password' => 'fv7M_K1TFO9LgCaEdIVhgw',
        'ssl' => 'tls',
        'port'=>587,
        ));
        $transport = new \Zend\Mail\Transport\Smtp($smtpOptions);
        $transport->send($message);
        
        $contentone=$this->getpublisherTable()->saveAll($email,$pass1,$fname,$lname);
        echo $contentone;
        exit;
    }
}
   
public function directSignupAction()
{
    $email = $_POST['email'];
    $name = $_POST['name'];  
    $protocol = '';
    
    if (isset($_SERVER['HTTPS']) &&
       ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'HTTPS') {
         $protocol = 'https://';
        }
        else {
        $protocol = 'http://';
           }
    
    $url       = $protocol.$_SERVER["SERVER_NAME"];      
    $chkemail  = $this->getpublisherTable()->selectEmail($email);
    $pass1     = md5($email);
    $pass      = $pass1."abcd1234";
    
    if(count($chkemail)==1)
    {

        echo "2";
        exit;
    }
       
    else
    {
        $body = '<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><p>Dear '.$name.',</p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="padding-left:50px;"><p style="margin:0;">Thank you for signing up for Smartfanpage. It\'s great to have you on board.</p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="padding-left:50px;"><p style="margin:0;">To get started with publishing campaigns, please go to the following link:<a href="'.$url.'/index/createpassword/'.$pass.'">'.$url.'/index/createpassword/'.$pass.'</a></p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="padding-left:50px;"><strong>After you have succesfully signed you can start with:</strong></td>
  </tr>
  <tr>
    <td style="padding-left:50px;">
    	<ul>
        	<li>Creating campaigns offered by the Smartfanpage community</li>
        	<li>Start getting useful user data to increase your sales</li>
        	<li>Ask developers from the community to develop one of your great ideas for a brand new campaign.</li>
        </ul>
    </td>
  </tr>
  <tr>
    <td style="padding-left:50px;"><p style="margin:0;">If you are interested for more info or you just need a live demo to get started. Please reply to this e-mail.</p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="padding-left:50px;"><p style="margin:0;">Kind regards,<br />
        Koen van de Wetering</p>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="padding-left:50px;"><img src="'.$url.'/img/createPasswordMailLogo.jpg" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="padding-left:50px;"><p style="margin:0;">Founder | <a href="http://www.smartfanpage.com/" target="_blank">Smartfanpage.com</a><br />
        +31 88 1415 001 | Liessentstraat 9a - 5405 AH - Uden</p></td>
  </tr>
</table>';               
        
        $html = new MimePart($body);  
        $html->type = "text/html";
        $body2 = new MimeMessage();  
        $body2->setParts(array($html,));  
   
        $message = new Message();
        $message->addTo($email)
        ->addFrom('info@smartfanpage.com')
        ->setSubject('smartfanpage Create Password')
        ->setBody($body2);
        $smtpOptions = new \Zend\Mail\Transport\SmtpOptions();
        $smtpOptions->setHost('smtp.mandrillapp.com')
        ->setConnectionClass('login')
        ->setName('smtp.mandrillapp.com')
        ->setConnectionConfig(array(
        'username' => 'info@smartfanpage.com',
        'password' => 'fv7M_K1TFO9LgCaEdIVhgw',
        'ssl' => 'tls',
        'port'=>587,
        ));
        $transport = new \Zend\Mail\Transport\Smtp($smtpOptions);
        $transport->send($message);
        
        $contentone=$this->getpublisherTable()->saveHomeUser($email,$pass1,$name);
        echo $contentone;
        exit;
    }
}
   
public function privacypolicyAction()
{
$this->layout('layout/indexlayout.phtml');     
$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');
$fetchid= 3;
$result = $this->getpagesheaderTable()->fetchAll($fetchid);
$contentone =$this->getpublisherTable()->selectUser1($sid);
if($sid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
    }
 $contentone=$this->getprivacypolicyTable()->fetchAll();
     
        
    return new ViewModel(array('contentpass'=>$contentone,'sid'=>$sid,'results'=>$result)); 
     
}
       
public function becomepublisherAction()
{
if($this->getRequest()->getPost('allSearch'))
{
        
        $user_session = new Container('loginId');
        $sid = $user_session->offsetGet('loginId');
        $result = $this->getpublisherTable()->selectUser1($sid); 
        if($sid != "")
        {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
        }
        $this->layout('layout/becomepublisher1.phtml');
        $request = $this->getRequest();
        $searchItem = $request->getPost('srchItem');
        $searchFirstName = $this->getDeveloperTable()->searchfName($searchItem);
        $searchLastName = $this->getDeveloperTable()->searchlName($searchItem); 
        $search_arry = array();
        foreach($searchFirstName as $searchq)
        {
            $search_arry[] = $searchq->id;
        }
        foreach($searchLastName as $searcha)
        {
            if(!in_array($searcha->id,$search_arry))
            {
               $search_arry[] = $searcha->id; 
            }
        }
        $searchresults = array();
        $i=0;
        foreach($search_arry as $srchs)
        {
        $searchResult = $this->getDeveloperTable()->getDeveloperWithId($srchs);
        $searchresults[$i]=$searchResult;
        $i++;
        }
       // print_r($searchresults);exit;
        $contents=$this->getbecomepublisherbannerTable()->fetchAll('4');
        return new ViewModel(array('contentpass'=>$searchresults,'content'=>$contents,'sid'=>$sid));
}
else
{
$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');
$contentone =$this->getpublisherTable()->selectUser1($sid);
if($sid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
    }
$this->layout('layout/becomepublisher1.phtml');
$contents=$this->getbecomepublisherbannerTable()->fetchAll('4');
$contentone=$this->getDeveloperTable()->fetchAll();
//print_r($contentone);exit;
return new ViewModel(array('contentpass'=>$contentone,'content'=>$contents,'sid'=>$sid));
}
    
}    
    
public function developersAction()
{

    
} 
    
public function marketingAction()
{ 
	$this->layout('layout/marketinglayout.phtml');
	
	$devid = $this->getEvent()->getRouteMatch()->getParam('id');
	$devid2 = $this->getEvent()->getRouteMatch()->getParam('pId');

	
	$this->layout()->setVariables(array(
		'devlink'=>$devid2
	));
	$user_session = new Container('loginId');
	$sid = $user_session->offsetGet('loginId');
	$contentone =$this->getpublisherTable()->selectUser1($sid);
	if($sid != "")
	{
		$user_session = new Container('sfpName');
		$sids = $user_session->offsetGet('sfpName');
		if($contentone[0]['fbName']!=""){
			$this->layout()->setVariables(array(
					'uname' => $contentone[0]['fbName'],
					'sfpuname' => $contentone[0]['fname'],
					'city' => $contentone[0]['hometown'],
					'fbuser'=>$contentone[0]['fbuser'],
					'sfpuser'=>$contentone[0]['sfpuser'],
					'sfpnm'=>$sids
			));
		}
		else{
			$this->layout()->setVariables(array(
					'uname' => $contentone[0]['fname'],
					'sfpuname' => $contentone[0]['fname'],
					'city' => $contentone[0]['hometown'],
					'fbuser'=>$contentone[0]['fbuser'],
					'sfpuser'=>$contentone[0]['sfpuser'],
					'sfpnm'=>$sids
			));
		}
	}
	if($devid2 != "")
	{
	
	
      $protocol = '';
    if (isset($_SERVER['HTTPS']) &&
       ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'HTTPS') {
         $protocol = 'https://';
        }
        else {
        $protocol = 'http://';
           }
   // echo $_SERVER['SERVER_PROTOCOL'].$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $url = $protocol.$_SERVER["SERVER_NAME"];
if($_POST['count'] == 1)
    {
    	$count = 0;
        $email = $_POST['eid'];
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $user_session = new Container('loginId');
        $sid = $user_session->offsetGet('loginId');
        $tempid = $_POST['tempid'];
        if($sid == "")
            {
                $user_session = new Container('devId');
                $did = $user_session->offsetGet('devId');
                if($did != "")
                    {
                        $sid = $did;  
                    }
                else
                    {
                        $sid = "0"; 
                    }
            }
        $data = array(
        'eId' => $email,
        'name' => $name,
        'comment' => $comment,
        'timeStamp'=>date("F j, Y, g:i a"),
        'uid'=>$sid,
        'tempid'=>$tempid
        );
        
        $id = $this->getuserCommentTable()->insertcom($data); 
        $comments = $this->getuserCommentTable()->selectcomment($tempid);
        $data1 = "";
        foreach($comments as $com)
            {
            if($com->tempid == $tempid)
                {
                    $uid = $com->uid;
                    $result =$this->getpublisherTable()->selectUser1($uid);
                    if(empty($result) && $uid != "0")
                        {
                            $result1 = $this->getDeveloperTable()->fetchdetails($uid);
                        }
                    
                    if(empty($result) && empty($result1))
                        {
                             
                            $img = $url."/img/no_img1.png";  
                            $data=array(
                            'id' => $com->id,
                            'profimage'=>$img,
                            'tempid'=>$tempid
                            );
                            $this->getuserCommentTable()->updatecom($data,$com->id,$tempid);
                        }
                    else if(!empty($result))
                        {
                            if($result[0]['fbName'] !="demo" && $result[0]['fbLastName'] !="user")
                                {
                                    $img = "https://graph.facebook.com/".$result[0]['fbId']."/picture?type=small";
                                    $data=array(
                                    'id' => $com->id,
                                    'profimage'=>$img,
                                    'tempid'=>$tempid
                                    );
                                    $this->getuserCommentTable()->updatecom($data,$com->id,$tempid);
                                }
                            else
                                {
                                    $img = $url."/img/no_img1.png";
                                    $data=array(
                                    'id' => $com->id,
                                    'profimage'=>$img,
                                    'tempid'=>$tempid
                                    );
                                    $this->getuserCommentTable()->updatecom($data,$com->id,$tempid);
                                }
                        }
                    else if(!empty($result1))
                        {
                            $img = $result1->cimage;
                            $data=array(
                            'id' => $com->id,
                            'profimage'=>$img,
                            'tempid'=>$tempid
                            );
                            $this->getuserCommentTable()->updatecom($data,$com->id,$tempid);
                        }
                }
            }
        $comments1 = $this->getuserCommentTable()->selectcomment($tempid);
        foreach($comments1 as $com1)
        {
            if($com1->tempid == $tempid)
            {
                $data1 .= '<li class="" id="#"><div class="commnt-fig"><figure><img src="'.$com1->profimage.'" alt="" style="width:50px;height:50px;"></figure></div><div class="commnt-raw"><span><h5>'.$com1->name.'</h5><p>'.$com1->timeStamp.'</p></span><span>'.$com1->comment.'</span></div></li>';
            }
        }
        echo "<ul>".$data1."</ul>";
        exit;
    }

    	
    	
        $tempid = $this->getEvent()->getRouteMatch()->getParam('id');
        $template = $this->getTemplateTable()->fetchAll($tempid);
        $devId = $template->devId;
        $getdev = $this->getDeveloperTable()->fetchdetails($devId);
        $getpromote = $this->getuserTemplateTable()->fetchpromote($tempid); 
        $getpromotes = array();
        foreach($getpromote as $promote)
            {
                $getpromotes[]= $this->getpublisherTable()->selectUser1($promote->user_id);
            }  
        $comments = $this->getuserCommentTable()->selectcomment($tempid);
        
        $regpromote = $this->getpromoteTable()->selectpromote($devId,$tempid);  
        
        
        $selectrates1 = $this->getratingTable()->selectrate($tempid);
        //echo $devid."-".$devid2;exit; //six
        $devid = urldecode($devid);
        $devid2 = urldecode($devid2);
        /*$explodedUrl = explode("/promote/",$url);
         $developerAndTemplate = explode("break/",$explodedUrl[1]);*/
        //*****exploded developer from url*****//
         
        $explodedDeveloperDetails = explode("|",$devid);
        $developerId= $explodedDeveloperDetails[0];
        $developerIdEncrypted = $explodedDeveloperDetails[1];
         
        $encryptedDeveloperId =  $this->encrypt_decrypt('encrypt', $developerId);
        //echo "<br/>";
        $originalDeveloperEncryptedId = str_replace("encoded","/",$developerIdEncrypted);
        $originalDeveloperEncryptedId = str_replace(" ","+",$originalDeveloperEncryptedId);
         
        //*****exploded template from url*****//
         
        $explodedTemplateDetails = explode("|",$devid2);
        $templateId= $explodedTemplateDetails[0];
        $regscreen = $this->getscreenshotsTable()->selectAllscreen($developerId);
  /* echo $templateId."<br/>11";
        print_r($regscreen);exit;*/
        $templateIdEncrypted = $explodedTemplateDetails[1];
         
        $encryptedTemplateId =  $this->encrypt_decrypt('encrypt', $templateId);
         
        $originalTemplateEncryptedId = str_replace("encoded","/",$templateIdEncrypted);
        $originalTemplateEncryptedId = str_replace(" ","+",$originalTemplateEncryptedId);
        
        if (($encryptedDeveloperId == $originalDeveloperEncryptedId ) && ($encryptedTemplateId == $originalTemplateEncryptedId))
        {
        return new ViewModel(array('publisherDetails'=>$contentone,'template1'=>$template,'comment'=>$comments,'developerIdEncrypted'=>$templateIdEncrypted,'promotion' => $getpromotes, 'promote' => $regpromote,'screen' => $regscreen,'developer' =>$getdev,'developerid'=>$developerId,'devlink'=>$templateId,'rating'=>$selectrates1 ));   
        }
        else{
        	 
        	$this->redirect()->toRoute('application/default',array('controller'=>'Error','action'=>'index'));
        }
$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');
$contentone =$this->getpublisherTable()->selectUser1($sid);
if($sid != "")
    {
        $tempid = $this->getEvent()->getRouteMatch()->getParam('id');
        $template = $this->getTemplateTable()->fetchAll($tempid);
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
       /* if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}*/
        
       
        
        $devId = $template->devId;
        $getdev = $this->getDeveloperTable()->fetchdetails($devId);
        $getpromote = $this->getuserTemplateTable()->fetchpromote($tempid); 
        $getpromotes = array();
        foreach($getpromote as $promote)
            {
                $getpromotes[]= $this->getpublisherTable()->selectUser1($promote->user_id);
            }  
        $comments = $this->getuserCommentTable()->selectcomment($tempid);
        $regpromote = $this->getpromoteTable()->selectpromote($devId,$tempid);  
        
       
        $selectrates1 = $this->getratingTable()->selectrate($tempid);
        // echo $devid."-".$devid2;exit; //one
        $devid = urldecode($devid);
        $devid2 = urldecode($devid2);
        /*$explodedUrl = explode("/promote/",$url);
         $developerAndTemplate = explode("break/",$explodedUrl[1]);*/
        //*****exploded developer from url*****//
         
        $explodedDeveloperDetails = explode("|",$devid);
        $developerId= $explodedDeveloperDetails[0];
        $developerIdEncrypted = $explodedDeveloperDetails[1];
         
        $encryptedDeveloperId =  $this->encrypt_decrypt('encrypt', $developerId);
        //echo "<br/>";
        $originalDeveloperEncryptedId = str_replace("encoded","/",$developerIdEncrypted);
        $originalDeveloperEncryptedId = str_replace(" ","+",$originalDeveloperEncryptedId);
         
        //*****exploded template from url*****//
         
        $explodedTemplateDetails = explode("|",$devid2);
        $templateId= $explodedTemplateDetails[0];
        $regscreen = $this->getscreenshotsTable()->selectAllscreen($templateId);
      /*echo $templateId."<br/>22";
        print_r($regscreen);exit;*/
        $templateIdEncrypted = $explodedTemplateDetails[1];
         
        $encryptedTemplateId =  $this->encrypt_decrypt('encrypt', $templateId);
         
        $originalTemplateEncryptedId = str_replace("encoded","/",$templateIdEncrypted);
        $originalTemplateEncryptedId = str_replace(" ","+",$originalTemplateEncryptedId);
        
        if (($encryptedDeveloperId == $originalDeveloperEncryptedId ) && ($encryptedTemplateId == $originalTemplateEncryptedId))
        {
        return new ViewModel(array('publisherDetails'=>$contentone,'template1'=>$template,'comment'=>$comments,'promotion' => $getpromotes,'developerIdEncrypted'=>$templateIdEncrypted,'promote' => $regpromote,'screen' => $regscreen,'developer' =>$getdev,'rating'=>$selectrates1,'developerid'=>$devid,'devlink'=>$devid2,'sid'=>$sid )); 

        }
        else{
        	 
        	$this->redirect()->toRoute('application/default',array('controller'=>'Error','action'=>'index'));
        }
    }
else
    {
        $tempid = $this->getEvent()->getRouteMatch()->getParam('id');
       
        $template = $this->getTemplateTable()->fetchAll($tempid);
      
         $this->layout()->setVariables(array(
        'title' => $template->templateName,
        'description' => $template->templateDesc
        
        ));
        $devId = $template->devId;
        $getdev = $this->getDeveloperTable()->fetchdetails($devId); 
        $getpromote = $this->getuserTemplateTable()->fetchpromote($tempid); 
        $getpromotes = array();
        foreach($getpromote as $promote)
        {
            $getpromotes[]= $this->getpublisherTable()->selectUser1($promote->user_id);
        }  
        $comments = $this->getuserCommentTable()->selectcomment($tempid);
        $regpromote = $this->getpromoteTable()->selectpromote($devId,$tempid);  
        
        
        
        $selectrates1 = $this->getratingTable()->selectrate($tempid);
        // echo $devid."-".$devid2;exit; //two
        $devid = urldecode($devid);
        $devid2 = urldecode($devid2);
        /*$explodedUrl = explode("/promote/",$url);
         $developerAndTemplate = explode("break/",$explodedUrl[1]);*/
        //*****exploded developer from url*****//
         
        $explodedDeveloperDetails = explode("|",$devid);
        $developerId= $explodedDeveloperDetails[0];
        $developerIdEncrypted = $explodedDeveloperDetails[1];
         
        $encryptedDeveloperId =  $this->encrypt_decrypt('encrypt', $developerId);
        //echo "<br/>";
        $originalDeveloperEncryptedId = str_replace("encoded","/",$developerIdEncrypted);
        $originalDeveloperEncryptedId = str_replace(" ","+",$originalDeveloperEncryptedId);
         
        //*****exploded template from url*****//
         
        $explodedTemplateDetails = explode("|",$devid2);
        $templateId= $explodedTemplateDetails[0];
        $regscreen = $this->getscreenshotsTable()->selectAllscreen($templateId );
      /*echo $templateId."<br/>33";
        print_r($regscreen);exit;*/
        $templateIdEncrypted = $explodedTemplateDetails[1];
         
        $encryptedTemplateId =  $this->encrypt_decrypt('encrypt', $templateId);
         
        $originalTemplateEncryptedId = str_replace("encoded","/",$templateIdEncrypted);
        $originalTemplateEncryptedId = str_replace(" ","+",$originalTemplateEncryptedId);
        
        if (($encryptedDeveloperId == $originalDeveloperEncryptedId ) && ($encryptedTemplateId == $originalTemplateEncryptedId))
        {
        return new ViewModel(array('publisherDetails'=>$contentone,'template1'=>$template,'comment'=>$comments,'developerIdEncrypted'=>$templateIdEncrypted,'promotion' => $getpromotes, 'promote' => $regpromote,'screen' => $regscreen,'developer' =>$getdev,'rating'=>$selectrates1,'developerid'=>$developerId,'devlink'=>$templateId ));      
    
        }
        else{
        	 
        	$this->redirect()->toRoute('application/default',array('controller'=>'Error','action'=>'index'));
        }
    }

//if($sid != "")
//    {
//    }
//else
//    {
//    }
    }
    else
    { 
    	$protocol = '';
    	if (isset($_SERVER['HTTPS']) &&
    			($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    			isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    			$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'HTTPS') {
    		$protocol = 'https://';
    	}
    	else {
    		$protocol = 'http://';
    	}
    	// echo $_SERVER['SERVER_PROTOCOL'].$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    	$url = $protocol.$_SERVER["SERVER_NAME"];
    	if($_POST['count'] == 1)
    	{
    		$email = $_POST['eid'];
    		$name = $_POST['name'];
    		$comment = $_POST['comment'];
    		$user_session = new Container('loginId');
    		$sid = $user_session->offsetGet('loginId');
    		$tempid = $_POST['tempid'];
    		if($sid == "")
    		{
    			$user_session = new Container('devId');
    			$did = $user_session->offsetGet('devId');
    			if($did != "")
    			{
    				$sid = $did;
    			}
    			else
    			{
    				$sid = "0";
    			}
    		}
    		$data = array(
    				'eId' => $email,
    				'name' => $name,
    				'comment' => $comment,
    				'timeStamp'=>date("F j, Y, g:i a"),
    				'uid'=>$sid,
    				'tempid'=>$tempid
    		);
    	
    		$id = $this->getuserCommentTable()->insertcom($data);
    		$comments = $this->getuserCommentTable()->selectcomment($tempid);
    		$countComment= count($comments);
    		$data1 = "";
    		foreach($comments as $com)
    		{
    			if($com->tempid == $tempid)
    			{
    				$uid = $com->uid;
    				$result =$this->getpublisherTable()->selectUser1($uid);
    				if(empty($result) && $uid != "0")
    				{
    					$result1 = $this->getDeveloperTable()->fetchdetails($uid);
    				}
    	
    				if(empty($result) && empty($result1))
    				{
    					 
    					$img = $url."/img/no_img1.png";
    					$data=array(
    							'id' => $com->id,
    							'profimage'=>$img,
    							'tempid'=>$tempid
    					);
    					$this->getuserCommentTable()->updatecom($data,$com->id,$tempid);
    				}
    				else if(!empty($result))
    				{
    					if($result[0]['fbName'] !="demo" && $result[0]['fbLastName'] !="user")
    					{
    						$img = "https://graph.facebook.com/".$result[0]['fbId']."/picture?type=small";
    						$data=array(
    								'id' => $com->id,
    								'profimage'=>$img,
    								'tempid'=>$tempid
    						);
    						$this->getuserCommentTable()->updatecom($data,$com->id,$tempid);
    					}
    					else
    					{
    						$img = $url."/img/no_img1.png";
    						$data=array(
    								'id' => $com->id,
    								'profimage'=>$img,
    								'tempid'=>$tempid
    						);
    						$this->getuserCommentTable()->updatecom($data,$com->id,$tempid);
    					}
    				}
    				else if(!empty($result1))
    				{
    					$img = $result1->cimage;
    					$data=array(
    							'id' => $com->id,
    							'profimage'=>$img,
    							'tempid'=>$tempid
    					);
    					$this->getuserCommentTable()->updatecom($data,$com->id,$tempid);
    				}
    			}
    		}
    		$comments1 = $this->getuserCommentTable()->selectcomment($tempid);
    		foreach($comments1 as $com1)
    		{
    			if($com1->tempid == $tempid)
    			{
    				$data1 .= '<li class="" id="#"><div class="commnt-fig"><figure><img src="'.$com1->profimage.'" alt="" style="width:50px;height:50px;"></figure></div><div class="commnt-raw"><span><h5>'.$com1->name.'</h5><p>'.$com1->timeStamp.'</p></span><span>'.$com1->comment.'</span></div></li>';
    			}
    		}
    		echo "<ul>".$data1."</ul>".'|'.$countComment;
    		exit;
    	}
    	
    	 
    	 
    	$tempid = $this->getEvent()->getRouteMatch()->getParam('id');
    	$template = $this->getTemplateTable()->fetchAll($tempid);
    	$devId = $template->devId;
    	$getdev = $this->getDeveloperTable()->fetchdetails($devId);
    	$getpromote = $this->getuserTemplateTable()->fetchpromote($tempid);
    	$getpromotes = array();
    	foreach($getpromote as $promote)
    	{
    		$getpromotes[]= $this->getpublisherTable()->selectUser1($promote->user_id);
    	}
    	$comments = $this->getuserCommentTable()->selectcomment($tempid);
    	$regpromote = $this->getpromoteTable()->selectpromote($devId,$tempid);
    	
    	
    	$selectrates1 = $this->getratingTable()->selectrate($tempid);
        //echo $devid."-".$devid2;exit; //three
    	$devid = urldecode($devid);
    	$devid2 = urldecode($devid2);
    	
    	/*$explodedUrl = explode("/promote/",$url);
    	 $developerAndTemplate = explode("break/",$explodedUrl[1]);*/
    	//*****exploded developer from url*****//
    	 
    	$explodedDeveloperDetails = explode("|",$devid);
    	$developerId= $explodedDeveloperDetails[0];
    	$developerIdEncrypted = $explodedDeveloperDetails[1];
    	 
    	$encryptedDeveloperId =  $this->encrypt_decrypt('encrypt', $developerId);
    	//echo "<br/>";
    	$originalDeveloperEncryptedId = str_replace("encoded","/",$developerIdEncrypted);
    	$originalDeveloperEncryptedId = str_replace(" ","+",$originalDeveloperEncryptedId);
    	 
    	//*****exploded template from url*****//
    	 
    	$explodedTemplateDetails = explode("|",$devid2);
    
    	$templateId= $explodedTemplateDetails[0];
    	$regscreen = $this->getscreenshotsTable()->selectAllscreen($developerId);
    	/*echo $templateId."<br/>44";
    	print_r($regscreen);exit;*/
    	$templateIdEncrypted = $explodedTemplateDetails[1];
    	 
    	$encryptedTemplateId =  $this->encrypt_decrypt('encrypt', $templateId);
    	 
    	$originalTemplateEncryptedId = str_replace("encoded","/",$templateIdEncrypted);
    	$originalTemplateEncryptedId = str_replace(" ","+",$originalTemplateEncryptedId);
    	
    	if ($encryptedDeveloperId == $originalDeveloperEncryptedId )
    	{
    	return new ViewModel(array('publisherDetails'=>$contentone,'template1'=>$template,'comment'=>$comments,'developerIdEncrypted'=>$templateIdEncrypted,'promotion' => $getpromotes, 'promote' => $regpromote,'screen' => $regscreen,'developer' =>$getdev,'developerid'=>$devid,'devlink'=>$devid2,'rating'=>$selectrates1,'developerid'=>$developerId,'devlink'=>$templateId ));
    	}
    	else{
    		
    		 
    		$this->redirect()->toRoute('application/default',array('controller'=>'Error','action'=>'index'));
    	}
    	$user_session = new Container('loginId');
    	$sid = $user_session->offsetGet('loginId');
    	$contentone =$this->getpublisherTable()->selectUser1($sid);
    	if($sid != "")
    	{
    		$tempid = $this->getEvent()->getRouteMatch()->getParam('id');
    		$template = $this->getTemplateTable()->fetchAll($tempid);
    		$user_session = new Container('sfpName');
    		$sids = $user_session->offsetGet('sfpName');
    		if($contentone[0]['fbName']!=""){
    			$this->layout()->setVariables(array(
    					'uname' => $contentone[0]['fbName'],
    					'sfpuname' => $contentone[0]['fname'],
    					'city' => $contentone[0]['hometown'],
    					'fbuser'=>$contentone[0]['fbuser'],
    					'sfpuser'=>$contentone[0]['sfpuser'],
    					'sfpnm'=>$sids
    			));
    		}
    		else{
    			$this->layout()->setVariables(array(
    					'uname' => $contentone[0]['fname'],
    					'sfpuname' => $contentone[0]['fname'],
    					'city' => $contentone[0]['hometown'],
    					'fbuser'=>$contentone[0]['fbuser'],
    					'sfpuser'=>$contentone[0]['sfpuser'],
    					'sfpnm'=>$sids
    			));
    		}
    	
    		 
    	
    		$devId = $template->devId;
    		$getdev = $this->getDeveloperTable()->fetchdetails($devId);
    		$getpromote = $this->getuserTemplateTable()->fetchpromote($tempid);
    		$getpromotes = array();
    		foreach($getpromote as $promote)
    		{
    			$getpromotes[]= $this->getpublisherTable()->selectUser1($promote->user_id);
    		}
    		$comments = $this->getuserCommentTable()->selectcomment($tempid);
    		$regpromote = $this->getpromoteTable()->selectpromote($devId,$tempid);
    		
    	
    		$selectrates1 = $this->getratingTable()->selectrate($tempid);
    		// echo $devid."-".$devid2;exit; //four
    		$devid = urldecode($devid);
    		$devid2 = urldecode($devid2);
    		/*$explodedUrl = explode("/promote/",$url);
    		 $developerAndTemplate = explode("break/",$explodedUrl[1]);*/
    		//*****exploded developer from url*****//
    		
    		$explodedDeveloperDetails = explode("|",$devid);
    		$developerId= $explodedDeveloperDetails[0];
    		$developerIdEncrypted = $explodedDeveloperDetails[1];
    		
    		$encryptedDeveloperId =  $this->encrypt_decrypt('encrypt', $developerId);
    		//echo "<br/>";
    		$originalDeveloperEncryptedId = str_replace("encoded","/",$developerIdEncrypted);
    		$originalDeveloperEncryptedId = str_replace(" ","+",$originalDeveloperEncryptedId);
    		
    		//*****exploded template from url*****//
    		
    		$explodedTemplateDetails = explode("|",$devid2);
    		$templateId= $explodedTemplateDetails[0];
    		$regscreen = $this->getscreenshotsTable()->selectAllscreen($templateId);
    		/*echo $templateId."<br/>55";
    		print_r($regscreen);exit;*/
    		$templateIdEncrypted = $explodedTemplateDetails[1];
    		
    		$encryptedTemplateId =  $this->encrypt_decrypt('encrypt', $templateId);
    		
    		$originalTemplateEncryptedId = str_replace("encoded","/",$templateIdEncrypted);
    		$originalTemplateEncryptedId = str_replace(" ","+",$originalTemplateEncryptedId);
    		 
    		if (($encryptedDeveloperId == $originalDeveloperEncryptedId ) && ($encryptedTemplateId == $originalTemplateEncryptedId))
    		{
    		return new ViewModel(array('publisherDetails'=>$contentone,'template1'=>$template,'comment'=>$comments,'promotion' => $getpromotes, 'developerIdEncrypted'=>$templateIdEncrypted,'promote' => $regpromote,'screen' => $regscreen,'developer' =>$getdev,'rating'=>$selectrates1,'sid'=>$sid,'developerid'=>$developerId,'devlink'=>$templateId ));
    	
    		}
    		else{
    			
    			$this->redirect()->toRoute('application/default',array('controller'=>'Error','action'=>'index'));
    		}
    	}
    	else
    	{
    		$tempid = $this->getEvent()->getRouteMatch()->getParam('id');
    		//*****exploded template from url*****//
    		
    		$explodedTemplateDetails = explode("|",$tempid);
    		$templateId= $explodedTemplateDetails[0];
    		
    		$templateIdEncrypted = $explodedTemplateDetails[1];
    		
    		$encryptedTemplateId =  $this->encrypt_decrypt('encrypt', $templateId);
    		
    		$originalTemplateEncryptedId = str_replace("encoded","/",$templateIdEncrypted);
    		$originalTemplateEncryptedId = str_replace(" ","+",$originalTemplateEncryptedId);
    		  
    		if ($encryptedTemplateId == $originalTemplateEncryptedId)
    		{
    		
    		$template = $this->getTemplateTable()->fetchAll($tempid);
    	
    		$this->layout()->setVariables(array(
    				'title' => $template->templateName,
    				'description' => $template->templateDesc
    	
    		));
    		$devId = $template->devId;
    		$getdev = $this->getDeveloperTable()->fetchdetails($devId);
    		$getpromote = $this->getuserTemplateTable()->fetchpromote($templateId);
    		$getpromotes = array();
    		foreach($getpromote as $promote)
    		{
    			$getpromotes[]= $this->getpublisherTable()->selectUser1($promote->user_id);
    		}
    		$comments = $this->getuserCommentTable()->selectcomment($templateId);
    		$regpromote = $this->getpromoteTable()->selectpromote($devId,$templateId);
    		$regscreen = $this->getscreenshotsTable()->selectAllscreen($templateId);
    		/*echo $templateId."<br/>66";
         print_r($regscreen);exit;*/
    		$selectrates1 = $this->getratingTable()->selectrate($templateId);
    	   //echo $devid."-".$devid2;exit; //five
    		//$devid = $templateId;
    		
    	
    		/*$explodedUrl = explode("/promote/",$url);
    		 $developerAndTemplate = explode("break/",$explodedUrl[1]);*/
    		//*****exploded developer from url*****//
    		
           // echo $devid;exit;
    		
    		return new ViewModel(array('publisherDetails'=>$contentone,'template1'=>$template,'comment'=>$comments,'promotion' => $getpromotes, 'promote' => $regpromote,'screen' => $regscreen,'developer' =>$getdev,'rating'=>$selectrates1,'developerid'=>$devid,'devlink'=>$devid2 ));
    		
    		}
    		else{
    			 
    			$this->redirect()->toRoute('application/default',array('controller'=>'Error','action'=>'index'));
    		}
    		}
    	
    	//if($sid != "")
    		//    {
    		//    }
    		//else
    			//    {
    			//    }
    
    }
}



public function ratestarAction()
{
	$rate = $_POST['rate'];
	$tempid = $_POST['tempid'];
	$selectrates = $this->getratingTable()->selectrate($tempid);
	$user_session = new Container('loginId');
	$sid = $user_session->offsetGet('loginId');
	if($sid != "")
	{
		$ratedeveloper = $this->getpublisherTable()->selectUser1($sid);
		if($ratedeveloper[0]['rating'] != "")
		{
			echo "0";
			exit;
		}
	}
	$user_session = new Container('devId');
	$did = $user_session->offsetGet('devId');
	if($did != "")
	{
		$ratedeveloper = $this->getDeveloperTable()->selectrow($did);
		if($ratedeveloper->rating != "")
		{
			echo "0";
			exit;
		}
	}
	if(empty($selectrates))
	{
		$data = array(
				'tempid' => $tempid,
				'rating' => $rate,
				'hits' => 1
		);
		$res = $this->getratingTable()->insertrate($data);
		$selectrates1 = $this->getratingTable()->selectrate($tempid);
		
		if($sid != "")
		{
			$data = array(
					'uId'=>$sid,
					'rating'=>$rate
			);
			$this->getpublisherTable()->updateUser($data,$sid);
		}
		if($did != "")
		{
			$data = array(
					'id'=>$did,
					'rating'=>$rate
			);
			$this->getDeveloperTable()->updateReg1($data,$did);
		}
	}
	else
	{
		$hits = $selectrates[0]['hits'] + 1;
		if($sid != "")
		{
			$data = array(
					'uId'=>$sid,
					'rating'=>$rate
			);
			$this->getpublisherTable()->updateUser($data,$sid);
		}
		if($did != "")
		{
			$data = array(
					'id'=>$did,
					'rating'=>$rate
			);
			$this->getDeveloperTable()->updateReg1($data,$did);
		}
		
		$data = array(
				'tempid' => $tempid,
				'rating' => $rate,
				'hits' => $hits
		);
		$res = $this->getratingTable()->updaterate($data,$tempid);
		
	}
	echo $res;
	exit;
}


public function ratingAction()
{
$rate = $_POST['rate'];
$tempid = $_POST['tempid'];
$selectrates = $this->getratingTable()->selectrate($tempid);
$user_session = new Container('loginId');
$sid = $user_session->offsetGet('loginId');
if($sid != "")
    {
        $ratedeveloper = $this->getpublisherTable()->selectUser1($sid);  
        if($ratedeveloper[0]['rating'] != "")
            {
                echo "0";
                exit;
            }
    }
$user_session = new Container('devId');
$did = $user_session->offsetGet('devId');
if($did != "")
    {
    $ratedeveloper = $this->getDeveloperTable()->selectrow($did);  
        if($ratedeveloper->rating != "")
        {
            echo "0";
            exit;
        }   
    }
if(empty($selectrates))
    {
        $data = array(
        'tempid' => $tempid,
        'rating' => $rate,
        'hits' => 1
        );
        $res = $this->getratingTable()->insertrate($data);
        $selectrates1 = $this->getratingTable()->selectrate($tempid);
        if($res == "1")
            {
                $res = round($rate,2)."|-|".$selectrates1[0]['hits'];
            }
        if($sid != "")
            {
                $data = array(
                'uId'=>$sid,
                'rating'=>$rate
                );
                $this->getpublisherTable()->updateUser($data,$sid);    
            }
        if($did != "")
            {
                $data = array(
                'id'=>$did,
                'rating'=>$rate
                );
                $this->getDeveloperTable()->updateReg1($data,$did);    
            }
    }
else
    {
        $hits = $selectrates[0]['hits'] + 1;
        if($sid != "")
            {
                $data = array(
                'uId'=>$sid,
                'rating'=>$rate
                );
                $this->getpublisherTable()->updateUser($data,$sid);    
            }
        if($did != "")
            {
                $data = array(
                'id'=>$did,
                'rating'=>$rate
                );
                $this->getDeveloperTable()->updateReg1($data,$did);    
            }
        $rate = $selectrates[0]['rating'] + $rate;
        $data = array(
        'tempid' => $tempid,
        'rating' => $rate,
        'hits' => $hits
        );
        $res = $this->getratingTable()->updaterate($data,$tempid);
        if($res == "1")
            {
                $rate = round($rate/$hits,2);
                $res = $rate."|-|".$hits;
            }
    
    }
echo $res;
exit;  
}
    
    
public function searchtemplateAction()
{
$srch = $_POST['srch'];
$devsearch = $this->getDeveloperTable()->searchfName($srch); 
$devsearch1 = $this->getDeveloperTable()->searchlName($srch); 
$res = "";
$res1 = "";
foreach($devsearch as $dev)
    {
        $res .= $dev->fName."|-|".$dev->lName."|-|".$dev->cdesc."|-|".$dev->cimage."[|]";
    }   

foreach($devsearch1 as $dev)
    {
        $res1 .= $dev->fName."|-|".$dev->lName."|-|".$dev->cdesc."|-|".$dev->cimage."[|]";
    }   
echo $res.$res1;
exit;
}
    
public function searchcatAction()
{
$srch = $_POST['srch'];
if(stristr("neon",$srch))
    {
        $srch = "epic";
    }
$devsearch = $this->getTemplateTable()->searchcategory($srch); 
$devsearch1 = $this->getTemplateTable()->searchtemplname($srch); 
$searchcategory = "";
$searchtemplname = "";
foreach($devsearch as $dev)
    {
    if($dev->approval == "1")
        {
            if($dev->templateName == "epic")
                {
                    $searchcategory .= $dev->templateName."|-|".$dev->scImage."|/|"; 
                }
            else
                {
                    $searchcategory .= $dev->templateName."|-|".$dev->scImage."|/|";     
                } 
        }
    }   
foreach($devsearch1 as $dev)
{
if($dev->approval == "1")
    {
    if($dev->templateName == "epic")
        {
            $searchtemplname .= $dev->templateName."|-|".$dev->scImage."|/|";
        }
    else
        {
            $searchtemplname .= $dev->templateName."|-|".$dev->scImage."|/|";  
        }
    }
}   
echo $searchcategory.$searchtemplname;
exit;
}
   
//public function searchfaqAction()
//{
//    //$srch = $_POST['srch'];
//     // $searchQuestion = "";
//    //$searchAnswer = "";
//    $request = $this->getRequest();
//
//$srch = $request->getPost('srchTerm');
//
////echo $srch;exit;
//    $searchQues = $this->getfaqContainerTable()->searchingques($srch);
//    
//    $searchAns = $this->getfaqContainerTable()->searchingans($srch); 
//   $search_arry = array();
//   foreach($searchQues as $searchq)
//   {
//     $search_arry[] = $searchq->id;
//   }
//
//   foreach($searchAns as $searcha)
//   {
//    if(!in_array($searcha->id,$search_arry))
//    {
//       $search_arry[] = $searcha->id; 
//    }
//   }
//   //$searchresults = "";
//   $searchresults = array();
//   $i=0;
//    foreach($search_arry as $srchs)
//    {
//       $searchResult = $this->getfaqContainerTable()->getsearchresult($srchs);
//       // $searchresults .= $searchResult->referenceId."|-|".$searchResult->question."|-|".$searchResult->answer."|/|";
//
////   echo $searchresults;
////    exit;
//$searchresults[$i]=$searchResult;
//$i++;
//}
//$j=0;
//$k=0;
//$l=0;
//$m=0;
//$arrayOne=array();
//$arrayTwo=array();
//$arrayThree=array();
//$arrayFour=array();
//$resultfaqsfp=array();
//$resultfaqpublisher=array();
//$resultfaqpricing=array();
//$resultfaqtechnical=array();
// //print_r($searchresults);
// foreach($searchresults as $search)
// {
//     if($search->referenceId == 1)
//     {
//       // $arrayOne[$j]=$search;
//       $resultfaqsfp[$j]=$search;
//        $j++;
//     }
//      if($search->referenceId == 2)
//     {
//        //$arrayTwo[$k]=$search;
//        $resultfaqpublisher[$k]=$search;
//        $k++;
//     }
//      if($search->referenceId == 3)
//     {
//       // $arrayThree[$l]=$search;
//       $resultfaqpricing[$l]=$search;
//        $l++;
//     }
//     if($search->referenceId == 4)
//     {
//        //$arrayFour[$m]=$search;
//        $resultfaqtechnical[$m]=$search;
//        $m++;
//     }
//     //$ka=1;
// }
//// if($ka!=0)
//// {
////    $this->redirect()->toRoute('application/default',array('controller'=>'index','action'=>'faq'));
////    //return new ViewModel(array('banner'=>$contentbanner,'contentsfp'=>$resultfaqsfp,'contentpub'=>$resultfaqpublisher,'contentprice'=>$resultfaqpricing,'contenttech'=>$resultfaqtechnical));
//// }
// //print_r($arrayFour);exit;
//}            
public function documentationAction()
{
	
	$protocol = '';
	if (isset($_SERVER['HTTPS']) &&
			($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
			isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
			$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'HTTPS') {
		$protocol = 'https://';
	}
	else {
		$protocol = 'http://';
	}
	// echo $_SERVER['SERVER_PROTOCOL'].$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$url = $protocol.$_SERVER["SERVER_NAME"];
	$this->layout('layout/indexlayout.phtml');
	$devid = $this->getEvent()->getRouteMatch()->getParam('id');
    $user_session = new Container('devId');
    $sid = $user_session->offsetGet('devId');
    $bloguser=$this->getDeveloperTable()->selectrow($sid);
    $this->layout()->setVariables(array(
    		'devid'=>$devid
    ));
    return new ViewModel(array('developer'=>$bloguser,'devid'=>$devid,'dynamicPath'=>$url));
} 
    
public function blogdetailsAction()
{
$this->layout('layout/blogdetailslayout.phtml');   
$user_session = new Container('loginId');
$lid = $user_session->offsetGet('loginId');
$contentone =$this->getpublisherTable()->selectUser1($lid);
$user_session = new Container('devId');
$sid = $user_session->offsetGet('devId');
 $encryptedDeveloperId =  $this->encrypt_decrypt('encrypt', $sid);
   $encryptedDeveloperId =str_replace("/","encoded",$encryptedDeveloperId);
  $protocol = '';
        if (isset($_SERVER['HTTPS']) &&
       ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'HTTPS') {
         $protocol = 'https://';
        }
        else {
        $protocol = 'http://';
           }
       // echo $_SERVER['SERVER_PROTOCOL'].$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $url = $protocol.$_SERVER["SERVER_NAME"];
if($lid != "")
    {
        $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
    }
$blogsfp=$this->getblogdetailssTable()->fetchAll();
$contents =$this->getblogDetailsHeaderTable()->fetchAll('1');

$name=$this->getRequest()->getPost('NAME');
$email=$this->getRequest()->getPost('email');
$message=$this->getRequest()->getPost('Message');
$id = $this->getEvent()->getRouteMatch()->getParam('id');
 $details = $this->getblogoverviewTable()->getblogdetails($id); 

$this->layout()->setVariables(array(
                'metaTitle' => $details->metaTitle,
                'metaKeyword' =>$details->metaKeyword,
                'metaDescription' =>$details->metaDescription,
                ));


if($sid != "")
    {
        $bloguser=$this->getDeveloperTable()->selectrow($sid);
        $user_name = $bloguser->uname;
        $emaill = $bloguser->eId;
        $image = $bloguser->cimage;
        if($name != '' && $message != null &&  $email != null)
            {
                if($image == "")
                    {
                    $image = $url."/img/no_img1.png";   
                    }
                $date = date( 'Y-m-d H:i:s');
                $broken_array = explode(" ",$date);
                $time = $broken_array[1];
                $data = array(  
                'name'=>$name,
                'email'=>$email,
                'message'=>$message,
                'date'=>$date,
                'time'=>$time,
                'image'=>$image,
                'pageid'=>$id
                );
                $this->getblogdetailssTable()->saveUserdet($data);
                $blogsfpz=$this->getblogdetailssTable()->getdetails($id);  
                
                return new ViewModel(array('contentpass'=>$blogsfpz,'banner'=>$contents,'bloguser'=>$bloguser,'details'=>$details,'lid'=>$lid));
            }
        else
            {
               
                $blogsfpz=$this->getblogdetailssTable()->getdetails($id);
                return new ViewModel(array('contentpass'=>$blogsfpz,'banner'=>$contents,'bloguser'=>$bloguser,'details'=>$details,'lid'=>$lid));
            }
    }
else
    {
    if($name != '' && $message != null &&  $email != null)
        {
            if($image == "")
                {
                    $image = $url."/img/no_img1.png";   
                }
            $date = date( 'Y-m-d H:i:s');
            $broken_array = explode(" ",$date);
            $time = $broken_array[1];
            $data = array(  
            'name'=>$name,
            'email'=>$email,
            'message'=>$message,
            'date'=>$date,
            'time'=>$time,
            'image'=>$image,
            'pageid'=>$id
            );
            
            $this->getblogdetailssTable()->saveUserdet($data);
            
            $blogsfpz=$this->getblogdetailssTable()->getdetails($id); 
            
            return new ViewModel(array('contentpass'=>$blogsfpz,'banner'=>$contents,'details'=>$details,'lid'=>$lid));
        }
        else
        {
            $blogsfpz=$this->getblogdetailssTable()->getdetails($id);
            return new ViewModel(array(
            'contentpass' => $blogsfpz,
            'banner'=>$contents,
            'details'=>$details,
            'lid'=>$lid
            ));
            
        }
    }


} 
    
public function blogarchiveAction()
{
    $this->layout('layout/bloglayout.phtml');
    $contents=$this->getblogoverviewHeaderTable()->fetchAll('1');
    return new ViewModel(array('content'=>$contents,));   
} 
                
public function blogoverviewAction()
{
	$this->layout('layout/indexlayout.phtml');
$i =0;
$res=array();
$user_session = new Container('loginId');
$lid = $user_session->offsetGet('loginId');

$contentone =$this->getpublisherTable()->selectUser1($lid);
$user_session = new Container('devId');
$sid = $user_session->offsetGet('devId');
$encryptedDeveloperId =  $this->encrypt_decrypt('encrypt', $sid);
$encryptedDeveloperId =str_replace("/","encoded",$encryptedDeveloperId);
 $user_session = new Container('sfpName');
        $sids = $user_session->offsetGet('sfpName');
        if($contentone[0]['fbName']!=""){
        $this->layout()->setVariables(array(
        'uname' => $contentone[0]['fbName'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		}
		else{
			$this->layout()->setVariables(array(
        'uname' => $contentone[0]['fname'],
        'sfpuname' => $contentone[0]['fname'],
        'city' => $contentone[0]['hometown'],
        'fbuser'=>$contentone[0]['fbuser'],
        'sfpuser'=>$contentone[0]['sfpuser'],
        'sfpnm'=>$sids
        ));
		} 
$contents=$this->getblogoverviewHeaderTable()->fetchAll('1');
$result=$this->getblogoverviewTable()->fetchAll();
foreach($result as $value)
    {
        $res[$i]=$value->id;
        $i++;
    }
$val = sizeof($res);
$details = array();
for($count=$val-1;$count>=0;$count--)
    {
        $id_val = $res[$count];          
        $details[] =  $this->getblogoverviewTable()->getdetails($id_val);
    }  
return new ViewModel(array('content'=>$contents,'res'=>$details,'lid'=>$lid));     
} 

public function sendrequestAction()
{
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phn = $_POST['phn'];
	$body = '<table>';
	$body .= "<tr><td><strong>Name    </strong> </td><td>" . $name . "</td></tr>";
	$body .= "<tr><td><strong>Phone   </strong> </td><td>" . $phn . "</td></tr>";
	$body .= "<tr><td><strong>Email   </strong> </td><td>" . $email . "</td></tr>";
	$body .= "</table>";
	
	$message = new Message();
	$html = new MimePart($body);
	$html->type = "text/html";
	$bodyMessage = new MimeMessage();
	$bodyMessage->addPart($html);
    $message->addTo('info@smartfanpage.com')
	->addFrom($email)
	->setSubject('AccessRequest')
	->setBody($bodyMessage);
	$smtpOptions = new \Zend\Mail\Transport\SmtpOptions();
	$smtpOptions->setHost('smtp.mandrillapp.com')
	->setConnectionClass('login')
	->setName('smtp.mandrillapp.com')
	->setConnectionConfig(array(
			'username' => 'info@smartfanpage.com',
			'password' => 'fv7M_K1TFO9LgCaEdIVhgw',
			'ssl' => 'tls',
			'port'=>587,
	));
	
	$transport = new \Zend\Mail\Transport\Smtp($smtpOptions);
	$transport->send($message);
	$this->getrequestemailTable()->saveAll($name,$email,$phn);
	 echo "Thank you for your message,will get back to you shortly";
	exit;
}

public function requestaccessAction()
{ 
	$this->layout('layout/requestlayout.phtml');

}
public function accesscodeAction()
{
	
	$textcode = $_POST['textcode'];
	
	//$chkemail =$this->getpublisherTable()->selectemails($uname);
	//$chkaccessCode =$this->getaccessCodeTable()->selectaccesCode($textcode);
	$contenttest =$this->getaccessCodeTable()->selectaccesCode($textcode);
	
	
	if(!empty($contenttest) && $contenttest[0]['accessCode'] != '1')
	{
		echo "1";
		setcookie("accesscode", $textcode, time()+3600, "/","", 0);
	}
	
	else
	{
		echo "2";
	}
	
	exit;
}


////////////////////////////////////////***************************FOR FORGET PASSWORD OF PUBLISHER*********//////////////////////
public function forgetpasswordAction()
{ 
	$this->layout('layout/indexlayout.phtml');
	$user_session = new Container('loginId');
	$sid = $user_session->offsetGet('loginId');
	$contentone =$this->getpublisherTable()->selectUser1($sid);
	if($sid != "")
	    {
	        $user_session = new Container('sfpName');
	        $sids = $user_session->offsetGet('sfpName');
	        if($contentone[0]['fbName']!="")
	        {
		        $this->layout()->setVariables(array(
		        'uname' => $contentone[0]['fbName'],
		        'sfpuname' => $contentone[0]['fname'],
		        'city' => $contentone[0]['hometown'],
		        'fbuser'=>$contentone[0]['fbuser'],
		        'sfpuser'=>$contentone[0]['sfpuser'],
		        'sfpnm'=>$sids
		        ));
			}
			else
			{
				$this->layout()->setVariables(array(
		        'uname' => $contentone[0]['fname'],
		        'sfpuname' => $contentone[0]['fname'],
		        'city' => $contentone[0]['hometown'],
		        'fbuser'=>$contentone[0]['fbuser'],
		        'sfpuser'=>$contentone[0]['sfpuser'],
		        'sfpnm'=>$sids
		        ));
			}
	    } 
}




//////////////////////////////////////// *******************FORGET PASSWORD FOR PUBLISHER ENDS HERE****************////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////************GET TABLE NAMES***********************////////////////////////////////////////////////
public function getblogDetailsHeaderTable()
{
    if (!$this->blogDetailsHeaderTable)
    {
         $sm = $this->getServiceLocator();
         $this->blogDetailsHeaderTable = $sm->get('Application\Model\blogDetailsHeaderTable');
    }
    return $this->blogDetailsHeaderTable;
}

public function getaboutUsImagesTable()
{
    if (!$this->aboutUsImagesTable)
    {
         $sm = $this->getServiceLocator();
         $this->aboutUsImagesTable = $sm->get('Application\Model\aboutUsImagesTable');
    }
    return $this->aboutUsImagesTable;
}
public function getaboutUsHeaderTable()
{
    if (!$this->aboutUsHeaderTable)
    {
         $sm = $this->getServiceLocator();
         $this->aboutUsHeaderTable = $sm->get('Application\Model\aboutUsHeaderTable');
    }
    return $this->aboutUsHeaderTable;
}
public function getblogarchiveHeaderTable()
{          
    if (!$this->blogarchiveHeaderTable)
    {
        $sm = $this->getServiceLocator();
        $this->blogarchiveHeaderTable = $sm->get('Application\Model\blogarchiveHeaderTable');
    }
    return $this->blogarchiveHeaderTable;
}

public function gethomepagetableTable()
{
    if (!$this->homepagetableTable)
    {
    $sm = $this->getServiceLocator();
    $this->homepagetableTable = $sm->get('Application\Model\homepagetableTable');
    }
    return $this->homepagetableTable;
}      

public function getcontactTable()
{
    if (!$this->contactTable)
    {
    $sm = $this->getServiceLocator();
    $this->contactTable = $sm->get('Application\Model\contactTable');
    }
    return $this->contactTable;
}      

public function gethomepageslidertableTable()
{
    if (!$this->homepagetableTable) 
    {
    $sm = $this->getServiceLocator();
    $this->homepageslidertableTable = $sm->get('Application\Model\homepageslidertableTable');
    }
    return $this->homepageslidertableTable;
}

public function gethomepagewalloffameTable()
{
    if (!$this->homepagewalloffameTable) 
    {
    $sm = $this->getServiceLocator();
    $this->homepagewalloffameTable = $sm->get('Application\Model\homepagewalloffameTable');
    }
    return $this->homepagewalloffameTable;
}

public function gettemplateimagesTable()
{
    if (!$this->templateimagesTable) 
    {
    $sm = $this->getServiceLocator();
    $this->templateimagesTable= $sm->get('Application\Model\templateimagesTable');
    }
    return $this->templateimagesTable;
}

public function gettemplatestoretbleTable()
{
    if (!$this->templatestoretbleTable) 
    {
    $sm = $this->getServiceLocator();
    $this->templatestoretbleTable = $sm->get('Application\Model\templatestoretbleTable');
    }
    return $this->templatestoretbleTable;
}

public function gethowsworkpagetbleTable()
{
    if (!$this->howsworkpagetbleTable) 
    {
    $sm = $this->getServiceLocator();
    $this->howsworkpagetbleTable = $sm->get('Application\Model\howsworkpagetbleTable');
    }
    return $this->howsworkpagetbleTable;
}

public function gethowsworkstepstbleTable()
{
    if (!$this->howsworkstepstbleTable)
    {
    $sm = $this->getServiceLocator();
    $this->howsworkstepstbleTable = $sm->get('Application\Model\howsworkstepstbleTable');
    }
    return $this->howsworkstepstbleTable;
}

public function getbecomepublisherTable()
{
    if (!$this->becomepublisherTable)
    {
    $sm = $this->getServiceLocator();
    $this->becomepublisherTable = $sm->get('Application\Model\becomepublisherTable');
    }
    return $this->becomepublisherTable;
}

public function getcasestudiesTable()
{
    if (!$this->becomepublisherTable) 
    {
    $sm = $this->getServiceLocator();
    $this->casestudiesTable = $sm->get('Application\Model\casestudiesTable');
    }
    return $this->casestudiesTable;
}

public function getbecomepublisherbannerTable()
{
    if (!$this->becomepublisherbannerTable) 
    {
    $sm = $this->getServiceLocator();
    $this->becomepublisherbannerTable = $sm->get('Application\Model\becomepublisherbannerTable');
    }
    return $this->becomepublisherbannerTable;
}
        
public function getaddressTable()
{          
    if (!$this->addressTable)
    {
    $sm = $this->getServiceLocator();
    $this->addressTable = $sm->get('Application\Model\addressTable');
    }
    return $this->addressTable;
}

public function getcontactheaderTable()
{          
    if (!$this->contactheaderTable)
    {
    $sm = $this->getServiceLocator();
    $this->contactheaderTable = $sm->get('Application\Model\contactheaderTable');
    }
    return $this->contactheaderTable;
}

public function getfaqtechnicalTable()
{
    if (!$this->faqtechnicalTable)
    {
     $sm = $this->getServiceLocator();
     $this->faqtechnicalTable = $sm->get('Application\Model\faqtechnicalTable');
    }
    return $this->faqtechnicalTable;
} 

public function getfaqpricingTable()
{
    if (!$this->faqpricingTable)
    {
     $sm = $this->getServiceLocator();
     $this->faqpricingTable = $sm->get('Application\Model\faqpricingTable');
    }
     return $this->faqpricingTable;
}

public function getfaqpublisherTable()
{
    if (!$this->faqpublisherTable)
    {
     $sm = $this->getServiceLocator();
     $this->faqpublisherTable = $sm->get('Application\Model\faqpublisherTable');
    }
     return $this->faqpublisherTable;
} 

public function getfaqsfpTable()
{
    if (!$this->faqsfpTable)
    {
     $sm = $this->getServiceLocator();
     $this->faqsfpTable = $sm->get('Application\Model\faqsfpTable');
    }
     return $this->faqsfpTable;
}  

public function getfaqbannerTable()
{          
    if (!$this->faqbannerTable)
    {
    $sm = $this->getServiceLocator();
    $this->faqbannerTable = $sm->get('Application\Model\faqbannerTable');
    }
    return $this->faqbannerTable;
}

public function getTemplateTable()
{
    if (!$this->templateTable) {
        $sm = $this->getServiceLocator();
        $this->templateTable = $sm->get('Application\Model\TemplateTable');
    }
    return $this->templateTable;
}

public function getbecomepublisherstudioTable()
{          
    if (!$this->becomepublisherstudioTable)
    {
        $sm = $this->getServiceLocator();
        $this->becomepublisherstudioTable = $sm->get('Application\Model\becomepublisherstudioTable');
    }
    return $this->becomepublisherstudioTable;
}

public function getblogdetailssTable()
{
    if (!$this->blogdetailssTable)
    {
    $sm = $this->getServiceLocator();
    $this->blogdetailssTable = $sm->get('Application\Model\blogdetailssTable');
    }
    return $this->blogdetailssTable;
} 
  
public function getblogoverviewHeaderTable()
{          
    if (!$this->blogoverviewHeaderTable)
    {
        $sm = $this->getServiceLocator();
        $this->blogoverviewHeaderTable = $sm->get('Application\Model\blogoverviewHeaderTable');
    }
    return $this->blogoverviewHeaderTable;
}
 
public function getDeveloperTable()
{          
    if (!$this->DeveloperTable)
    {
        $sm = $this->getServiceLocator();
        $this->DeveloperTable = $sm->get('Application\Model\DeveloperTable');
    }
    return $this->DeveloperTable;
}

public function gettermsserviceTable()
{
    if (!$this->termsserviceTable)
    {
         $sm = $this->getServiceLocator();
         $this->termsserviceTable = $sm->get('Application\Model\termsserviceTable');
    }
         return $this->termsserviceTable;
} 
 
public function getdisclaimerTable()
{
    if (!$this->disclaimerTable)
    {
         $sm = $this->getServiceLocator();
         $this->disclaimerTable = $sm->get('Application\Model\disclaimerTable');
    }
         return $this->disclaimerTable;
}

public function getpublisherTable()
{          
    if (!$this->publisherTable)
    {
        $sm = $this->getServiceLocator();
        $this->publisherTable = $sm->get('Application\Model\publisherTable');
    }
    return $this->publisherTable;
}  


public function getaccessCodeTable()
{
	if (!$this->accessCodeTable)
	{
		$sm = $this->getServiceLocator();
		$this->accessCodeTable = $sm->get('Application\Model\accessCodeTable');
	}
	return $this->accessCodeTable;
}


public function getprivacypolicyTable()
{
    if (!$this->privacypolicyTable)
    {
         $sm = $this->getServiceLocator();
         $this->privacypolicyTable = $sm->get('Application\Model\privacypolicyTable');
    }
         return $this->privacypolicyTable;
}

public function getfbuserTable() 
{
    if (!$this->fbuserTable)
    {
         $sm = $this->getServiceLocator();
         $this->fbuserTable = $sm->get('Application\Model\fbuserTable');
    }
    return $this->fbuserTable;
}  

public function getblogoverviewTable()
{
    if (!$this->blogoverviewTable)
    {
         $sm = $this->getServiceLocator();
         $this->blogoverviewTable = $sm->get('Application\Model\blogoverviewTable');
    }
         return $this->blogoverviewTable;
} 

public function getuserCommentTable()
{
    if (!$this->userCommentTable)
    {
         $sm = $this->getServiceLocator();
         $this->userCommentTable = $sm->get('Application\Model\userCommentTable');
    }
         return $this->userCommentTable;
} 

public function getuserTemplateTable()
{
   if (!$this->userTemplateTable) {
     $sm = $this->getServiceLocator();
     $this->userTemplateTable = $sm->get('Application\Model\userTemplateTable');
    }
    return $this->userTemplateTable;  
}
    
public function getpromoteTable()
{
    if (!$this->promoteTable) 
    {
        $sm = $this->getServiceLocator();
        $this->promoteTable = $sm->get('Application\Model\promoteTable');
    }
return $this->promoteTable;
} 
    
public function getscreenshotsTable()
{
    if (!$this->screenshotsTable) 
    {
        $sm = $this->getServiceLocator();
        $this->screenshotsTable = $sm->get('Application\Model\screenshotsTable');
    }
return $this->screenshotsTable;
}

public function getratingTable()
{
    if (!$this->ratingTable) 
    {
         $sm = $this->getServiceLocator();
         $this->ratingTable = $sm->get('Application\Model\ratingTable');
    }
    return $this->ratingTable;
}
public function getfaqContainerTable()
{
    if (!$this->faqContainerTable) 
    {
         $sm = $this->getServiceLocator();
         $this->faqContainerTable = $sm->get('Application\Model\faqContainerTable');
    }
    return $this->faqContainerTable;
}

public function getrequestemailTable()
{
	if (!$this->requestemailTable)
	{
		$sm = $this->getServiceLocator();
		$this->requestemailTable = $sm->get('Application\Model\requestemailTable');
	}
	return $this->requestemailTable;
}


/**************** for developer terms and service pages*******************************/
public function getdeveloperdisclaimerTable()
{
	if (!$this->developerdisclaimerTable)
	{
		$sm = $this->getServiceLocator();
		$this->developerdisclaimerTable = $sm->get('Application\Model\developerdisclaimerTable');
	}
	return $this->developerdisclaimerTable;
}
public function getdevelopertermsserviceTable()
{
	if (!$this->developertermsserviceTable)
	{
		$sm = $this->getServiceLocator();
		$this->developertermsserviceTable = $sm->get('Application\Model\developertermsserviceTable');
	}
	return $this->developertermsserviceTable;
}
public function getdeveloperpagesheaderTable()
{
	if (!$this->developerpagesheaderTable)
	{
		$sm = $this->getServiceLocator();
		$this->developerpagesheaderTable = $sm->get('Application\Model\developerpagesheaderTable');
	}
	return $this->developerpagesheaderTable;
}
public function getprivacypolicydeveloperTable()
{
	if (!$this->privacypolicydeveloperTable)
	{
		$sm = $this->getServiceLocator();
		$this->privacypolicydeveloperTable = $sm->get('Application\Model\privacypolicydeveloperTable');
	}
	return $this->privacypolicydeveloperTable;
}

/**************** for developer *******************************/


public function getanimatedImageTable()
{
	if (!$this->animatedImageTable)
	{
		$sm = $this->getServiceLocator();
		$this->animatedImageTable = $sm->get('Application\Model\animatedImageTable');
	}
	return $this->animatedImageTable;
}
public function getpagesheaderTable()
{
	if (!$this->pagesheaderTable)
	{
		$sm = $this->getServiceLocator();
		$this->pagesheaderTable = $sm->get('Application\Model\pagesheaderTable');
	}
	return $this->pagesheaderTable;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////************GET TABLE NAMES***********************////////////////////////////////////////////////     
}
?>