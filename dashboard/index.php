<?php
require_once "/funcs/session.php";
avviaSessioneProtetta(15 * 60); // 15 minuti di timeout

echo "benvenuto {$_SESSION["username"]}";
?>