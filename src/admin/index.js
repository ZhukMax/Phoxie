import React from 'react';
import ReactDOM from 'react-dom';
import Feap from 'feap';

let navigationItems = {
    "users": "Пользователи",
    "media": "Медиа-файлы",
    "polls": "Опросы"
};

const AdminFront = (
    <Feap
        navigationItems={navigationItems}
    />
);

ReactDOM.render(AdminFront, document.getElementById('root'));