<?php
	#require_once '../config/serv_conf.inc';

if ($_POST["button"] == "Change Quantity")
{
   	while(list($key,$value)=each($_COOKIE["items_tray"]))
   	{
		$tmp = $_POST["qty".$key];
                if ($tmp == "0")
                        continue ;
                else {
                        $set_qty[$key] = $tmp;
      		setcookie('items_tray['.$key.']', $set_qty[$key], 0, '/', $SITECOOKIE, FALSE);
		}
	}
	if ( $rewriteurl == "yes" ) {
		header('Location:/cart.html');
	} else {
		        header('Location:/index.php?main=cart'); }
   	exit();
}
else if ($_POST["button"] == "Remove Item")
{
	/*while(list($key,$value)=each($_COOKIE["items_tray"]))
	{
		if($_POST["remove_item"] == $key)
		{
			setcookie('items_tray['.$key.']', "", 0, '/', $SITECOOKIE, FALSE);
		}
	}*/	
	#phpinfo();
	if(isset($_COOKIE["items_tray"]))
                while(list($key,$value)=each($_COOKIE["items_tray"]))
                {
                        reset($_POST["remove_item"]);
                        while(list($key2,$value2)=each($_POST["remove_item"]))
                        {
                                if($key2 == $key)
                                {
                                        setcookie('items_tray['.$key.']', "", 0, '/', $SITECOOKIE, FALSE);
                                }
                        }
                }
	if ( $rewriteurl == "yes" ) {
		header('Location:/cart.html');
	} else {
		        header('Location:/index.php?main=cart'); }
        exit();
}
else if ($_POST["button"] == "Check Out")
{
	if($_COOKIE["check_out"] == "false" || $_COOKIE["check_out"] == "")
	{
		setcookie('check_out', "true", 0, '/', $SITECOOKIE, FALSE);
   		header('Location:'.$SSLWEBSITE.'/registry.html');
   		exit();
	}
	elseif ($_COOKIE["check_out"] == "true")
	 {
		header('Location:'.$SSLWEBSITE.'/index.php?main=display_info');
                exit();
	}
}
elseif (isset($_GET["pass_id"]))
{	
        setcookie('items_tray['.$_GET["pass_id"].']', '1', 0, '/', $SITECOOKIE, FALSE);
	if ( $rewriteurl == "yes" ) {
		header('Location:/cart.html');
	} else {
		        header('Location:/index.php?main=cart'); }
        exit();
}
elseif (isset($_POST["value"]))
{	
        setcookie('items_tray['.$_POST["value"].']', '1', 0, '/', $SITECOOKIE, FALSE);
	header('Location:'.$_SERVER["HTTP_REFERER"]);
        exit();
}
?>
