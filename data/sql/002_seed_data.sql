USE tomtroc;

INSERT INTO users (username, email, password, profile) VALUES
('nathalire', 'nathalie@mail.com', '$2y$10$examplehash...', 'nathalie.png'),
('alexlecture', 'alex@mail.com', '$2y$10$examplehash...', 'alex.png'),
('sas634', 'sas@mail.com', '$2y$10$examplehash...', 'sas.png'),
('mariebooks', 'marie@mail.com', '$2y$10$examplehash...', 'marie.png');



-- User 1 : nathalire
INSERT INTO books (title, author, description, status, image, user_id) VALUES
('Esther', 'Alabaster', 'Livre illustré de la série biblique Alabaster.', 'disponible', '/assets/uploads/books/Esther.jpg', 1),
('The Kinfolk Table', 'Nathan Williams', 'Recettes et art de vivre minimaliste.', 'disponible', '/assets/uploads/books/KinFolk.jpg', 1),
('Wabi Sabi', 'Beth Kempton', 'Philosophie japonaise de l’imperfection et de la simplicité.', 'disponible', '/assets/uploads/books/Wabi_Sabi.jpg', 1),
('Milk & honey', 'Rupi Kaur', 'Recueil de poésie contemporaine sur la douleur et la guérison.', 'disponible', '/assets/uploads/books/Milk_honey.jpg', 1);

-- User 2 : alexlecture
INSERT INTO books (title, author, description, status, image, user_id) VALUES
('Delight!', 'Justin Rossow', 'Réflexions spirituelles et inspirantes.', 'disponible', '/assets/uploads/books/Delight.jpg', 2),
('Milwaukee Mission', 'Elder Cooper Low', 'Témoignage sur la mission à Milwaukee.', 'disponible', '/assets/uploads/books/Milwaukee.jpg', 2),
('Minimalist Graphics', 'Julia Schoniau', 'Exploration du design graphique minimaliste.', 'disponible', '/assets/uploads/books/Minimalist.jpg', 2),
('Hygge', 'Melk Wiking', 'Art de vivre danois basé sur le confort et la convivialité.', 'disponible', '/assets/uploads/books/Hygge.jpg', 2);

-- User 3 : sas634
INSERT INTO books (title, author, description, status, image, user_id) VALUES
('Innovation', 'Matt Ridley', 'Essai sur l’histoire et l’impact de l’innovation.', 'disponible', '/assets/uploads/books/Innovation.jpg', 3),
('Psalms', 'Alabaster', 'Livre illustré de la série biblique Alabaster.', 'disponible', '/assets/uploads/books/Psalms.jpg', 3),
('Thinking, Fast & Slow', 'Daniel Kahneman', 'Analyse des deux systèmes de pensée humaine.', 'disponible', '/assets/uploads/books/Thinking_Fast_Slow.jpg', 3),
('A Book Full Of Hope', 'Rupi Kaur', 'Poèmes sur l’espoir et la résilience.', 'disponible', '/assets/uploads/books/A_Book_Full_Of_Hope.jpg', 3);

-- User 4 : mariebooks
INSERT INTO books (title, author, description, status, image, user_id) VALUES
('The Subtle Art Of Not Giving A Fuck', 'Mark Manson', 'Guide de développement personnel iconoclaste.', 'disponible', '/assets/uploads/books/Subtle.jpg', 4),
('Narnia', 'C.S Lewis', 'Roman de fantasy classique pour petits et grands.', 'disponible', '/assets/uploads/books/Narnia.jpg', 4),
('Compagny Of One', 'Paul Jarvis', 'Essai sur l’entrepreneuriat minimaliste.', 'disponible', '/assets/uploads/books/Compagny_Of_One.jpg', 4),
('The Two Towers', 'J.R.R Tolkien', 'Deuxième tome du Seigneur des Anneaux.', 'disponible', '/assets/uploads/books/The_Two_Towers.jpg', 4);
