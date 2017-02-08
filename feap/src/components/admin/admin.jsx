import React, { Component, PropTypes } from 'react';
import Grid  from 'react-bootstrap/lib/Grid';
import Head from '../head';

const propTypes = {
    children: PropTypes.node
};

class admin extends Component {
    render() {
        return (
            <div>
                <Head />
                <Grid>
                    {this.props.children}
                </Grid>
            </div>
        );
    }
}

admin.propTypes = propTypes;

export default admin;
