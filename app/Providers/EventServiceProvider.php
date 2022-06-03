<?php

namespace App\Providers;

use App\Models\MerchantReview;
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
    MerchantReview::created(fn (MerchantReview $review) => $review->merchant->increment('reviews_count'));
    MerchantReview::saved(fn (MerchantReview $review) => $review->merchant->update(['average_rate' => $review->merchant->reviews->avg('stars')]));
    MerchantReview::deleted(fn (MerchantReview $review) => $review->merchant->decrement('reviews_count'));
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
