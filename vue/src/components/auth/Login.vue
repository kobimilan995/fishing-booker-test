<template>
    <div class="col-md-6 offset-md-3">
        <h4>Login</h4>
        <form @submit.prevent="submitLoginRequest">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" v-model="credentials.email" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" v-model="credentials.password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            credentials: {
                email: '',
                password: ''
            }
        }
    },

    methods: {
        submitLoginRequest() {
            axios.post('http://localhost:8000/api/login', this.credentials).then(response => {
                let token = response.headers.authorization;
                let user = response.data.user;
                localStorage.setItem('auth-token', token);
                localStorage.setItem('auth-user', JSON.stringify(user));
                this.$store.commit('auth/SET_TOKEN', token);
                this.$store.commit('auth/SET_USER', response.data.user);
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('auth-token');;
                this.$router.push({name: 'home'});
            }).catch(error => {
                console.log(error);
                if(error.response.status == 400) {
                    let {data} = error.response.data;
                    this.$notify({
                        group: 'error',
                        title: 'Error',
                        text: data[Object.keys(data)[0]][0],
                        type: 'error'
                    });
                }
            });
        }
    },

    computed: {
        token() {
            return this.$store.state.auth.token;
        }
    }
}
</script>
