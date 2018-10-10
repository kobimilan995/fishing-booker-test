<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class=" navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <router-link to="/" class="nav-link">Home</router-link>
                </li>
            </ul>
            <ul class="navbar-nav my-lg-0" v-if="!token">
                <li class="nav-item">
                    <!-- <a class="nav-link" href="#">Login</a> -->
                    <router-link to="/login" class="nav-link">Login</router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/register" class="nav-link">Register</router-link>
                </li>
            </ul>
            <ul class="navbar-nav my-lg-0" v-else>
                <li class="nav-item">
                    <h4 class="mr-4">{{authUser.first_name}} {{authUser.last_name}} - ({{authUser.role_name}})</h4>
                </li>
                <li class="nav-item">
                    <!-- <a class="nav-link" href="#">Login</a> -->
                    <a class="nav-link" href="#" @click.prevent="logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {

        }
    },

    computed: {
        token() {
            return this.$store.state.auth.token;
        },

        authUser() {
            return this.$store.state.auth.user;
        }
    },

    methods: {
        logout() {
            localStorage.removeItem('auth-token');
            localStorage.removeItem('auth-user');
            this.$store.commit('auth/SET_TOKEN', '');
            this.$store.commit('auth/SET_USER', {});
            this.$router.push({name: 'login'});
        }
    }

}
</script>
