<?php require '../../private/php/session.php';?>
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
    <?php include 'header.html'; ?>

    <?php include 'sidebar.php'; ?>

    <main>
      <section class="carousel">
          <article class="modernNeonBoxGlass"></article>

          <?php include '../../private/php/generate-carousel.php'; ?>
          <?php generateCarousel(); ?>

          <article class="modernNeonBoxGlass"></article>
      </section>

      <form action="menu.php" method="get" class="searchbar"autocomplete=off>
        <span>$ls</span>
        <input type="text" name="search" placeholder="Search for your favorite meal...">
      </form>

      <section class="menus">
        <?php include '../../private/php/generate-menu-list.php'; ?>
        <?php generateMenuList(3); ?>
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
            From our <a href="menu.php#lasagna">Full Stack Lasagna</a> layered to perfection, to our
            <a href="menu.php#carbonara">Callback Carbonara</a> that always delivers, every dish is crafted
            with precision and passion.
          </p>
          <p>
            We proudly serve our signature <a href="menu.php#salad">5G-Free Salad</a> (pure nature, zero
            interference), the legendary <a href="menu.php#margherita">NPC Margherita</a> (simple, iconic,
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
            <a href="menu.php">Order now</a> or <a href="#contact">Contact us</a>
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
            our dedicated <a href="allergens.php">allergens</a> page.
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

    <?php include 'footer.html'; ?>

</body>
</html>
