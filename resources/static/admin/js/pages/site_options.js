document.addEventListener('alpine:init', () => {
  Alpine.data('app', () => ({
    init() {
      this.modal = new bootstrap.Modal(this.$refs.modal);
      this.$refs.modal.addEventListener('hide.bs.modal', () => { this.change.revert() });
    },

    options: options,
    change: {
      setOption(o) {
        this.o = o;
        this.oldValue = JSON.parse(JSON.stringify(o.value));
      },

      get type() {
        if (this.o == undefined) return null;
        switch (this.o.name) {
          case 'featured_categories':
            return 'multivalue';
          default:
            return 'input';
        }
      },

      revert(idx) {
        if (this.type == 'multivalue' && idx != undefined) this.o.value[idx] = this.oldValue[idx];
        else this.o.value = this.oldValue;
      },
      dropValue(idx) {
        return this.o.value = this.o.value.filter((_, i) => i != idx);
      },
      addValue() {
        return this.o.value.push('');
      },

      get optionName() {
        if (this.o == undefined) return '';
        return this.o.name.unslug();
      },
      oldValue: '',
    },

    submit() {
      this.$refs.form.submit();
    },

    editOption(o) {
      this.change.setOption(o);
      this.modal.show();
    },


    maxLength(text, length) {
      if (text.length < length) return text;
      return text.slice(0, length) + '...';
    }
  }))
})