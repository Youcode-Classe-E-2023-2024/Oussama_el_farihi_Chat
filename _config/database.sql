CREATE DATABASE IF NOT EXISTS chat_room;


CREATE TABLE user (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    img TEXT
);

CREATE TABLE room (
    id_room INT AUTO_INCREMENT PRIMARY KEY,
    name_room VARCHAR(255),
    date_creation DATETIME,
    id_createur INT,
    img VARCHAR(255),
    FOREIGN KEY (id_createur) REFERENCES user(id_user) ON DELETE CASCADE
);

CREATE TABLE message (
    id_message INT AUTO_INCREMENT PRIMARY KEY,
    contenu TEXT,
    date_envoi DATETIME,
    id_user INT,
    id_room INT,
    FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_room) REFERENCES room(id_room) ON DELETE CASCADE
);

CREATE TABLE ami (
    id_user1 INT,
    id_user2 INT,
    statut VARCHAR(255),
    PRIMARY KEY (id_user1, id_user2),
    FOREIGN KEY (id_user1) REFERENCES user(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_user2) REFERENCES user(id_user) ON DELETE CASCADE
);

CREATE TABLE invitation_room (
    id_invitation INT AUTO_INCREMENT PRIMARY KEY,
    id_user_invited INT,
    id_room INT,
    statut VARCHAR(255),
    FOREIGN KEY (id_user_invited) REFERENCES user(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_room) REFERENCES room(id_room) ON DELETE CASCADE
);

CREATE TABLE user_room (
    id_user_room INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_room INT,
    role VARCHAR(255),
    FOREIGN KEY (id_user) REFERENCES user(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_room) REFERENCES room(id_room) ON DELETE CASCADE
);

CREATE TABLE blocage (
    id_blocage INT AUTO_INCREMENT PRIMARY KEY,
    id_user_bloqueur INT,
    id_user_bloque INT,
    date_blocage DATETIME,
    FOREIGN KEY (id_user_bloqueur) REFERENCES user(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_user_bloque) REFERENCES user(id_user) ON DELETE CASCADE
);
