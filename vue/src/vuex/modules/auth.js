export default {
    namespaced: true,
    state: {
        token: localStorage.getItem('auth-token') ? localStorage.getItem('auth-token') : '',
        user: {}
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
