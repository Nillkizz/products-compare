<x-public.layouts.main>
  <div class="bg-body-extra-light" x-data="app">
    <div class="content content-full">
      <section class="review d-flex justify-content-center">
        <div class="card" style="width: 600px">
          <div class="card-body d-flex flex-column gap-4">

            <div class="d-flex align-items-center gap-4">
              @unless(empty($store->logoUrl('h70')))
                <div class="logo overflow-hidden rounded border" style="height:70px"><img class="h-100"
                    src="{{ $store->logoUrl('s0-h70') }}" alt="logo"></div>
              @endunless
              <div class="site">{{ $store->site }}</div>
            </div>

            <div class="stars">
              <div class="fs-5">Evaluate your shopping experience</div>
              <div class="js-rating fs-2" style="cursor: pointer;" @@mouseout="state.hoverStar = 0">
                <template x-for="i in 5">
                  <i class="fa fa-fw fa-star"
                    :class="{ 'text-muted': !isActiveStar(i), 'text-warning': isActiveStar(i) }"
                    @@mouseover="state.hoverStar = i" @@click="fields.stars = i"></i>
                </template>
              </div>
            </div>

            <div class="questions" x-show="fields.stars > 0">
              @foreach ($questions as $item)
                <div class="d-flex align-items justify-content-between mb-2" data-question="{{ $item['question'] }}"
                  data-answer="{{ $item['answer'] }}">
                  <span>
                    {{ $item['question'] }}
                  </span>
                  <div class="answer">
                    <button class="btn btn-outline-secondary"
                      @@click="answer('{{ $item['question'] }}', '{{ $item['answer'] }}', true)"
                      :class="{ 'btn-outline-success': true == fields.questions['{{ $item['question'] }}'].answer }">Yes</button>
                    <button class="btn btn-outline-secondary"
                      @@click="answer('{{ $item['question'] }}', '{{ $item['answer'] }}', false)"
                      :class="{ 'btn-outline-danger': false == fields.questions['{{ $item['question'] }}'].answer }">No</button>
                  </div>
                </div>
              @endforeach
            </div>

            <div class="review" x-show="fields.stars > 0">
              <textarea class="form-control" style="resize: none; height: 120px;"
                placeholder="(Optional) Here you can describe your shopping process and your views on it without rudeness. Be polite, honest, helpful and constructive."
                x-model="fields.text"></textarea>
            </div>

            <div class="footer d-flex justify-content-between">
              <div class="spacer"></div>
              <button class="btn btn-primary" :disabled="fields.stars == 0" @@click="submit()">Leave
                Review</button>
            </div>
          </div>
        </div>
      </section>

      <form class="d-none" action="{{ route('store.reviews.store', compact('store')) }}" method="POST"
        x-ref="form">
        @csrf
        @method('POST')
        <input type="number" name="stars" :value="fields.stars">
        <template x-for="question, i in Object.entries(fields.questions)">
          <template x-if="question[1].answer !== null">
            <div>
              <input type="text" :name="`questions[${i}][question]`" :value="question[0]">
              <input type="text" :name="`questions[${i}][text]`" :value="question[1].text">
              <input type="text" :name="`questions[${i}][answer]`" :value="question[1].answer">
            </div>
          </template>
        </template>
        <textarea name="text" :value="fields.text"></textarea>
      </form>

    </div>
  </div>

  <x-slot name="js_after">
    <script src="{{ mix('static/public/js/pages/store-review_create.js') }}"></script>
  </x-slot>
</x-public.layouts.main>
