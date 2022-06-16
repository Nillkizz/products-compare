<?php

if (!function_exists('Xml2Array')) {
  function Xml2Array(string $xmlString)
  {
    $xmlObject = new SimpleXMLElement($xmlString, LIBXML_NOCDATA);
    $json = json_encode((array) $xmlObject);
    $array = json_decode($json, true);
    return $array;
  }
}
