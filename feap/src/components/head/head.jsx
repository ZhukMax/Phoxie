import React, { Component } from 'react';
import { Link } from 'react-router';
import Nav from 'react-bootstrap/lib/Nav';
import Navbar from 'react-bootstrap/lib/Navbar';
import NavItem  from 'react-bootstrap/lib/NavItem';
import LinkContainer from 'react-router-bootstrap/lib/LinkContainer';
import { logout } from '../../redux/actions/authActions'

class Head extends Component {
    render() {
        return (
            <Navbar>
                <Navbar.Header>
                    <Navbar.Brand>
                        <Link to='/admin'>FeaPanel</Link>
                    </Navbar.Brand>
                    <Navbar.Toggle />
                </Navbar.Header>
                <Navbar.Collapse>
                    <Nav navbar>
                        <LinkContainer to="/admin/settings">
                            <NavItem>Settings</NavItem>
                        </LinkContainer>
                    </Nav>
                </Navbar.Collapse>
                <button onClick={() => logout()}>Logout</button>
            </Navbar>
        );
    }
}

export default Head;
