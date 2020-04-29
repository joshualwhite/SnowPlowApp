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

      <h3>Routes</h3>
      <div v-for="__route in routes" v-bind:key="__route.id">
        <div v-if="__route.id != 1" >
            <h3 class="mt-4">{{__route.name}} | {{getPercentDone(__route)}}</h3>
            <ul class="list-inline">
              <li class="list-inline-item" v-for="employee in __route.employees" v-bind:key="employee.name">{{employee.name}}</li>
            </ul>
            <a class="btn btn-primary" :href="`/route/${__route.id}`">View Route</a>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      customers: [],
      routes: [],
      alert: false,
      message: ''
    };
  },
  created() {
    this.fetchRoutes();
  },
  methods: {
    fetchRoutes(page_url) {
      fetch('/api/route_status')
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
        .catch(err => console.log(err));
    },
    sortTop(){
      fetch('/api/routes/sort-top', {
          method: 'put',
        })
        .then(res => res.text())
        .then(res => this.my_alert(res))
        .catch(err => console.log(err));
    },
    sortBottom(){
      fetch('/api/routes/sort-bottom', {
          method: 'put',
        })
        .then(res => res.text())
        .then(res => this.my_alert(res))
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
    },
    getPercentDone(route){
      return Math.floor((route.done/route.total) * 100) + "%";
    },
  }
};
</script>