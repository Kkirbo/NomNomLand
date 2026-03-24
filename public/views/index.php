<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Funzione</title>

    <link rel="icon" href="../assets/icons/logo.ico">
    <link rel="stylesheet" href="../styles/index.css">
    <script defer src="../scripts/index.js"></script>
</head>
<body>
    <!-- Background animation not yet implemented
    <canvas class="background"></canvas>
    -->
    <?php include '../php/header.html'; ?>

    <?php include '../php/sidebar.php'; ?>

    <main>
      <section class="carousel">
        <article class="modernNeonBoxGlass"></article>
        <article class="Meal modernNeonBoxGlass">
              <a href="menu.html#ravioli" class="imageLink"><img draggable="false" src="../assets/images/meals/ravioli.webp" alt="Ravioli Image"></a>
              <ul>
                  <li><h3>Today's special</h3></li>
                  <li>Boolean Ravioli Open-Source</li>
                  <li>Version 1.1 — True/False Edition</li>
                  <li><a href="menu.html#ravioli"><button>Order</button></a></li>
              </ul>
        </article>
        <article class="Meal modernNeonBoxGlass">
            <a href="menu.html#lasagna" class="imageLink"><img draggable="false" src="../assets/images/meals/lasagna.jpg" alt="Favorite meal Image"></a>
            <ul>
                <li><h3>Customer favorite</h3></li>
                <li>Full Stack Lasagna</li>
                <li>Version Beta-1.0 — Layered Deployment</li>
                <li><a href="menu.html#lasagna"><button>Order</button></a></li>
            </ul>
        </article>
        <article class="Meal modernNeonBoxGlass">
            <a href="menu.html#spaghetti" class="imageLink"><img draggable="false" src="../assets/images/meals/spaghetti.jpg" alt="Best seller meal Image"></a>
            <ul>
                <li><h3>Best seller</h3></li>
                <li>Spaghetti Code</li>
                <li>Version Legacy 0.9 — Chaos Edition</li>
                <li><a href="menu.html#spaghetti"><button>Order</button></a></li>
            </ul>
        </article>
        <article class="modernNeonBoxGlass"></article>
      </section>

      <form action="menu.html" method="get" class="searchbar"autocomplete=off>
        <span>$ls</span>
        <input type="text" name="search" placeholder="Search for your favorite meal...">
      </form>

      <section class="menus">
        <article class="menu modernNeonBoxGlass">
              <a href="menu.html#menu1" class="imageLink"><img draggable="false" src="../assets/images/menus/nature.png" alt="Nature Menu Image"></a>
              <h3>Connect to Nature Menu</h3>
              <ul>
                  <li>Starter | Main course</li>
                  <li>The best vegetal menu</li>
                  <li>No gluten dishes included</li>
                  <li>Available 24/7</li>
              </ul>
              <a href="menu.html#menu1"><button>8.99€</button></a>
          </article>
          <article class="menu modernNeonBoxGlass">
              <a href="menu.html#menu2" class="imageLink"><img draggable="false" src="../assets/images/menus/menu2.png" alt="Wombo Combo Menu Image"></a>
              <h3>Wombo Combo Menu</h3>
              <ul>
                  <li>Main course | Drink</li>
                  <li>All our classics avaiable</li>
                  <li>The choice of our clients</li>
                  <li>The standard</li>
              </ul>
              <a href="menu.html#menu2"><button>15.99€</button></a>
          </article>
          <article class="menu modernNeonBoxGlass">
              <a href="menu.html#menu3" class="imageLink"><img draggable="false" src="../assets/images/menus/menu3.png" alt="SegFault Menu Image"></a>
              <h3>SegFault Rushed Menu</h3>
              <ul>
                  <li>Main course | Drink</li>
                  <li>The best foods avaiable</li>
                  <li>For a quick meal</li>
                  <li>Affordable and Fast</li>
              </ul>
              <a href="menu.html#menu3"><button>19.99€</button></a>
          </article>
      </section>

      <section class="infos" id="about">
        <h2>About us</h2>
        <article class="modernNeonBoxGlass">
          <p>
            Welcome to La Funzione, where Italian tradition meets clean code.
            We believe great cuisine works like great software: carefully structured,
            beautifully designed, and compiled to perfection.
          </p>
          <p>
            Our menu is built on classic Italian foundations with a modern twist.
            From our <a href="menu.html#lasagna">Full Stack Lasagna</a> layered to perfection, to our
            <a href="menu.html#carbonara">Callback Carbonara</a> that always delivers, every dish is crafted
            with precision and passion.
          </p>
          <p>
            We proudly serve our signature <a href="menu.html#salad">5G-Free Salad</a> (pure nature, zero
            interference), the legendary <a href="menu.html#margherita">NPC Margherita</a> (simple, iconic,
            never glitchy), and pasta cooked strictly in dente —
            perfectly compiled, never overcooked, never undercooked.
          </p>
          <p>
            At La Funzione, there are no bugs in the kitchen — only features.
            Fresh ingredients, seasonal updates, and an experience designed
            to keep you coming back for the next delicious release.
          </p>
          <p>La Funzione v2.0 — Now Serving Seasonal Updates</p>

          <p>
            Ready to execute your reservation?
            <a href="menu.html">Order now</a> or <a href="#contact">Contact us</a>
          </p>
        </article>
      </section>

      <section class="infos" id="faq">
        <h2>Q&A</h2>

        <details>
          <summary>Do I need a reservation?</summary>
          <p>
            We highly recommend making a reservation, especially on weekends.
            Walk-ins are welcome depending on availability.
          </p>
        </details>

        <details>
          <summary>Do you offer vegetarian or vegan options?</summary>
          <p>
            Yes. Our menu includes carefully crafted vegetarian dishes and
            seasonal vegan options prepared with fresh ingredients.
          </p>
        </details>

        <details>
          <summary>Are allergens clearly indicated?</summary>
          <p>
            Absolutely. A full allergen list is available upon request and on
            our dedicated <a href="allergens.html">allergens</a> page.
          </p>
        </details>

        <details>
          <summary>Do you host private events?</summary>
          <p>
            Yes, we offer private dining experiences for birthdays, corporate
            events and special occasions. Contact us for details.
          </p>
        </details>

        <details>
          <summary>Is there parking nearby?</summary>
          <p>
            Public parking is available within a 2-minute walk of the restaurant.
          </p>
        </details>

        <details>
          <summary>Do you accept large group bookings?</summary>
          <p>
            Yes, we welcome group reservations. Please contact us directly to arrange
            seating and menu options for parties of 8 or more.
          </p>
        </details>

        <details>
          <summary>What payment methods do you accept?</summary>
          <p>
            We accept cash, credit cards, and contactless payments.
          </p>
        </details>

        <details>
          <summary>Is the restaurant accessible?</summary>
          <p>
            Yes, our restaurant is wheelchair accessible and equipped with accessible
            restroom facilities.
          </p>
        </details>
      </section>
    </main>

    <?php include '../php/footer.html'; ?>

</body>
</html>
