<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery</title>
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/delivery.css">
</head>
<body>

  <?php include '../php/sidebar.php'; ?>

    <section class="infos modernNeonBoxGlass">

      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.991629987298!2d2.289610393129337!3d48.858369997414485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2964e34e2d%3A0x8ddca9ee380ef7e0!2sTour%20Eiffel!5e0!3m2!1sfr!2sfr!4v1771511294650!5m2!1sfr!2sfr" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

      <label for="toggle" class="btn">Informations</label>

      <form action="delivery.html" method="post">
        <input type="submit" value="Delivery complete">
      </form>
    </section>

    <input type="checkbox" id="toggle" hidden>
    <section class="popup">
      <dl id="delivery-info" class="modernNeonBox">
        <dt>Adresse</dt>
        <dd>Tour Eiffel</dd>

        <dt>Code interphone</dt>
        <dd>Rien</dd>

        <dt>Étage</dt>
        <dd>Rez de chaussé</dd>

        <dt>Téléphone</dt>
        <dd>
            <a href="tel:+33612345678">06 12 34 56 78</a>
        </dd>
        <dt>Ouvrir sur Maps:</dt>
        <dd>
            <a href="https://maps.app.goo.gl/gvG1JYQCssCRfnDK9" target="_blank">Tour Eiffel</a>
        </dd>

        <dt>Commentaires</dt>
        <dd>JE VEUX DES PIZZAS CHAUDES !</dd>

        <label for="toggle" class="close">Fermer</label>
      </dl>
    </section>
</body>
</html>
