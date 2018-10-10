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
    },

    created() {
        axios.get('http://localhost:8000/api/test').then(response => {
            console.log(response);
        }).catch(error => {
            console.log(error);
        });
    }
}
</script>
