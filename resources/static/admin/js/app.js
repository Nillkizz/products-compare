import './bootstrap';

new ClipboardJS('[data-clipboard-text]').on('success', (e) => { Dashmix.helpers('jq-notify', { type: 'success', icon: 'fa fa-check me-1', message: 'Link copied!' }); });