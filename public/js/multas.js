
new Vue({
  el: '#messages',
  data: {
    someData:'0'
  },
  ready() {

      // GET /someUrl
      this.$http.get('numero_demultas').then((response) => {
          this.$set('someData', response.json())


          // success callback
      }, (response) => {
        this.$set('numero_demultas', 'fuckit');
          // error callback
      });

    }

  //
  // methods:{
  //   fetchMessages:function() {
  //     this.$http.get('/numero_demultas', function(messages) {
  //       return this.$set('numero_demultas', messages);
  //     });
  //   }
  // },
  //
  // ready:function(){
  //   this.fetchMessages();
  // },

});
