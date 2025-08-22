<?php
/*logout.php */
//This page handles the sessions//?>
<?php
session_start();
session_destroy();
header("Location: login.php");
exit;
