export default {
    namespaced: true,
    state: {
        gmt: ''
    },
    mutations: {
        SET_GMT(state, gmdate) {
            state.gmt = gmdate;
        }
    },
    actions: {

    }
}
