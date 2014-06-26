<?php
include 'config/config.inc';

$session = LSession::instance();
if (!$session->get('admin_id')) {
	header('Location: login.php');
}

$users = array();

if (!empty($_POST['nickname'])) {
	$ids = LookupUserNickNameDao::getUserIdsFromNickName(trim($_POST['nickname']));
	foreach ($ids as $id) {
		$users[$id] = new UserDao($id);
	}
}

if (!empty($_POST['ref_type']) && !empty($_POST['ref_id'])) {
	$ids = LookupUserExternalDao::getUserIdsFromExternalRef(trim($_POST['ref_type']), trim($_POST['ref_id']));
	foreach ($ids as $id) {
		$users[$id] = new UserDao($id);
	}
}
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<title>Account Search</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/search.css">
</head>
<body>
<?php include 'inc/header.inc.php' ?>
<div id="body">
<form id="name_search" method="post" action="" enctype="multipart/form-data" accept-charset="UTF-8">
<table id="name_search">
<tr><td>Search by Nink Name:</td></tr>
<tr><td class="first">Nick Name:</td><td><input class="field" type="text" name="nickname" /></td></tr>
<tr><td></td><td><input class="button" type="submit" value="Search" /></td></tr>
</table>
</form>
<form id="ref_search" method="post" action="" enctype="multipart/form-data" accept-charset="UTF-8">
<table>
<tr><td class="first">Search by External Reference:</td></tr>
<tr><td class="first">External Type:</td><td>
<select class="field" name="ref_type">
<option value=""></option>
<?php foreach (UserDao::$TYPEARRAY as $key=>$val) { ?>
<option value="<?=$val ?>"><?=$key ?></option>
<?php } ?>
</select>
</td></tr>
<tr><td class="first">External Id:</td><td><input class="field" type="text" name="ref_id" /></td></tr>
<tr><td></td><td><input class="button" type="submit" value="Search" /></td></tr>
</table>
</form>
<table id="user_detail">
<thead><tr>
<td>Account ID</td>
<td>Nick Name</td>
<td>External Type</td>
<td>External ID</td>
<td>Last Login Time</td>
<td>Superuser</td>
<td>Blocked</td>
</tr></thead>
<tbody>
<?php $index = 1; foreach ($users as $user) { ?>
<tr class="<?=($index%2==0 ? 'odd' : 'even') ?>">
<td><a href="detail.php?id=<?=$user->var[UserDao::IDCOLUMN] ?>"><?=$user->var[UserDao::IDCOLUMN] ?></a></td>
<td><?=$user->var[UserDao::NICKNAME] ?></td>
<td><?=UserDao::$TYPEARRAYREV[$user->var[UserDao::EXTERNALTYPE]] ?></td>
<td><?=$user->var[UserDao::EXTERNALREF] ?></td>
<td><?=$user->var[UserDao::LASTLOGIN] ?></td>
<td><?=$user->var[UserDao::SUPERUSER] ?></td>
<td><?=$user->var[UserDao::BLOCKED] ?></td>
</tr>
<?php $index++; }?>
</tbody>
</table>
</div>
<?php include 'inc/footer.inc.php' ?>
</body>
<script type="text/javascript" src="js/common.js"></script>
</html>