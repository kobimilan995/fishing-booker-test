<template>
    <div class="">
        <h4 class="col-md-4 offset-md-3">Registration</h4>
        <form class=" col-md-6 offset-md-3" @submit.prevent="submitRegisterRequest">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="first_name" class="form-control" id="first_name" v-model="user.first_name" aria-describedby="first_name" placeholder="First name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="last_name" class="form-control" id="last_name" v-model="user.last_name" aria-describedby="last_name" placeholder="Last name" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" v-model="user.email" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" v-model="user.password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Password Confirmation</label>
                <input type="password" class="form-control" v-model="user.password_confirmation" id="password_confirmation" placeholder="Password confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

            <small id="emailHelp" class="form-text text-muted"><router-link to="/login">Already have an account?</router-link></small>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {
                first_name: '',
                last_name: '',
                email: '',
                password: '',
                password_confirmation: ''
            }
        }
    },

    methods: {
        submitRegisterRequest() {
            axios.post('http://localhost:8000/api/register', this.user).then(response => {
                let {data} = response;
                this.$notify({
                    group: 'notify',
                    title: 'Success',
                    text: data.message,
                    type: 'success'
                });
                this.$router.push({name: 'login'});
            }).catch(error => {
                if(error.response.status == 400) {
                    let {data} = error.response.data;
                    this.$notify({
                        group: 'notify',
                        title: 'Error',
                        text: data[Object.keys(data)[0]][0],
                        type: 'error'
                    });
                }
            });
        }
    }
}
</script>
