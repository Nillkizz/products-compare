<?php

if (!class_exists('BS')) {
  class BS
  {
    static function tooltip($text, $delay = 500)
    {
      return "data-bs-toggle='tooltip' data-bs-original-title='$text' data-bs-delay='$delay' data-bs-animation='true'";
    }
  }
}
