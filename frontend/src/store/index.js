import { createStore } from "vuex";

export default createStore({
  state: {
    affiche: false,
    LoggedIn: false,
    role: null
  },
  getters: {},
  mutations: {
    CHANGE_AFFICHE(state, affiche) {
      state.affiche = affiche;
    },
    CHANGE_LOGGEDIN(state, LoggedIn) {
      state.LoggedIn = LoggedIn
    },
    CHANGE_ROLE(state, role) {
      state.role = role
    }
    
  },
  actions: {
    set_affiche({commit}, affiche) {
      commit("CHANGE_AFFICHE", affiche);
    },
    set_loggedin({ commit }, LoggedIn) {
      commit("CHANGE_LOGGEDIN", LoggedIn)
    },
    set_role({ commit }, role) {
      commit("CHANGE_ROLE", role)
    }
  },
  modules: {},
});
