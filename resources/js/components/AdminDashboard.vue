<template>
    <div class="container">
       <h3>Admin</h3>
       <button @click="resetRoutes()" class="btn btn-danger">Reset Route Status</button>
       <button @click="sortBy()" class="btn btn-primary">Sort</button>
      <hr>
      <div class="row">
        <div class="col-5">
          <h4>Incomplete</h4>
          <div v-for="__route in routes" v-bind:key="__route.id">
             <div v-if="__route.done != __route.total">
                <span>{{__route.name}}</span><span class="float-right">Customers Remaining:{{__route.total}}</span>
             </div>
          </div>
        </div>
        <div class="col-5">
          <h4>Complete</h4>
           <div v-for="__route in routes" v-bind:key="__route.id">
             <div v-if="__route.done == __route.total">
                <span><b>{{__route.name}}</b></span>
             </div>
           </div>
        </div>
        <div class="col-1"></div>
      </div>
      <div class="row mt-5">
        <div class="col-5">
          <h4>Customers to Be Billed</h4>
          <div v-for="__route in routes" v-bind:key="__route.id">
              <div v-for="__customer in __route.customers" v-bind:key="__customer.id">
                <div v-if="__customer.status == 4">
                  {{__customer.name}}
              </div>
             </div>
          </div>
        </div>
      </div>
    </div> 
</template>

<script>
export default {
  data() {
    return {
      customers: [],
      routes: [
      ],
      sort_by_text: '',
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
        .then(res => res.data())
        .then(res => console.log(res))
        .catch(err => console.log(err));
    },
  }
};
</script>