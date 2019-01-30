import { createStore, combineReducers, applyMiddleware } from 'redux';
import thunk from 'redux-thunk';

import { reducers } from './reducers';

const initState = {
    data: {
        users: [],
        me: {}
    },
    httpError: null
};
export const store = createStore(
    combineReducers(reducers), 
    initState,
    applyMiddleware(thunk)
);