<?php
include '../configs/load.php';
include BASE_HOME."includes/IboUser.class.php";

$method = $_GET['method'];

if($method == "checkemail"){
	$email = $_GET['email'];
	$userdb = new IboUser($dbutil);
	$re = $userdb->checkEmailUnique($email);
	if($re){
		echo "yes";
	}else{
		echo "no";
	}
	exit(0);
}

if($method == "checkcode"){
	$code = $_GET['code'];
	$vcode = $_SESSION['VerifyCode'];
	if(strtolower($code) == strtolower($vcode)){
		echo "yes";
	}else{
		echo "no";
	}
	exit(0);
}

if($method == "register"){
	$email = $_GET['email'];
	$pass = $_GET['pass'];
	$userdb = new IboUser($dbutil);
	$userdb->addUser($email, $pass);
	echo "yes";
	exit(0);
}elseif ("updateUsername" == $method){
	$updateValue = $_GET['updateValue'];
	$userKey = $_GET['userKey'];
	$userdb = new IboUser($dbutil);
	$re = $userdb->updateUsername($userKey, $updateValue);
	if($re){
		$user = $_SESSION['user'];
		if($user != null){
			$user->user_name = $updateValue;
		}
		echo "yes";
	}else{
		echo "no";
	}
	exit(0);
}elseif ("updatePassword" == $method){
	$updateValue = $_GET['updateValue'];
	$userKey = $_GET['userKey'];
	$userdb = new IboUser($dbutil);
	$pass = encodePassword($updateValue);
	$re = $userdb->updatePassword($userKey, $pass);
	if($re){
		$user = $_SESSION['user'];
		if($user != null){
			$user->user_passwd = $pass;
		}
		echo "yes";
	}else{
		echo "no";
	}
	exit(0);
}elseif("updatePhoto" == $method){
	$userid = $_GET['userKey'];
	$fileElementName = "tagsInput";
	if(!empty($_FILES[$fileElementName]['error'])){
		echo $_FILES[$fileElementName]['error'];
	}elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none'){
		$error = 'No file was uploaded..';
		echo $error;
	}else{
		
		$oldName = $_FILES[$fileElementName]["name"];
		$namePart = explode(".",$oldName);
		$typeTag = ".".$namePart[count($namePart)-1];
// 		if('.jpg' == $typeTag || ".png"==$typeTag){
			$time = str_replace(" ","",microtime());
			$filename = 'upload/'.$userid."-userPhoto-".$time.$typeTag;
			
			$filenameTmp = $_FILES[$fileElementName]['tmp_name'];
			
			move_uploaded_file($filenameTmp, $filename);
			
			$userdb = new IboUser($dbutil);
			$re = $userdb->updatePhoto($userid, $filename);
			if($re==1){
				$user = $_SESSION['user'];
				if($user != null){
					$user->user_photo = $filename;
				}
				$arr = array ('result'=>'yes','path'=>$filename);
				echo json_encode($arr);
			}else{
				$arr = array ('result'=>'no','path'=>$filename);
				echo json_encode($arr);
			}
// 		}
	}
}
?>