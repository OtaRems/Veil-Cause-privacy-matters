<?php
require_once "session.php";
avviaSessioneProtetta(15 * 60);
session_unset();
session_destroy();
header("Location: /login/index.html?expired=2");
exit();