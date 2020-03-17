<template>
    <div class="container">
        
        <hr>
        <div v-for="__route in routes" v-bind:key="__route.id">
            <h3 class="mt-4">{{__route.name}}</h3>
            <a class="mr-3" href="EMPLOYEE ID">{{__route.user}}</a><a href="EMPLOYEE ID">Employee 2</a><div class="mr-2 mb-2"></div>
            <a class="btn btn-success" href="#">Edit Route</a>
            <div class="btn-group dropright">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Customers
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Customer Name, Customer Address</a>
                    <a class="dropdown-item" href="#">Customer Name, Customer Address</a>            
                    <a class="dropdown-item" href="#">Customer Name, Customer Address</a>            
                    <a class="dropdown-item" href="#">Customer Name, Customer Address</a>                
                </div>
            </div>
            <hr>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            routes: [],
            route: {
                id: '',
                name: '',
                user: '',
            },
            route_id: '',
            edit: false
        };
    },
    created(){
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
        deleteRoute(id) {
            if (confirm('Are You Sure?')) {
                fetch('api/route/' + id, {
                    method: 'delete',
                })
                .then(res => res.json())
                .then(data => res.data)
                .then(data => {
                    alert('Route Removed');
                    this.fetchRoutes();
                })
                .catch(err => console.log(err));
            }
        }
    }
};
</script>