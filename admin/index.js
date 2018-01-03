import React from 'react';
import ReactDOM from 'react-dom';
import Feap from 'feap';

let navigationItems = {
    "users": "Пользователи",
    "media": "Медиа-файлы"
};

const AdminFront = (
    <Feap
        navigationItems={navigationItems}
    />
);

ReactDOM.render(AdminFront, document.getElementById('root'));
