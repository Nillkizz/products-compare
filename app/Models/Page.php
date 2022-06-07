<?php

namespace App\Models;

use App\Models\Interfaces\HasStatus;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class Page extends Model implements HasStatus
{
  use HasFactory, Searchable;

  const SEARCH_COLUMN = 'name';
  const TEMPLATE_PREFIX = "public.page_templates.";
  const DEFAULT_TEMPLATE = self::TEMPLATE_PREFIX . "default";

  static public function getTemplates()
  {
    $files = File::files(resource_path('views/public/page_templates'));
    $fileNames = array_map(fn ($f) => $f->getFilename(), $files);
    $template_names = array_map(fn ($filename) => preg_replace('/(\.blade)?\.php$/', '', $filename), $fileNames);
    $templates = array_map(fn ($template_name) => self::TEMPLATE_PREFIX . $template_name, $template_names);
    return array_combine($template_names, $templates);
  }

  public function getTemplate($template_name = null)
  {
    if ($template_name == null) $template_name = $this->template;
    return Arr::get(self::getTemplates(), $template_name, self::DEFAULT_TEMPLATE);
  }

  protected $fillable = [
    'name', 'title', 'path', 'template', 'description', 'content', 'status'
  ];
}
