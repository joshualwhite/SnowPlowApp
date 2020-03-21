<template>
    <div class="container">
        <h2>Routes</h2>
        <div v-for="__route in routes" v-bind:key="__route.id">
          <div v-if="__route.id != 1" >
              <h3 class="mt-4">{{__route.name}}</h3>
              <a class="mr-3" href="EMPLOYEE ID">{{__route.user}}</a><a href="EMPLOYEE ID">Employee 2</a><div class="mr-2 mb-2"></div>
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

export default {
    
  data() {
    return {
      routes: [],
      user: [],
    };
  },
  created() {
    this.fetchRoutes();
    this.fetchUser();
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
    fetchUser() {
      page_url = page_url || '/api/usersAPI/current';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.user = res.data;
        })
        .catch(err => console.log(err));
    }
  }
};
</script>