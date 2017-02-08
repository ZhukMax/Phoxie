import { combineReducers } from 'redux'
import { routerReducer } from 'react-router-redux'
import authReducer from './authReducer'
import counterReducer from './counterReducer'

export default combineReducers({
    auth:    authReducer,
    counter: counterReducer,
    routing: routerReducer
})
