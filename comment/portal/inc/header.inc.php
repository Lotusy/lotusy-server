<?php
$session = LSession::instance();
?>
<div id="header">
<?php if ($session->get('admin_id')) { ?>
<div id="logout" onclick="window.location.href='logout.php'"><label>Logout</label></div>
<?php } ?>
<div id="logo"></div>
</div>
<div class="space"></div>