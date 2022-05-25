#!/usr/bin/php
<?php

error_reporting(E_ALL);

ini_set("display_errors", 1);

$fila = utf8_encode($argv[1]);
$nmtitulochamado = utf8_encode($argv[2]);
$dschamado = utf8_encode($argv[3]);

$soapURL = "https://qualitor.teccloud.com/qualitor/ws/services/service.php?wsdl=WSTicket";
$soapClient = new SoapClient($soapURL);
$token = $soapClient->login('noc.stefanini', 'Stef@nini@2021', 1);

#print $token;

$xml = '<?xml version="1.0" encoding="UTF-8"?>';
$xml .= '<wsqualitor>';
$xml .= " <contents> ";
$xml .= "  <data> ";
$xml .= "        <cdtipochamado>39</cdtipochamado>";
$xml .= "        <cdcontato>50</cdcontato>";
$xml .= "        <nmtitulochamado>$nmtitulochamado</nmtitulochamado>";
$xml .= "        <cdcategoria>$fila</cdcategoria>";
$xml .= "        <cdlocalidade>3</cdlocalidade>";
$xml .= "        <cdorigem>5</cdorigem>";
$xml .= "        <cdseveridade>4</cdseveridade>";
$xml .= "        <idchamado>1</idchamado>";
$xml .= "        <dschamado>$dschamado</dschamado>";
$xml .= "        <cdcliente>39</cdcliente>";
$xml .= "  </data> ";
$xml .= "   <informacoesadicionais>";
$xml .= "    <vlinformacaoadicional49><![CDATA[Data Center Campo Bom (DC CBM)]]></vlinformacaoadicional49>";
$xml .= "   </informacoesadicionais>";
$xml .= " </contents> ";
$xml .= '</wsqualitor>';

$return = $soapClient->addTicketByData($token, $xml);

print $return;
print "
";
