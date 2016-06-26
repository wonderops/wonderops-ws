<?php

$success = false;
$captcha_failed=false;
$name = "";
$email = "";
$phone = "";
$company_name = "";
$msg = "";


if(isset($_GET['send']))
{

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$company_name = $_POST['company-name'];
$msg = $_POST['msg'];

  require_once('recaptchalib.php');
  $privatekey = "6LeBcu8SAAAAAFCr174hlw6XFOqcFhhwaVEG-zr2";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
	
  $captcha_failed=true;
  
  } else {
    
$to = 'info@wonderops.com';

$subject = 'New Message';

$headers = "From: " . strip_tags($_POST['email']) . "\r\n";
$headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
//$headers .= "CC: susan@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";



$message = '<html><body>';
$message .= "<h1>New Message From : $name</h1><br/>";
$message .= "<h5>Email ID : $email</h5><br/>";
$message .= "<h5>Phone No : $phone</h5><br/>";
$message .= "<h5>Company Name : $company_name</h5><br/><hr color=black size=3 >";
$message .= "<h5>Message : $msg</h5><br/>";
$message .= '</body></html>';

mail($to, $subject, $message, $headers);

$success=true;
$name = "";
$email = "";
$phone = "";
$company_name = "";
$msg = "";

}
  
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   	<!-- title-->
	<title>WonderOps - Secure DevOps</title>
               
    <!-- SEO starts-->
    <meta content="Performing IT Magic" name="description">
    <meta content="WonderOps, IT Services" name="keywords">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<!-- SEO ends-->
        
    <!-- Stylesheet-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
    <link href='http://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
        
	<!-- Scripts-->
	
	<style type="text/css">
	#form label.error {
		color:red;
		}
	#form input.error {
		border:1px solid red;
	}
	
.box {
 min-width: 100px;
 padding: 20px 50px;
 margin: 20px 0;
 font: normal 12px/12px arial, helvetica, sans-serif;
/* border radius */
 -webkit-border-radius: 4px;  
 -moz-border-radius: 4px;  
 border-radius: 4px;
}

strong {
margin-right: 10px;
}

.success {
/* background */
 background: url(success.png), #efffb9;
 background-color: #efffb9;
 background-position: 10px center;
 background-repeat: no-repeat;
/* shadows and highlights */
 -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15),
0 2px 1px rgba(255, 255, 255, 0.8) inset,
0 -2px 2px #e2f897 inset;  
 -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15),
0 2px 1px rgba(255, 255, 255, 0.8) inset,
0 -2px 2px #e2f897 inset;  
 box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15),
0 2px 1px rgba(255, 255, 255, 0.8) inset,
0 -2px 2px #e2f897 inset;
/* border */
 border: 1px solid #99c600;
}

.error {
/* background */
 background: url(error.png), #fccac2;
 background-color: #fccac2;
 background-position: 10px center;
 background-repeat: no-repeat;
/* shadows and highlights */
 -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15),
0 2px 1px rgba(255, 255, 255, 0.5) inset,
0 -2px 2px #fcb7ac inset;  
 -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15),
0 2px 1px rgba(255, 255, 255, 0.5) inset,
0 -2px 2px #fcb7ac inset;  
 box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15),
0 2px 1px rgba(255, 255, 255, 0.5) inset,
0 -2px 2px #fcb7ac inset;
/* border */
 border: 1px solid #eb5339;
}

	</style>
</head>
<body>
<div id="navigation">
    <!-- Logo starts -->
    <!--    <img class="nav-logo" src="images/logo.png"> -->
    <!-- Logo ends -->
<!-- Menu starts -->
      <ul>
<li><a href="http://wonderops.com">HOME</a></li>
            <li><a href="server-management">Server Management</a></li>
            <li><a href="information-security">Information Security</a></li>
            <li><a href="software-development">Software Development</a></li>
            <li><a href="about">ABOUT</a></li>
            <li><a href="contact.php">CONTACT</a></li>
            <li><a href="media">Media</a></li>
<!-- <li><a href="mailto:info@wonderops.com">CONTACT</a></li> -->
      </ul>
<!--Menu ends-->



	</div>
<!--Content Starts-->
<div class="main-container">
<!-- Top bar starts -->
	
 <!-- Top bar ends-->
	<div class="why-this-inner"  style="margin-bottom:0px;"> 
        	<div class="why-cho_inner">
        	<h2>Contact WonderOps</h2>
             <div class="why-cho_inner_subtext" >
             
Please use the form below to ask any questions or get a quote for services
<?php if($success){?>
<div class="box success"><strong>SUCCESS!</strong> Your message was successfully sent.</div>
<?php } ?>

<?php if($captcha_failed){?>
<div class="box error"><strong>ERROR!</strong> Captcha Verification Failed. Please Retry</div>
<?php } ?>

<div id="content" style="width:100%;margin-bottom:90px !important;">
   <div id="post-2461" class="" style="line-height: 22px !important;">
      <div class="post-content" style="color: #747474 !important;line-height: 22px !important;font-size: 13px;">
 <p></p>
 <br/>
      </div>
      <form action="?send" method="post" id="form">
         <div id="comment-input" style="overflow: hidden;margin-bottom: 13px;">
		
		<input type="text" name="name" id="name" value="<?php echo $name; ?>" placeholder="Your Name (required)" size="22" tabindex="1" aria-required="true" class="input-name" style="border: 1px solid #d2d2d2;width: 28%;font-size: 13px;color: #747474;-webkit-box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);-moz-box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);padding: 8px 2%;float: left;margin-right: 1%;color: #aaa9a9 !important;font: 100% Arial,Helvetica,sans-serif;vertical-align: middle;" required>
		 
		 <input type="text" name="email" id="email" value="<?php echo $email; ?>" placeholder="Your Email (required)" size="22" tabindex="2" aria-required="true" class="input-email" spellcheck="false" ginger_software_editor="true" style="border: 1px solid #d2d2d2;width: 28%;font-size: 13px;color: #747474;-webkit-box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);-moz-box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);padding: 8px 2%;float: left;margin-right: 1%;color: #aaa9a9 !important;font: 100% Arial,Helvetica,sans-serif;vertical-align: middle;" required> 
		 
		 <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>" placeholder="Your Phone" size="22" tabindex="3" class="input-website" style="border: 1px solid #d2d2d2;width: 28%;font-size: 13px;color: #747474;-webkit-box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);-moz-box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);padding: 8px 2%;float: left;margin-right: 1%;color: #aaa9a9 !important;font: 100% Arial,Helvetica,sans-serif;vertical-align: middle;">
		 
		 </div>
		 
		 <div id="comment-input" style="overflow: hidden;margin-bottom: 13px;">
					<input type="text" name="company_name" id="company_name" value="<?php echo $company_name; ?>" placeholder="Your Company Name " size="22" tabindex="4" aria-required="true" class="input-name" style="border: 1px solid #d2d2d2;width: 94.3%;font-size: 13px;color: #747474;-webkit-box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);-moz-box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);padding: 8px 2%;float: left;margin-right: 1%;color: #aaa9a9 !important;font: 100% Arial,Helvetica,sans-serif;vertical-align: middle;">

		 </div>
         
		 <div id="comment-textarea">
		 
		 <textarea name="msg" id="msg" cols="39" rows="4" tabindex="5" class="textarea-comment" placeholder="Your Inquiry (required)" spellcheck="false" ginger_software_editor="true" style="background-attachment: local !important;background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAA5wAAACmCAYAAAC2u4CHAAAL8ElEQ…AAAQIECBAgQIAAAQIEEgHBmbAaJUCAAAECBAgQIECAAIEHd/QApwwdkNAAAAAASUVORK5CYII=) !important;position: relative;font-size: 13px;white-space: pre-wrap;background-position: 0px 0px !important;background-repeat: no-repeat no-repeat!important;border-color: #d2d2d2 !important;border: 1px solid #d2d2d2;width: 96%;height: 150px;font-size:13px;color: #747474;-webkit-box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);-moz-box-shadow: inset 0 1px5px rgba(0,0,0,0.1);box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);padding: 8px 11px;font: 100%;Arial,Helvetica,sans-serif;vertical-align: middle;background-color:white" required valid-email><?php echo $msg; ?></textarea>
		 
		 </div>
         <div id="comment-recaptcha" style="float:left;padding-top:20px;">
      
       <?php
          require_once('recaptchalib.php');
          $publickey = "6LeBcu8SAAAAAJI6JWpHdPLQIygtkowNosYJKoNi"; // you got this from the signup page
          echo recaptcha_get_html($publickey);
        ?>
		
	
		</div>

<div id="comment-submit" style="float:right;padding-top:80px;margin-right:20px;"><p></p><div><input name="submit" type="submit" id="submit" tabindex="5" value="Send inquiry" class="comment-submit button small green" style="background: #eaa722;
color: #FFFFFF !important;background-image: -webkit-gradient( linear, left top, left bottom, color-stop(0, #eaa722), color-stop(1, #eaa722) );border: 1px solid #AAD75B;min-height: 50px;font: 13px/32px 'PTSansBold', arial, helvetica, sans-serif;
text-transform: uppercase;text-align: center;text-shadow: 0 1px 0 #fff;padding: 0 20px;-webkit-border-radius: 2px;-moz-border-radius: 2px;border-radius: 2px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.2);-moz-box-shadow: 0 1px 1px rgba(0,0,0,0.2);box-shadow: 0 1px 1px rgba(0,0,0,0.2);"></div><p></p></div>
	
	</form>

            </div> 
		</div>
		</div>
		</div>
			<br/>
     <div style="margin-top:30px;float:left; width:100%; height:60px; background:#3a3a3c; font-size:12px; text-align:center; color:#fff; line-height:60px; border-top:5px solid #eaa722;">Copyright  @2013. WonderOps. All Rights Reserved</div>
</div> 
</body>
</html>
