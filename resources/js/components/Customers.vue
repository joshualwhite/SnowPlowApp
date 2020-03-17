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
        <input type="text" class="form-control" placeholder="Name" v-model="customer.name">
      </div>
      <div class="form-group">
        <textarea class="form-control" placeholder="Comments" v-model="customer.comments"></textarea>
      </div>
      <button type="submit" class="btn btn-primary btn-block w-25">Save</button>
    </form>
    <button @click="clearForm()" class="btn btn-danger btn-block w-25 mb-2">Cancel</button>
    <nav aria-label="Customer Pages Navigation">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchCustomers(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchCustomers(pagination.next_page_url)">Next</a></li>
      </ul>

    </nav>
    <table class="table table-hover">
            <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Assigned Route</th>
            <th></th>
        </tr>
        <tr v-for="customers in customers" v-bind:key="customers.id">
            <td>{{customers.name}}</td>
            <td>{{customers.address}}</td>
            <td>{{customers.phone_number}}</td>
            <td>{{customers.route_id}}</td>
            <td>
                <button @click="editCustomer(customer)" class="btn btn-primary">Edit</button>
                <button @click="deleteCustomer(customer.id)" class="btn btn-danger">Delete</button>
            </td>
        </tr>
    </table>


      <h3>{{ customers.name }}</h3>
      <p>{{ customers.address }}</p>
      
    </div>
</template>

<script>
export default {
  data() {
    return {
      customers: [],
      customer: {
        id: '',
        name: '',
        address: '',
        phone_number: '',
        route_id: '',
        comments: ''
      },
      customer_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchCustomers();
  },
  methods: {
    fetchCustomers(page_url) {
      let vm = this;
      page_url = page_url || '/api/customersAPI';
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
        fetch(`api/customersAPI/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
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
        fetch('api/customerAPI', {
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
        fetch('api/customersAPI', {
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
      this.customer.title = customer.title;
      this.customer.body = customer.body;
    },
    clearForm() {
      this.edit = false;
      this.customer.id = null;
      this.customer.customer_id = null;
      this.customer.title = '';
      this.customer.body = '';
    }
  }
};
</script>