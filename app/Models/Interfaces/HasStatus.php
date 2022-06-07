<?php

namespace App\Models\Interfaces;

interface HasStatus
{
  const STATUS_PUBLISHED = 'published';
  const STATUS_DRAFT = 'draft';
  const STATUS_TRASH = 'trash';
  const STATUSES = [
    self::STATUS_PUBLISHED,
    self::STATUS_DRAFT,
    self::STATUS_TRASH,
  ];
}
