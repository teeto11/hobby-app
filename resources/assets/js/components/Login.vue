<template>
     <form>
        <div class="container">
            <div class="row">
                <div class="col-md-6 guy">
                        <div class="alert alert-success" v-show="this.message">{{this.message}}</div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" v-model="details.email">
                            <small v-if="errors.email" class="text-danger">{{errors.email[0]}}</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" v-model="details.password">
                            <small v-if="errors.password" class="text-danger">{{errors.password[0]}}</small>
                            </div>
                            <button type="submit" class="btn btn-default" @click.prevent="formsubmit">Submit</button>
                        </div>
                </div>
            </div>
  </form>
    
</template>
<script>
export default {
      data(){
        return{
            details:{
                 email:'',
                 password:'',
                 
            },
             errors:{},
             token: '',
             user:{},
             message:''
        }
    },
    methods:{
          formsubmit(){
            axios.post('http://localhost:7000/api/login',this.details)
                 .then((response)=>{
                     console.log(response);
                     if(response.data.success == false){
                         this.errors = response.data.error
                     }else{
                         this.token = response.data.data.token
                         this.user = response.data.user.user.id
                        
                         // console.log(this.user.id)
                     }
                      this.details = ""
                       localStorage.setItem("token",this.token)
                      localStorage.setItem("user",this.user)
                       localStorage.setItem("username",response.data.user.user.name)
                      this.$router.replace({path:'home'})
                    
                 })
                 .catch((error)=>{
                     console.log("error"+error.response)
                 })
        }
    }
        
    
}
</script>