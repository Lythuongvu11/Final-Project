import { createStore } from 'vuex';

const store = createStore({
    state: {
        isLoggedIn: false, // Mặc định người dùng chưa đăng nhập
    },
    mutations: {
        setLoggedIn(state, isLoggedIn) {
            state.isLoggedIn = isLoggedIn;
        },
    },
});

export default store;