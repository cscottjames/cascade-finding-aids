<?php

//get the file parameter from the request URL
$param = $_GET['file'];

//create a new XML file with XSLT in it
$xslDoc = new DOMDocument();
$xslDoc->load("ead.xsl");
$xmlDoc = new DOMDocument();
$url = 'xml/' . $param . ".xml";
$xmlDoc->load($url);

//error handling for incorrect parameters (bad link)
if (@$xmlDoc->load($url) === false) { echo "Error: The finding aid you requested is either unavailable or could not be accessed. If you continue to experience problems, please file a support ticket at <a href='/contact-us/report-a-problem.html'>Report a Problem</a>"; }

//transform the XML into HTML
$proc = new XSLTProcessor();
$proc->importStylesheet($xslDoc);
echo $proc->transformToXML($xmlDoc);

?>