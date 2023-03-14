<?php
// Load the XML file
$xml = new DomDocument();
$xml->load('cities.xml');

// Load the XSLT file
$xsl = new DomDocument();
$xsl->load('cities.xsl');

// Create an XSLT processor and import the XSLT stylesheet
$processor = new XsltProcessor();
$processor->importStylesheet($xsl);

// Transform the XML file using the XSLT processor
$html = $processor->transformToXML($xml);

// Output the resulting HTML
echo $html;
?>

