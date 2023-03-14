<?php
// Load the XML file
$xml = new DomDocument();
$xml->load('users.xml');

// Load the XSLT file
$xsl = new DomDocument();
$xsl->load('users.xsl');

// Create an XSLT processor and import the XSLT stylesheet
$processor = new XsltProcessor();
$processor->importStylesheet($xsl);

// Set the parameters for the XSLT stylesheet
$processor->setParameter('', 'usertype', 'Tenant');

// Transform the XML file using the XSLT processor
$html = $processor->transformToXML($xml);

// Output the resulting HTML
echo $html;
?>

