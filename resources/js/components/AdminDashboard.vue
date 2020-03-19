<template>
    <div class="container">
       <h3>Admin</h3>
    </div> 
</template>

<script>
export default {
  data() {
    return {
      routes: [],
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
  }
};
</script>