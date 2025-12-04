USE tomtroc;

INSERT INTO users (username, email, password) VALUES
('nathalire', 'nathalie@mail.com', '$2y$10$examplehash...'),
('alexlecture', 'alex@mail.com', '$2y$10$examplehash...'),
('sas634', 'sas@mail.com', '$2y$10$examplehash...'),
('mariebooks', 'marie@mail.com', '$2y$10$examplehash...');

INSERT INTO books (title, author, description, status, user_id) VALUES
-- Nathan Williams
('The Kinfolk Table', 'Nathan Williams',
 'Ouvrage qui célèbre l’art de partager des repas simples et authentiques, avec des photographies chaleureuses.',
 'disponible', 1),
('The Kinfolk Home', 'Nathan Williams',
 'Exploration des intérieurs minimalistes et chaleureux à travers le monde.',
 'disponible', 1),
('Kinfolk Travel', 'Nathan Williams',
 'Guide inspirant pour voyager lentement et découvrir des lieux uniques.',
 'disponible', 1),
('Kinfolk Entrepreneur', 'Nathan Williams',
 'Portraits de créateurs et entrepreneurs qui réinventent leur vie professionnelle.',
 'disponible', 1),

-- Yuval Noah Harari
('Sapiens : Une brève histoire de l’humanité', 'Yuval Noah Harari',
 'Essai captivant retraçant l’évolution de l’humanité et ses grandes révolutions.',
 'disponible', 2),
('Homo Deus', 'Yuval Noah Harari',
 'Réflexion sur l’avenir de l’humanité et ses possibles évolutions technologiques.',
 'disponible', 2),
('21 leçons pour le XXIe siècle', 'Yuval Noah Harari',
 'Analyse des défis contemporains : politique, technologie, climat.',
 'disponible', 2),
('Money : The True Story of a Made-Up Thing', 'Yuval Noah Harari',
 'Exploration de l’histoire et du rôle de la monnaie dans les sociétés humaines.',
 'disponible', 2),

-- Paulo Coelho
('L’Alchimiste', 'Paulo Coelho',
 'Voyage initiatique de Santiago en quête de sa légende personnelle, empreint de sagesse.',
 'disponible', 3),
('Onze minutes', 'Paulo Coelho',
 'Roman sur l’amour, la sexualité et la quête de soi.',
 'disponible', 3),
('Le Manuscrit retrouvé', 'Paulo Coelho',
 'Texte philosophique sur la vie, la peur et l’espoir.',
 'disponible', 3),
('Brida', 'Paulo Coelho',
 'Histoire d’une jeune femme en quête de spiritualité et de magie.',
 'disponible', 3),

-- Antoine de Saint-Exupéry
('Le Petit Prince', 'Antoine de Saint-Exupéry',
 'Conte poétique sur l’amitié, l’amour et le sens de la vie à travers les yeux d’un enfant.',
 'disponible', 4),
('Vol de nuit', 'Antoine de Saint-Exupéry',
 'Roman sur les pionniers de l’aviation et leur courage.',
 'disponible', 4),
('Terre des hommes', 'Antoine de Saint-Exupéry',
 'Réflexion humaniste sur l’expérience de l’aviation et la condition humaine.',
 'disponible', 4),
('Pilote de guerre', 'Antoine de Saint-Exupéry',
 'Témoignage sur la Seconde Guerre mondiale et la résistance.',
 'disponible', 4);

