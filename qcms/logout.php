<?php
ob_start(); //begin buffering of output - probably not require for SR since using javascript redirects

require_once("cms.inc.php");

$_SESSION = array();
session_destroy();

echo "<script>self.location='$CONFIG[url_prefix]/qcms/index.php';</script><noscript>You cannot login without JavaScript. Please enable Javascript, or get a browser that supports it.</noscript>";

ob_end_flush(); //output buffer to browser

exit();
?>
