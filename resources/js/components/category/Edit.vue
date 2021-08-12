<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Customer</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" v-model="customer.email" readonly>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" v-model="customer.firstname">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" v-model="customer.lastname">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" v-model="customer.phone">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="text" class="form-control" v-model="customer.mobile">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"update-category",
    data(){
        return {
            customer:{
                email:"",
                firstname:"",
                lastname:"",
                phone:"",
                mobile:"",
                _method:"patch"
            }
        }
    },
    mounted(){
        this.showCategory()
    },
    methods:{
        async showCategory(){
            await this.axios.get(`/api/customer/${this.$route.params.id}`).then(response=>{
                const { email, firstname, lastname, phone, mobile } = response.data
                this.customer.email = email
                this.customer.firstname = firstname
                this.customer.lastname = lastname
                this.customer.phone = phone
                this.customer.mobile = mobile
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            await this.axios.put(`/api/customer/${this.$route.params.id}`,this.customer).then(response=>{
                // console.log(response);
                this.$router.push({name:"categoryList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>