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
            if(this.$store.state.gmt.gmtHuman) {
                return this.$store.state.gmt.gmtHuman;
            } else {
                return '';
            }
        }
    }
}
</script>
