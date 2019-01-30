/**
 * All Reducers as an object.
 * --------------------------
 */
export const reducers = {
    data: data,
    httpError: httpError
};

 
 /**
  * Functions that create new state from actions and old state (reducers).
  * ----------------------------------------------------------------------
  */

import { actions } from "./actions";

export function data(state = {}, action) {
    switch(action.type) {
        case actions.SEARCH_USERS:
            return Object.assign({}, state, {
                users: action.users,
                query: action.query
        });
        case actions.GET_ME:
            return Object.assign({}, state, {
                me: action.me
        });
        default:
            return state;
    }
}

export function httpError(state = {}, action) {
    switch(action.type) {
        case actions.HTTP_ERROR:
            return Object.assign({}, state, {
                error: action.error
            });
        case actions.RESET_HTTP_ERROR:
            return Object.assign({}, state, {
                error: null
            });
        default:
            return state;
    }
}
