
new Vue({
  el: '#folios',

  data: {
    someData:'0',
      notFound:'0'
  },

  methods:{
    fetchNumber:function() {
        this.$http.get('numero_demultas').then((response) => {
            this.$set('someData', response.json())
            // success callback
        });

        this.$http.get('api/not_found').then((response) => {
            this.$set('notFound', response.json())
        });
    }
  },

  ready:function(){
    this.fetchNumber();

      setInterval(function (){
        this.fetchNumber();

      }.bind(this),2000);
  }

});
