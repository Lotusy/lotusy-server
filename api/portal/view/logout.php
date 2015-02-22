<?php
include 'config/config.inc';

$session = LSession::instance();

$session->destroy();

header('Location: login.php');
?>
