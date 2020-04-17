<?php
class _Configuration
{
    public static $CONFIGURATION_QUERY_PARAMS = "php://input";
    public static $CONFIGURATION_SESSION_PERSONA = "persona_session";
    public static $CONFIGURATION_UPLOADS_DIR = '/constructora/uploads/';
}

function startSessionIfNotSet()
{
    if (!isset($_SESSION)) {
        session_start();
    }
}

function getPersonaFullName()
{
    startSessionIfNotSet();

    $fullName = "";
    $fullName = $_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["nombre_1"];
    if (isset($_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["nombre_2"])) {
        $fullName = $fullName . " " . $_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["nombre_2"];
    }
    if (isset($_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["nombre_3"])) {
        $fullName = $fullName . " " . $_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["nombre_3"];
    }
    if (isset($_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["apellido_paterno"])) {
        $fullName = $fullName . " " . $_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["apellido_paterno"];
    }
    if (isset($_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["apellido_materno"])) {
        $fullName = $fullName . " " . $_SESSION[_Configuration::$CONFIGURATION_SESSION_PERSONA][0]["apellido_materno"];
    }
    $fullName = str_replace("  ", " ",  " " . $fullName);
    return $fullName;
}

function getNameFile()
{
    $fecha = new DateTime();
    return $fecha->format('YmdHisu');
}

function base64_to_jpeg($base64_string)
{
    // open the output file for writing
    //$ifp = fopen($output_file, 'w+');
    $rootPath = $_SERVER["DOCUMENT_ROOT"];
    $outputFileName = getNameFile() . ".jpg";
    //$ifp = fopen($rootPath . "/uploads/" . $outputFileName, 'w+');
    $ifp = fopen($rootPath . _Configuration::$CONFIGURATION_UPLOADS_DIR . $outputFileName, 'w+');

    if (!$ifp) {
        return 'fopen failed. reason: ' . $php_errormsg;
    }
    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    $data = explode(',', $base64_string);

    // we could add validation here with ensuring count( $data ) > 1
    fwrite($ifp, base64_decode($data[1]));

    // clean up the file resource
    fclose($ifp);

    return $outputFileName;
}
