<form name="login" method=post action="formbase.php">
<div class=tbl_title_front>
	<h4 class=title_form>Login here</h4>
	<label for=user_id>User ID</label><input class=text name="user_id" type=text maxlength=30><br />
	<label for=passwd>Password</label><input class=text name="cust_passwd" type=password maxlength=30><a class=dark_small href="<?php #echo $PHP_SELF; ?>/emailpasswd.html">Forgot your Password?</a><br />
	<h4 class=title_button><input class=submit name="action" type=submit value="Login"></h4>
</div>
</form>
