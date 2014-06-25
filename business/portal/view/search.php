<?php
include 'config/config.inc';

$session = LSession::instance();
if (!$session->get('admin_id')) {
	header('Location: login.php');
}

$businesses = array();

if (!empty($_POST['zh_name'])) {
	$ids = BusinessDao::getBusinessIdsByName($_POST['zh_name'], BusinessDao::NAMEZH);
	foreach ($ids as $id) {
		$businesses[$id] = new BusinessDao($id);
	}
}

if (!empty($_POST['tw_name'])) {
	$ids = BusinessDao::getBusinessIdsByName($_POST['tw_name'], BusinessDao::NAMETW);
	foreach ($ids as $id) {
		$businesses[$id] = new BusinessDao($id);
	}
}

if (!empty($_POST['en_name'])) {
	$ids = BusinessDao::getBusinessIdsByName($_POST['en_name'], BusinessDao::NAMEEN);
	foreach ($ids as $id) {
		$businesses[$id] = new BusinessDao($id);
	}
}

?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<title>Business Search</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/search.css">
</head>
<body>
<?php include 'inc/header.inc.php' ?>
<div id="body">
<form id="zh_name_search" method="post" action="" enctype="multipart/form-data" accept-charset="UTF-8">
<table>
<tr><td class="first">简体中文名称:</td><td><input class="field" type="text" name="zh_name" /></td><td><input class="button" type="submit" value="Search" /></td></tr>
</table>
</form>
<form id="tw_name_search" method="post" action="" enctype="multipart/form-data" accept-charset="UTF-8">
<table>
<tr><td class="first">繁體中文名稱:</td><td><input class="field" type="text" name="tw_name" /></td><td><input class="button" type="submit" value="Search" /></td></tr>
</table>
</form>
<form id="en_name_search" method="post" action="" enctype="multipart/form-data" accept-charset="UTF-8">
<table>
<tr><td class="first">English Name:</td><td><input class="field" type="text" name="en_name" /></td><td><input class="button" type="submit" value="Search" /></td></tr>
</table>
</form>
<table id="business_detail">
<thead><tr>
<td>ID</td>
<td>简体中文</td>
<td>繁體中文</td>
<td>English Name</td>
<td>Street</td>
<td>City</td>
<td>Verified</td>
</tr></thead>
<tbody>
<?php $index = 1; foreach ($businesses as $business) { ?>
<tr class="<?=($index%2==0 ? 'odd' : 'even') ?>">
<td><a href="detail.php?id=<?=$business->var[BusinessDao::IDCOLUMN] ?>"><?=$business->var[BusinessDao::IDCOLUMN] ?></a></td>
<td><?=$business->var[BusinessDao::NAMEZH] ?></td>
<td><?=$business->var[BusinessDao::NAMETW] ?></td>
<td><?=$business->var[BusinessDao::NAMEEN] ?></td>
<td><?=$business->var[BusinessDao::STREET] ?></td>
<td><?=$business->var[BusinessDao::CITY] ?></td>
<td><?=$business->var[BusinessDao::VERRFIED] ?></td>
</tr>
<?php $index++; }?>
</tbody>
</table>
</div>
<?php include 'inc/footer.inc.php' ?>
</body>
<script type="text/javascript" src="js/common.js"></script>
</html>