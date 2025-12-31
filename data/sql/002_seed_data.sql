USE tomtroc;

INSERT INTO users (username, email, password, profile) VALUES
('nathalire', 'nathalie@mail.com', '$2y$10$examplehash...', 'nathalie.png'),
('alexlecture', 'alex@mail.com', '$2y$10$examplehash...', 'alex.png'),
('sas634', 'sas@mail.com', '$2y$10$examplehash...', 'sas.png'),
('mariebooks', 'marie@mail.com', '$2y$10$examplehash...', 'marie.png');


-- User 1 : nathalire
INSERT INTO books (title, author, description, status, image, user_id) VALUES
('Esther', 'Alabaster',
 'Un ouvrage visuel qui revisite le livre d’Esther avec une approche artistique moderne. Chaque page mêle photographie minimaliste et texte biblique réinterprété. L’ensemble crée une expérience méditative, douce et inspirante. Un livre parfait pour ceux qui aiment les éditions soignées et contemplatives.',
 'disponible', '/assets/uploads/books/Esther.jpg', 1),

('The Kinfolk Table', 'Nathan Williams',
 'Un voyage dans l’art de recevoir, porté par l’esthétique Kinfolk. Le livre rassemble des recettes simples, des portraits de créateurs et des scènes de vie authentiques. Il invite à ralentir, partager et cuisiner avec intention. Une ode au minimalisme chaleureux et à la convivialité.',
 'disponible', '/assets/uploads/books/KinFolk.jpg', 1),

('Wabi Sabi', 'Beth Kempton',
 'Une exploration poétique de la beauté imparfaite et éphémère. L’autrice dévoile les principes du wabi-sabi à travers des anecdotes, des réflexions et des pratiques concrètes. Le livre encourage à accepter l’imperfection et à vivre avec plus de simplicité. Un guide apaisant pour ceux qui cherchent du sens dans le quotidien.',
 'disponible', '/assets/uploads/books/Wabi_Sabi.jpg', 1),

('Milk & honey', 'Rupi Kaur',
 'Un recueil de poésie intime sur la douleur, la guérison et la résilience. Les textes courts, accompagnés d’illustrations minimalistes, touchent par leur sincérité. Rupi Kaur explore l’amour, la perte et la reconstruction personnelle. Un livre puissant, à lire d’une traite ou à savourer lentement.',
 'disponible', '/assets/uploads/books/Milk_honey.jpg', 1);


-- User 2 : alexlecture
INSERT INTO books (title, author, description, status, image, user_id) VALUES
('Delight!', 'Justin Rossow',
 'Un livre qui rassemble des réflexions inspirantes sur la joie et la spiritualité. Chaque chapitre propose une perspective positive sur les défis du quotidien. L’auteur invite à cultiver la gratitude et à reconnaître les petites victoires. Un ouvrage lumineux, idéal pour nourrir son esprit.',
 'disponible', '/assets/uploads/books/Delight.jpg', 2),

('Milwaukee Mission', 'Elder Cooper Low',
 'Un témoignage authentique sur l’expérience missionnaire à Milwaukee. L’auteur partage ses rencontres, ses doutes et les moments qui l’ont transformé. Le récit offre un regard humain sur la foi en action. Un livre sincère, riche en émotions et en apprentissages.',
 'disponible', '/assets/uploads/books/Milwaukee.jpg', 2),

('Minimalist Graphics', 'Julia Schoniau',
 'Une immersion dans l’univers du design graphique minimaliste. Le livre explore les formes, les couleurs et les compositions épurées. Il présente des exemples concrets et des analyses visuelles inspirantes. Un indispensable pour les créatifs et amateurs de design.',
 'disponible', '/assets/uploads/books/Minimalist.jpg', 2),

('Hygge', 'Melk Wiking',
 'Une célébration du bonheur danois à travers le confort, la chaleur et la simplicité. L’auteur dévoile les secrets du hygge avec humour et bienveillance. Le livre regorge d’idées pour créer une atmosphère apaisante chez soi. Une lecture douce, parfaite pour les amateurs de cocooning.',
 'disponible', '/assets/uploads/books/Hygge.jpg', 2);


-- User 3 : sas634
INSERT INTO books (title, author, description, status, image, user_id) VALUES
('Innovation', 'Matt Ridley',
 'Un essai captivant sur l’histoire et la dynamique de l’innovation humaine. Ridley montre comment les idées évoluent, se croisent et transforment nos sociétés. Le livre mêle anecdotes, analyses et réflexions sur le progrès. Une lecture stimulante pour les curieux et les esprits créatifs.',
 'disponible', '/assets/uploads/books/Innovation.jpg', 3),

('Psalms', 'Alabaster',
 'Une édition artistique des Psaumes, mêlant poésie biblique et photographie moderne. Chaque page invite à la contemplation et à la sérénité. Le design épuré met en valeur la profondeur des textes. Un ouvrage idéal pour méditer ou offrir.',
 'disponible', '/assets/uploads/books/Psalms.jpg', 3),

('Thinking, Fast & Slow', 'Daniel Kahneman',
 'Un livre majeur sur la psychologie cognitive et nos mécanismes de décision. Kahneman distingue deux systèmes de pensée qui influencent nos choix. L’ouvrage est riche en exemples, expériences et enseignements pratiques. Une référence incontournable pour comprendre l’esprit humain.',
 'disponible', '/assets/uploads/books/Thinking_Fast_Slow.jpg', 3),

('A Book Full Of Hope', 'Rupi Kaur',
 'Un recueil lumineux qui explore l’espoir, la guérison et la force intérieure. Les poèmes, simples et touchants, résonnent avec douceur. Rupi Kaur y célèbre la résilience et la beauté des émotions humaines. Un livre réconfortant, parfait pour les moments de doute.',
 'disponible', '/assets/uploads/books/A_Book_Full_Of_Hope.jpg', 3);


-- User 4 : mariebooks
INSERT INTO books (title, author, description, status, image, user_id) VALUES
('The Subtle Art Of Not Giving A Fuck', 'Mark Manson',
 'Un guide percutant qui bouscule les codes du développement personnel. Manson invite à choisir ses priorités et à accepter ses limites. Le ton direct et l’humour noir rendent la lecture addictive. Un livre qui aide à vivre plus librement et plus lucidement.',
 'disponible', '/assets/uploads/books/Subtle.jpg', 4),

('Narnia', 'C.S Lewis',
 'Un classique intemporel qui mêle aventure, magie et symbolisme. Le lecteur suit des enfants transportés dans un monde merveilleux. L’univers est riche, poétique et rempli de créatures fascinantes. Un roman qui émerveille autant les jeunes que les adultes.',
 'disponible', '/assets/uploads/books/Narnia.jpg', 4),

('Compagny Of One', 'Paul Jarvis',
 'Un essai brillant sur l’entrepreneuriat minimaliste et durable. Jarvis défend l’idée qu’une petite structure peut être plus libre et efficace. Le livre propose des conseils concrets et des exemples inspirants. Une lecture essentielle pour ceux qui veulent entreprendre autrement.',
 'disponible', '/assets/uploads/books/Compagny_Of_One.jpg', 4),

('The Two Towers', 'J.R.R Tolkien',
 'Le deuxième tome épique du Seigneur des Anneaux. Les héros se séparent et affrontent des dangers grandissants. Tolkien déploie un univers riche, sombre et profondément humain. Un récit haletant qui prépare à l’apothéose finale.',
 'disponible', '/assets/uploads/books/The_Two_Towers.jpg', 4);
