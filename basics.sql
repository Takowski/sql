-- Affiche toutes les données.
SELECT * FROM students;
JOIN school 
ON students.school_id = school.id; 
-- Affiche uniquement les prénoms.
SELECT prenom FROM students;
-- Affiche les prénoms, les dates de naissance et l’école de chacun.
SELECT students.nom, students.prenom, students.datenaissance, students.genre, school.school 
FROM students
JOIN school
ON students.school_id = school.id;
-- Affiche uniquement les élèves qui sont de sexe féminin.
SELECT * FROM students
WHERE genre = 'F';
-- Affiche uniquement les élèves qui font partie de l’école d'Addy.
SELECT students.nom, students.prenom, students.datenaissance, students.genre, school.school
FROM students
JOIN school
ON students.school = school.idschool
WHERE students.school = (
    SELECT school FROM students WHERE nom = 'Addy'
);
-- Affiche uniquement les prénoms des étudiants, par ordre inverse à l’alphabet (DESC). Ensuite, la même chose mais en limitant les résultats à 2.
select prenom from students order by prenom desc;
-- Ajoute Ginette Dalor, née le 01/01/1930 et affecte-la à Bruxelles, toujours en SQL.
INSERT INTO students (nom, prenom, datenaissance, genre, school)
VALUES ('Dalor', 'Ginette', '1930-01-01', 'F', 1);
-- Modifie Ginette (toujours en SQL) et change son sexe et son prénom en “Omer”.
UPDATE students SET prenom = 'Omer', genre = 'M' WHERE nom = 'Dalor';
-- Supprimer la personne dont l’ID est 3.
-- Modifier le contenu de la colonne School de sorte que "1" soit remplacé par "Liege" et "2" soit remplacé par "Gent". (attention au type de la colonne !)
-- Faire d’autres manipulations pour voir si t’es bien compris.



