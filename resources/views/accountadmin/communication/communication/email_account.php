<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once("../global/config.php");
require_once("check_access.php");

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if(check_access('SETUP_COMMUNICATION') == 0 ){
        header("location:../index");
        exit;
}

$msg = '';
if(!empty($_POST)){
        //echo "<pre>";print_r($_POST);exit;

	$EMAIL_ACCOUNT = $_POST;
	$EMAIL_ACCOUNT['PASSWORD'] = my_encrypt('',$EMAIL_ACCOUNT['PASSWORD']);

	if($_GET['id'] == ''){
		$EMAIL_ACCOUNT['PK_COMPANY'] = $_SESSION['PK_COMPANY'];
		$EMAIL_ACCOUNT['CREATED_BY'] = $_SESSION['PK_USER'];
		$EMAIL_ACCOUNT['CREATED_ON'] = date("Y-m-d H:i:s");
		db_perform('EMAIL_ACCOUNT', $EMAIL_ACCOUNT, 'insert');
		$PK_EMAIL_ACCOUNT = $db->insert_ID();
	} else {
		$EMAIL_ACCOUNT['EDITED_BY'] = $_SESSION['PK_USER'];
		$EMAIL_ACCOUNT['EDITED_ON'] = date("Y-m-d H:i:s");
		db_perform('EMAIL_ACCOUNT', $EMAIL_ACCOUNT, 'update'," PK_COMPANY = '$_SESSION[PK_COMPANY]' AND PK_EMAIL_ACCOUNT = '$_GET[id]' ");
		$PK_EMAIL_ACCOUNT = $_GET['id'];
	}

	$EMAIL = 'noreply@gmail.com';

	$res_broad = $db->Execute("SELECT * FROM EMAIL_ACCOUNT WHERE PK_COMPANY = '$_SESSION[PK_COMPANY]' AND PK_EMAIL_ACCOUNT = '$PK_EMAIL_ACCOUNT' ");
	try {
		//Server settings
		$mail->SMTPDebug = 4;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = $res_broad->fields['HOST'];                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = $res_broad->fields['USER_NAME'];
		$mail->Password   = my_decrypt('',$res_broad->fields['PASSWORD']);
		$mail->SMTPSecure = $res_broad->fields['ENCRYPTION_TYPE'];
		$mail->Port       = $res_broad->fields['PORT'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		$mail->setFrom($res_broad->fields['USER_NAME'], '');
		$mail->addReplyTo($res_broad->fields['USER_NAME'], '');
		$mail->AddAddress($EMAIL,'');

		$result  = $db->Execute("SELECT * FROM Z_EMAIL_TEMPLATE where ID = '2' ");
		$subject = $result->fields['SUBJECT'];
		$msg 	 = $result->fields['CONTENT'];

		$subject = str_replace("{Login ID}",$res_broad->fields['USER_NAME'],$subject);
		$msg 	 = str_replace("{Login ID}",$res_broad->fields['USER_NAME'],$msg);

		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body    = $msg;

		$mail->SMTPOptions = array(
                  'ssl' => array(
                      'verify_peer' => false,
                      'verify_peer_name' => false,
                      'allow_self_signed' => true
                  )
	       );

		//echo $subject.'<br />'.$msg;exit;
		if(!$mail->Send()) {
			header("location:email_account?id=".$PK_EMAIL_ACCOUNT.'&e=1');
			exit;
		} else {
			$msg = 'SMTP Configured Successfully!!!';
			header("location:manage_email_account");
			exit;
		}

	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";exit;
	}
}

if($_GET['id'] == ''){
	$HOST                   = '';
	$PORT                   = '';
	$USER_NAME              = '';
	$PASSWORD               = '';
	$ENCRYPTION_TYPE        = '';
} else {
	$res = $db->Execute("select * from EMAIL_ACCOUNT WHERE PK_COMPANY = '$_SESSION[PK_COMPANY]' AND PK_EMAIL_ACCOUNT = '$_GET[id]' ");
	if($res->RecordCount() == 0) {
		header("location:manage_email_account");
		exit;
	}
	$HOST                   = $res->fields['HOST'];
	$PORT                   = $res->fields['PORT'];
	$USER_NAME              = $res->fields['USER_NAME'];
	$PASSWORD               = $res->fields['PASSWORD'];
	$ENCRYPTION_TYPE        = $res->fields['ENCRYPTION_TYPE'];

	$PASSWORD = my_decrypt('',$PASSWORD);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
        <? require_once("css.php"); ?>
        <title>Email Settings | <?=$title?></title>
</head>

<body class="horizontal-nav boxed skin-megna fixed-layout">
   <? require_once("pre_load.php"); ?>
    <div id="main-wrapper">
       <? require_once("menu.php"); ?>
        <div class="page-wrapper">
            <div class="container-fluid">
                 <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Email Settings</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
							<form class="floating-labels m-t-40" method="post" name="form1" id="form1" enctype="multipart/form-data" >
								<div class="p-20">
									<? if($_GET['e'] == 1){ ?>
										<div class="form-group">
											<label for="input-text" class="col-sm-2 control-label"></label>
											<div class="col-sm-10" style="color:red">
												Something is wrong. We are not able to connect to the mail client. Please check the configuration and try again.
											</div>
										</div>
									<? } ?>

									<div class="d-flex">
										<div class="col-12 col-sm-6 form-group focused" id="HOST_LBL">
											<input type="text" class="form-control required-entry" id="HOST" name="HOST" value="<?=$HOST?>"  placeholder="smtp.gmail.com"  >
											<span class="bar"></span>
											<label for="HOST">Host</label>
										</div>
									</div>

									<div class="d-flex">
										<div class="col-12 col-sm-6 form-group focused" id="PORT_LBL">
											<input type="text" class="required-entry form-control" id="PORT" name="PORT" value="<?=$PORT?>" placeholder="465" >
											<span class="bar"></span>
											<label for="PORT">Port</label>
										</div>
									</div>
									<div class="d-flex">
										<div class="col-12 col-sm-6 form-group focused" >
											<select id="ENCRYPTION_TYPE" name="ENCRYPTION_TYPE" class="form-control">
												<option value="tls" <? if($ENCRYPTION_TYPE == 'tls') echo "selected"; ?> >TLS</option>
												<option value="ssl" <? if($ENCRYPTION_TYPE == 'ssl') echo "selected"; ?> >SSL</option>
											</select>
											<span class="bar"></span>
											<label for="ENCRYPTION_TYPE">Encryption Type</label>
										</div>
									</div>

									<div class="d-flex">
										<div class="col-12 col-sm-6 form-group focused" id="USER_NAME_LBL">
											<input type="text" class="required-entry form-control" id="USER_NAME" name="USER_NAME" value="<?=$USER_NAME?>" placeholder="john@gmail.com" >
											<span class="bar"></span>
											<label for="USER_NAME">User Name</label>
										</div>
									</div>
									<div class="d-flex">
										<div class="col-12 col-sm-6 form-group focused" id="PASSWORD_LBL">
											<input type="password" class="required-entry form-control" id="PASSWORD" name="PASSWORD" value="<?=$PASSWORD?>" placeholder="Your Email Password" >
											<span class="bar"></span>
											<label for="PASSWORD">Password</label>
										</div>
									</div>

								<div class="row">
									<div class="col-3 col-sm-3">
									</div>

									<div class="col-9 col-sm-9">
										<button type="submit" class="btn waves-effect waves-light btn-info">Save</button>
										<button type="button" onclick="window.location.href='manage_email_account'"  class="btn waves-effect waves-light btn-dark">Cancel</button>
									</div>
								</div>
                            </div>
                        </form>
                     </div>
                </div>
            </div>

		</div>
	</div>

	<? require_once("footer.php"); ?>
</div>

	<? require_once("js.php"); ?>

	<script src="../backend_assets/dist/js/validation_prototype.js"></script>
	<script src="../backend_assets/dist/js/validation.js"></script>

	<script type="text/javascript">
		var form1 = new Validation('form1');

		jQuery(document).ready(function($) {
			document.getElementById('HOST_LBL').classList.add("focused");
			document.getElementById('PORT_LBL').classList.add("focused");
			document.getElementById('USER_NAME_LBL').classList.add("focused");
			document.getElementById('PASSWORD_LBL').classList.add("focused");
		});
	</script>
</body>

</html>
