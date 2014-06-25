<?php
include 'config/config.inc';

$session = LSession::instance();
if (!$session->get('admin_id')) {
	header('Location: login.php');
}

if (empty($_GET['id'])) {
	header('Location: search.php');
}

$business = new BusinessDao($_GET['id']);

if ($business->var[BusinessDao::IDCOLUMN]==0) {
	header('Location: search.php');
}

if (isset($_POST['verified'])) {
	$business->var[BusinessDao::NAMEZH] = $_POST['namezh'];
	$business->var[BusinessDao::NAMETW] = $_POST['nametw'];
	$business->var[BusinessDao::NAMEEN] = $_POST['nameen'];
	$business->var[BusinessDao::IMAGE] = $_POST['image'];
	$business->var[BusinessDao::STREET] = $_POST['street'];
	$business->var[BusinessDao::CITY] = $_POST['city'];
	$business->var[BusinessDao::STATE] = $_POST['state'];
	$business->var[BusinessDao::COUNTRY] = $_POST['country'];
	$business->var[BusinessDao::ZIP] = $_POST['zip'];
	$business->var[BusinessDao::LAT] = $_POST['lat'];
	$business->var[BusinessDao::LNG] = $_POST['lng'];
	$business->var[BusinessDao::PRICE] = $_POST['price'];
	$business->var[BusinessDao::HOURS] = $_POST['hours'];
	$business->var[BusinessDao::CASHONLY] = $_POST['cashonly'];
	$business->var[BusinessDao::VERRFIED] = $_POST['verified'];
	$business->var[BusinessDao::TEL] = $_POST['tel'];
	$business->var[BusinessDao::WEBSITE] = $_POST['website'];
	$business->var[BusinessDao::SOCIAL] = $_POST['social'];

	$updated = $business->save();
}
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<title>Business Detail</title>
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
<tr><td class="first">Business ID:</td><td><?=$business->var[BusinessDao::IDCOLUMN] ?></td></tr>
<tr><td class="first">User ID:</td><td><?=$business->var[BusinessDao::USERID] ?></td></tr>
<tr><td class="first">Chinese Simplified Name:</td><td><input type="text" class="field" name="namezh" value="<?=$business->var[BusinessDao::NAMEZH] ?>" /></td></tr>
<tr><td class="first">Chinese Troditional Name:</td><td><input type="text" class="field" name="nametw" value="<?=$business->var[BusinessDao::NAMETW] ?>" /></td></tr>
<tr><td class="first">English Name:</td><td><input type="text" class="field" name="nameen" value="<?=$business->var[BusinessDao::NAMEEN] ?>" /></td></tr>
<tr><td class="first"><img src="<?=$business->var[BusinessDao::IMAGE] ?>"/></td><td><input type="text" class="field" name="image" value="<?=$business->var[BusinessDao::IMAGE] ?>" /></td></tr>
<tr><td class="first">Street:</td><td><input type="text" class="field" name="street" value="<?=$business->var[BusinessDao::STREET] ?>" /></td></tr>
<tr><td class="first">City:</td><td><input type="text" class="field" name="city" value="<?=$business->var[BusinessDao::CITY] ?>" /></td></tr>
<tr><td class="first">State:</td><td><input type="text" class="field" name="state" value="<?=$business->var[BusinessDao::STATE] ?>" /></td></tr>
<tr><td class="first">Country:</td><td><input type="text" class="field" name="country" value="<?=$business->var[BusinessDao::COUNTRY] ?>" /></td></tr>
<tr><td class="first">Zip:</td><td><input type="text" class="field" name="zip" value="<?=$business->var[BusinessDao::ZIP] ?>" /></td></tr>
<tr><td class="first">Latitude:</td><td><input type="text" class="field" name="lat" value="<?=$business->var[BusinessDao::LAT] ?>" /></td></tr>
<tr><td class="first">Longitude:</td><td><input type="text" class="field" name="lng" value="<?=$business->var[BusinessDao::LNG] ?>" /></td></tr>
<tr><td class="first">Price:</td><td><input type="text" class="field" name="price" value="<?=$business->var[BusinessDao::PRICE] ?>" /></td></tr>
<tr><td class="first">Hours:</td><td><input type="text" class="field" name="hours" value="<?=$business->var[BusinessDao::HOURS] ?>" /></td></tr>
<tr><td class="first">Cash Only:</td><td><input type="text" class="field" name="cashonly" value="<?=$business->var[BusinessDao::CASHONLY] ?>" /></td></tr>
<tr><td class="first">Tel:</td><td><input type="text" class="field" name="tel" value="<?=$business->var[BusinessDao::TEL] ?>" /></td></tr>
<tr><td class="first">Website:</td><td><input type="text" class="field" name="website" value="<?=$business->var[BusinessDao::WEBSITE] ?>" /></td></tr>
<tr><td class="first">Social Link:</td><td><input type="text" class="field" name="social" value="<?=$business->var[BusinessDao::SOCIAL] ?>" /></td></tr>
<tr><td class="first">Verified:</td><td><input type="text" class="field" name="verified" value="<?=$business->var[BusinessDao::VERRFIED] ?>" /></td></tr>
<tr><td></td><td><input class="button" type="submit" value="Update" /> <input onclick="window.location.href='search.php'" class="button" type="button" value="Cancel" /></td></tr>
</table>
</form>
</div>
<?php include 'inc/footer.inc.php' ?>
</body>
<script type="text/javascript" src="js/common.js"></script>
</html>