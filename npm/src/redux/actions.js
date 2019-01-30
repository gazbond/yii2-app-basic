/**
 * Constants at the top for quick reference.
 * -----------------------------------------
 */

export const SEARCH_USERS = 'SEARCH_USERS';
export const GET_ME = 'GET_ME';


/**
 * All actions as an object.
 * -------------------------
 */
export const actions = {};
actions[SEARCH_USERS] = SEARCH_USERS;
actions[GET_ME] = GET_ME;


/**
 * Functions that create action objects (action creators).
 * -------------------------------------------------------
 */

import axios from 'axios';

export function searchUsers(query) {
    return dispatch => {
        axios.get('/api/users', {
            params: {
                query: query
            }
        })
        .then(response => {
            dispatch({
                type: SEARCH_USERS,
                query: query,
                users: response.data
            });
        })
        .catch(error => {});
    };
}

export function getMe() {
    return dispatch => {
        axios.get('/api/users/me')
        .then(response => {
            dispatch({
                type: GET_ME,
                me: response.data
            });
        })
        .catch(error => {});
    }
}

