Nova.booting((Vue, router, store) => {
  Vue.component('nova-log-cleaner', require('./components/Card'));
  Vue.component('confirm-flush-log-modal', require('./components/ConfirmFlushLogModal'));
})
