<template>
    <div>
            <form class="px-6 mt-10" @submit.prevent.default="createNewContact()">
                <ContactInputField  label="Contact name" placeholder="Contact name" name="name" :errors="errors" @update:field="form.name = $event" :myprop="form.name"/>
                <ContactInputField  label="Email" placeholder="your@email.com" name="email" :errors="errors" @update:field="form.email = $event" :myprop="form.email"/>
                <ContactInputField  label="MM/DD/YYYY" placeholder="birthday" name="birthday" :errors="errors" @update:field="form.birthday = $event" :myprop="form.birthday"/>
                <ContactInputField  label="Company" placeholder="Company" name="company" :errors="errors" @update:field="form.company = $event" :myprop="form.company"/>
                <div class="flex justify-end">
                    <button class="px-4 py-2 text-red-700 border-2 hover:border-red-700" @click="$router.push('/contacts/'+ $route.params.id)">Cancel</button>
                    <button class="ml-3 px-4 py-2 bg-blue-500 rounded-lg text-white hover:bg-blue-400">Save contact</button>
                </div>
            </form>


    </div>
</template>

<script>
    import ContactInputField from "../../components/ContactInputField";
    export default {
        name: "ContactEdit",
        components:{
            ContactInputField

        },
        data: function(){
            return {
                form:{
                    'name': '',
                    'email': '',
                    'birthday': '',
                    'company': '',
                },
                'errors':null,
                loading: true
            }
        },
        methods:{
            createNewContact:function (){

                axios.patch('/api/contacts/'+ this.$route.params.id, this.form)
                    .then(res => {
                        this.$router.push(res.data.links.self)

                    }).catch(err =>{
                    this.errors = err.response.data.errors

                })

            }
        },
        mounted () {
            axios.get('/api/contacts/' + this.$route.params.id)
                .then(res =>{
                    this.form = res.data.data.attributes
                    this.loading = false
                }).catch(err=>{
                if(err.response.status === 404){
                    this.$router.push('/contacts/');
                }
                this.loading = false
            })
        },
    }
</script>

<style scoped>

</style>
