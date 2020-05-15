<template>
    <div>
        <ContactList url="/api/birthdays"/>
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
