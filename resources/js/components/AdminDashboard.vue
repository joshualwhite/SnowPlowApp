<template>
    <div class="container">
       <h3>Admin</h3>
       <div class="alert alert-primary" role="alert" v-if="alert">
        {{message}}
      </div>
       <button @click="resetRoutes()" class="btn btn-danger">Reset Routes</button>
       <button @click="sortTop()" class="btn btn-primary">Sort From Top</button>
       <button @click="sortBottom()" class="btn btn-primary">Sort From Bottom</button>
      <hr>
      <div class="row">
        <div class="col-5">
          <h4>Incomplete</h4>
          <div v-for="__route in routes" v-bind:key="__route.id">
             <div v-if="__route.done != __route.total">
                <span>{{__route.name}}</span><span class="float-right">Customers Remaining:{{__route.total}}</span>
             </div>
          </div>
        </div>
        <div class="col-5">
          <h4>Complete</h4>
           <div v-for="__route in routes" v-bind:key="__route.id">
             <div v-if="__route.done == __route.total">
                <span><b>{{__route.name}}</b></span>
             </div>
           </div>
        </div>
      </div>
    </div> 
</template>

<script>
export default {
  data() {
    return {
      customers: [],
      routes: [
      ],
      alert: false,
      message: ''
    };
  },
  created() {
    this.fetchRoutes();
  },
  methods: {
    fetchRoutes(page_url) {
      let vm = this;
      page_url = page_url || '/api/adminRoutes';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.routes = res.data;
        })
        .catch(err => console.log(err));
      },
    resetRoutes(){
      fetch('/api/routes/reset', {
          method: 'put',
        })
        .then(res => res.text())
        .then(res => this.my_alert(res))
        .then(res => console.log(res))
        .catch(err => console.log(err));
    },
    sortTop(){
      fetch('/api/routes/sort-top', {
          method: 'put',
        })
        .then(res => res.text())
        .then(res => this.my_alert(res))
        .then(res => console.log(res))
        .catch(err => console.log(err));
    },
    sortBottom(){
      fetch('/api/routes/sort-bottom', {
          method: 'put',
        })
        .then(res => res.text())
        .then(res => this.my_alert(res))
        .then(res => console.log(res))
        .catch(err => console.log(err));
    },
    my_alert(message){
      this.alert = true;
      this.message = message;
      setTimeout(this.timeout , 10000);
    },
    timeout(){
      this.alert = false;
      this.message = ""; 
    }
  }
};
</script>