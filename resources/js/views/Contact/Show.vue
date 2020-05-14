<template>
    <div v-if="loading">Loading...</div>
    <div v-else class=" p-6">
        <div class="flex justify-between">
            <div class="text-blue-600 text-sm text-bold hover:text-blue-400">
                < Back
            </div>
            <div class="flex">
                <router-link :to="'contacts/'+ this.contact.data.contact_id + '/edit' " class="text-sm font-bold px-4 py-2 text-green-600 border border-green-600 mr-4 rounded">Edit</router-link>
                <a href="#" class="text-sm font-bold px-6 py-2 text-red-600 border border-red-600 rounded">Delete</a>
            </div>
        </div>
        <div class="flex mt-6 items-center">
            <AvatarCircle :name="contact.data.attributes.name"/>
            <div class="font-bold text-gray-900 ml-2">{{contact.data.attributes.name}}</div>
        </div>

            <p class="mt-12 font-bold text-gray-600 uppercase text-sm">Contact</p>
            <p class="text-blue-500 mt-1"> lala</p>
            <p class="mt-6 font-bold text-gray-600 uppercase text-sm">Company</p>
            <p class="text-blue-500 mt-1"> lala</p>
            <p class="mt-6 font-bold text-gray-600 uppercase text-sm">Birthday</p>
            <p class="text-blue-500 mt-1"> lala</p>
    </div>
</template>

<script>
    import AvatarCircle from "../../components/AvatarCircle";
    export default {
        name: "Show",
        components:{
            AvatarCircle
        },
        data: function () {
            return {
                contact: null,
                loading: true
            }
        },
        mounted () {
            axios.get('/api/contacts/' + this.$route.params.id)
                .then(res =>{
                this.contact = res.data
                this.loading = false
            }).catch(err=>{

                this.loading = false
            })
        }
    }
</script>

<style scoped>

</style>
