<template>
<div>
     <nav class="navbar navbar-default" v-show="!user">
        <div class="container-fluid">
            <div class="navbar-header my-nav">
               <router-link to="/login" class="navbar-brand">
                Login
                </router-link> 
               <router-link to="/register" class="navbar-brand">
                Register
                </router-link> 
            </div>
        </div>
    </nav>

     <nav class="navbar navbar-default" v-show="user">
        <div class="container-fluid">
            <div class="navbar-header my-nav">
               <router-link to="/#" class="navbar-brand">
                 Welcome {{username}}
                </router-link> 
               <router-link to="/logout" @click="logout" class="navbar-brand">
                Logout
                </router-link> 
            </div>
        </div>
    </nav>
  </div>  

</template>
<style scoped>
  .navbar-default .navbar-brand{
    
     margin: 0 auto;
  }
</style>
<script>
export default {
    data(){
        return{
            user: '',
            username: ''
        }
    },
       mounted() {
               this.user = localStorage.getItem("user")
               this.username = localStorage.getItem("username")
       },
       methods:{
           logout(){
                localStorage.removeItem("user")
                 localStorage.removeItem("token")
                  localStorage.removeItem("username")
                 this.$router.replace({path:'login'})
           }
       }
    
}
</script>