<template>
  <div class="container">
    <h2>Customers</h2>
    <form @submit.prevent="addCustomer" class="mb-3">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Name" v-model="customer.name">
      </div>
            <div class="form-group">
        <input type="text" class="form-control" placeholder="Phone Number" v-model="customer.phone_number">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Address" v-model="customer.address">
      </div>
      <div class="form-group">
        <textarea class="form-control" placeholder="Comments" v-model="customer.comments"></textarea>
      </div>
      <div class="form-group">
        <select class="selectpicker form-control" v-model="customer.route_id">
          <option disabled value="">Select A Route</option>
          <option v-for="route in routes" v-bind:value="route.id" v-bind:key="route.id">{{route.name}}</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
    <button @click="clearForm()" class="btn btn-danger">Cancel</button>
    <nav aria-label="Customer Pages Navigation" class="mt-2">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchCustomers(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchCustomers(pagination.next_page_url)">Next</a></li>
      </ul>
     <input type="text" class="form-control mb-2" v-model="search" placeholder="Search Customers"/>
    </nav>
    <table class="table table-hover">
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Assigned Route</th>
            <th></th>
        </tr>
        <tr v-for="__customer in filteredCustomers" v-bind:key="__customer.id">
            <td>{{__customer.name}}</td>
            <td>{{__customer.address}}</td>
            <td>{{__customer.phone_number}}</td>
            <td>{{__customer.route_id}}</td>
            <td>
                <button @click="editCustomer(__customer)" class="btn btn-primary">Edit</button>
                <button @click="deleteCustomer(__customer.id)" class="btn btn-danger">Delete</button>
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
      search: '',
      customer: {
        id: '',
        name: '',
        address: '',
        phone_number: '',
        route_id: 1,
        comments: '',
      },
      routes: [],
      customer_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchCustomers();
    this.fetchRoutes();
  },
  computed:{
    filteredCustomers: function() {
      return this.customers.filter((customer) => {
        return customer.name.match(this.search)
      })
    }
  },
  methods: {
    fetchRoutes() {
      let vm = this;
      fetch('/api/routes/simple')
      .then(res => res.json())
        .then(res => {
          this.routes = res.data;
        })
        .catch(err => console.log(err));
    },
    fetchCustomers(page_url) {
      let vm = this;
      page_url = page_url || '/api/customers';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.customers = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
      this.pagination = pagination;
    },
    deleteCustomer(id) {
      if (confirm('Are You Sure?')) {
        fetch('api/customer/' + id, {
          method: 'delete',
        })
          .then(res => res.text())
          .then(res => console.log(res))
          .then(data => {
            alert('Customer Removed');
            this.fetchCustomers();
          })
          .catch(err => console.log(err));
      }
    },
    addCustomer() {
      if (this.edit === false) {
        // Add
        fetch('api/customer', {
          method: 'post',
          body: JSON.stringify(this.customer),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Customer Added');
            this.fetchCustomers();
          })
          .catch(err => console.log(err));
      } else {
        // Update
        fetch('api/customer', {
          method: 'put',
          body: JSON.stringify(this.customer),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Customer Updated');
            this.fetchCustomers();
          })
          .catch(err => console.log(err));
      }
    },
    editCustomer(customer) {
      this.edit = true;
      this.customer.id = customer.id;
      this.customer.customer_id = customer.id;
      this.customer.name = customer.name;
      this.customer.address = customer.address;
      this.customer.phone_number = customer.phone_number;
      this.customer.comments = customer.comments;
      this.customer.route_id = 1;
    },
    clearForm() {
      this.edit = false;
      this.customer.id = null;
      this.customer.customer_id = null;
      this.customer.name = '';
      this.customer.address = '';
      this.customer.phone_number = '';
      this.customer.comments = '';
      this.customer.route_id = 1;
    }
  }
};
</script>