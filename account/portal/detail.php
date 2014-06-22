<?php
include 'config/config.inc';

$session = LSession::instance();
if (!$session->get('admin_id')) {
	header('Location: login.php');
}

if (empty($_GET['id'])) {
	header('Location: search.php');
}

$user = new UserDao($_GET['id']);

if ($user->var[UserDao::IDCOLUMN]==0) {
	header('Location: search.php');
}

if (isset($_POST['username'])) {
	$user->var[UserDao::USERNAME] = $_POST['username'];
	$user->var[UserDao::NICKNAME] = $_POST['nickname'];
	$user->var[UserDao::PROFILEPIC] = $_POST['profile_pic'];
	$user->var[UserDao::DESCRIPTION] = $_POST['description'];
	$user->var[UserDao::SUPERUSER] = $_POST['superuser'];
	$user->var[UserDao::BLOCKED] = $_POST['blocked'];

	$updated = $user->save();
}
?>
<!DOCTYPE>
<html>
<head>
<title>Account Administrator Login</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/detail.css">
</head>
<body>
<?php include 'inc/header.inc.php' ?>
<div id="body">
<?php
if (isset($updated)) {
	echo $updated ? '<span class="success">- Successfully updated</span>' : '<span class="error">x Error on update</span>';
} 
?>
<form id="update" method="post" action="" enctype="multipart/form-data" accept-charset="UTF-8">
<table>
<tr><td class="first">Account ID:</td><td><?=$user->var[UserDao::IDCOLUMN] ?></td></tr>
<tr><td class="first">External Type:</td><td><?=$user->var[UserDao::EXTERNALTYPE] ?></td></tr>
<tr><td class="first">External ID:</td><td><?=$user->var[UserDao::EXTERNALREF] ?></td></tr>
<tr><td class="first"><img src="<?=$user->var[UserDao::PROFILEPIC] ?>"/></td><td><input type="text" class="field" name="profile_pic" value="<?=$user->var[UserDao::PROFILEPIC] ?>" /></td></tr>
<tr><td class="first">User Name:</td><td><input type="text" class="field" name="username" value="<?=$user->var[UserDao::USERNAME] ?>" /></td></tr>
<tr><td class="first">Nick Name:</td><td><input type="text" class="field" name="nickname" value="<?=$user->var[UserDao::NICKNAME] ?>" /></td></tr>
<tr><td class="first">Description:</td><td><input type="text" class="field" name="description" value="<?=$user->var[UserDao::DESCRIPTION] ?>" /></td></tr>
<tr><td class="first">Superuser:</td><td><input type="text" class="field" name="superuser" value="<?=$user->var[UserDao::SUPERUSER] ?>" /></td></tr>
<tr><td class="first">Blocked:</td><td><input type="text" class="field" name="blocked" value="<?=$user->var[UserDao::BLOCKED] ?>" /></td></tr>
<tr><td class="first">Last Login:</td><td><?=$user->var[UserDao::LASTLOGIN] ?></td></tr>
<tr><td></td><td><input class="button" type="submit" value="Update" /> <input onclick="window.location.href='search.php'" class="button" type="button" value="Cancel" /></td></tr>
</table>
</form>
</div>
<?php include 'inc/footer.inc.php' ?>
</body>
<script type="text/javascript" src="js/common.js"></script>
</html>