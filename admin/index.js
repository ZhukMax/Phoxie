import React from 'react';
import ReactDOM from 'react-dom';
import Feap from 'feap';

let navigationItems = {
    "users": "Users",
    "media": "Media files"
};

const AdminFront = (
    <Feap
        navigationItems={navigationItems}
    />
);

ReactDOM.render(AdminFront, document.getElementById('root'));
