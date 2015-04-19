<?php

$xml = new DOMDocument();
$xml->load('data.xml');

if (!$xml->schemaValidate('jeuxvideo.xsd')) {
    print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
} else {
    echo 'ok';
}
