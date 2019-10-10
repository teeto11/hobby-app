<template>
     <div>
            <div class="modal fade" id="myModal" role="dialog">
                  <div class="alert alert-success" v-show="this.message">{{this.message}}</div>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit {{list.hobby}} details</h4>
                        </div>
                        <div class="modal-body">
                               <form>
                                     <div class="form-group">
                                            <div class="form-group">
                                                <label for="hobby">Add Hobby</label>
                                                <input type="text" class="form-control" name="hobby[]" id="hobby" v-model="list.hobby" placeholder="Hobby">
                                                <!-- <small v-if="error.hobby" class="text-danger">{{error.hobby[0]}}</small> -->
                                            </div>
                                          <button type="submit" class="btn btn-default" @click.prevent="formsubmit">Submit</button>
                                    </div>
                              </form>
                         </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div> 
                </div>
            </div>
     </div>
   
</template>
<script>
 
export default {
   data(){
       return{ 
           list:{
               hobby:'',
               user_id: '',
           },
           headers:'',
            message:'',
             error:{},
       }
   },
   methods:{
       formsubmit(){
             this.list.user_id = localStorage.getItem("user")
             this.headers= {Authorization:this.token}
              axios.post('http://localhost:7000/api/update-hobby',this.list,this.headers)
                  .then((response)=>{
                     if(response.data.success == false){
                         this.error = response.data.data
                     }else{
                         this.message = response.data.message
                         //this.lis =''
                        
                     }
                    // console.log(response)
                 })
                   .catch((error)=>{
                     console.log(error)
                 })

       },
   }
}
</script>