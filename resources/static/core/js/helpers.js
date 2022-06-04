window.goto = (url, nofollow = false) => {
  const $a = document.createElement('a')
  $a.href = url;
  if (nofollow) $a.setAttribute('nofollow', '')
  $a.click();
}


(() => {
  const properties = {
    strip: {
      value: function (char = ' ') {
        return this.replace(new RegExp(`^${char}*|${char}*$`), '');
      }
    },
    upperFirst: {
      value: function () {
        return this[0].toUpperCase() + this.slice(1)
      }
    },
    toTitleCase: {
      value: function () {
        return this.toLowerCase().replace(/^\w|\s\w/g, v => v.toUpperCase());
      }
    },
    slug: {
      value: function () {
        const getDelemiter = (v) => v.toLowerCase() == v ? '_' : '-';
        return this.replace(/\s(\w)/g, (_, v) => getDelemiter(v) + v).toLowerCase().replace(/[^\w\s\d\_\-]/g, '');
      }
    },
    unslug: {
      value: function () {
        return this.replace(/-(\w)/g, (_, v) => ' ' + v.toUpperCase()).replace(/_/g, ' ').upperFirst();
      }

    }
  }

  Object.entries(properties).forEach(([key, val]) => Object.defineProperty(String.prototype, key, val));
})();



window.performanceWrapper = function (cb) {
  const start = performance.now();
  cb();
  const duration = performance.now() - start;
  return duration;
}

window.testPerformance = function (cb, times) {
  const testFunction = () => { for (let i = 0; i < times; i++) cb() };
  return performanceWrapper(testFunction);
}


window.InputHandlers = class {
  constructor($input = null, config = {}) {
    if ($input !== null) InputHandlers.listen($input);
  }

  init() {
    Array.from(document.querySelectorAll('input[data-type]')).forEach(InputHandlers.listen);
  }

  static listen($input) {
    switch ($input.dataset.type) {
      case 'slug':
        return $input.addEventListener('change', InputHandlers.slug);
      default:
        console.warn('Input type not found.')
    }
  }


  static slug(e) {
    return e.target.value = e.target.value.slug();
  }
}