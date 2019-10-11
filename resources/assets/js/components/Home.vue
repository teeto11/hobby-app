<template>
<div class="col-xs-12 col-sm-10 col-sm-offset-1">
    <div class="panel panel-primary">
         <div class="alert alert-success" v-show="this.message">{{this.message}}</div>
      <div class="panel-heading">Hobby Form</div>
      <div class="panel-body">
          <form>
                <div class="form-group">
                            <div class="form-group">
                                        <label for="hobby">Add Hobby</label>
                                        <input type="text" class="form-control" name="hobby[]" id="hobby" v-model="detail.hobby" placeholder="Hobby">
                                    <small v-if="error.hobby" class="text-danger">{{error.hobby[0]}}</small>
                            </div>
                        <button type="submit" class="btn btn-default" @click.prevent="formsubmit">Submit</button>
                    </div>
            </form>
      </div>
       <hr>
    </div>
        <div class="panel panel-warning" v-show="user">
            <div class="panel-heading">All Hobbies</div>
                <div class="panel-body">
                    <table class="table table-bordered" v-for="(user,index) in this.user" :key="index">
                        <thead>
                            <tr>
                            <th scope="col">SN</th>
                            <th scope="col">Hobby</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th>{{user.id}}</th>
                            <td>{{user.hobby}}</td>
                              <td><button class="btn btn-success" data-toggle="modal" data-target="#myModal" @click="update(index)">Edit</button></td>
                              <td><button class="btn btn-danger" @click="del(index,user.id)">Delete</button></td>
                            </tr>

                        </tbody>
                        </table>
                        <Update></Update>
                </div>
        </div>
</div>
</template>
<script>
import Update from './Update'
export default {
components:{
     Update
},
    data(){
        return{
            detail:{
                 hobby:'',
                 user_id:'',
            },
              headers:'',
              message:'',
              error:{},
              user:{},
              token: '',
             
        }
    },
    mounted() {
       
         this.token = localStorage.getItem("token");
          this.user = localStorage.getItem("user")
          //console.log(this.user)
         if(!this.token){
               this.$router.replace({path:'register'})
         }
         this.getdata()
    },
    methods:{
        formsubmit(){
             this.headers= {Authorization:this.token}
             this.user = localStorage.getItem("user")
             this.detail.user_id = this.user
             console.log(this.detail.user_id)
             axios.post('http://localhost:7000/api/add-hobby',this.detail,this.headers)

                  .then((response)=>{
                     if(response.data.success == false){
                         this.error = response.data.data
                     }else{
                         this.message = response.data.message
                         this.detail.hobby =''
                         this.getdata()
                     }
                     console.log(response)
                 })
                   .catch((error)=>{
                     console.log(error)
                 })
        },
        getdata(){
              axios.get(`http://localhost:7000/api/all-hobby/${this.user}`)
                  .then((response)=>{
                      this.user = response.data.data
                     console.log(response)
                 })
                   .catch((error)=>{
                     console.log(error)
                 })
        },
        update(index){
                this.$children[0].list = this.user[index]
        },
          del(item,id){
            // console.log(item);
             if(confirm("are you sure")){
                axios.get(`http://localhost:7000/api/delete-hobby/${id}`)
                     .then((response)=>{
                         this.user.splice(item,1)
                          this.message = response.data.message
                    
                       //console.log(response)
                })
                    .catch((error)=>{
                    console.log(error)
                 })
             }
         }

}
}
</script>