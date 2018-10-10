<template>
    <div id="app">
        <navigation-component></navigation-component>
        <div class="container">
            <router-view></router-view>
        </div>
        <notifications group="notify" position="bottom left" />
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
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$store.state.auth.token;

        axios.interceptors.response.use((response) => {
            return response;
        }, (error) => {
            if(error.response.status == 401) {
                localStorage.removeItem('auth-token');
                localStorage.removeItem('auth-user');
                this.$store.commit('auth/SET_TOKEN', '');
                this.$store.commit('auth/SET_USER', {});
                this.$router.push({name: 'login'});
            } else if(error.response.status == 403){

                this.$router.push({name: 'home'});
            }

            return Promise.reject(error);
        });
    },

    mounted() {
        axios.get('http://localhost:8000/api/gmdate').then(response => {
            this.$store.commit('gmt/SET_GMT', moment(response.data.gmdate));
            let self = this;
            function intervalFunction() {
                self.$store.commit('gmt/INCREMENT_GMT');
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
