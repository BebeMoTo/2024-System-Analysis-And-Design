<?php
require_once "config.php";

unset($_SESSION['username']);
session_unset();
session_destroy();
header("Location: ../index.php?logout");
