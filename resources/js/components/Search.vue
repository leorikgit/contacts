<template>
    <div class="">
        <div class="relative">
            <div class="absolute">
                <svg viewBox="0 0 24 24" class="w-5 h-5 mt-3 ml-2">
                    <path fill-rule="evenodd" d="M20.2 18.1l-1.4 1.3-5.5-5.2 1.4-1.3 5.5 5.2zM7.5 12c-2.7 0-4.9-2.1-4.9-4.6s2.2-4.6 4.9-4.6 4.9 2.1 4.9 4.6S10.2 12 7.5 12zM7.5.8C3.7.8.7 3.7.7 7.3s3.1 6.5 6.8 6.5c3.8 0 6.8-2.9 6.8-6.5S11.3.8 7.5.8z" clip-rule="evenodd"/>
                </svg>
            </div>
            <input class="w-64 pl-8 mr-2 py-2 rounded-full focus:outline-none bg-gray-200 border border-gray-400 focus:border-blue-500 focus:shadow focus:bg-gray-100" placeholder="search..." v-model="value" @input="Search()" @click="modal = ! modal">
            <div class="absolute w-96 bg-blue-900 p-4 mt-2 rounded-lg text-white right-0 z-20" v-if="modal">
                <div v-if="contacts.length === 0">No result for '{{value}}'</div>
                <div v-for="contact in contacts" @click="modal = false; value = ''; contacts = []">
                    <router-link :to="'/contacts/' + contact.data.contact_id">
                        <div class="flex items-center">
                            <AvatarCircle :name="contact.data.attributes.name"/>
                            <div class="ml-2">
                                <div class="text-white font-bold">{{contact.data.attributes.name}}</div>
                                <div class="text-white font-bold">{{contact.data.attributes.company}}</div>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
        <div v-if="modal" class="absolute z-10 black opacity-0 top-0 bottom-0 right-0 left-0" @click="modal = false"></div>
    </div>
</template>

<script>
    import _ from 'lodash';
    import AvatarCircle from './AvatarCircle';
    export default {
        name: "Search",
        components:{
            AvatarCircle
        },
        data: function () {
            return {
                value: '',
                modal: false,
                contacts: []
            }

        },
        methods:{
            Search: _.debounce(
                function () {
                    if(this.value.length <= 2){
                        return
                    }
                    axios.post('/api/search', {'searchTerm' : this.value}).then(res => {
                        this.contacts = res.data.data
                    }).catch(err=>{

                    })
                }, 300)

        }
    }
</script>

<style scoped>

</style>
