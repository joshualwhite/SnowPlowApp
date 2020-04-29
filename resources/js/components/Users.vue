<template>
  <div class="container">
    <h2>Users</h2>
    <div class="alert alert-primary" role="alert" v-if="alert">
        {{message}}
    </div>
    <form @submit.prevent="addUser" class="mb-3">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Name" v-model="user.name">
      </div>
            <div class="form-group">
        <input type="text" class="form-control" placeholder="Phone Number" v-model="user.phone_number">
      </div>
            <div class="form-group">
        <input type="text" class="form-control" placeholder="Password" v-model="user.password">
      </div>
            <div class="form-group">
        <input type="text" class="form-control" placeholder="Email" v-model="user.email">
      </div>
       <div class="form-group">
         <select class="selectpicker form-control" v-model="user.route_id">
         <option disabled value="">Select A Route</option>
          <option v-for="route in routes" v-bind:value="route.id" v-bind:key="route.id">{{route.name}}</option>
        </select>
      </div>
      <span>Select Privileges:    </span>
      <input name="admin" type="radio" v-model="user.admin" value=1> Admin
      <input name="admin" type="radio" v-model="user.admin" value=0> User
      <br />
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
    <button @click="clearForm()" class="btn btn-danger mb-2">Cancel</button>
    <nav aria-label="User Pages Navigation">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchUsers(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchUsers(pagination.next_page_url)">Next</a></li>
      </ul>
    <input type="text" class="form-control mb-2" v-model="search" placeholder="Search Users"/>
    </nav>
    <table class="table table-hover">
          <tr>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Role</th>
            <th></th>
        </tr>
        <tr v-for="__user in filteredUsers" v-bind:key="__user.id">
            <td>{{__user.name}}</td>
            <td>{{__user.phone_number}}</td>
            <td>{{__user.email}}</td>
            <td  v-if="__user.admin == 1">Admin</td>
            <td  v-else>User</td>
            <td>
                
                <div v-if="__user.admin != 1" >
                  <button @click="editUser(__user)" class="btn btn-primary">Edit</button>
                  <button @click="deleteUser(__user.id)" class="btn btn-danger">Delete</button>
                </div>
                <div v-if="__user.admin == 1" >
                  <button @click="editUser(__user)" class="btn btn-primary">Edit</button>
                </div>

            </td>
        </tr>
    </table>
    </div>
</template>

<script>
export default {
  data() {
    return {
      users: [],
      search: '',
      user: {
        id: '',
        name: '',
        phone_number: '',
        password: '',
        admin: 0,
        route_id: 1,
      },
      routes: [],
      user_id: '',
      pagination: {},
      edit: false,
      alert: false,
      message: '', 
    };
  },
  created() {
    this.fetchUsers();
    this.fetchRoutes();
  },
  computed:{
    filteredUsers: function() {
      return this.users.filter((user) => {
        return user.name.match(this.search)
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
    fetchUsers(page_url) {
      let vm = this;
      page_url = page_url || '/api/usersAPI';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.users = res.data;
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
    deleteUser(id) {
      if (confirm('Are You Sure?')) {
        fetch(`api/usersAPI/`+id, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            this.my_alert("User Deleted");
            this.fetchUsers();
          })
          .catch(err => console.log(err));
      }
    },
    addUser() {
      if (this.edit === false) {
        // Add
        console.log(JSON.stringify(this.user));
        fetch('api/usersAPI', {
          method: 'post',
          body: JSON.stringify(this.user),
          headers: {
            'content-type':'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            this.my_alert("User Added");
            this.fetchUsers();
          })
          .catch(err => console.log(err));
      } else {
        // Update
        console.log(JSON.stringify(this.user));
        fetch('api/usersAPI', {
          method: 'put',
          body: JSON.stringify(this.user),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            this.my_alert("User Updated");
            this.fetchUsers();
          })
          .catch(err => console.log(err));
      }
    },
    editUser(user) {
      this.edit = true;
      this.user.name = user.name;
      this.user.phone_number = user.phone_number;
      this.user.email = user.email;
      this.user.id = user.id;
      this.user.admin = user.admin;
      this.user.route_id = 1;
    },
    clearForm() {
      this.edit = false;
      this.user.name = '';
      this.user.phone_number = '';
      this.user.password = '';
      this.user.email = '';
      this.user.id = null;
      this.user.admin = null;
      this.user.route_id = 1;
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