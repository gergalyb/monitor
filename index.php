<?php
/*if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}*/
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">

    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />

    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./bootstrap/material/css/material-fullpalette.css">
    <link rel="stylesheet" href="./bootstrap/material/css/ripples.css">
    <link rel="stylesheet" href="./bootstrap/material/css/roboto.css">
    <link rel="stylesheet" href="./bootstrap/datepicker/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="./bootstrap/datetimepicker/css/bootstrap-datetimepicker.css">

    <script type="text/javascript" src="./js/script.js"></script>
    <script type="text/javascript" src="./bootstrap/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="./bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="./bootstrap/material/js/material.min.js"></script>
    <script type="text/javascript" src="./bootstrap/material/js/ripples.min.js"></script>
    <script type="text/javascript" src="./bootstrap/datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="./bootstrap/datepicker/locales/bootstrap-datepicker.hu.min.js"></script>
    <script type="text/javascript" src="./bootstrap/datetimepicker/js/moment.js"></script>
    <script type="text/javascript" src="./bootstrap/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

    <title>Dreher üzenetforgalom monitoring</title>
</head>
<body>

<?php
require './config/conn.php';
require './templates/menu.php';
require './templates/sidebar.php';
require './templates/mainContent.php';
?>

</body>
</html>
