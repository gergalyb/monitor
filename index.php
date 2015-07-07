<?php
/*if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}*/
?>

<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="./css/style.css">
  <meta charset="utf-8">
</head>

<?php
require './config/conn.php';
require './templates/menu.php';
require './templates/sidebar.php';
require './templates/mainContent.php';
?>

</html>
