<template>
    <div class="container">
        <h2>Routes</h2>
        <form @submit.prevent="addRoute" class="mb-3">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Name" v-model="route.name">
        </div>
        <button type="submit" class="btn btn-primary btn-block w-25">Save</button>
        </form>
        <button @click="clearForm()" class="btn btn-danger btn-block w-25 mb-2">Cancel</button>
        <div v-for="__route in routes" v-bind:key="__route.id">
            <h3 class="mt-4">{{__route.name}}</h3>
            <a class="mr-3" href="EMPLOYEE ID">{{__route.user}}</a><a href="EMPLOYEE ID">Employee 2</a><div class="mr-2 mb-2"></div>
            <div class="float-right">
                <a v-if="__route.id != 1" class="btn btn-danger text-light" @click="deleteRoute(__route.id)">Delete Route</a>
            </div>
            <a class="btn btn-success text-light" @click="editRoute(__route)">Edit Route</a>
            <div class="btn-group dropright">
                <button type="button" class="btn btn-secondary dropdown-toggle mr-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Customers
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">  
                    <a class="dropdown-item" href="#">Customer</a>            
                    <a class="dropdown-item">No Customers</a>
                </div>
                <hr>
            </div>
        </div>
    </div> 
</template>

<script>

export default {
    
  data() {
    return {
      routes: [],
      route: {
        id: '',
        name: '',
      },
      route_id: '',
      edit: false
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
    
    deleteRoute(id) {
      if (confirm('Are You Sure?')) {
        fetch('api/route/' + id, {
          method: 'delete',
        })
          .then(res => res.text())
          .then(res => console.log(res))
          .then(data => {
            alert('Route Removed');
            this.fetchRoutes();
          })
          .catch(err => console.log(err));
      }
    },
    addRoute() {
      if (this.edit === false) {
        // Add
        fetch('api/route', {
          method: 'post',
          body: JSON.stringify(this.route),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Route Added');
            this.fetchRoutes();
          })
          .catch(err => console.log(err));
      } else {
        // Update
        fetch('api/route', {
          method: 'put',
          body: JSON.stringify(this.route),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Route Updated');
            this.fetchRoutes();
          })
          .catch(err => console.log(err));
      }
    },
    editRoute(route) {
      this.edit = true;
      this.route.id = route.id;
      this.route.name = route.name;
      // Set this.whatever = whatever
    },
    clearForm() {
      this.edit = false;
      this.route.name = "",
      this.route.id = null;
    }
  }
};
</script>