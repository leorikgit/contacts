<template>
    <div>
       <ContactList url="/api/contacts"/>
    </div>
</template>

<script>

    import ContactList from "../../components/ContactList";
    export default {
        name: "Index",
        components:{
            ContactList
        }

    }
</script>

<style scoped>

</style>
