<template>
    <div v-if="loading">Loading...</div>
    <div v-else class=" p-6  ">
        <div class="flex justify-between">
            <button class="text-blue-600 text-sm text-bold hover:text-blue-400" @click="$router.back()">
                < Back
            </button>
            <div class="relative">
                <router-link :to="'/contacts/'+ this.contact.data.contact_id + '/edit' " class="text-sm font-bold px-4 py-2 text-green-600 border border-green-600 mr-4 rounded">Edit</router-link>
                <a href="#" class="text-sm font-bold px-6 py-2 text-red-600 border border-red-600 rounded"
                @click="modal = ! modal"
                >Delete</a>
                <div v-if="modal" class="absolute w-64 right-0 p-8 bg-blue-900 text-white mt-3 mr-8 rounded-lg z-20">
                    <p>Are you sure that you want to delete this record?</p>
                    <div class="flex justify-end">
                        <button @click="modal = !modal" class="mr-2 border border-white py-2 px-2 rounded">Cancel</button>
                        <button @click="destroy()" class="text-white bg-red-600 border border-red-600 px-4 py-2 rounded hover:bg-red-500">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="modal" class="absolute top-0 bottom-0 right-0 left-0 bg-black opacity-25 z-10" @click="modal = !modal"></div>

        <div class="flex mt-6 items-center">
            <AvatarCircle :name="contact.data.attributes.name"/>
            <div class="font-bold text-gray-900 ml-2">{{contact.data.attributes.name}}</div>
        </div>

            <p class="mt-12 font-bold text-gray-600 uppercase text-sm">Contact</p>
            <p class="text-blue-500 mt-1">{{contact.data.attributes.name}}</p>
            <p class="mt-6 font-bold text-gray-600 uppercase text-sm">Company</p>
            <p class="text-blue-500 mt-1">{{contact.data.attributes.company}}</p>
            <p class="mt-6 font-bold text-gray-600 uppercase text-sm">Birthday</p>
            <p class="text-blue-500 mt-1">{{contact.data.attributes.birthday}}</p>
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
                loading: true,
                modal: false
            }
        },
        mounted () {
            axios.get('/api/contacts/' + this.$route.params.id)
                .then(res =>{
                this.contact = res.data
                this.loading = false
            }).catch(err=>{
                if(err.response.status === 404){
                    this.$router.push('/contacts/');
                }
                this.loading = false
            })
        },
        methods:{
            destroy: function () {
                axios.delete('/api/contacts/' + this.$route.params.id)
                    .then(res =>{
                        this.$router.push('/contacts/');
                    }).catch(err=>{

                    this.loading = false
                })
            }
        }
    }
</script>

<style scoped>

</style>
