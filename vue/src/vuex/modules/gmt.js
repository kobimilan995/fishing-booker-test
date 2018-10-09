export default {
    namespaced: true,
    state: {
        gmt: '',
        gmtHuman: ''
    },
    mutations: {
        SET_GMT(state, gmdate) {
            state.gmt = gmdate;
            state.gmtHuman = state.gmt.format('MMMM Do YYYY, h:mm:ss a')
        },

        INCREMENT_GMT(state) {
            state.gmt = state.gmt.add(1, 'seconds');
            state.gmtHuman = state.gmt.format('MMMM Do YYYY, h:mm:ss a');
        }
    },
    actions: {

    }
}
