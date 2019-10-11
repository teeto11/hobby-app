<template>
    <form>
        <div class="container">
            <div class="row">
                <div class="col-md-6 guy">
                     <div class="alert alert-success" v-show="this.message">{{this.message}}</div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Email" v-model="details.name">
                                <small v-if="errors.name" class="text-danger">{{errors.name[0]}}</small>
                           </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" v-model="details.email">
                            <small v-if="errors.email" class="text-danger">{{errors.email[0]}}</small>
                            </div>
                             <div class="form-group">
                                <label for="exampleInputEmail1">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="phone  number" v-model="details.phone_number">
                               <small v-if="errors.phone_number" class="text-danger">{{errors.phone_number[0]}}</small>
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
                 name:'',
                 email:'',
                 password:'',
                 phone_number:''
                 
            },
             errors:{},
             token: '',
             user:{},
             message:''
        }
    },
    
    methods:{        
        formsubmit(){
           
            axios.post('http://localhost:7000/api/register',this.details)
                 .then((response)=>{
                     console.log(response);
                     if(response.data.code == 400){
                         this.errors = response.data.error
                     }else{
                         this.token = response.data.data.token
                         this.user = response.data.user.user,
                         this.message = "regisration successful"
                     }
                      this.details = ""
                     // localStorage.setItem("token",this.token)
                 })
                 .catch((error)=>{
                     console.log("error"+error.response)
                 })
        }
    }
}
</script>
<style scoped>
 
</style>