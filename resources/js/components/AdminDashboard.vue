<template>
    <div class="container">
       <h3>Admin</h3>
       <button @click="resetRoutes()" class="btn btn-danger">Reset Route Status</button>
       <button @click="sortBy()" class="btn btn-primary">Sort By {{"sort_by"}}</button>

      <div class="row">
        <div class="col-5">
          Done
           <div v-for="__route in routes" v-bind:key="__route.id">
             <p v-if="__route.done = route.total">{{route.name}}</p>
           <div>
        </div>
        <div class="col-5">
          Not Done
          <div v-for="__route in routes" v-bind:key="__route.id">
             <p v-if="__route.done != route.total">{{route.name}}</p>
          </div>
        </div>
      </div>


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
      routes: [
        name,
        sort_by,
        id,
        done,
        total
      ],
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
    sortBy(){
      fetch('/api/routes/sort', {
          method: 'put',
        })
        .then(res => res.text())
        .then(res => console.log(res))
        .catch(err => console.log(err));
    },
  }
};
</script>