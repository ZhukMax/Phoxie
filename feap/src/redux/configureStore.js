import { applyMiddleware, createStore } from 'redux'
import { browserHistory } from 'react-router'
import { routerMiddleware } from 'react-router-redux'
import thunk from 'redux-thunk'
import rootReducer from './reducers'

const routingMiddleware = routerMiddleware(browserHistory);

export default function (initialState = {}) {
    return createStore(rootReducer, initialState, applyMiddleware(thunk, routingMiddleware))
}
