<?php require_once '../../private/php/session.php';?>
<input type="checkbox" id="togglesidebar" class="togglesidebar">
<label for="togglesidebar" class="togglesidebar">
  <span class="top_line"></span>
  <span class="mid_line"></span>
  <span class="bot_line"></span>
</label>
<aside class="sidebar">
  <ul>
    <li>
      <label for="togglesidebar"><span>Close</span></label>
    </li>
    <label for="holo-toggle">
      <li id="toggleTheme">
        Theme
        <div class="toggle-container">
          <div class="toggle-wrap">
            <input class="toggle-input" id="holo-toggle" type="checkbox" checked />
            <label class="toggle-track" for="holo-toggle">

              <div class="toggle-thumb">
                <div class="thumb-core"></div>
                <div class="thumb-inner"></div>
                <div class="thumb-scan"></div>
                <div class="thumb-particles">
                  <div class="thumb-particle"></div>
                  <div class="thumb-particle"></div>
                  <div class="thumb-particle"></div>
                  <div class="thumb-particle"></div>
                  <div class="thumb-particle"></div>
                </div>
              </div>

              <div class="toggle-data">
                <div class="data-text off">RICH</div>
                <div class="data-text on">DATA</div>
                <div class="status-indicator off"></div>
                <div class="status-indicator on"></div>
              </div>

              <div class="energy-rings">
                <div class="energy-ring"></div>
                <div class="energy-ring"></div>
                <div class="energy-ring"></div>
              </div>

              <div class="interface-lines">
                <div class="interface-line"></div>
                <div class="interface-line"></div>
                <div class="interface-line"></div>
                <div class="interface-line"></div>
                <div class="interface-line"></div>
                <div class="interface-line"></div>
              </div>

              <div class="toggle-reflection"></div>
              <div class="holo-glow"></div>
            </label>
          </div>
        </div>
      </li>
    </label>
    <li>
      <a class="active" href="index.php">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/></svg>
        Home
      </a>
    </li>
    <?php
      if (is_logged_in()) {
        echo '
          <li>
            <a href="cart.php">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M223.5-103.5Q200-127 200-160t23.5-56.5Q247-240 280-240t56.5 23.5Q360-193 360-160t-23.5 56.5Q313-80 280-80t-56.5-23.5Zm400 0Q600-127 600-160t23.5-56.5Q647-240 680-240t56.5 23.5Q760-193 760-160t-23.5 56.5Q713-80 680-80t-56.5-23.5ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg>
              Cart
            </a>
          </li>
        ';
      }
    ?>
    <li>
      <a href="menu.php">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="m175-120-56-56 410-410q-18-42-5-95t57-95q53-53 118-62t106 32q41 41 32 106t-62 118q-42 44-95 57t-95-5l-50 50 304 304-56 56-304-302-304 302Zm118-342L173-582q-54-54-54-129t54-129l248 250-128 128Z"/></svg>
        Menu
      </a>
    </li>
    <li>
      <?php
        if (is_logged_in()) {
          echo '
            <a href="../views/profile.php">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
              Profile
            </a>
          ';
        } else {
          echo '
            <a href="../views/login.php">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
              Login
            </a>
          ';
        }
      ?>
    </li>
    <?php
      $logged_in = is_logged_in();
      if ($logged_in) {
        if (!isset($user) || !$user) $user = get_user_by_session();
        echo '
          <li>
            <a href="orders.php">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M160-160v-516L82-846l72-34 94 202h464l94-202 72 34-78 170v516H160Zm240-280h160q17 0 28.5-11.5T600-480q0-17-11.5-28.5T560-520H400q-17 0-28.5 11.5T360-480q0 17 11.5 28.5T400-440ZM240-240h480v-358H240v358Zm0 0v-358 358Z"/></svg>
              ' . (!is_any_role($user, ["admin", "cook", "delivery"]) ? "My " : "") . 'Orders
            </a>
          </li>
        ';
        if (is_role($user, "admin"))
        echo '
          <li>
            <a href="admin.php">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M380.5-480.5Q340-521 340-580t40.5-99.5Q421-720 480-720t99.5 40.5Q620-639 620-580t-40.5 99.5Q539-440 480-440t-99.5-40.5ZM523-537q17-17 17-43t-17-43q-17-17-43-17t-43 17q-17 17-17 43t17 43q17 17 43 17t43-17ZM480-80q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 152-90.5 276.5T480-80Zm0-400Zm0-315-240 90v189q0 54 15 105t41 96q42-21 88-33t96-12q50 0 96 12t88 33q26-45 41-96t15-105v-189l-240-90Zm-70 523q-34 8-65 22 29 30 63 52t72 34q38-12 72-34t63-52q-31-14-65-22t-70-8q-36 0-70 8Z"/></svg>
              Admin
            </a>
          </li>
        ';
      }
    ?>
    <li>
      <a href="chess.php">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 0C12.5523 0 13 0.447715 13 1V2H14C14.5523 2 15 2.44772 15 3C15 3.55228 14.5523 4 14 4H13L13 6.13426C14.1873 6.46304 15.1164 7.36761 15.6095 8.53557C16.7887 7.70672 18.0146 7.33092 19.1893 7.38765C20.8173 7.46629 22.1801 8.37142 22.9824 9.70379C24.5267 12.2682 23.9536 16.1461 20.2565 19.277L21.1708 21.1056C21.8357 22.4354 20.8688 24 19.382 24H4.61805C3.13129 24 2.1643 22.4354 2.82919 21.1056L3.74347 19.277C0.0464058 16.1461 -0.526611 12.2682 1.01767 9.70378C1.82002 8.37141 3.18278 7.46628 4.8108 7.38766C5.9855 7.33093 7.21132 7.70675 8.3906 8.5356C8.88363 7.36763 9.81271 6.46305 11 6.13427L11 4H10C9.44771 4 9 3.55228 9 3C9 2.44772 9.44771 2 10 2H11V1C11 0.447715 11.4477 0 12 0ZM8.01285 10.8098C6.84088 9.69153 5.74956 9.34466 4.90727 9.38533C4.0034 9.42898 3.2202 9.92317 2.73099 10.7355C1.80208 12.2781 1.87787 15.2648 5.34014 18H10.4437C10.1872 17.422 9.88055 16.7115 9.57338 15.9543C9.19326 15.0173 8.80704 13.9956 8.51427 13.0583C8.27053 12.2779 8.06505 11.476 8.01285 10.8098ZM13.5564 18H18.6599C22.1222 15.2648 22.198 12.2781 21.2691 10.7355C20.7799 9.92318 19.9967 9.42898 19.0928 9.38533C18.2505 9.34464 17.1592 9.6915 15.9872 10.8097C15.935 11.4759 15.7296 12.2779 15.4858 13.0583C15.193 13.9956 14.8068 15.0173 14.4267 15.9543C14.1195 16.7115 13.8129 17.422 13.5564 18ZM18.382 20H12H5.61804L4.61805 22H19.382L18.382 20ZM12 16.5687C12.1822 16.1478 12.3779 15.6844 12.5734 15.2025C12.9433 14.2907 13.307 13.3255 13.5768 12.462C13.8564 11.5668 14 10.8867 14 10.5C14 10.4699 13.9996 10.4401 13.9989 10.4105C13.959 8.87922 12.9603 8 12 8C11.0398 8 10.0411 8.87924 10.0012 10.4105C10.0004 10.4401 10 10.47 10 10.5C10 10.8867 10.1437 11.5668 10.4233 12.462C10.693 13.3255 11.0568 14.2907 11.4267 15.2025C11.6222 15.6844 11.8179 16.1478 12 16.5687Z"></path> </g></svg>
        Chess
      </a>
    </li>
    <li>
      <a href="index.php#about">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M440-280h80v-240h-80v240Zm40-320q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
        About
      </a>
    </li>
    <li>
      <a href="#contact">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="m480-80-10-120h-10q-142 0-241-99t-99-241q0-142 99-241t241-99q71 0 132.5 26.5t108 73q46.5 46.5 73 108T800-540q0 75-24.5 144t-67 128q-42.5 59-101 107T480-80Zm80-146q71-60 115.5-140.5T720-540q0-109-75.5-184.5T460-800q-109 0-184.5 75.5T200-540q0 109 75.5 184.5T460-280h100v54Zm-101-95q17 0 29-12t12-29q0-17-12-29t-29-12q-17 0-29 12t-12 29q0 17 12 29t29 12Zm-29-127h60q0-30 6-42t38-44q18-18 30-39t12-45q0-51-34.5-76.5T460-720q-44 0-74 24.5T344-636l56 22q5-17 19-33.5t41-16.5q27 0 40.5 15t13.5 33q0 17-10 30.5T480-558q-35 30-42.5 47.5T430-448Zm30-65Z"/></svg>
        Contact
      </a>
    </li>
    <?php
      if ($logged_in) echo '
        <li>
          <a href="logout.php">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
            Logout
          </a>
        </li>
      ';
    ?>
  </ul>
</aside>
<link rel="stylesheet" href="../styles/holo-button.css">
<script defer type="module" src="../scripts/sidebar.js"></script>
