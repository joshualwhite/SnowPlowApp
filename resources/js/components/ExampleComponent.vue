<template>
    <div class="container">
        <table class="table table-hover">
            <tr>
            <th>Routes in progress</th>
            <th>Finished routes</th>
            <th></th>
        </tr>
        <tr v-for="__user in filteredUsers" v-bind:key="__user.id">
            <td>{{__user.name}}</td>
            <td>{{__user.phone_number}}</td>
            <td>{{__user.email}}</td>
            <td>{{__user.password}}</td>
            <td>
                <button @click="editUser(__user)" class="btn btn-primary">Edit</button>
                <button @click="deleteUser(__user.id)" class="btn btn-danger">Delete</button>
            </td>
        </tr>
    </table>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
