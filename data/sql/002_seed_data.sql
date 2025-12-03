USE tomtroc;

INSERT INTO users (username, email, password) VALUES
('nathalire', 'nathalie@mail.com', '$2y$10$examplehash...'),
('alexlecture', 'alex@mail.com', '$2y$10$examplehash...'),
('sas634', 'sas@mail.com', '$2y$10$examplehash...'),
('mariebooks', 'marie@mail.com', '$2y$10$examplehash...');

INSERT INTO books (title, author, description, status, user_id) VALUES
('The Kinfolk Table', 'Nathan Williams',
 'Ouvrage qui célèbre l’art de partager des repas simples et authentiques, avec des photographies chaleureuses.',
 'disponible', 1),
('Sapiens : Une brève histoire de l’humanité', 'Yuval Noah Harari',
 'Essai captivant retraçant l’évolution de l’humanité et ses grandes révolutions.',
 'disponible', 2),
('L’Alchimiste', 'Paulo Coelho',
 'Voyage initiatique de Santiago en quête de sa légende personnelle, empreint de sagesse.',
 'disponible', 3),
('Le Petit Prince', 'Antoine de Saint-Exupéry',
 'Conte poétique sur l’amitié, l’amour et le sens de la vie à travers les yeux d’un enfant.',
 'disponible', 4);
