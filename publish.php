
<?php
$version = $argv[1];

if (!$version) {
    echo "Please specify version";
    exit();
}

$hasError = false;

$componentCfgFile = "templateDetails.xml";
if (!$hasError && file_exists($componentCfgFile)) {
    $xml = simplexml_load_file(($componentCfgFile));
    $xml->version = $version;
    $xml->asXML($componentCfgFile);
} else {
    $hasError = true;
}

$componentUpdateFile = "update.xml";
if (!$hasError && file_exists($componentUpdateFile)) {
    $xml = simplexml_load_file(($componentUpdateFile));
    $xml->update->version = $version;
    $xml->update->downloads->downloadurl = 'https://github.com/arctur-de/joomla-template-die-gruenen/archive/v'.$version.".zip";
    $xml->asXML($componentUpdateFile);
} else {
    $hasError = true;
}

if ($hasError) {
    echo "ERROR";
} else {
    echo "DONE";
}