<x-public.layouts.main>
  <div class="bg-body-extra-light">
    <div class="content content-full">
      <div class="push mb-5">

        <section class="d-flex mb-3 flex-wrap gap-5">
          <div>
            <a href="http://{{ $merchant->site }}" class="text-dark">
              <h1 class="fs-2 mb-2">{{ $merchant->site }}</h1>
            </a>
            <div class="logo">
              @if ($hasLogo)
                <img src="{{ $logo }}">
              @endunless
          </div>
        </div>

        <div class="text-center">
          <div class="rating fs-2 fw-bold">{{ sprintf('%0.1f', $merchant->rate) }}</div>
          <x-stars class="fs-3" :rate="$merchant->rate" :hideCount="true" />
          <div class="reviewCount">Reviews: {{ $merchant->reviews_count }}</div>
        </div>
      </section>

      <section class="contacts mb-5">
        <h2 class="fs-3 mb-2">Contacts</h2>
        <div class="d-flex ms-2 flex-wrap gap-3">
          @foreach ($contacts as $contact)
            @php
              $v = $contact['value'];
            @endphp
            <div class="contact" style="min-width: 150px">
              <h3 class="contact__name fw-bold fs-6 m-0">{{ $merchant->getVerboseContactType($contact) }}</h3>
              @switch($contact['type'])
                @case('email')
                  <div class="contact__value"><a href="tel:{{ preg_replace('/\W/', '', $v) }}">{{ $v }}</a>
                  </div>
                @break

                @case('phone')
                  <div class="contact__value"><a href="mail:{{ $v }}"></a>{{ $v }}</div>
                @break

                @default
                  <div class="contact__value">{{ $v }}</div>
              @endswitch
            </div>
          @endforeach
        </div>
      </section>

      {{-- <div class="popular-categories">
        <h2 class="fs-5 mb-2">Popular categories</h2>
        <div class="d-flex ms-2 flex-wrap gap-4">
          @foreach ($contacts as $contact)
            <a class="contact__name fs-6">Category</a>
          @endforeach
        </div>
      </div> --}}

      {{-- <div class="popular-products">
        <h2 class="fs-5 mb-2">Popular categories</h2>
        <div class="d-flex ms-2 flex-wrap gap-4">
          @foreach ($contacts as $contact)
            <a class="contact__name fs-6">Category</a>
          @endforeach
        </div>
      </div> --}}


      <section class="reviews card card-body">
        <div class="heading">
          <h2 class="d-inline-block fs-5">Reviews</h2> <span
            class="count">{{ $merchant->reviews_count }}</span>
        </div>
        <div class="reviews_statistics">
          <div class="bar">
            @foreach ($merchant->getReviewsReport() as $stars => $rr)
              @if ($rr['count'] > 0)
                <div class="d-flex reviews-col stars{{ $stars }} gap-1" style="width:{{ $rr['percent'] }}%"
                  title="{{ $rr['text'] }}">
                  @if ($rr['percent'] > 10)
                    <span class="ms-1 fw-bold">{{ $stars }}</span>
                  @endif
                  @if ($rr['percent'] > 20)
                    <i class="fa fa-star fs-8"></i>
                  @endif
                  @if ($rr['percent'] > 30)
                    <span class="fs-7">{{ $rr['percent'] }}%</span>
                  @endif
                </div>
              @endif
            @endforeach
          </div>
        </div>

        <div class="reviews-list">
          @foreach ($reviews as $review)
            <div class="review-item">
              <div class="flex flex-wrap gap-3">
                <div class="d-inline-block stars-wrapper">
                  <x-stars class="" :rate="$review->stars" :hideCount="true" />
                </div>
                <div class="d-inline-block date text-muted">{{ $review->created_at->format('Y-m-d') }}</div>
              </div>
              <div class="text mb-2">
                {{ $review->text }}
              </div>
              <div class="questions">
                @foreach ($review->questions as $question)
                  <div @class([
                      'question',
                      'text-success' => $question['answer'],
                      'text-danger' => !$question['answer'],
                  ])>{{ $question['text'] }}</div>
                @endforeach
              </div>
            </div>
            <hr>
          @endforeach
          <div id="pagination" class="d-flex d-sm-block justify-content-center">
            {{ $reviews->withQueryString()->onEachSide(2)->links() }}
          </div>
        </div>
      </section>

    </div>
  </div>
</div>
</x-public.layouts.main>
