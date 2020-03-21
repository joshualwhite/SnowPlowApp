<template>
    <div class="container">
        <h2>Routes</h2>
        <form @submit.prevent="addRoute" class="mb-3">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Name" v-model="route.name">
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <button @click="getRouteCustomers(route.id)" class="btn btn-success">Edit Customers</button>
        <button @click="clearForm()" class="btn btn-danger">Cancel</button>
        <hr>
        <div class="row mt" v-if="this.edit_customers">
          <div class="col-5">
            <h4>Unassigned Customers</h4>
            <draggable class="list-group" :list="unassigned" group="people" @change="log">
              <div
                class="list-group-item"
                v-for="(element) in unassigned"
                :key="element.name"
              >
                {{ element.name }}
              </div>
            </draggable>
          </div>

          <div class="col-5">
            <h4>{{route.name || "New Route"}}</h4>
            <draggable class="list-group" :list="edit_route" group="people" @change="log">
              <div
                class="list-group-item"
                v-for="(element) in edit_route"
                :key="element.name"
              >
                {{ element.name }}  <div class="float-right">{{Number(element.route_position) + 1}}</div> 
              </div>
              <div v-show="!customers_exist" class="list-group-item">Drag Customers Over!</div>
            </draggable>
          </div>
        </div>
        <div v-for="__route in routes" v-bind:key="__route.id">
          <div v-if="__route.id != 1" >
              <h3 class="mt-4">{{__route.name}}</h3>
              <a class="mr-3" href="EMPLOYEE ID">{{__route.user}}</a><a href="EMPLOYEE ID">Employee 2</a><div class="mr-2 mb-2"></div>
              <div class="float-right">
                  <a class="btn btn-danger text-light" @click="deleteRoute(__route.id)">Delete Route</a>
              </div>
              <a class="btn btn-success text-light" @click="editRoute(__route)">Edit Route</a>
              <div class="btn-group dropright">
                  <button type="button" class="btn btn-secondary dropdown-toggle mr-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Customers
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> 
                      <a v-for="customer in __route.customers" v-bind:key="customer.id" class="dropdown-item">{{customer.name + " " + customer.address}}</a>
                  </div>
                  <hr>
              </div>
            </div>
        </div>
    </div> 
</template>

<script>
import draggable from 'vuedraggable'

export default {
    
  data() {
    return {
      routes: [],
      route: {
        id: '',
        name: '',
        user: '',
        customers: [{
          id: '',
          address: '',
          name: '',
          route_position: '',
        }],
        unassigned: []
      },
      unassigned: [],
      edit_route: [],
      route_id: '',
      edit: false,
      edit_customers: false,
      customers_exist: false
    };
  },
  created() {
    this.fetchRoutes();
  },
  methods: {
    fetchRoutes(page_url) {
      let vm = this;
      page_url = page_url || '/api/routes';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.routes = res.data;
        })
        .catch(err => console.log(err));
      },
  }
};
</script>