ZenBook - Plateforme Sécurisée de Réservation de Ressources

Présentation du Projet
**ZenBook** est une application web full-stack développée dans le cadre de la validation du **Titre Professionnel Développeur Web et Web Mobile (DWWM)**. 

Cette plateforme centralisée permet à une structure de gérer et de planifier la réservation de ses ressources partagées (salles de réunion, matériels informatiques, équipements pédagogiques). L'application intègre un algorithme strict de contrôle anti-chevauchement des créneaux horaires ainsi qu'une gestion des accès sécurisée basée sur les rôles (RBAC).

---

Informations Générales
Candidat :VALENTIN Mickael
Organisme de Formation :** Centre Européen De Formation (CEF)
Session :** 2026
Examen :** Titre Professionnel DWWM (Niveau 5 - Équivalent Bac+2)

---

Stack Technique
Back-End :PHP 8.2+ / Symfony 6.4 LTS
Abstraction de Données :** Doctrine ORM
Base de Données :MariaDB / MySQL
Front-End :Twig (Moteur de templates), HTML5 / CSS3 (Responsive Design, Flexbox, Grid), JavaScript (Vanilla ES6)
Sécurité :Composant Security de Symfony (Argon2id, Protection CSRF, Échappement automatique XSS via Twig)

---

Fonctionnalités Clés
Gestion des utilisateurs :** Inscription, connexion, profils sécurisés avec hachage de mot de passe.
Système de Réservation (Règle métier principale) :Vérification en temps réel de la disponibilité d'une ressource grâce au `QueryBuilder` de Doctrine pour empêcher les doublons de réservation sur un même créneau.
Espace Client (`ROLE_USER`) :** Consultation du catalogue des ressources, visualisation des calendriers de disponibilité et historique personnalisé des réservations.
Espace Administration (`ROLE_ADMIN`) :** Interface CRUD complète pour la gestion des utilisateurs, des ressources disponibles et modération globale des réservations.

---

Installation et Configuration en Local

Prérequis
Assurez-vous d'avoir installé sur votre machine :
* PHP 8.2 ou supérieur
* Composer
* Un serveur de base de données (XAMPP, WampServer, Laragon ou Docker)
* Symfony CLI (recommandé)
