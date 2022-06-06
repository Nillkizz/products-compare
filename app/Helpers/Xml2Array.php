<?php

if (!function_exists('Xml2Array')) {
  function Xml2Array(string $xmlString)
  {
    $xmlObject = simplexml_load_string($xmlString,);
    $json = json_encode($xmlObject);
    $array = json_decode($json, true);

    return $array;
  }
}
