TODO:

Phase 4 prio:
-Logs d'incident
-Stats: compter plats/menus achetés
-Menu aléatoire
-Page menu pour admin: modifier/créer des plats/menus
-Ancien order direct dans le cart
-Par user: plats favoris et afficher sur cart.php

-Fonction bonus pour soutenance:
  -Game while delivering
    -Chess with burgers
    -Dino Game
    -Physics based game
  Réservation de table (carte interactive, calendrier, optimisation de tables etc)
  Code promo | Aymane
  Animation recherche menu
  Générateur de recommandations (petit questionnaire et ça recommande des plats)
  Affichage progression de la commande en temps réel pour client
  Chatbot du restaurant
  Orders pour restaurateur/admin: chiffre d'affaires simulé, plats les plus commandés, temps moyen de préparation, nombre de commandes en attente, chaque livreur occupé/disponible etc
  Créateur de plat (genre sandwich) custom (pourquoi pas avec un petit jeu ou faut satisfaire les demandes du chef)
  Panier sur menu avec drag and drop (prendre les plats et les mettre dans le panier a la souris)
  Générateur de mail (sans les envoyer) pour genre register, commande confirmée/livrée (Messagerie) (Aymane a renseigner)

Fix:
-Carousel | Julien
-Compte deactivated pas bloqués | Aymane
-Menus
  -Fix les menus (stocker données des plats choisis)
  -Modal async qui redirige pas et choisir un nombre de plats
-Orders
  -Vérifier le rôle avant d'afficher les boutons et d'autoriser les actions
  -Ajouter commande sur place (si addresse = "restaurant" on autorise pas les livreurs) | ccy
-Form.js
  -Régler login/register export/module | Julien
  -Message d'erreur sur admin/profil/login/register (form.js) |Aymane

Secondaire:
-Payement/Profil
  -Implémenter points fidélité
-Menus
  -créneaux limités
  -personnes max (compter les gens qui réservent ou un truc comme ça)
