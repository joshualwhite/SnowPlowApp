<template>
    <div class="container">
      <div class="alert alert-primary" role="alert" v-if="alert">
        {{message}}
      </div>
      <div>
        <a class= "btn btn-dark" :href="`/route/${customer.route_id}`">Go Back </a>
        <button style="float" @click="openGoogleMap(customer.address)" class="btn btn-primary float-right">Open In Maps</button>
      </div>
      <h4 class="mt-2">{{customer.name}}</h4>
      <h5>{{customer.address}}</h5>
      <form @submit.prevent="updateCustomer" class="mb-3">
          <div class="form-group">
              <textarea rows ="4" class="form-control" placeholder="Comments" v-model="customer.comments"></textarea>
          </div>
          <div class="form-group">
              <select id="status" class="selectpicker form-control" v-model="customer.status">
                  <option value=0>Not Done</option>
                  <option value=1>Plow Ridge</option>
                  <option value=2>Customers Plowed</option>
                  <option value=3>No Need</option>
                  <option value=4>We Completed</option>
              </select>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
      </form>
    </div>  
</template>

<script>
export default {
  data() {
    return {
      customer: {
        customer_id: '',
        id: '',
        name: '',
        address: '',
        phone_number: '',
        route_id: '', 
        comments:'',
        status:'',
        rating:'',
      },
      alert: false,
      message: ''
    };
  },
  created() {
    let uri = window.location.href.split('/');
    uri = uri[4]
    this.fetchCustomer(uri);
  },
  methods: {
    fetchCustomer(id) {
      fetch('/api/customer/' + id)
        .then(res => res.json())
        .then(res => {
          this.customer = res.data;
        })
        .catch(err => console.log(err));
    },
    updateCustomer(){
      this.customer.customer_id = this.customer.id;
      fetch('/api/customer', {
        method: 'put',
        body: JSON.stringify(this.customer),
        headers: {
          'content-type': 'application/json'
        }
      })
        .then(res => res.json())
        .then(data => {
          this.my_alert('Customer Status Updated');
        })
        .catch(err => console.log(err));
        this.edit_customer = false;
    },
    openGoogleMap(address) {
        const urlSuffix = 
           address +
           ", " +
           "" +           //street address two
           ", " +
           "Grand Forks" + // town
           ", ";
           //"58202";        //zip

        window.open(
          "https://www.google.com/maps/search/?api=1&query=" + urlSuffix,
          "_blank"
        );
    },
    my_alert(message){
      this.alert = true;
      this.message = message;
      setTimeout(this.timeout , 10000);
    },
    timeout(){
      this.alert = false;
      this.message = ""; 
    }
  }
};
</script>