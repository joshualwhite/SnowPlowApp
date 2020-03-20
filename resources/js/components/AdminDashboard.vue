<template>
    <div class="container">
       <h3>Admin</h3>
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
  }
};
</script>