<?php
session_start();

if (!isset($_SESSION["User"])) {
    header("Location: login_ui.php");
    exit();
}

header("Location: dashboardUi.php");
exit();
