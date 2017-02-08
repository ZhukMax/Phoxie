import React from 'react'
import { IndexRoute, Route }  from 'react-router'
import { UserIsAuthenticated, UserIsAdmin } from './utility/wrappers'
import App from './App'
import Admin from './components/admin'
import Login from './components/auth'
import Dashboard from './components/dashboard'
import Settings from './components/settings'
import NoMatch from './components/errors/404'

export default (
    <Route path="/" component={App}>
        <Route path="login"         component={Login}/>
        <Route path="admin"         component={UserIsAuthenticated(UserIsAdmin(Admin))}>
            <IndexRoute                 component={Dashboard} />
            <Route path="/settings"     component={Settings} />
            <Route path="*"             component={NoMatch} />
        </Route>
    </Route>
);
