document.addEventListener('alpine:init', () => {
  Alpine.data('app', () => ({
    init() {
      Array.from(document.querySelectorAll('[data-question]')).forEach($e => {
        this.fields.questions[$e.dataset.question] = { answer: null, text: $e.dataset.answer };
      });
    },

    state: {
      hoverStar: 0,
    },
    fields: {
      stars: 0,
      questions: {},
      text: ''
    },

    submit() {
      this.$refs.form.submit();
    },

    answer(question, text, val) {
      const oldVal = this.fields.questions[question].answer;
      console.log(oldVal, val);
      if (oldVal == val) val = null;
      this.fields.questions[question] = { answer: val, text: text };
    },

    isActiveStar(idx) {
      return idx <= Math.max(this.state.hoverStar, this.fields.stars)
    }

  }))
})