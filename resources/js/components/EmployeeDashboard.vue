<template>
    <div class="container">
      <div  v-if="!chose_route">
        <h2>Routes</h2>
        <div v-for="__route in routes" v-bind:key="__route.id">
          <div v-if="__route.id != 1" >
              <h3 class="mt-4">{{__route.name}}</h3>
              <a class="mr-3" href="EMPLOYEE ID">{{__route.user}}</a><a href="EMPLOYEE ID">Employee 2</a><div class="mr-2 mb-2"></div>
              <button @click="chooseRoute(__route)" class="btn btn-secondary">Choose Route</button>
          </div>
        </div>
      </div>
      <div v-if="chose_route">
        <button @click="goBack()" class="btn btn-secondary">All Routes</button>
        <div v-for="__customer in my_route.customers" v-bind:key="__customer.id">
          {{__customer.name}}
          <div>
            <input name="customerStatus" type="radio" v-model="user.status" value=1> Needs to be Plowed
            <input name="customerStatus" type="radio" v-model="user.status" value=2> Customer Plowed
            <input name="customerStatus" type="radio" v-model="user.status" value=3> Not Enough Snow to Plow
            <input name="customerStatus" type="radio" v-model="user.ststua" value=4> We Plowed
          </div>
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
      my_route: [],
      chose_route: false,
      edit_customer: false,
    };
  },
  created() {
    this.fetchRoutes();
  },
  methods: {
    fetchRoutes(page_url) {
      page_url = page_url || '/api/routes';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.routes = res.data;
        })
        .catch(err => console.log(err));
    },
    chooseRoute(route) {
      this.chose_route = true;
      this.my_route = route; 
    },
    goBack() {
      this.chose_route = false;
      this.my_route = [];
    }
  }
};
</script>