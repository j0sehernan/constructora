<?php
@include_once("_Configuration.php");

startSessionIfNotSet();
session_destroy();
unset($_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA]);
header("Location: ../index.php");
