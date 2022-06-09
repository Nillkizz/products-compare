<?php

namespace App\Providers;

use App\Models\StoreReview;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
  /**
   * The event listener mappings for the application.
   *
   * @var array<class-string, array<int, class-string>>
   */
  protected $listen = [
    Registered::class => [
      SendEmailVerificationNotification::class,
    ],
  ];

  /**
   * Register any events for your application.
   *
   * @return void
   */
  public function boot()
  {
    StoreReview::created(fn (StoreReview $review) => $review->store->incr_rate());
    StoreReview::saved(fn (StoreReview $review) => $review->store->recalculate_rate());
    StoreReview::deleted(fn (StoreReview $review) => $review->store->decr_rate());
  }

  /**
   * Determine if events and listeners should be automatically discovered.
   *
   * @return bool
   */
  public function shouldDiscoverEvents()
  {
    return false;
  }
}
