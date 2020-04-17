<?php
@include_once("_Configuration.php");

startSessionIfNotSet();
if (!isset($_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA])) {
    header("Location: index.php");
}
