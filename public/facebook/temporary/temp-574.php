<img src="/img/divider.png" id="imgdragable" style="display: none;">



<?php include_once('/var/www/staging/public/sfpFormFb.php');?>



  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"><script type="text/javascript">(window.NREUM||(NREUM={})).loader_config={xpid:"UwACU1BRGwYIXVhQBAQ="};window.NREUM||(NREUM={}),__nr_require=function(t,e,n){function r(n){if(!e[n]){var o=e[n]={exports:{}};t[n][0].call(o.exports,function(e){var o=t[n][1][e];return r(o?o:e)},o,o.exports)}return e[n].exports}if("function"==typeof __nr_require)return __nr_require;for(var o=0;o<n.length;o++)r(n[o]);return r}({QJf3ax:[function(t,e){function n(t){function e(e,n,a){t&&t(e,n,a),a||(a={});for(var c=s(e),f=c.length,u=i(a,o,r),d=0;f>d;d++)c[d].apply(u,n);return u}function a(t,e){f[t]=s(t).concat(e)}function s(t){return f[t]||[]}function c(){return n(e)}var f={};return{on:a,emit:e,create:c,listeners:s,_events:f}}function r(){return{}}var o="nr@context",i=t("gos");e.exports=n()},{gos:"7eSDFh"}],ee:[function(t,e){e.exports=t("QJf3ax")},{}],3:[function(t){function e(t){try{i.console&&console.log(t)}catch(e){}}var n,r=t("ee"),o=t(1),i={};try{n=localStorage.getItem("__nr_flags").split(","),console&&"function"==typeof console.log&&(i.console=!0,-1!==n.indexOf("dev")&&(i.dev=!0),-1!==n.indexOf("nr_dev")&&(i.nrDev=!0))}catch(a){}i.nrDev&&r.on("internal-error",function(t){e(t.stack)}),i.dev&&r.on("fn-err",function(t,n,r){e(r.stack)}),i.dev&&(e("NR AGENT IN DEVELOPMENT MODE"),e("flags: "+o(i,function(t){return t}).join(", ")))},{1:23,ee:"QJf3ax"}],4:[function(t){function e(t,e,n,i,s){try{c?c-=1:r("err",[s||new UncaughtException(t,e,n)])}catch(f){try{r("ierr",[f,(new Date).getTime(),!0])}catch(u){}}return"function"==typeof a?a.apply(this,o(arguments)):!1}function UncaughtException(t,e,n){this.message=t||"Uncaught error with no additional information",this.sourceURL=e,this.line=n}function n(t){r("err",[t,(new Date).getTime()])}var r=t("handle"),o=t(6),i=t("ee"),a=window.onerror,s=!1,c=0;t("loader").features.err=!0,t(5),window.onerror=e;try{throw new Error}catch(f){"stack"in f&&(t(1),t(2),"addEventListener"in window&&t(3),window.XMLHttpRequest&&XMLHttpRequest.prototype&&XMLHttpRequest.prototype.addEventListener&&window.XMLHttpRequest&&XMLHttpRequest.prototype&&XMLHttpRequest.prototype.addEventListener&&!/CriOS/.test(navigator.userAgent)&&t(4),s=!0)}i.on("fn-start",function(){s&&(c+=1)}),i.on("fn-err",function(t,e,r){s&&(this.thrown=!0,n(r))}),i.on("fn-end",function(){s&&!this.thrown&&c>0&&(c-=1)}),i.on("internal-error",function(t){r("ierr",[t,(new Date).getTime(),!0])})},{1:10,2:9,3:7,4:11,5:3,6:24,ee:"QJf3ax",handle:"D5DuLP",loader:"G9z0Bl"}],5:[function(t){t("loader").features.ins=!0},{loader:"G9z0Bl"}],6:[function(t){function e(){}if(window.performance&&window.performance.timing&&window.performance.getEntriesByType){var n=t("ee"),r=t("handle"),o=t(1),i=t(2);t("loader").features.stn=!0,t(3),n.on("fn-start",function(t){var e=t[0];e instanceof Event&&(this.bstStart=Date.now())}),n.on("fn-end",function(t,e){var n=t[0];n instanceof Event&&r("bst",[n,e,this.bstStart,Date.now()])}),o.on("fn-start",function(t,e,n){this.bstStart=Date.now(),this.bstType=n}),o.on("fn-end",function(t,e){r("bstTimer",[e,this.bstStart,Date.now(),this.bstType])}),i.on("fn-start",function(){this.bstStart=Date.now()}),i.on("fn-end",function(t,e){r("bstTimer",[e,this.bstStart,Date.now(),"requestAnimationFrame"])}),n.on("pushState-start",function(){this.time=Date.now(),this.startPath=location.pathname+location.hash}),n.on("pushState-end",function(){r("bstHist",[location.pathname+location.hash,this.startPath,this.time])}),"addEventListener"in window.performance&&(window.performance.addEventListener("webkitresourcetimingbufferfull",function(){r("bstResource",[window.performance.getEntriesByType("resource")]),window.performance.webkitClearResourceTimings()},!1),window.performance.addEventListener("resourcetimingbufferfull",function(){r("bstResource",[window.performance.getEntriesByType("resource")]),window.performance.clearResourceTimings()},!1)),document.addEventListener("scroll",e,!1),document.addEventListener("keypress",e,!1),document.addEventListener("click",e,!1)}},{1:10,2:9,3:8,ee:"QJf3ax",handle:"D5DuLP",loader:"G9z0Bl"}],7:[function(t,e){function n(t){i.inPlace(t,["addEventListener","removeEventListener"],"-",r)}function r(t){return t[1]}var o=(t(1),t("ee").create()),i=t(2)(o),a=t("gos");if(e.exports=o,n(window),"getPrototypeOf"in Object){for(var s=document;s&&!s.hasOwnProperty("addEventListener");)s=Object.getPrototypeOf(s);s&&n(s);for(var c=XMLHttpRequest.prototype;c&&!c.hasOwnProperty("addEventListener");)c=Object.getPrototypeOf(c);c&&n(c)}else XMLHttpRequest.prototype.hasOwnProperty("addEventListener")&&n(XMLHttpRequest.prototype);o.on("addEventListener-start",function(t){if(t[1]){var e=t[1];"function"==typeof e?this.wrapped=t[1]=a(e,"nr@wrapped",function(){return i(e,"fn-",null,e.name||"anonymous")}):"function"==typeof e.handleEvent&&i.inPlace(e,["handleEvent"],"fn-")}}),o.on("removeEventListener-start",function(t){var e=this.wrapped;e&&(t[1]=e)})},{1:24,2:25,ee:"QJf3ax",gos:"7eSDFh"}],8:[function(t,e){var n=(t(2),t("ee").create()),r=t(1)(n);e.exports=n,r.inPlace(window.history,["pushState"],"-")},{1:25,2:24,ee:"QJf3ax"}],9:[function(t,e){var n=(t(2),t("ee").create()),r=t(1)(n);e.exports=n,r.inPlace(window,["requestAnimationFrame","mozRequestAnimationFrame","webkitRequestAnimationFrame","msRequestAnimationFrame"],"raf-"),n.on("raf-start",function(t){t[0]=r(t[0],"fn-")})},{1:25,2:24,ee:"QJf3ax"}],10:[function(t,e){function n(t,e,n){t[0]=o(t[0],"fn-",null,n)}var r=(t(2),t("ee").create()),o=t(1)(r);e.exports=r,o.inPlace(window,["setTimeout","setInterval","setImmediate"],"setTimer-"),r.on("setTimer-start",n)},{1:25,2:24,ee:"QJf3ax"}],11:[function(t,e){function n(){f.inPlace(this,p,"fn-")}function r(t,e){f.inPlace(e,["onreadystatechange"],"fn-")}function o(t,e){return e}function i(t,e){for(var n in t)e[n]=t[n];return e}var a=t("ee").create(),s=t(1),c=t(2),f=c(a),u=c(s),d=window.XMLHttpRequest,p=["onload","onerror","onabort","onloadstart","onloadend","onprogress","ontimeout"];e.exports=a,window.XMLHttpRequest=function(t){var e=new d(t);try{a.emit("new-xhr",[],e),u.inPlace(e,["addEventListener","removeEventListener"],"-",o),e.addEventListener("readystatechange",n,!1)}catch(r){try{a.emit("internal-error",[r])}catch(i){}}return e},i(d,XMLHttpRequest),XMLHttpRequest.prototype=d.prototype,f.inPlace(XMLHttpRequest.prototype,["open","send"],"-xhr-",o),a.on("send-xhr-start",r),a.on("open-xhr-start",r)},{1:7,2:25,ee:"QJf3ax"}],12:[function(t){function e(t){var e=this.params,r=this.metrics;if(!this.ended){this.ended=!0;for(var i=0;c>i;i++)t.removeEventListener(s[i],this.listener,!1);if(!e.aborted){if(r.duration=(new Date).getTime()-this.startTime,4===t.readyState){e.status=t.status;var a=t.responseType,f="arraybuffer"===a||"blob"===a||"json"===a?t.response:t.responseText,u=n(f);if(u&&(r.rxSize=u),this.sameOrigin){var d=t.getResponseHeader("X-NewRelic-App-Data");d&&(e.cat=d.split(", ").pop())}}else e.status=0;r.cbTime=this.cbTime,o("xhr",[e,r,this.startTime])}}}function n(t){if("string"==typeof t&&t.length)return t.length;if("object"!=typeof t)return void 0;if("undefined"!=typeof ArrayBuffer&&t instanceof ArrayBuffer&&t.byteLength)return t.byteLength;if("undefined"!=typeof Blob&&t instanceof Blob&&t.size)return t.size;if("undefined"!=typeof FormData&&t instanceof FormData)return void 0;try{return JSON.stringify(t).length}catch(e){return void 0}}function r(t,e){var n=i(e),r=t.params;r.host=n.hostname+":"+n.port,r.pathname=n.pathname,t.sameOrigin=n.sameOrigin}if(window.XMLHttpRequest&&XMLHttpRequest.prototype&&XMLHttpRequest.prototype.addEventListener&&!/CriOS/.test(navigator.userAgent)){t("loader").features.xhr=!0;var o=t("handle"),i=t(2),a=t("ee"),s=["load","error","abort","timeout"],c=s.length,f=t(1);t(4),t(3),a.on("new-xhr",function(){this.totalCbs=0,this.called=0,this.cbTime=0,this.end=e,this.ended=!1,this.xhrGuids={}}),a.on("open-xhr-start",function(t){this.params={method:t[0]},r(this,t[1]),this.metrics={}}),a.on("open-xhr-end",function(t,e){"loader_config"in NREUM&&"xpid"in NREUM.loader_config&&this.sameOrigin&&e.setRequestHeader("X-NewRelic-ID",NREUM.loader_config.xpid)}),a.on("send-xhr-start",function(t,e){var r=this.metrics,o=t[0],i=this;if(r&&o){var f=n(o);f&&(r.txSize=f)}this.startTime=(new Date).getTime(),this.listener=function(t){try{"abort"===t.type&&(i.params.aborted=!0),("load"!==t.type||i.called===i.totalCbs&&(i.onloadCalled||"function"!=typeof e.onload))&&i.end(e)}catch(n){try{a.emit("internal-error",[n])}catch(r){}}};for(var u=0;c>u;u++)e.addEventListener(s[u],this.listener,!1)}),a.on("xhr-cb-time",function(t,e,n){this.cbTime+=t,e?this.onloadCalled=!0:this.called+=1,this.called!==this.totalCbs||!this.onloadCalled&&"function"==typeof n.onload||this.end(n)}),a.on("xhr-load-added",function(t,e){var n=""+f(t)+!!e;this.xhrGuids&&!this.xhrGuids[n]&&(this.xhrGuids[n]=!0,this.totalCbs+=1)}),a.on("xhr-load-removed",function(t,e){var n=""+f(t)+!!e;this.xhrGuids&&this.xhrGuids[n]&&(delete this.xhrGuids[n],this.totalCbs-=1)}),a.on("addEventListener-end",function(t,e){e instanceof XMLHttpRequest&&"load"===t[0]&&a.emit("xhr-load-added",[t[1],t[2]],e)}),a.on("removeEventListener-end",function(t,e){e instanceof XMLHttpRequest&&"load"===t[0]&&a.emit("xhr-load-removed",[t[1],t[2]],e)}),a.on("fn-start",function(t,e,n){e instanceof XMLHttpRequest&&("onload"===n&&(this.onload=!0),("load"===(t[0]&&t[0].type)||this.onload)&&(this.xhrCbStart=(new Date).getTime()))}),a.on("fn-end",function(t,e){this.xhrCbStart&&a.emit("xhr-cb-time",[(new Date).getTime()-this.xhrCbStart,this.onload,e],e)})}},{1:"XL7HBI",2:13,3:11,4:7,ee:"QJf3ax",handle:"D5DuLP",loader:"G9z0Bl"}],13:[function(t,e){e.exports=function(t){var e=document.createElement("a"),n=window.location,r={};e.href=t,r.port=e.port;var o=e.href.split("://");return!r.port&&o[1]&&(r.port=o[1].split("/")[0].split("@").pop().split(":")[1]),r.port&&"0"!==r.port||(r.port="https"===o[0]?"443":"80"),r.hostname=e.hostname||n.hostname,r.pathname=e.pathname,r.protocol=o[0],"/"!==r.pathname.charAt(0)&&(r.pathname="/"+r.pathname),r.sameOrigin=!e.hostname||e.hostname===document.domain&&e.port===n.port&&e.protocol===n.protocol,r}},{}],14:[function(t,e){function n(t){return function(){r(t,[(new Date).getTime()].concat(i(arguments)))}}var r=t("handle"),o=t(1),i=t(2);"undefined"==typeof window.newrelic&&(newrelic=window.NREUM);var a=["setPageViewName","addPageAction","setCustomAttribute","finished","addToTrace","inlineHit","noticeError"];o(a,function(t,e){window.NREUM[e]=n("api-"+e)}),e.exports=window.NREUM},{1:23,2:24,handle:"D5DuLP"}],"7eSDFh":[function(t,e){function n(t,e,n){if(r.call(t,e))return t[e];var o=n();if(Object.defineProperty&&Object.keys)try{return Object.defineProperty(t,e,{value:o,writable:!0,enumerable:!1}),o}catch(i){}return t[e]=o,o}var r=Object.prototype.hasOwnProperty;e.exports=n},{}],gos:[function(t,e){e.exports=t("7eSDFh")},{}],handle:[function(t,e){e.exports=t("D5DuLP")},{}],D5DuLP:[function(t,e){function n(t,e,n){return r.listeners(t).length?r.emit(t,e,n):(o[t]||(o[t]=[]),void o[t].push(e))}var r=t("ee").create(),o={};e.exports=n,n.ee=r,r.q=o},{ee:"QJf3ax"}],id:[function(t,e){e.exports=t("XL7HBI")},{}],XL7HBI:[function(t,e){function n(t){var e=typeof t;return!t||"object"!==e&&"function"!==e?-1:t===window?0:i(t,o,function(){return r++})}var r=1,o="nr@id",i=t("gos");e.exports=n},{gos:"7eSDFh"}],G9z0Bl:[function(t,e){function n(){var t=p.info=NREUM.info,e=f.getElementsByTagName("script")[0];if(t&&t.licenseKey&&t.applicationID&&e){s(d,function(e,n){e in t||(t[e]=n)});var n="https"===u.split(":")[0]||t.sslForHttp;p.proto=n?"https://":"http://",a("mark",["onload",i()]);var r=f.createElement("script");r.src=p.proto+t.agent,e.parentNode.insertBefore(r,e)}}function r(){"complete"===f.readyState&&o()}function o(){a("mark",["domContent",i()])}function i(){return(new Date).getTime()}var a=t("handle"),s=t(1),c=(t(2),window),f=c.document,u=(""+location).split("?")[0],d={beacon:"bam.nr-data.net",errorBeacon:"bam.nr-data.net",agent:"js-agent.newrelic.com/nr-632.min.js"},p=e.exports={offset:i(),origin:u,features:{}};f.addEventListener?(f.addEventListener("DOMContentLoaded",o,!1),c.addEventListener("load",n,!1)):(f.attachEvent("onreadystatechange",r),c.attachEvent("onload",n)),a("mark",["firstbyte",i()])},{1:23,2:14,handle:"D5DuLP"}],loader:[function(t,e){e.exports=t("G9z0Bl")},{}],23:[function(t,e){function n(t,e){var n=[],o="",i=0;for(o in t)r.call(t,o)&&(n[i]=e(o,t[o]),i+=1);return n}var r=Object.prototype.hasOwnProperty;e.exports=n},{}],24:[function(t,e){function n(t,e,n){e||(e=0),"undefined"==typeof n&&(n=t?t.length:0);for(var r=-1,o=n-e||0,i=Array(0>o?0:o);++r<o;)i[r]=t[e+r];return i}e.exports=n},{}],25:[function(t,e){function n(t){return!(t&&"function"==typeof t&&t.apply&&!t[i])}var r=t("ee"),o=t(1),i="nr@wrapper",a=Object.prototype.hasOwnProperty;e.exports=function(t){function e(t,e,r,a){function nrWrapper(){var n,i,s,f;try{i=this,n=o(arguments),s=r&&r(n,i)||{}}catch(d){u([d,"",[n,i,a],s])}c(e+"start",[n,i,a],s);try{return f=t.apply(i,n)}catch(p){throw c(e+"err",[n,i,p],s),p}finally{c(e+"end",[n,i,f],s)}}return n(t)?t:(e||(e=""),nrWrapper[i]=!0,f(t,nrWrapper),nrWrapper)}function s(t,r,o,i){o||(o="");var a,s,c,f="-"===o.charAt(0);for(c=0;c<r.length;c++)s=r[c],a=t[s],n(a)||(t[s]=e(a,f?s+o:o,i,s))}function c(e,n,r){try{t.emit(e,n,r)}catch(o){u([o,e,n,r])}}function f(t,e){if(Object.defineProperty&&Object.keys)try{var n=Object.keys(t);return n.forEach(function(n){Object.defineProperty(e,n,{get:function(){return t[n]},set:function(e){return t[n]=e,e}})}),e}catch(r){u([r])}for(var o in t)a.call(t,o)&&(e[o]=t[o]);return e}function u(e){try{t.emit("internal-error",e)}catch(n){}}return t||(t=r),e.inPlace=s,e.flag=i,e}},{1:24,ee:"QJf3ax"}]},{},["G9z0Bl",4,12,6,5]);</script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>B2B Email Course</title>
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="/editcss/jquery-ui.css">
<link rel="stylesheet" href="/editcss/jquery.datetimepicker.css">
<link rel="stylesheet" href="/editcss/jquery.timepicker.css">
  <link rel="stylesheet" href="http://test.scampaigns.com/user_template/976552e428ed938610-Loretta_Email_Course/css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
  
  <script>
    WebFont.load({
      google: {
        families: ['Open Sans', 'Raleway']
      }
    });
  </script>
 <script>
    WebFont.load({
      google: {
        families: ['Open Sans', 'Raleway']
      }
    });
  </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  
  
     
  <style>
  .SFPTWO_EDITFORM li {
  margin-bottom: 26px;
}

.jui-checkbox-row {
  height: auto;
  overflow: hidden;
}
  </style>
  
  




<div class="main_section SFPTWO_BACKGROUND">
<div class="header">
    <div class="container">
    	<div class="textme" style="display:block;"></div><div class="SFPTWO_IMAGEEDIT nownsfpimgdel tagsimg_1">
    		<img src="http://test.scampaigns.com/user_template/976552e428ed938610-Loretta_Email_Course/images/1b2ayl6-fake-logo.png" class="company-logo">
        <div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
    </div>
</div>
<div class="main">
<div class="container">
  
  
<div class="main-heading tool-tip">
 <div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_1 texttagdelete">      
    <h1 class="textedit SFPTWO_TAGEDIT edit tag_1 tagdelete">5 Conversion Tricks Youâ€™re Missing</h1><div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
     <div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_2 texttagdelete">      
    <h4 class="textedit SFPTWO_TAGEDIT edit tag_2 tagdelete">Explain in the Subheadline something that Supports the Headline</h4>
  <div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
</div>
<div class="row main-center">
    <div class="textme" style="display:block;"></div><div class="col-sm-6 col-md-7 SFPTWO_IMAGEEDIT nownsfpimgdel tagsimg_2">
        <img src="http://test.scampaigns.com/user_template/976552e428ed938610-Loretta_Email_Course/images/ar0imc-email-envelope.png" class="envelope img-responsive">
    <div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
    <div class="col-sm-6 col-md-5">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-offset-0">
            <div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_3 texttagdelete">
                <h3 class="textedit SFPTWO_TAGEDIT edit tag_3 tagdelete">Get the Free <br> 5-day Email Course</h3><div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
                <div style="overflow: hidden; width: 100%;">
                 
              <span style="position:relative;"><ul class="designelements clearfix" style="position:absolute;left:0; z-index:9999;"><li id="lilabelme" style="display:none;"><a style="cursor: pointer;" onclick="chechTypeAndAdd(this.rel)" rel="label" id="label" class=""><span>Title</span><img src="/formbuild/title_icon.png" alt=""></a></li></ul><form id="editable" action="" class="SFPTWO_EDITFORM extendform" style="margin-top:25px; clear:both;" method="post"><img src="/img/divider.png" id="imgdrag" style="display: none;"><img src="/img/divider.png" id="imgdragable" style="display: none;"><ul class="sortable-list ui-sortable"><li id="trigme" style="display: none;"><div></div></li> 
              <li class="dottedLi SFPTWO_TEXTEDIT tags_4 texttagdelete"><div id="labeledit" class="labeledit textdrag"><p id="pid_917" class="opt SFPTWO_TAGEDIT getme tag_4 tagdelete"><font class="SFPCOLOR">First Name *</font></p></div><input type="text" name="" id="txtbox_297" class="SFPTEXT form-control"><div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></li>
              <li class="dottedLi SFPTWO_TEXTEDIT tags_5 texttagdelete"><div id="labeledit" class="labeledit emaildrag"><p id="pid_559" class="opt SFPTWO_TAGEDIT getme tag_5 tagdelete"><font class="SFPCOLOR">Email *</font></p></div><input type="email" name="" id="email_331" required="required" class="SFPEMAIL form-control"><div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></li>  
             <li class="dottedLi SFPTWO_TEXTEDIT tags_6 texttagdelete"><div id="getbtnme" class="submitdrag"><input class="btn btn-lg btn-block" type="submit" name="submit" value="Send the eCourse"></div><div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></li>
              <li class="dottedLi SFPTWO_TEXTEDIT tags_7 texttagdelete"><div id="labeledit" class="labeledit singledrag"><p id="pid_399" class="opt SFPTWO_TAGEDIT note tag_6 tagdelete"><font class="SFPCOLOR">Tell them you're not going to spam them and point them to your <a href="#">privacy policy</a></font></p></div><div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></li>
             <!--[form]-->
                <input type="hidden" id="SFPTEXTFORM" value="form-control">
                <input type="hidden" id="SFPSUBMITFORM" value="btn btn-lg btn-block">
                <input type="hidden" id="SFPEMAILFORM" value="form-control">
                <input type="hidden" id="SFPPARAGRAPHFORM" value="form-control">
                <input type="hidden" id="SFPSINGLELINEFORM" value="note">
                <input type="hidden" id="SFPMULTILINEFORM" value="form-control">
                <input type="hidden" id="SFPTEXTAREAFORM" value="form-control">
                <input type="hidden" id="SFPDROPDOWNFORM" value="form-control">
               <!-- <[dropdown-option(class)]->"getme"/>-->
                <input type="hidden" id="SFPLEBELFORM" value="getme">
                
                </ul></form></span></div>
               </div> 
           
        </div>
    </div>
</div>
<div class="row">
	<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
    	<div class="bullet-points-intro">
        	<div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_8 texttagdelete">
            	<h3 class="textedit SFPTWO_TAGEDIT edit tag_7 tagdelete">Each Day You will Learn Something New</h3>
            <div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
        	<div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_9 texttagdelete">
            	<p class="textedit SFPTWO_TAGEDIT edit tag_8 tagdelete">Intro description for Web App goes here. It tells people how this Web App is going to change their business. For the better of course. Not the worse. People wouldn't buy a Web App like that.</p>
            <div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
        </div>
        <div class="bullet-points">
        
        
        
        
        <div class="row has-bullet-line">
            <div class="col-xs-2 col-sm-1">
             <div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_10 texttagdelete">
            	<span class="bullet-number textedit SFPTWO_TAGEDIT edit tag_9 tagdelete">1</span>
                <div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
            </div>
            <div class="col-xs-10 col-sm-11 tool-tip">
            <div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_11 texttagdelete">
                <h4 class="textedit SFPTWO_TAGEDIT edit tag_10 tagdelete">Here's what they Learn in Lesson 1</h4><div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
             <div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_12 texttagdelete">   
                <p class="textedit SFPTWO_TAGEDIT edit tag_11 tagdelete">This is the first point about your report that's going to get them itching to download. If it doesn't, be more pursuasive.</p>
              <div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
           </div>
        </div>

        <div class="row has-bullet-line">
            <div class="col-xs-2 col-sm-1">
            <div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_13 texttagdelete">
            	<span class="bullet-number textedit SFPTWO_TAGEDIT edit tag_12 tagdelete">2</span>
                <div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
            </div>
            <div class="col-xs-10 col-sm-11 tool-tip">
             <div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_14 texttagdelete">
                <h4 class="textedit SFPTWO_TAGEDIT edit tag_13 tagdelete">A Bit About What they Learn in Lesson 2 </h4> <div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
               <div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_15 texttagdelete">
                <p class="textedit SFPTWO_TAGEDIT edit tag_14 tagdelete">This is the first point about your report that's going to get them itching to download. If it doesn't, be more pursuasive.</p>
            <div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
             </div>
        </div>

        <div class="row has-bullet-line">
            <div class="col-xs-2 col-sm-1">
            	<div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_16 texttagdelete">
            	<span class="bullet-number textedit SFPTWO_TAGEDIT edit tag_15 tagdelete">3</span>
                <div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
            </div>
            <div class="col-xs-10 col-sm-11 tool-tip">
              <div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_17 texttagdelete">
                <h4 class="textedit SFPTWO_TAGEDIT edit tag_16 tagdelete">And Then There's Lesson 3 </h4><div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
              <div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_18 texttagdelete">
                <p class="textedit SFPTWO_TAGEDIT edit tag_17 tagdelete">This is the first point about your report that's going to get them itching to download. If it doesn't, be more pursuasive.</p>
             <div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
            </div>
        </div>

        <div class="row has-bullet-line">
            <div class="col-xs-2 col-sm-1">
            <div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_19 texttagdelete">
            	<span class="bullet-number textedit SFPTWO_TAGEDIT edit tag_18 tagdelete">4</span>
                <div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
            </div>
            <div class="col-xs-10 col-sm-11 tool-tip">
            <div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_20 texttagdelete">
                <h4 class="textedit SFPTWO_TAGEDIT edit tag_19 tagdelete">Why Not Move onto Lesson 4 </h4><div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
            <div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_21 texttagdelete">
                <p class="textedit SFPTWO_TAGEDIT edit tag_20 tagdelete">This is the first point about your report that's going to get them itching to download. If it doesn't, be more pursuasive.</p>
             <div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
            </div>
        </div>
        
        <div class="row has-bullet-line">
            <div class="col-xs-2 col-sm-1">
            	<div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_22 texttagdelete">
            	<span class="bullet-number textedit SFPTWO_TAGEDIT edit tag_21 tagdelete">5</span>
                <div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
            </div>
            <div class="col-xs-10 col-sm-11 tool-tip">
            <div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_23 texttagdelete">
                <h4 class="textedit SFPTWO_TAGEDIT edit tag_22 tagdelete">By this time They're Brilliant Lesson 5</h4><div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
             <div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_24 texttagdelete">
                <p class="textedit SFPTWO_TAGEDIT edit tag_23 tagdelete">This is the first point about your report that's going to get them itching to download. If it doesn't, be more pursuasive.</p>
            <div class="SFP_settings" style="display:none"><a title="Setting" class="setSFPic" href="javascript:void(0)"></a></div></div>
              </div>
        </div>
        
        
        
        
        
        
        
        
        </div>
    </div>
</div>
    
    
</div>
</div>
<div class="footer">
    <div class="container">
    
    	<div class="textme" style="display:block;"></div><div class="SFPTWO_TEXTEDIT tags_25 texttagdelete"><p>©2014 Your Company, Inc.</p></div>
    </div>
</div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript"  src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script> 
<script type="text/javascript" src="/js3/jquery.datetimepicker.js"></script> 
<script type="text/javascript"  src="/js/jquery.timepicker.js"></script> 
<script>

$(".jui-checkbox-row p.SFPTWO_TAGEDIT").live( "click", function(){
    $(this).parent().find('input[type="checkbox"]').trigger('click');
});

$(".jui-checkbox-row p.SFPTWO_TAGEDIT").live( "click", function(){
    $(this).parent().find('input[type="radio"]').trigger('click');
});

function datepick(num)
{
  $('body').on('click', '#datepicker'+num, function(event) {
    
    $(this).datepicker({

       showOn: 'focus',

        yearRange: "1900:+85",

        changeMonth: true,

        changeYear: true
    }).focus();

});  
}


function timepick(num)
{
    $('body').on('click', '#timepicker'+num, function(event) {
     $(this).timepicker(
        {
       'step': '30',
			'minTime': '00:00',
			'maxTime': '23:59',
			'timeFormat': 'H:i',
  }).focus();
}); 
}   
</script> 
<script type="text/javascript">window.NREUM||(NREUM={});NREUM.info={"beacon":"bam.nr-data.net","licenseKey":"f767fe6f50","applicationID":"5899235","transactionName":"YFwEMkZYX0ZYBhINVlkWMxRdFkRGXBc5EFxaSQoHQFweDA5TU1ELUg1UXlFdCAYBU1dUFHtWFANATVBqfAgHDVVoegkTRkpUGlALAgFBGUkOFg==","queueTime":0,"applicationTime":0,"atts":"TBsHRA5CTEg=","errorBeacon":"bam.nr-data.net","agent":"js-agent.newrelic.com\/nr-632.min.js"}</script></body>
</html>

</div>

       
		<script type="text/javascript">
            var d = document;
            var safari = (navigator.userAgent.toLowerCase().indexOf() != -1) ? true : false;
            var gebtn = function(parEl,child) { return parEl.getElementsByTagName(child); };
            onload = function() {
                
                var body = gebtn(d,'body')[0];
                body.className = body.className && body.className != '' ? body.className + ' has-js' : 'has-js';
                
                if (!d.getElementById || !d.createTextNode) return;
                var ls = gebtn(d,'label');
                for (var i = 0; i < ls.length; i++) {
                    var l = ls[i];
                    if (l.className.indexOf('label_') == -1) continue;
                    var inp = gebtn(l,'input')[0];
                    if (l.className == 'label_check') {
                        l.className = (safari && inp.checked == true || inp.checked) ? 'label_check c_on' : 'label_check c_off';
                        l.onclick = check_it;
                    };
                    if (l.className == 'label_radio') {
                        l.className = (safari && inp.checked == true || inp.checked) ? 'label_radio r_on' : 'label_radio r_off';
                        l.onclick = turn_radio;
                    };
                };
            };
            var check_it = function() {
                var inp = gebtn(this,'input')[0];
                if (this.className == 'label_check c_off' || (!safari && inp.checked)) {
                    this.className = 'label_check c_on';
                    if (safari) inp.click();
                } else {
                    this.className = 'label_check c_off';
                    if (safari) inp.click();
                };
            };
            var turn_radio = function() {
                var inp = gebtn(this,'input')[0];
                if (this.className == 'label_radio r_off' || inp.checked) {
                    var ls = gebtn(this.parentNode,'label');
                    for (var i = 0; i < ls.length; i++) {
                        var l = ls[i];
                        if (l.className.indexOf('label_radio') == -1)  continue;
                        l.className = 'label_radio r_off';
                    };
                    this.className = 'label_radio r_on';
                    if (safari) inp.click();
                } else {
                    this.className = 'label_radio r_off';
                    if (safari) inp.click();
                };
            };
        </script>
        
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <!--<script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>-->