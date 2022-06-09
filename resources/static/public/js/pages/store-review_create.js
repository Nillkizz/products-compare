document.addEventListener('alpine:init', () => {
  Alpine.data('app', () => ({
    init() {
      const questions = this._questions = Array.from(document.querySelectorAll('[data-question]'))
        .map($e => ({ question: $e.dataset.question, text: $e.dataset.answer, answer: null }));

      questions.forEach(q => this.state.questions[q.question] = null);
    },

    _questions: [],

    state: {
      hoverStar: 0,
      questions: {}
    },

    fields: {
      stars: 0,
      text: ''
    },

    getAnswer(question) {
      return this.state.questions[question];
    },

    get questions() {
      const questions = this._questions
        .filter(q => this.state.questions[q.question] !== null);
      return questions;
    },

    submit() {
      this.$refs.form.submit();
    },

    answer(question, val) {
      const oldVal = this.state.questions[question] ?? null;
      if (oldVal == val) val = null;
      this.state.questions[question] = val;
    },

    starIsActive(idx) {
      return idx <= Math.max(this.state.hoverStar, this.fields.stars)
    }

  }))
})