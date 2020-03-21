<template>
    <div class="container">
      <div  v-if="(!chose_route)">
        <h2>Routes</h2>
        <div v-for="__route in routes" v-bind:key="__route.id">
          <div v-if="__route.id != 1" >
              <h3 class="mt-4">{{__route.name}}</h3>
              <a class="mr-3" href="EMPLOYEE ID">{{__route.user}}</a><a href="EMPLOYEE ID">Employee 2</a><div class="mr-2 mb-2"></div>
              <button @click="chooseRoute(__route)" class="btn btn-secondary">Choose Route</button>
          </div>
        </div>
      </div>
      <div v-if="(chose_route)">
        <button @click="goBack()" class="btn btn-secondary">All Routes</button>
        <div v-for="__customer in my_route.customers" v-bind:key="__customer.id">
          {{__customer.name}}
<<<<<<< HEAD
          <div>
            <input name="customerStatus" type="radio" v-model="user.status" value=1> Needs to be Plowed
            <input name="customerStatus" type="radio" v-model="user.status" value=2> Customer Plowed
            <input name="customerStatus" type="radio" v-model="user.status" value=3> Not Enough Snow to Plow
            <input name="customerStatus" type="radio" v-model="user.ststua" value=4> We Plowed
          </div>
=======
          <button @click="editCustomer(__customer)" class="btn btn-primary">Edit Customer</button>

>>>>>>> 9799930431cde40b11e9dbc9dcf27dbd27d446e1
        </div>
      </div>

      <div v-if="edit_customer">
        <button @click="goBack2()" class="btn btn-secondary">Hide</button>
        <h4>{{customer.name}}</h4>

        <form @submit.prevent="addCustomer" class="mb-3">
          <div class="form-group">
            <textarea class="form-control" placeholder="Comments" v-model="customer.comments"></textarea>
          </div>
          <div class="form-group">
            <select id="status" class="selectpicker form-control" v-model="customer.status">
              <option disabled value=0>Not Done</option>
              <option value=1>Plow Ridge</option>
              <option value=2>Customers Plowed</option>
              <option value=3>No Need</option>
              <option value=4>We Completed</option>
            </select>
          </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
     </div>
    </div>
</template>

<script>

export default {
    
  data() {
    return {
      routes: [],
      user: [],
      customer: [],
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
    },
    editCustomer(customer){
      this.customer = customer; 
      this.edit_customer = true;
    },
    goBack2(){
      this.edit_customer = false;
      this.customer = []; 
    }
  }
};
</script>