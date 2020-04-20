<template>
    <div class="container">
      <h3>{{route.name}}</h3>
      <a href="http://snowplowdev.test/home" class="btn btn-secondary">All Routes</a>
      <table class="mt-3 table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Status</th>
            <th scope="col">Name</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="__customer in customers" v-bind:key="__customer.id">
            <th scope="row">{{__customer.route_position + 1}}</th>
            <td><span :class= status[__customer.status].css >{{status[__customer.status].message}}</span></td>
            <td>{{__customer.name}}</td>
            <td><a :href="`/customer/${__customer.id}`" class="btn btn-primary ml-auto">Details</a></td>
          </tr>
        </tbody>
      </table>
    </div>  
</template>

<script>

export default {
  data() {
    return {
      route: {
          name: '',
          sort_by:'',
          id:'',
      },
      customers: [],
      status: {
          0: { css: 'badge badge-danger',
               message: 'Not Done'
            },
          1: { css: 'badge badge-warning',
               message: 'Plow Ridge'
            },
          4: { css: 'badge badge-primary',
               message: 'Completed'
            },
          3: { css: 'badge badge-secondary',
               message: 'No Need'
            },
          2: { css: 'badge badge-secondary',
               message: 'Customer'
            },
       } 
    };
  },
  created() {
    let uri = window.location.href.split('/');
    uri = uri[4]
    this.fetchCustomers(uri);
    this.fetchRoute(uri);
  },
  methods: {
    fetchRoute(route_id) {
      fetch('/api/route/' + route_id)
        .then(res => res.json())
        .then(res => {
          this.route = res.data;
        })
        .catch(err => console.log(err));
    },
    fetchCustomers(route_id) {
      fetch('/api/customers/route/' + route_id)
        .then(res => res.json())
        .then(res => {
          this.customers = res.data;
        })
        .catch(err => console.log(err));
    },
    get_url(id){
      return "snowplowdev.test/customer/" + id;
    }
  }
};
</script>