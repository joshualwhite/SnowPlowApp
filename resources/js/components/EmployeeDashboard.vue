<template>
    <div class="container">
      <h2>Routes</h2>
      <div v-for="__route in routes" v-bind:key="__route.id">
        <div v-if="__route.id != 1" >
            <h3 class="mt-4">{{__route.name}} | {{getPercentDone(__route)}}</h3>
            <ul class="list-inline">
              <li class="list-inline-item" v-for="employee in __route.employees" v-bind:key="employee.id">{{employee.name}}</li>
            </ul>            
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