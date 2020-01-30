
<?php
$version = $argv[1];

if (!$version) {
    echo "Please specify version";
    exit();
}

function Zip($source, $destination) {
    if (!extension_loaded('zip') || !file_exists($source)) {
        echo extension_loaded('zip');
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            $file = realpath($file);

            if (is_dir($file) === true)
            {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true)
            {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}

$hasError = false;

$outputFilename = "template-".$version.".zip";

$componentCfgFile = "src/templateDetails.xml";
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
    $xml->update->downloads->downloadurl = 'https://raw.githubusercontent.com/arctur-de/joomla-template-die-gruenen/master/dist/'.$outputFilename;
    $xml->asXML($componentUpdateFile);
} else {
    $hasError = true;
}

if (!$hasError && !Zip("src", "dist/".$outputFilename)) {
    $hasError = true;
};

if ($hasError) {
    echo "ERROR";
} else {
    echo "DONE";
}