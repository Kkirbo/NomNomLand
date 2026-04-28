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
    <li>
      <a href="menu.php">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="m175-120-56-56 410-410q-18-42-5-95t57-95q53-53 118-62t106 32q41 41 32 106t-62 118q-42 44-95 57t-95-5l-50 50 304 304-56 56-304-302-304 302Zm118-342L173-582q-54-54-54-129t54-129l248 250-128 128Z"/></svg>
        Menu
      </a>
    </li>
    <li>
      <a href="index.php#contact">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="m480-80-10-120h-10q-142 0-241-99t-99-241q0-142 99-241t241-99q71 0 132.5 26.5t108 73q46.5 46.5 73 108T800-540q0 75-24.5 144t-67 128q-42.5 59-101 107T480-80Zm80-146q71-60 115.5-140.5T720-540q0-109-75.5-184.5T460-800q-109 0-184.5 75.5T200-540q0 109 75.5 184.5T460-280h100v54Zm-101-95q17 0 29-12t12-29q0-17-12-29t-29-12q-17 0-29 12t-12 29q0 17 12 29t29 12Zm-29-127h60q0-30 6-42t38-44q18-18 30-39t12-45q0-51-34.5-76.5T460-720q-44 0-74 24.5T344-636l56 22q5-17 19-33.5t41-16.5q27 0 40.5 15t13.5 33q0 17-10 30.5T480-558q-35 30-42.5 47.5T430-448Zm30-65Z"/></svg>
        Contact
      </a>
    </li>
    <li>
      <a href="index.php#about">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M440-280h80v-240h-80v240Zm40-320q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
        About
      </a>
    </li>
    <?php
      $logged_in = is_logged_in();
      if ($logged_in) {
        $user = get_user_by_session();
        if ($user && ($user['role'] === 'admin' || $user['role'] === 'cook' || $user['role'] === 'delivery'))
        echo '
          <li>
            <a href="orders.php">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M160-160v-516L82-846l72-34 94 202h464l94-202 72 34-78 170v516H160Zm240-280h160q17 0 28.5-11.5T600-480q0-17-11.5-28.5T560-520H400q-17 0-28.5 11.5T360-480q0 17 11.5 28.5T400-440ZM240-240h480v-358H240v358Zm0 0v-358 358Z"/></svg>
              Orders
            </a>
          </li>
        ';
        if ($user && $user['role'] === 'admin')
        echo '
          <li>
            <a href="admin.php">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M380.5-480.5Q340-521 340-580t40.5-99.5Q421-720 480-720t99.5 40.5Q620-639 620-580t-40.5 99.5Q539-440 480-440t-99.5-40.5ZM523-537q17-17 17-43t-17-43q-17-17-43-17t-43 17q-17 17-17 43t17 43q17 17 43 17t43-17ZM480-80q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 152-90.5 276.5T480-80Zm0-400Zm0-315-240 90v189q0 54 15 105t41 96q42-21 88-33t96-12q50 0 96 12t88 33q26-45 41-96t15-105v-189l-240-90Zm-70 523q-34 8-65 22 29 30 63 52t72 34q38-12 72-34t63-52q-31-14-65-22t-70-8q-36 0-70 8Z"/></svg>
              Admin
            </a>
          </li>
        ';
        echo '
          <li>
            <a href="logout.php">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
              Logout
            </a>
          </li>
        ';
      }
    ?>
  </ul>
</aside>
<link rel="stylesheet" href="../styles/holo-button.css">
<script defer type="module" src="../scripts/sidebar.js"></script>
