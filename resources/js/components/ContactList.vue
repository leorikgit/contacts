<template>
    <div class="p-6">
        <div v-if="loading" class="flex items-senter justify-center p-10">Loading...</div>
        <div v-else v-for="contact in contacts.data" class="py-3 border-b border-gray-400 hover:bg-gray-100">
            <router-link :to="'/contacts/' + contact.data.contact_id" class="flex items-center">
                <AvatarCircle :name="contact.data.attributes.name"/>
                <div class="pl-4">
                    <div class="font-bold text-blue-400 text-sm">{{contact.data.attributes.name}}</div>
                    <div class="text-gray-700">{{contact.data.attributes.company}}</div>
                </div>
            </router-link>
        </div>
    </div>
</template>

<script>
    import AvatarCircle from "../components/AvatarCircle";
    export default {
        name: "ContactList",
        data: function () {
            return {
                loading:true,
                contacts: null
            }

        },
        props: [
          'url'
        ],
        components:{
            AvatarCircle
        },
        mounted() {
            axios.get(this.url)
                .then(res =>{
                    this.contacts = res.data
                    this.loading = false;
                }).catch(err=>{
                this.loading = false;
            })
        }
    }
</script>

<style scoped>

</style>
