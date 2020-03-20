<template>
    <div class="container">
       <h3>Admin</h3>
<<<<<<< HEAD
       <table class="table table-hover">
          <tr>
              <th>Routes in progress</th>
              <th>Finished Routes</th>
          </tr>
          <tr v-for="__route in routes" v-bind:key="__route.id">
              <tr v-for="__customer in routes" v-bind:key="__customer.id">
                
            <td>{{__route.name}}</td>
            <td>
            </td>
        </tr>
        </table>
=======
       <button @click="resetRoutes()" class="btn btn-danger">Reset Route Status</button>
>>>>>>> f6b3512b744d8a54d3989a339b6025136a1dfcb1
    </div> 
</template>

<script>
export default {
  data() {
    return {
      customers: [],
      routes: [],
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
    resetRoutes(){
      fetch('/api/routes/reset', {
          method: 'put',
        })
        .then(res => res.text())
        .then(res => console.log(res))
        .catch(err => console.log(err));
    },
  }
};
</script>