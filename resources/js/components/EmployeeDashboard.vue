<template>
    <div class="container">
      <h2>Routes</h2>
      <div v-for="__route in routes" v-bind:key="__route.id">
        <div v-if="__route.id != 1" >
            <h3 class="mt-4">{{__route.name}} | {{getPercentDone(__route)}}</h3>
            <a class="mr-3" href="EMPLOYEE ID">{{__route.user}}</a><a href="EMPLOYEE ID">Employee 2</a><div class="mr-2 mb-2"></div>
            <a class="btn btn-primary" :href="`/route/${__route.id}`">Choose Route</a>
        </div>
      </div>
    </div>
</template>

<script>

export default {
  data() {
    return {
      routes: [],
      user: [],
      customers: []
    };
  },
  created() {
    this.fetchRoutes();
    this.fetchCustomers();
  },
  methods: {
    fetchRoutes() {
      fetch('/api/route_status')
        .then(res => res.json())
        .then(res => {
          this.routes = res.data;
        })
        .catch(err => console.log(err));
    },
    fetchCustomers() {
      fetch('/api/customers')
        .then(res => res.json())
        .then(res => {
          this.customers = res.data;
        })
        .catch(err => console.log(err));
    },
    getPercentDone(route){
      return Math.floor((route.done/route.total) * 100) + "%";
    },
  }
};
</script>