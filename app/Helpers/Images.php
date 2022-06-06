<?php

namespace Helpers;

class Images
{
  static function modelImageHandler($instance, string $collection, $withFallback = true, string|null $conversion = null)
  {
    $image_url = null;
    $media = $instance->getFirstMedia($collection);

    if ($media == null) {
      if ($withFallback) $image_url = env('FALLBACK_IMAGE_URL');
      return $image_url;
    }

    if ($media->hasGeneratedConversion($conversion)) $image_url = $media->getUrl($conversion);
    else $image_url = $media->getUrl();

    return $image_url;
  }
}
