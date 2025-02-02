INSERT INTO permission (permission_name, permission_icon, permission_action)
VALUES ('Usuarios', 'users', '/dashboard'),
       ('Localizadores', 'map-pin', '/qr'),
       ('Mascotas', 'list', '/pet/petsadmin'),
       ('Mi Perfil', 'user', '/profile'),
       ('Mis Mascotas', 'list', '/'),
       ('Cerrar Sesión', 'log-out', '/closesession');

INSERT INTO `permissionxrole` (`entity_id`, `permission_id`, `role_id`)
VALUES (1, 1, 1),
       (2, 2, 1),
       (3, 3, 1),
       (4, 4, 1),
       (5, 6, 1),
       (6, 5, 1),
       (7, 4, 2),
       (8, 5, 2),
       (9, 6, 2);