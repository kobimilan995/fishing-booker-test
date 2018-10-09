<template>
    <div>
        <h1>Home</h1>
        <p>{{gmdate}}</p>
    </div>
</template>

<script>
export default {
    computed: {
        gmdate() {
            if(this.$store.state.gmt.gmt) {
                return this.$store.state.gmt.gmt.format('MMMM Do YYYY, h:mm:ss a');
            } else {
                return '';
            }
        }
    }
}
</script>
