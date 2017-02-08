import React, { Component, PropTypes } from 'react';
import { routerActions } from 'react-router-redux'
import { connect } from 'react-redux'

import { login } from '../../redux/actions/authActions'

// function select(state, ownProps) {
//     const isAuthenticated = state.user.name || false;
//     const redirect = ownProps.location.query.redirect || '/';
//     return {
//         isAuthenticated,
//         redirect
//     }
// }

class auth extends Component {
    render() {
        return (
            <div>
                <h2>Enter your name</h2>
                <input type="text" ref="name" />
                <br/>
                <button onClick={this.onClick}>Login</button>
            </div>
        );
    }
}

export default connect(select, { login, replace: routerActions.replace })(auth)
