
new Vue({
  el: '#cards',

  data: {
    items:{
      placa:"",
      total:0
    }
  },

  methods:{
    fetchNumber:function() {
        this.$http.get('api/top10').then((response) => {
            this.$set('items', response.json())
            // success callback
        });
    }
  },

  ready:function(){
    this.fetchNumber();

      // setInterval(function (){
      //   this.fetchNumber();
      //
      // }.bind(this),30000);
  }

});
