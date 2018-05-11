// register modal component
Vue.component('modal', {
  template: '#modal-template',
  props: {
    show: {
      type: Boolean,
      required: true,
      twoWay: true
    }
  }
})

// start app
new Vue({
  el: '#app',
  data: {
    showModal: false
  }
})
