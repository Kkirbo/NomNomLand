<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css"/>
    <link rel="stylesheet" href="../styles/menu.css"/>
    <title>Menu</title>
</head>
<body>
  <?php include '../php/header.html'; ?>

  <?php include '../php/sidebar.php'; ?>

<h1 id="menuheader">Restaurant Menu</h1>

  <div class="menu-left">
    <h2 id="sousmenuheader">Menus</h2>

  <div class="cards-container" role="list" aria-label="Featured menus">
    <article class="menu-card modernNeonBoxGlass" role="listitem" aria-label="Connect to Nature menu, 8.99€">
  <img src="../assets/images/menus/nature.png" class="menu-img" alt="Connect to Nature menu illustration" />
  <h3>Connect to Nature</h3>
  <a href="#menu1" class="card-btn" aria-label="View Connect to Nature menu details – 8.99€">8.99€</a>
</article>

<article class="menu-card modernNeonBoxGlass" role="listitem" aria-label="Wombo Combo menu, 15.99€">
    <img src="../assets/images/meals/Wombo-combo.png" class="menu-img" alt="Wombo Combo menu illustration" />
    <h3>Wombo Combo</h3>
    <a href="#menu2" class="card-btn" aria-label="View Wombo Combo menu details – 15.99€">15.99€</a>
  </article>

<article class="menu-card modernNeonBoxGlass" role="listitem" aria-label="SegFault Rush / Core dumped menu, 19.99€">
      <img src="../assets/images/meals/CPU.png" class="menu-img" alt="SegFault Rush / Core dumped menu illustration"/>
      <h3>SegFault Rush  /  (Core dumped)</h3>
    <a href="#menu3" class="card-btn" aria-label="View SegFault Rush menu details – 19.99€">19.99€</a>
    </article>
 <article class="menu-card modernNeonBoxGlass" role="listitem" aria-label="Sweet BlueStacks menu, 4.99€">
    <img src="../assets/images/meals/Bluestacks.png" class="menu-img" alt="Sweet BlueStacks menu illustration"/>
    <h3>Sweet BlueStacks</h3>
    <a href="#menu4" class="card-btn" aria-label="View Sweet BlueStacks menu details – 4.99€">4.99€</a>
  </article>
    <article class="menu-card modernNeonBoxGlass" role="listitem" aria-label="Java and Tea Runtime menu, 4.99€">
    <img src="../assets/images/meals/Café-Java.png" class="menu-img" alt="Java and Tea Runtime menu illustration"/>
    <h3>Java &amp; Tea Runtime</h3>
    <a href="#menu5" class="card-btn" aria-label="View Java and Tea Runtime menu details – 4.99€">4.99€</a>
  </article>
    </div>

    <h2>Others</h2>
<div class="cards-container" role="list" aria-label="Menu categories">
  <article class="menu-card modernNeonBoxGlass basic" role="listitem" aria-label="Entries category">
    <h3>Entries</h3>
    <a href="#menuentrees" class="card-btn card-btn-basic" aria-label="See all entries">More info...</a>
  </article>
  <article class="menu-card modernNeonBoxGlass basic" role="listitem" aria-label="Main meals category">
    <h3>Main meals</h3>
    <a href="#menuplats" class="card-btn card-btn-basic" aria-label="See all main meals">More info...</a>
  </article>
  <article class="menu-card modernNeonBoxGlass basic" role="listitem" aria-label="Desserts category">
    <h3>Desserts</h3>
    <a href="#menudesserts" class="card-btn card-btn-basic" aria-label="See all desserts">More info...</a>
  </article>
  <article class="menu-card modernNeonBoxGlass basic" role="listitem" aria-label="Drinks and hot drinks category">
    <h3>Drinks and hot drinks</h3>
    <a href="#menudrinks" class="card-btn card-btn-basic" aria-label="See all drinks and hot drinks">More info...</a>
  </article>
</div>
</div>


</section>


  <a href="../views/index.html" class="return0" aria-label="Return to home page">
    End of the menu: return 0; // Buon appetito
  </a>

<!-- ===== MODALS ===== -->

<div id="salad" class="modal" role="dialog" aria-modal="true" aria-labelledby="salad-title">
  <div class="modal_content modernNeonBox">
        <a href="#" class="modal_close" aria-label="Close Salade sans 5G details">&times;</a>
    <h2 class="dish-title" id="salad-title">Salade sans 5G</h2>
    <img src="../assets/images/meals/Salade.jpeg" class="dish-img" alt="Salade sans 5G – fresh garden salad with quinoa, avocado and lemon dressing"/>
    <p class="dish-version">Version Nature Stable 1.0 — 100% Offline</p>
      <div class="dish-section">
        <h3>Architecture</h3>
        <ul>
          <li>Frontend : Roquette, jeunes pousses</li>
          <li>Backend : Avocat, concombre, tomates</li>
          <li>Seeds and kernel : Quinoa, graines, noix</li>
          <li>Firewall : Citron &amp; huile d'olive</li>
        </ul>
      </div>
      <div class="dish-section">
        <h3>Spécifications</h3>
        <ul>
          <li>Exécution : Fraîche</li>
          <li>Build : 7 min</li>
          <li>Autonomie : +4h</li>
          <li>Connectivité : Désactivée</li>
          <li>Compatible : Vegan / Sans gluten</li>
        </ul>
      </div>
      <div class="devnote">
        <p>blablahblah</p>
      </div>
    <div class="dish-footer">
      <p>&gt; Aucun réseau requis. Recharge naturelle garantie.</p>
    </div>
    </div>
  </div>
</div>

<div id="calzone" class="modal" role="dialog" aria-modal="true" aria-labelledby="calzone-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Calzone Container details">&times;</a>
    <h2 class="dish-title" id="calzone-title">Calzone Container</h2>
    <img src="../assets/images/meals/Calzone-Container.webp" class="dish-img" alt="Calzone Container – folded artisan pizza filled with mozzarella, ham and mushrooms"/>
    <p class="dish-version">Version Dockerisée 2.3 - Hot Deploy Edition</p>
    <div class="dish-section">
      <h3>Architecture</h3>
      <ul>
        <li>Frontend: Pâte artisanale double couche (UI isolée)</li>
        <li>Core engine: Sauce tomate sécurisée (base LTS)</li>
        <li>Middleware: Mozarella fondante haute disponibilité</li>
        <li>Microservices: Jambon premium, champignons, poivrons</li>
        <li>Orchestrateur: Basilic frais</li>
        <li>Container Seal: Repli hermétique anti-fuite thermique</li>
      </ul>
    </div>
    <div class="dish-section">
      <h3>Spécifications</h3>
      <ul>
        <li>Exécution: Chaud / Temps réel</li>
        <li>Build: 12 min au four (2000°C)</li>
        <li>Scalabilité: Format Solo / Duo</li>
        <li>Tolérance aux pannes: Résiste aux coupures de Wi-Fi</li>
        <li>Compatibilité: Omnivore / Option</li>
      </ul>
    </div>
    <div class="dish-section">
      <h3>Sécurité</h3>
      <ul>
      <li>Isolation thermique complète</li>
      <li>Aucune dépendance externe requise</li>
      <li>Anti-crash fromage</li>
      </ul>
    </div>
    <div class="devnote">
      <ul>
      <li>Image comestible encapsulée</li>
      <li>Aucun serveur distant requis</li>
      <li>Runtime 100% local</li>
      </ul>
    </div>
    <div class="dish-footer">
      <ul>
        <p>Conteneur autonome</p>
        <p>Port chaud ouvert par defaut</p>
      </ul>
    </div>
  </div>
</div>

<div id="lasagna" class="modal" role="dialog" aria-modal="true" aria-labelledby="lasagna-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Full Stack Lasagna details">&times;</a>
    <h2 class="dish-title" id="lasagna-title">Full Stack Lasagna</h2>
    <img src="../assets/images/meals/lasagna.jpg" class="dish-img" alt="Full Stack Lasagna – multi-layered lasagna with beef ragù, béchamel and gratin cheese"/>
    <p class="dish-version">Version Beta-1.0 — Layered Deployment</p>
    <div class="dish-section">
      <h3>Architecture</h3>
      <ul>
        <li>Frontend : Feuille de pâte supérieure (UI visible)</li>
        <li>Backend : Ragoût bœuf &amp; légumes</li>
        <li>API Layer : Béchamel intermédiaire</li>
        <li>Database : Fromage gratiné persistant</li>
        <li>Cache : Herbes aromatiques</li>
        <li>Load Balancer : Double couche alternée</li>
      </ul>
    </div>
    <div class="dish-section">
      <h3>Spécifications</h3>
      <ul>
        <li>Exécution : Four traditionnel</li>
        <li>Build : 25 min</li>
        <li>Stack : Multi-couches synchronisées</li>
        <li>Scalabilité : Format Familial</li>
        <li>Compatibilité : Omnivore / Végétarienne</li>
      </ul>
    </div>
    <div class="dish-section">
      <h3>Sécurité</h3>
      <ul>
        <li>Isolation par couches</li>
        <li>Anti-fuite béchamel</li>
        <li>Rollback possible (réchauffage)</li>
      </ul>
    </div>
    <div class="devnote">
      <ul>
        <li>Architecture modulaire empilée</li>
        <li>Déploiement horizontal recommandé</li>
      </ul>
    </div>
    <div class="dish-footer">
      <ul>
        <p>Stack comestible haute densité</p>
        <p>Zéro dépendance cloud</p>
      </ul>
    </div>
  </div>
</div>

<div id="margherita" class="modal" role="dialog" aria-modal="true" aria-labelledby="margherita-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close NPC Margherita details">&times;</a>
    <h2 class="dish-title" id="margherita-title">NPC Margherita</h2>
    <img src="../assets/images/meals/Margherita Pizza.jpg" alt="NPC Margherita – classic pizza with tomato sauce, mozzarella and fresh basil"/>
    <p class="dish-version">Version Passive 1.4 — Background Process</p>
    <div class="dish-section">
      <h3>Architecture</h3>
      <ul>
        <li>Base Engine : Pâte fine</li>
        <li>Core : Sauce tomate vanilla</li>
        <li>Rendering : Mozzarella dynamique</li>
        <li>Script comportemental : Basilic décoratif</li>
        <li>AI Level : Stable &amp; prévisible</li>
      </ul>
    </div>
    <div class="dish-section">
      <h3>Spécifications</h3>
      <ul>
        <li>Exécution : Temps réel</li>
        <li>Build : 8 min</li>
        <li>Interaction : Minimaliste</li>
        <li>Mode : Idle / Friendly</li>
        <li>Compatibilité : Universelle</li>
      </ul>
    </div>
    <div class="dish-section">
      <h3>Sécurité</h3>
      <ul>
        <li>Aucun script externe</li>
        <li>Anti-bug ananas</li>
      </ul>
    </div>
    <div class="devnote">
      <ul>
        <li>Fonctionne sans input utilisateur</li>
        <li>Parfaite pour environnements débutants</li>
      </ul>
    </div>
    <div class="dish-footer">
      <ul>
        <p>Instance simple</p>
        <p>Stable en production</p>
      </ul>
    </div>
  </div>
</div>

<div id="penne" class="modal" role="dialog" aria-modal="true" aria-labelledby="penne-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Penne.js Bolognese details">&times;</a>
        <h2 class="dish-title" id="penne-title">Penne.js Bolognese</h2>
    <img src="../assets/images/meals/Penne.jpg" class="dish-img" alt="Penne.js Bolognese – penne pasta with rich bolognese sauce and parmesan"/>
    <p class="dish-version">Version 3.2 — Async Flavor</p>
    <div class="dish-section">
      <h3>Architecture</h3>
      <ul>
        <li>Framework : Penne al dente</li>
        <li>Runtime : Sauce bolognaise riche</li>
        <li>Event Loop : Cuisson progressive</li>
        <li>Modules : Parmesan, thym</li>
        <li>Package Manager : Huile d'olive</li>
      </ul>
    </div>
    <div class="dish-section">
      <h3>Spécifications</h3>
      <ul>
        <li>Exécution : Chaud &amp; asynchrone</li>
        <li>Build : 15 min</li>
        <li>Dépendances : Viande + tomate</li>
        <li>Compatibilité : Node Kitchen</li>
      </ul>
    </div>
    <div class="dish-section">
      <h3>Sécurité</h3>
      <ul>
        <li>Gestion mémoire al dente</li>
      </ul>
    </div>
    <div class="devnote">
      <ul>
        <li>Callback saveur optimisée</li>
        <li>Supporte multi-thread gustatif</li>
      </ul>
    </div>
    <div class="dish-footer">
      <ul>
        <p>Script savoureux</p>
        <p>API gustative ouverte</p>
      </ul>
    </div>
  </div>
</div>

<div id="ravioli" class="modal" role="dialog" aria-modal="true" aria-labelledby="ravioli-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Boolean Ravioli Open-Source details">&times;</a>
    <h2 class="dish-title" id="ravioli-title">Boolean Ravioli Open-Source</h2>
    <img src="../assets/images/meals/ravioli.webp" class="dish-img" alt="Boolean Ravioli Open-Source – fresh ravioli stuffed with ricotta and spinach in tomato sauce"/>
    <p class="dish-version">Version 1.1 — True/False Edition</p>
    <div class="dish-section">
      <h3>Architecture</h3>
      <ul>
        <li>Shell : Pâte hermétique</li>
        <li>Payload : Ricotta &amp; épinards</li>
        <li>Condition : Fromage = true</li>
        <li>Else : Vide = false</li>
        <li>Repository : Sauce tomate publique</li>
      </ul>
    </div>
    <div class="dish-section">
      <h3>Spécifications</h3>
      <ul>
        <li>Exécution : Eau bouillante</li>
        <li>Build : 6 min</li>
        <li>Licence : Libre consommation</li>
        <li>Fork possible : Oui</li>
      </ul>
    </div>
    <div class="dish-section">
      <h3>Sécurité</h3>
      <ul>
        <li>Encapsulation complète</li>
        <li>Anti-overflow farce</li>
      </ul>
    </div>
    <div class="devnote">
      <ul>
        <li>Logique binaire culinaire</li>
        <li>Merge request accepté avec parmesan</li>
      </ul>
    </div>
    <div class="dish-footer">
      <ul>
        <p>Code farci</p>
        <p>Transparence garantie</p>
      </ul>
    </div>
  </div>
</div>

<div id="carbonara" class="modal" role="dialog" aria-modal="true" aria-labelledby="carbonara-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Callback Carbonara details">&times;</a>
    <h2 class="dish-title" id="carbonara-title">Callback Carbonara</h2>
    <img src="../assets/images/meals/Carbonara.jpg" class="dish-img" alt="Callback Carbonara – spaghetti with creamy egg and parmesan sauce and crispy lardons"/>
    <p class="dish-version">Version 2.0 — Creamy Response</p>
    <div class="dish-section">
      <h3>Architecture</h3>
      <ul>
        <li>Core Engine : Spaghetti</li>
        <li>Callback : Sauce œuf &amp; parmesan</li>
        <li>Promise : Lardons croustillants</li>
        <li>Async Layer : Poivre noir</li>
        <li>Dependency Injection : Crème (optionnelle ⚠)</li>
      </ul>
    </div>
    <div class="dish-section">
      <h3>Spécifications</h3>
      <ul>
        <li>Exécution : Immédiate</li>
        <li>Build : 12 min</li>
        <li>Mode : Synchronous taste</li>
        <li>Compatibilité : Italien strict mode</li>
      </ul>
    </div>
    <div class="dish-section">
      <h3>Sécurité</h3>
      <ul>
        <li>Anti-coagulation</li>
        <li>Timeout cuisson critique</li>
      </ul>
    </div>
    <div class="devnote">
      <ul>
        <li>Callback exécuté après cuisson</li>
        <li>Promise résolue à chaud</li>
      </ul>
    </div>
    <div class="dish-footer">
      <ul>
        <p>Réponse crémeuse</p>
        <p>Aucun deadlock détecté</p>
      </ul>
    </div>
  </div>
</div>

<div id="spaghetti" class="modal" role="dialog" aria-modal="true" aria-labelledby="spaghetti-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Spaghetti Code details">&times;</a>
        <h2 class="dish-title" id="spaghetti-title">Spaghetti Code</h2>
    <img src="../assets/images/meals/spaghetti.jpg" class="dish-img" alt="Spaghetti Code – tangled spaghetti with mystery sauce"/>
    <p class="dish-version">Version Legacy 0.9 — Chaos Edition</p>
    <div class="dish-section">
      <h3>Architecture</h3>
      <ul>
        <li>Structure : Nouilles entremêlées</li>
        <li>Core : Sauce indéterminée</li>
        <li>Modules : Mélange aléatoire</li>
        <li>Dépendances : Multiples &amp; non documentées</li>
        <li>Debug : Complexe</li>
      </ul>
    </div>
    <div class="dish-section">
      <h3>Spécifications</h3>
      <ul>
        <li>Exécution : Imprévisible</li>
        <li>Build : Variable</li>
        <li>Maintenabilité : Faible</li>
        <li>Scalabilité : Risquée</li>
      </ul>
    </div>
    <div class="dish-section">
      <h3>Sécurité</h3>
      <ul>
        <li>Risque de débordement</li>
        <li>Refactor recommandé</li>
      </ul>
    </div>
    <div class="devnote">
      <ul>
        <li>Héritage ancien projet</li>
        <li>Documentation manquante</li>
      </ul>
    </div>
    <div class="dish-footer">
      <ul>
        <p>Système legacy</p>
        <p>Refactoring conseillé</p>
      </ul>
    </div>
  </div>
</div>

<div id="bruschetta" class="modal" role="dialog" aria-modal="true" aria-labelledby="bruschetta-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Bruschetta Binary details">&times;</a>
    <h2 class="dish-title" id="bruschetta-title">Bruschetta Binary</h2>
    <img src="../assets/images/meals/Bruschetta.jpg" class="dish-img" alt="Bruschetta Binary – toasted artisan bread with cherry tomatoes, garlic and basil"/>
    <p class="dish-version">Version 1.0 — Crunchy Edition</p>
    <div class="dish-section">
      <h3>Architecture</h3>
      <ul>
        <li>Base: Pain grillé artisanal</li>
        <li>Frontend: Tomates cerises</li>
        <li>Backend: Ail &amp; basilic</li>
        <li>Middleware: Huile d'olive extra vierge</li>
      </ul>
    </div>
    <div class="dish-section">
      <h3>Spécifications</h3>
      <ul>
        <li>Exécution: Immédiate</li>
        <li>Build: 5 min</li>
        <li>Compatibilité: Végétarien / Vegan</li>
      </ul>
    </div>
    <div class="dish-footer">
      <p>Saveur garantie 100% locale</p>
    </div>
  </div>
</div>

<div id="garlic" class="modal" role="dialog" aria-modal="true" aria-labelledby="garlic-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Garlic Bread API details">&times;</a>
    <h2 class="dish-title" id="garlic-title">Garlic Bread API</h2>
    <img src="../assets/images/meals/garlic_bread.jpg" class="dish-img" alt="Garlic Bread API – crispy baguette with garlic butter and fresh parsley"/>
    <p class="dish-version">Version 2.1 — Hot Deploy</p>
    <div class="dish-section">
      <h3>Architecture</h3>
      <ul>
        <li>Base: Baguette croustillante</li>
        <li>Middleware: Beurre à l'ail</li>
        <li>Addon: Persil frais</li>
        <li>Runtime: Four chaud 180°C</li>
      </ul>
    </div>
    <div class="dish-section">
      <h3>Spécifications</h3>
      <ul>
        <li>Exécution: 8 min</li>
        <li>Scalabilité: Portions multiples</li>
        <li>Compatibilité: Tous types de repas</li>
      </ul>
    </div>
    <div class="dish-footer">
      <p>API garantie sans bug d'ail</p>
    </div>
  </div>
</div>

<div id="smoothie" class="modal" role="dialog" aria-modal="true" aria-labelledby="smoothie-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Smoothie API details">&times;</a>
    <h2 class="dish-title" id="smoothie-title">Smoothie API</h2>
    <img src="../assets/images/meals/smoothie.jpg" class="dish-img" alt="Smoothie API – fresh blended fruit smoothie with orange juice and ice"/>
    <p class="dish-version">Version 1.2 — Fruity Endpoint</p>
    <div class="dish-section">
      <h3>Architecture</h3>
      <ul>
        <li>Base: Fruits frais mixés</li>
        <li>Middleware: Jus d'orange &amp; pomme</li>
        <li>Frontend: Glaçons</li>
      </ul>
    </div>
    <div class="dish-footer">
      <p>Endpoint rafraîchissant garanti</p>
    </div>
  </div>
</div>

<div id="tiramisu" class="modal" role="dialog" aria-modal="true" aria-labelledby="tiramisu-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Tiramisu Async details">&times;</a>
    <h2 class="dish-title" id="tiramisu-title">Tiramisu Async</h2>
    <img src="../assets/images/meals/tiramisu.jpg" class="dish-img" alt="Tiramisu Async – classic layered tiramisu with coffee-soaked biscuits and mascarpone"/>
    <p class="dish-version">Version 1.0 — Layered Flavor</p>
    <div class="dish-section">
      <h3>Architecture</h3>
      <ul>
        <li>Base: Biscuits imbibés café</li>
        <li>Middleware: Mascarpone crémeux</li>
        <li>Frontend: Cacao poudre</li>
        <li>Runtime: Frais 4°C</li>
      </ul>
    </div>
    <div class="dish-footer">
      <p>Déploiement doux garanti</p>
    </div>
  </div>
</div>

<div id="gelato" class="modal" role="dialog" aria-modal="true" aria-labelledby="gelato-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Gelato Node.js details">&times;</a>
    <h2 class="dish-title" id="gelato-title">Gelato Node.js</h2>
    <img src="../assets/images/meals/gelato.jpg" class="dish-img" alt="Gelato Node.js – Italian gelato with fresh fruit and chocolate sauce"/>
    <p class="dish-version">Version 2.2 — Async Freeze</p>
    <div class="dish-section">
      <h3>Architecture</h3>
      <ul>
        <li>Base: Lait &amp; crème</li>
        <li>Middleware: Fruits frais</li>
        <li>Frontend: Sauce chocolat</li>
        <li>Runtime: Congélation rapide</li>
      </ul>
    </div>
    <div class="dish-footer">
      <p>Saveur garantissant zéro latence</p>
    </div>
  </div>
</div>

<div id="latte" class="modal" role="dialog" aria-modal="true" aria-labelledby="latte-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Latte Debug details">&times;</a>
    <h2 class="dish-title" id="latte-title">Latte Debug</h2>
    <img src="../assets/images/meals/cat-latte.jpg" class="dish-img" alt="Latte Debug – espresso with steamed milk and decorative latte art"/>
    <p class="dish-version">Version 3.0 — Error Handling Edition</p>
    <div class="dish-section">
      <h3>Architecture</h3>
      <ul>
        <li>Base: Lait filtré</li>
        <li>Middleware: Espresso shot</li>
        <li>Frontend: Latte art dynamique</li>
      </ul>
    </div>
    <div class="dish-footer">
      <p>Débuggages dernière minute</p>
    </div>
  </div>
</div>

<div id="the" class="modal" role="dialog" aria-modal="true" aria-labelledby="the-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Thé Green Deployment details">&times;</a>
    <h2 class="dish-title" id="the-title">Thé Green Deployment</h2>
    <img src="../assets/images/meals/tea.jpg" class="dish-img" alt="Thé Green Deployment – brewed green tea with optional honey and lemon"/>
    <p class="dish-version">Version 2.5 — Continuous Brew</p>
    <div class="dish-section">
      <h3>Architecture</h3>
      <ul>
        <li>Base: Feuilles de thé vert</li>
        <li>Middleware: Infusion lente</li>
        <li>Frontend: Miel &amp; citron optionnels</li>
        <li>Runtime: Température 80°C</li>
      </ul>
    </div>
    <div class="dish-footer">
      <p>Déploiement naturel garanti</p>
    </div>
  </div>
</div>

<div id="espresso" class="modal" role="dialog" aria-modal="true" aria-labelledby="espresso-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Espresso Kernel Panic details">&times;</a>
    <h2 class="dish-title" id="espresso-title">Espresso Kernel Panic</h2>
    <img src="../assets/images/meals/Espresso.jpg" class="dish-img" alt="Espresso Kernel Panic – intense concentrated espresso shot"/>
    <p class="dish-version">Version 1.9 — Fatal Shot Edition</p>
    <div class="dish-section">
      <h3>Architecture</h3>
      <ul>
        <li>Base: Espresso concentré</li>
        <li>Middleware: Micro-mousse</li>
        <li>Runtime: Shot rapide</li>
        <li>Debug: Écran noir garanti</li>
      </ul>
    </div>
    <div class="dish-footer">
      <p>Redémarrage requis après consommation</p>
    </div>
  </div>
</div>

<!-- ===== MENU MODALS ===== -->

<div id="menu1" class="modal" role="dialog" aria-modal="true" aria-labelledby="menu1-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Connect to Nature menu">&times;</a>
    <h2 class="dish-title" id="menu1-title">Menu connexion à la nature</h2>
    <ul class="liste" aria-label="Dishes included in Connect to Nature menu">
      <li><a href="#salad" class="link" aria-label="View Salade sans 5G details">Salade sans 5G</a></li>
      <li><a href="#bruschetta" class="link" aria-label="View Bruschetta Binary details">Bruschetta Binary</a></li>
      <li><a href="#garlic" class="link" aria-label="View Garlic Bread API details">Garlic Bread API</a></li>
    </ul>
  </div>
</div>

<div id="menu2" class="modal" role="dialog" aria-modal="true" aria-labelledby="menu2-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Wombo Combo menu">&times;</a>
    <h2 class="dish-title" id="menu2-title">Wombo Combo</h2>
    <ul class="liste" aria-label="Dishes included in Wombo Combo menu">
      <li><a href="#calzone" class="link" aria-label="View Calzone Container details">Calzone Container</a></li>
      <li><a href="#lasagna" class="link" aria-label="View Full Stack Lasagna details">Full Stack Lasagna</a></li>
      <li><a href="#margherita" class="link" aria-label="View NPC Margherita details">NPC Margherita</a></li>
    </ul>
  </div>
</div>

<div id="menu3" class="modal" role="dialog" aria-modal="true" aria-labelledby="menu3-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close SegFault Rush menu">&times;</a>
    <h2 class="dish-title" id="menu3-title">SegFault Rush (Core dumped)</h2>
    <ul class="liste" aria-label="Dishes included in SegFault Rush menu">
      <li><a href="#penne" class="link" aria-label="View Penne.js Bolognese details">Penne.js Bolognese</a></li>
      <li><a href="#ravioli" class="link" aria-label="View Boolean Ravioli Open-Source details">Boolean Ravioli Open-Source</a></li>
      <li><a href="#carbonara" class="link" aria-label="View Callback Carbonara details">Callback Carbonara</a></li>
      <li><a href="#spaghetti" class="link" aria-label="View Spaghetti Code details">Spaghetti Code</a></li>
      <li><a href="#espresso" class="link" aria-label="View Espresso Kernel Panic details">Espresso Kernel Panic</a></li>
    </ul>
  </div>
</div>

<div id="menu4" class="modal" role="dialog" aria-modal="true" aria-labelledby="menu4-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Sweet BlueStacks menu">&times;</a>
    <h2 class="dish-title" id="menu4-title">Sweet BlueStacks</h2>
    <ul class="liste" aria-label="Dishes included in Sweet BlueStacks menu">
      <li><a href="#tiramisu" class="link" aria-label="View Tiramisu Async details">Tiramisu Async</a></li>
      <li><a href="#gelato" class="link" aria-label="View Gelato Vanilla Script details">Gelato Vanilla Script</a></li>
    </ul>
  </div>
</div>

<div id="menu5" class="modal" role="dialog" aria-modal="true" aria-labelledby="menu5-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Java and Tea Runtime menu">&times;</a>
    <h2 class="dish-title" id="menu5-title">Java &amp; Tea Runtime</h2>
    <ul class="liste" aria-label="Dishes included in Java and Tea Runtime menu">
      <li><a href="#latte" class="link" aria-label="View Latte Debug details">Latte Debug</a></li>
      <li><a href="#espresso" class="link" aria-label="View Espresso Kernel Panic details">Espresso Kernel Panic</a></li>
      <li><a href="#the" class="link" aria-label="View Thé Green Deployment details">Thé Green Deployment</a></li>
    </ul>
  </div>
</div>

<!-- ===== CATEGORY MODALS ===== -->

<div id="menuentrees" class="modal" role="dialog" aria-modal="true" aria-labelledby="menuentrees-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Entries list">&times;</a>
    <h2 class="dish-title basic" id="menuentrees-title">Entries</h2>
    <ul class="liste" aria-label="List of all entries">
      <li class="texte"><a href="#salad" class="link" aria-label="View Salade sans 5G details">Salade sans 5G</a></li>
      <li class="texte"><a href="#bruschetta" class="link" aria-label="View Bruschetta Binary details">Bruschetta Binary</a></li>
      <li class="texte"><a href="#garlic" class="link" aria-label="View Garlic Bread API details">Garlic Bread API</a></li>
    </ul>
  </div>
</div>

<div id="menuplats" class="modal" role="dialog" aria-modal="true" aria-labelledby="menuplats-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Main meals list">&times;</a>
    <h2 class="dish-title basic" id="menuplats-title">Meals</h2>
    <ul class="liste" aria-label="List of all main meals">
      <li class="texte"><a href="#calzone" class="link" aria-label="View Calzone Container details">Calzone Container</a></li>
      <li class="texte"><a href="#lasagna" class="link" aria-label="View Full Stack Lasagna details">Full Stack Lasagna</a></li>
      <li class="texte"><a href="#margherita" class="link" aria-label="View NPC Margherita details">NPC Margherita</a></li>
      <li class="texte"><a href="#penne" class="link" aria-label="View Penne.js Bolognese details">Penne.js Bolognese</a></li>
      <li class="texte"><a href="#ravioli" class="link" aria-label="View Boolean Ravioli Open-Source details">Boolean Ravioli Open-Source</a></li>
      <li class="texte"><a href="#carbonara" class="link" aria-label="View Callback Carbonara details">Callback Carbonara</a></li>
      <li class="texte"><a href="#spaghetti" class="link" aria-label="View Spaghetti Code details">Spaghetti Code</a></li>
    </ul>
  </div>
</div>

<div id="menudrinks" class="modal" role="dialog" aria-modal="true" aria-labelledby="menudrinks-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Coffee and drinks list">&times;</a>
    <h2 class="dish-title basic" id="menudrinks-title">Coffee and drinks</h2>
    <ul class="liste" aria-label="List of all drinks and hot drinks">
      <li class="texte"><a href="#latte" class="link" aria-label="View Latte Debug details">Latte Debug</a></li>
      <li class="texte"><a href="#espresso" class="link" aria-label="View Espresso Kernel Panic details">Espresso Kernel Panic</a></li>
      <li class="texte"><a href="#the" class="link" aria-label="View Thé Green Deployment details">Thé Green Deployment</a></li>
      <li class="texte"><a href="#smoothie" class="link" aria-label="View Smoothie API details">Smoothie API</a></li>
    </ul>
  </div>
</div>

<div id="menudesserts" class="modal" role="dialog" aria-modal="true" aria-labelledby="menudesserts-title">
  <div class="modal_content modernNeonBox">
    <a href="#" class="modal_close" aria-label="Close Desserts list">&times;</a>
    <h2 class="dish-title basic" id="menudesserts-title">Desserts</h2>
    <ul class="liste" aria-label="List of all desserts">
      <li class="texte"><a href="#tiramisu" class="link" aria-label="View Tiramisu Async details">Tiramisu Async</a></li>
      <li class="texte"><a href="#gelato" class="link" aria-label="View Gelato Vanilla Script details">Gelato Vanilla Script</a></li>
    </ul>
  </div>
</div>

    <?php include '../php/footer.html'; ?>

</body>
</html>
