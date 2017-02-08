import React from 'react'
import ReactDOM from 'react-dom'
import { browserHistory, Router } from 'react-router'
import { Provider } from 'react-redux'
import { syncHistoryWithStore } from 'react-router-redux'
import routes from './routes.jsx'
import configureStore from './redux/configureStore'

const store = configureStore();
const history = syncHistoryWithStore(browserHistory, store);

const feap = (
    <Provider store={store}>
        <Router history={history}>
            {routes}
        </Router>
    </Provider>
);

module.exports = feap;
