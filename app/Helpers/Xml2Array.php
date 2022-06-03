<?php

if (!function_exists('Xml2Array')) {
  function Xml2Array(string $source)
  {
    $xmlString = file_get_contents($source);
    $xmlObject = simplexml_load_string($xmlString);

    $json = json_encode($xmlObject);
    $array = json_decode($json, true);

    dd($array);
  }
}
