-- Une fois connecté, exécutez les commandes suivantes
CREATE USER 'gabonsondeuser'@'localhost' IDENTIFIED BY 'gabonsondemdp';
CREATE DATABASE gabonsondedb;
GRANT ALL PRIVILEGES ON gabonsondedb.* TO 'gabonsondeuser'@'localhost';
FLUSH PRIVILEGES;

USE gabonsondedb;

CREATE TABLE users( participantID INT AUTO_INCREMENT, noms TEXT, prenoms TEXT, age INT, sexe TEXT, profession TEXT, ipadress TEXT, PRIMARY KEY(participantID));
CREATE TABLE societe( id INT AUTO_INCREMENT, reponse1 TEXT, reponse2 TEXT, reponse3 TEXT, reponse4 TEXT, reponse5 TEXT, participantID INT, PRIMARY KEY(id));
CREATE TABLE environnement( id INT AUTO_INCREMENT, reponse1 TEXT, reponse2 TEXT, reponse3 TEXT, reponse4 TEXT, reponse5 TEXT, participantID INT, PRIMARY KEY(id));
CREATE TABLE technologie( id INT AUTO_INCREMENT, reponse1 TEXT, reponse2 TEXT, reponse3 TEXT, reponse4 TEXT, reponse5 TEXT, participantID INT, PRIMARY KEY(id));
CREATE TABLE sante( id INT AUTO_INCREMENT, reponse1 TEXT, reponse2 TEXT, reponse3 TEXT, reponse4 TEXT, reponse5 TEXT, participantID INT, PRIMARY KEY(id));
CREATE TABLE education( id INT AUTO_INCREMENT, reponse1 TEXT, reponse2 TEXT, reponse3 TEXT, reponse4 TEXT, reponse5 TEXT, participantID INT, PRIMARY KEY(id));
CREATE TABLE culture( id INT AUTO_INCREMENT, reponse1 TEXT, reponse2 TEXT, reponse3 TEXT, reponse4 TEXT, reponse5 TEXT, participantID INT, PRIMARY KEY(id));
CREATE TABLE sport( id INT AUTO_INCREMENT, reponse1 TEXT, reponse2 TEXT, reponse3 TEXT, reponse4 TEXT, reponse5 TEXT, participantID INT, PRIMARY KEY(id));
CREATE TABLE divers( id INT AUTO_INCREMENT, reponse1 TEXT, reponse2 TEXT, reponse3 TEXT, reponse4 TEXT, reponse5 TEXT, participantID INT, PRIMARY KEY(id));

CREATE TABLE surveyresults( participantID INT AUTO_INCREMENT, cat1 INT, cat2 INT, cat3 INT, cat4 INT, cat5 INT, PRIMARY KEY(participantID));
-- (Optionnel) Vérifiez les privilèges
SHOW GRANTS FOR 'gabonsondeuser'@'localhost';
