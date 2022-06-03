document.addEventListener('alpine:init', () => {
  Alpine.data('app', () => ({
    options: options.map(o => { o.json = JSON.parse(o.json); return o; }),


    init() {
      console.log(this.options)
      this.modal = new bootstrap.Modal(this.$refs.modal);
      this.$refs.modal.addEventListener('hide.bs.modal', () => { this.change.revert() });
    },

    change: {
      setOption(o) {
        this.o = o;
        this.oldValue = JSON.parse(JSON.stringify(o.json.value));
      },

      get type() {
        if (this.o == undefined) return null;
        return this.o.json.type || 'input';
      },

      revert(idx) {
        if (this.type == 'multivalue' && idx != undefined) this.o.json.value[idx] = this.oldValue[idx];
        else this.o.json.value = this.oldValue;
      },
      dropValue(idx) {
        return this.o.json.value = this.o.json.value.filter((_, i) => i != idx);
      },
      addValue() {
        return this.o.json.value.push('');
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