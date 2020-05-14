<template>
    <div class="rounded-full w-10 h-10 bg-blue-500 text-white flex items-center justify-center border-1 border-gray-400 text-sm text-bold">
        {{avatarCircle}}
    </div>
</template>

<script>
    export default {
        name: "AvatarCircle",
        props: [
            'name'
        ],
        computed:{
            avatarCircle: function () {
                return this.name.match(/[A-Z]/g).slice(0, 2).join('');
            }
        }
    }
</script>

<style scoped>

</style>
