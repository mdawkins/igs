<?php

#require_once '../functions/functions.php';
// $BASE is the name=$BASE in a form
// $MAINBASE is the main=$MAINBASE sent to the browser for direction
// $dbtable where info is being insert/update/select from
// $formfields is all the construct info
function regform($BASE, $MAINBASE, $dbtable, $formfields)
{
	#global $link;
	$FIELDCNT=0;
	while(list($key, $value) = each($formfields)) {
		$FIELDCNT++;
	}
	if(isset($_COOKIE["cookie_post"])) {
		$line = preg_split(";", $_COOKIE["cookie_post"]);
		foreach ($line as $postvar) {
			list($postname, $postvarible) = split(",",$postvar);
			$_POST[$postname] = $postvarible;		
		}
		setcookie('cookie_post', "", 0, '/', $SITECOOKIE, FALSE);
	}

	if ($_POST["action"] == "Continue" || $_POST["action"] == "Update" || $_POST["action"] == "Add"
		|| $_POST["action"] == "Register" || $_POST["action"] == "Update Password" || $_POST["action"] == "Send E-mail") {
		require_once '../functions/_check.php'; // sets $submitattempt no=passes yes=retry
	}

	// ****************************************************************************************
	if ($_POST["action"] == "Continue" && $submitattempt == "no") {
		$passpost='';
		while(list($key,$value)=each($_POST)) {
			$passpost.=$key.','.$value.';';
		}
		#$passpost.='action,Continue';
		setcookie('cookie_post', $passpost, 0, '/', $SITECOOKIE, FALSE);
		header('Location:index.php?main=billing');
		exit();
	// ****************************************************************************************
	} elseif ($_POST["action"] == "Add" && $submitattempt == "no") {
		require_once '../functions/_add.php';
		header('Location:'.$_SERVER["HTTP_REFERER"]);
		exit();
	} elseif ($_POST["action"] == "Update" && $submitattempt == "no") {
		require_once '../functions/_update.php';
		header('Location:'.$_SERVER["HTTP_REFERER"]);
		exit();
	} elseif ($_POST["action"] == "Update Password" && $submitattempt == "no") {
		$_POST["update_passwd"] = 'yes';
		require_once '../functions/_update.php';
		setcookie("cookie_passwd", $_POST["new_passwd"], 0, '/', $SITECOOKIE, TRUE);	
		unset($_POST["new_passwd"]);
		header('Location:'.$_SERVER["HTTP_REFERER"]);
		exit();
	} elseif ($_POST["action"] == "Send E-mail" && $submitattempt == "no") {
		require_once '../functions/_update.php';
		require_once '../functions/_email.php';
		header('Location:'.$_SERVER["HTTP_REFERER"]); 
		exit();
	} elseif ($_POST["action"] == "Register" && $submitattempt == "no") {
		$user_id=$_POST["user_id"];
		$cust_passwd=$_POST["cust_passwd"];
		require_once '../functions/_add.php';
		$_POST["user_id"]=$user_id;
		$_POST["cust_passwd"]=$cust_passwd;
		require_once '../functions/login.php';
		//break;
	} elseif ($_POST["action"] == "Change Password") {
		exit();
	} elseif ($_POST["action"] == "Delete") {
		require_once '../functions/_delete.php';
		header('Location:'.$_SERVER["HTTP_REFERER"]);
		exit();
	} elseif ($_POST["action"] == "Search" && $_SERVER["PHP_SELF"] == "/oss/formbase.php") { // change /oss/forbase depending on directory
		require_once '../functions/_search.php';
		header('Location:'.$_SERVER["HTTP_REFERER"].$search_href);
		exit();
	// ****************************************************************************************
	} else { // go back until the proper info is entered
		if (isset($_GET["searchfield"]) && (isset($_GET["value"])) || isset($_POST["value"]) ) {
			require_once '../functions/_retrieve.php';
		}
		if ($_SERVER["PHP_SELF"] == "/oss/formbase.php" || $_SERVER["PHP_SELF"] == "/formbase.php") { // this is for the webpages admin
			$passpost='';
			while(list($key,$value)=each($_REQUEST)) {
				$passpost.=$key.','.$value.';';
			}
			setcookie('cookie_post', $passpost, 0, '/', $SITECOOKIE, FALSE);
			header('Location:'.$_SERVER["HTTP_REFERER"]);
			exit();
		} else {
			require_once '../functions/_create.php';
		}
	}
}
#phpinfo(32);
?>
