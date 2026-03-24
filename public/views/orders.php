<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/admin.css">
</head>
<body>

    <?php include '../php/sidebar.php'; ?>

    <section class="orders">

        <h2>Pending Orders</h2>

        <article class="menu modernNeonBoxGlassAdmin orderCard">

            <h3>Order #1024</h3>

            <ul>
                <li><strong>Customer Email:</strong> john.doe@email.com</li>
                <li><strong>Arrival Date:</strong> 2026-02-20 18:42</li>
            </ul>

            <!-- Checkbox cachée -->
            <input type="checkbox" id="order-toggle" class="modalToggle">

            <!-- Bouton ouvrir -->
            <label for="order-toggle" class="openModalBtn">
                Display Details
            </label>

            <!-- MODAL FULL SCREEN -->
            <div class="modal">

                <!-- Overlay fermeture -->
                <label for="order-toggle" class="overlay"></label>

                <div class="modalContent modernNeonBoxGlass">

                    <h3>Order #1024 Details</h3>

                    <ul>
                        <li>1x Git Merge Menu</li>
                        <li>2x Connect to Nature Menu</li>
                        <li>1x Coke</li>
                    </ul>

                    <p><strong>Total:</strong> 34.97€</p>

                    <!-- Start Preparation -->
                    <form action="update_order_status.php" method="POST">
                        <input type="hidden" name="order_id" value="1024">
                        <input type="hidden" name="status" value="preparing">
                        <button type="submit">Start Preparation</button>
                    </form>

                    <!-- Send to Delivery -->
                    <form action="update_order_status.php" method="POST">
                        <input type="hidden" name="order_id" value="1024">
                        <input type="hidden" name="status" value="delivery">
                        <button type="submit">Send to Delivery</button>
                    </form>

                    <!-- Bouton fermer -->
                    <label for="order-toggle" class="closeBtn">
                        Close
                    </label>

                </div>
            </div>

        </article>

      <article class="menu modernNeonBoxGlassAdmin orderCard">

        <h3>Order #1023</h3>

        <ul>
            <li><strong>Customer Email:</strong> the.rock@email.com</li>
            <li><strong>Arrival Date:</strong> 2026-02-20 18:42</li>
        </ul>

        <!-- Checkbox cachée -->
        <input type="checkbox" id="order-toggle" class="modalToggle">

        <!-- Bouton ouvrir -->
        <label for="order-toggle" class="openModalBtn">
            Display Details
        </label>

        <!-- MODAL FULL SCREEN -->
        <div class="modal">

            <!-- Overlay fermeture -->
            <label for="order-toggle" class="overlay"></label>

            <div class="modalContent modernNeonBoxGlass">

                <h3>Order #1023 Details</h3>

                <ul>
                    <li>1x Git Merge Menu</li>
                    <li>2x Connect to Nature Menu</li>
                    <li>1x Coke</li>
                </ul>

                <p><strong>Total:</strong> 34.97€</p>

                <!-- Start Preparation -->
                <form action="update_order_status.php" method="POST">
                    <input type="hidden" name="order_id" value="1024">
                    <input type="hidden" name="status" value="preparing">
                    <button type="submit">Start Preparation</button>
                </form>

                <!-- Send to Delivery -->
                <form action="update_order_status.php" method="POST">
                    <input type="hidden" name="order_id" value="1024">
                    <input type="hidden" name="status" value="delivery">
                    <button type="submit">Send to Delivery</button>
                </form>

                <!-- Bouton fermer -->
                <label for="order-toggle" class="closeBtn">
                    Close
                </label>

            </div>
        </div>

      </article>

    <article class="menu modernNeonBoxGlassAdmin orderCard">

        <h3>Order #1022</h3>

        <ul>
            <li><strong>Customer Email:</strong> pas.dinspi@email.com</li>
            <li><strong>Arrival Date:</strong> 2026-02-20 18:42</li>
        </ul>

        <!-- Checkbox cachée -->
        <input type="checkbox" id="order-toggle" class="modalToggle">

        <!-- Bouton ouvrir -->
        <label for="order-toggle" class="openModalBtn">
            Display Details
        </label>

        <!-- MODAL FULL SCREEN -->
        <div class="modal">

            <!-- Overlay fermeture -->
            <label for="order-toggle" class="overlay"></label>

            <div class="modalContent modernNeonBoxGlass">

                <h3>Order #1022 Details</h3>

                <ul>
                    <li>1x Git Merge Menu</li>
                    <li>2x Connect to Nature Menu</li>
                    <li>1x Coke</li>
                </ul>

                <p><strong>Total:</strong> 34.97€</p>

                <!-- Start Preparation -->
                <form action="update_order_status.php" method="POST">
                    <input type="hidden" name="order_id" value="1024">
                    <input type="hidden" name="status" value="preparing">
                    <button type="submit">Start Preparation</button>
                </form>

                <!-- Send to Delivery -->
                <form action="update_order_status.php" method="POST">
                    <input type="hidden" name="order_id" value="1024">
                    <input type="hidden" name="status" value="delivery">
                    <button type="submit">Send to Delivery</button>
                </form>

                <!-- Bouton fermer -->
                <label for="order-toggle" class="closeBtn">
                    Close
                </label>

            </div>
        </div>

      </article>

    <article class="menu modernNeonBoxGlassAdmin orderCard">

        <h3>Order #1021</h3>

        <ul>
            <li><strong>Customer Email:</strong> goat@email.com</li>
            <li><strong>Arrival Date:</strong> 2026-02-20 21:22</li>
        </ul>

        <!-- Checkbox cachée -->
        <input type="checkbox" id="order-toggle" class="modalToggle">

        <!-- Bouton ouvrir -->
        <label for="order-toggle" class="openModalBtn">
            Display Details
        </label>

        <!-- MODAL FULL SCREEN -->
        <div class="modal">

            <!-- Overlay fermeture -->
            <label for="order-toggle" class="overlay"></label>

            <div class="modalContent modernNeonBoxGlass">

                <h3>Order #1021 Details</h3>

                <ul>
                    <li>1x Git Merge Menu</li>
                    <li>2x Connect to Nature Menu</li>
                    <li>1x Water</li>
                </ul>

                <p><strong>Total:</strong> 34.97€</p>

                <!-- Start Preparation -->
                <form action="update_order_status.php" method="POST">
                    <input type="hidden" name="order_id" value="1024">
                    <input type="hidden" name="status" value="preparing">
                    <button type="submit">Start Preparation</button>
                </form>

                <!-- Send to Delivery -->
                <form action="update_order_status.php" method="POST">
                    <input type="hidden" name="order_id" value="1024">
                    <input type="hidden" name="status" value="delivery">
                    <button type="submit">Send to Delivery</button>
                </form>

                <!-- Bouton fermer -->
                <label for="order-toggle" class="closeBtn">
                    Close
                </label>

            </div>
        </div>

      </article>

    </section>

</body>
</html>
