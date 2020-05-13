<template>
    <div>
        <form class="px-6 mt-10">
            <div class="relative pb-8">
                <label  class="absolute text-xs text-bold uppercase text-blue-500" for="name">Contact Name</label>
                <input class="w-full pt-6 border-b-2 border-gray-400 text-gray-900 pb-1 focus:outline-none focus:border-blue-400" id="name" type="text" placeholder="Contact Name" >
            </div>
            <div class="relative pb-8">
                <label  class="absolute text-xs text-bold uppercase text-blue-500" for="name">Contact Name</label>
                <input class="w-full pt-6 border-b-2 border-gray-400 text-gray-900 pb-1 focus:outline-none focus:border-blue-400" id="name" type="text" placeholder="Contact Name" >
            </div>
            <div class="relative pb-8">
                <label  class="absolute text-xs text-bold uppercase text-blue-500" for="name">Contact Name</label>
                <input class="w-full pt-6 border-b-2 border-gray-400 text-gray-900 pb-1 focus:outline-none focus:border-blue-400" id="name" type="text" placeholder="Contact Name" >
            </div>
            <div class="flex justify-end">
                <button class="text-red-700 py-2 px-4 hover:border-red-700 border-2">Cancel</button>
                <button class="ml-2 bg-blue-500 text-white rounded px-4 py-2 hover:bg-blue-400 ">Create new contact</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "ContactCreate"
    }
</script>

<style scoped>

</style>
