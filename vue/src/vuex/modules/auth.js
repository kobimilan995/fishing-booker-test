export default {
    namespaced: true,
    state: {
        token: localStorage.getItem('auth-token') ? localStorage.getItem('auth-token') : '',
        user: localStorage.getItem('auth-user') ? JSON.parse(localStorage.getItem('auth-user')): {},
    },
    mutations: {
        SET_TOKEN(state, token) {
            state.token = token;
        },

        SET_USER(state, user) {
            state.user = user;
        }
    },
    actions: {

    }
}
