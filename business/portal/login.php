<?php
include 'config/config.inc';

$session = LSession::instance();

if (isset($_POST['business_admin_email']) && isset($_POST['business_admin_passwd'])) {
	$admin = BusinessAdminDao::login($_POST['business_admin_email'], $_POST['business_admin_passwd']);
	if (isset($admin)) {
		$session->set('admin_id', $admin->var[BusinessAdminDao::IDCOLUMN]);
		$session->set('admin_name', $admin->var[BusinessAdminDao::USERNAME]);
	}
}

if ($session->get('admin_id')) {
	header('Location: search.php');
}
?>
<!DOCTYPE>
<html>
<head>
<title>Business Administrator Login</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<?php include 'inc/header.inc.php' ?>
<div id="body">
<form method="post" action="" enctype="multipart/form-data" accept-charset="UTF-8">
<table>
<tr><td>Email:</td><td><input class="field" type="text" name="business_admin_email" /></td></tr>
<tr><td>Password:</td><td><input class="field" type="password" name="business_admin_passwd" /></td></tr>
<tr><td></td><td><input class="button" type="submit" value="Sign in" /> <input class="button" type="button" value="Cancel" /></td></tr>
</table>

</form>
</div>
<?php include 'inc/footer.inc.php' ?>
</body>
<script type="text/javascript" src="js/common.js"></script>
</html>