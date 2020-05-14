<template>
    <div>
        <form class="px-6 mt-10" @submit.prevent.default="createNewContact()">
            <ContactInputField  label="Contact name" placeholder="Contact name" name="name" :errors="errors" @update:field="form.name = $event"/>
            <ContactInputField  label="Email" placeholder="your@email.com" name="email" :errors="errors" @update:field="form.email = $event"/>
            <ContactInputField  label="MM/DD/YYYY" placeholder="birthday" name="birthday" :errors="errors" @update:field="form.birthday = $event"/>
            <ContactInputField  label="Company" placeholder="Company" name="company" :errors="errors" @update:field="form.comapny = $event"/>
            <div class="flex justify-end">
                <button class="px-4 py-2 text-red-700 border-2 hover:border-red-700">Cancel</button>
                <button class="ml-3 px-4 py-2 bg-blue-500 rounded-lg text-white hover:bg-blue-400">Create new contact</button>

            </div>
        </form>
    </div>
</template>

<script>
    import ContactInputField from "../../components/ContactInputField";
    export default {
        name: "ContactCreate",
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
                'errors':null
            }
        },
        methods:{
            createNewContact:function (){

                    axios.post('/api/contacts', this.form)
                    .then(res => {
                        alert('success');
                    }).catch(err =>{
                        this.errors = err.response.data.errors
                    })

            }
        }
    }
</script>

<style scoped>

</style>
