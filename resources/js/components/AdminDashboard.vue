<template>
    <div class="container">
       <h3>Admin</h3>
       <button @click="resetRoutes()" class="btn btn-danger">Reset Route Status</button>
       <button @click="sortBy()" class="btn btn-primary">Sort By "sort_by"</button>

      <div class="row">
        <div class="col-5">
          <h3>Done</h3>
           <div v-for="__route in routes" v-bind:key="__route.id">
             <p v-if="__route.done == __route.total">{{__route.name}}</p>
           </div>
        </div>
        <div class="col-5">
          <h3>Not Done</h3>
          <div v-for="__route in routes" v-bind:key="__route.id">
             <p v-if="__route.done != __route.total">{{__route.name}}</p>
          </div>
        </div>
      </div>


       <table class="table table-hover">
          <tr>
              <th>Routes in progress</th>
              <th>Finished Routes</th>
          </tr>
          <tr v-for="__route in routes" v-bind:key="__route.id">
              <tr v-for="__customer in routes.cu" v-bind:key="__customer.id">
                
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
      ],
    };
  },
  created() {
    this.fetchRoutes();
  },
  methods: {
    fetchRoutes(page_url) {
      let vm = this;
      page_url = page_url || '/api/adminRoutes';
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