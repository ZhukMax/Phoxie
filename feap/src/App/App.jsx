import React, { Component, PropTypes } from 'react';
import { Link } from 'react-router';

import './App.css';

const propTypes = {
    children: PropTypes.node
};

class App extends Component {
    render() {
        return (
            <div>
                <Link to='/admin'>FeaPanel</Link>
                {this.props.children}
            </div>
        );
    }
}

App.propTypes = propTypes;

export default App;
