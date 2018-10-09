<template>
    <div id="app">
        <navigation-component></navigation-component>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import Navigation from './components/layout/Navigation.vue';

export default {
    name: 'app',
    components: {
        'navigation-component': Navigation
    },

    created() {
        axios.get('http://localhost:8000/api/gmdate').then(response => {
            console.log(response.data);
            this.$store.commit('gmt/SET_GMT', moment(response.data.gmdate));
            let self = this;
            function intervalFunction() {
                self.$store.commit('gmt/SET_GMT', moment(this.gmdate).add(1, 'seconds'));
            }

            setInterval(intervalFunction, 1000);
        }).catch(error => {
            console.log(error);
        });
    },

    computed: {
        gmdate() {
            if(this.$store.state.gmt.gmt) {
                return this.$store.state.gmt.gmt.moment('MMMM Do YYYY, h:mm:ss a');
            } else {
                return '';
            }
        }
    }
}
</script>
