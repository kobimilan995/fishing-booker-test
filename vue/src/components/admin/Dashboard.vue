<template>
    <h1>admin dashboard</h1>
</template>

<script>
    export default {
        created() {
            axios.get('http://localhost:8000/api/admin/test').then(response => {
                console.log(response);
            }).catch(error => {
                console.log(error);
            });
        }
    }
</script>
