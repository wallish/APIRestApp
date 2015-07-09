<?php
$xml = simplexml_load_file("xmltest.xml");

$result = $xml->xpath("titre");

print_r($result);
?> 