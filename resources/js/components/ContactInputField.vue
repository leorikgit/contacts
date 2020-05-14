<template>
    <div class="relative pb-8">
        <label  class="absolute text-xs text-bold uppercase text-blue-500" :for="name">{{label}}</label>
        <input  class="w-full pt-6 border-b-2 border-gray-400 text-gray-900 pb-1 focus:outline-none focus:border-blue-400" :id="name" type="text" :placeholder="placeholder" :name="name"
            @input="updateInput()"
            v-model="value"
            :class="errorObjectClass(name)">
        <div  class="text-bold text-sm text-red-600" v-text="errorMessage(name)">Error here</div>

    </div>
</template>

<script>
    export default {
        name: "ContactInputField",
        props:[
            'name', 'label', 'placeholder', 'errors'
        ],
        data: function () {
            return {
                value: '',
            }
        },
        methods:{
            updateInput: function () {
                this.clearError(this.name);
                this.$emit('update:field', this.value)
            },
            errorMessage(name){

                if(this.hasError){
                    return this.errors.meta[name][0];
                }
            },
            clearError: function (name)  {
                if(this.hasError){
                     this.errors.meta[name] = null;
                }
            },
            errorObjectClass: function(name){
                return {
                    'error-field': this.hasError
                }
            }
        },
        computed:{
            hasError:function () {
                return this.errors && this.errors.meta[this.name] && this.errors.meta[this.name].length > 0
            }
        }
    }
</script>

<style scoped>
.error-field{
    @apply .border-b-2 .border-red-500;
}
</style>
