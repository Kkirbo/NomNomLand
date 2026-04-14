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
        echo '
          <li>
            <a href="logout.php">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
              Logout
            </a>
          </li>
        ';
        $user = get_user_by_session();
        if ($user && $user['role'] === 'admin')
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
    <label for="holo-toggle">
      <li id="toggleTheme">
        Theme
        <div class="toggle-container">
          <div class="toggle-wrap">
            <input class="toggle-input" id="holo-toggle" type="checkbox" checked />
            <label class="toggle-track" for="holo-toggle">
              <div class="track-lines">
                <div class="track-line"></div>
              </div>

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
  </ul>
</aside>

<style media="screen">
.toggle-container {
position: relative;
width: 150px;
display: flex;
flex-direction: column;
align-items: center;
perspective: 800px;
z-index: 5;
}

.toggle-wrap {
position: relative;
width: 100%;
height: 60px;
transform-style: preserve-3d;
}

.toggle-input {
position: absolute;
opacity: 0;
width: 0;
height: 0;
}

.toggle-track {
position: absolute;
width: 100%;
height: 100%;
background: rgba(0, 30, 60, 0.4);
border-radius: 30px;
cursor: pointer;
box-shadow:
  0 0 15px rgba(0, 80, 255, 0.2),
  inset 0 0 10px rgba(0, 0, 0, 0.8);
overflow: hidden;
backdrop-filter: blur(5px);
transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
border: 1px solid rgba(0, 150, 255, 0.3);
}

.toggle-track::before {
content: "";
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
background: radial-gradient(
    ellipse at center,
    rgba(0, 80, 255, 0.1) 0%,
    rgba(0, 0, 0, 0) 70%
  ),
  linear-gradient(90deg, rgba(0, 60, 120, 0.1) 0%, rgba(0, 30, 60, 0.2) 100%);
opacity: 0.6;
transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
}

.toggle-track::after {
content: "";
position: absolute;
top: 2px;
left: 2px;
right: 2px;
height: 10px;
background: linear-gradient(
  90deg,
  rgba(0, 170, 255, 0.3) 0%,
  rgba(0, 80, 255, 0.1) 100%
);
border-radius: 30px 30px 0 0;
opacity: 0.7;
filter: blur(1px);
}

.track-lines {
position: absolute;
top: 50%;
left: 0;
width: 100%;
height: 1px;
transform: translateY(-50%);
overflow: hidden;
}

.track-line {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
background: repeating-linear-gradient(
  90deg,
  rgba(0, 150, 255, 0.3) 0px,
  rgba(0, 150, 255, 0.3) 5px,
  transparent 5px,
  transparent 15px
);
animation: track-line-move 3s linear infinite;
}

@keyframes track-line-move {
0% {
  transform: translateX(0);
}
100% {
  transform: translateX(20px);
}
}

.toggle-thumb {
position: absolute;
width: 54px;
height: 54px;
left: 3px;
top: 3px;
background: radial-gradient(
  circle,
  rgba(10, 40, 90, 0.9) 0%,
  rgba(0, 20, 50, 0.8) 100%
);
border-radius: 50%;
box-shadow:
  0 2px 15px rgba(0, 0, 0, 0.5),
  inset 0 0 15px rgba(0, 150, 255, 0.5);
transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
z-index: 2;
border: 1px solid rgba(0, 170, 255, 0.6);
overflow: hidden;
transform-style: preserve-3d;
}

.thumb-core {
position: absolute;
width: 40px;
height: 40px;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
background: radial-gradient(
  circle,
  rgba(0, 180, 255, 0.6) 0%,
  rgba(0, 50, 120, 0.2) 100%
);
border-radius: 50%;
box-shadow: 0 0 20px rgba(0, 150, 255, 0.5);
opacity: 0.9;
transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
}

.thumb-inner {
position: absolute;
width: 25px;
height: 25px;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
background: radial-gradient(
  circle,
  rgba(255, 255, 255, 0.8) 0%,
  rgba(100, 200, 255, 0.5) 100%
);
border-radius: 50%;
box-shadow: 0 0 10px rgba(100, 200, 255, 0.7);
opacity: 0.7;
transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
animation: pulse 2s infinite alternate;
}

@keyframes pulse {
0% {
  opacity: 0.5;
  transform: translate(-50%, -50%) scale(0.9);
}
100% {
  opacity: 0.8;
  transform: translate(-50%, -50%) scale(1.1);
}
}

.thumb-scan {
position: absolute;
width: 100%;
height: 5px;
background: linear-gradient(
  90deg,
  rgba(0, 0, 0, 0) 0%,
  rgba(0, 150, 255, 0.5) 20%,
  rgba(255, 255, 255, 0.8) 50%,
  rgba(0, 150, 255, 0.5) 80%,
  rgba(0, 0, 0, 0) 100%
);
top: 0;
left: 0;
filter: blur(1px);
animation: thumb-scan 2s linear infinite;
opacity: 0.7;
}

@keyframes thumb-scan {
0% {
  top: -5px;
  opacity: 0;
}
20% {
  opacity: 0.7;
}
80% {
  opacity: 0.7;
}
100% {
  top: 54px;
  opacity: 0;
}
}

.thumb-particles {
position: absolute;
width: 100%;
height: 100%;
top: 0;
left: 0;
overflow: hidden;
}

.thumb-particle {
position: absolute;
width: 3px;
height: 3px;
background: rgba(100, 200, 255, 0.8);
border-radius: 50%;
box-shadow: 0 0 5px rgba(100, 200, 255, 0.8);
animation: thumb-particle-float 3s infinite ease-out;
opacity: 0;
}

.thumb-particle:nth-child(1) {
top: 70%;
left: 30%;
animation-delay: 0.2s;
}

.thumb-particle:nth-child(2) {
top: 60%;
left: 60%;
animation-delay: 0.6s;
}

.thumb-particle:nth-child(3) {
top: 50%;
left: 40%;
animation-delay: 1s;
}

.thumb-particle:nth-child(4) {
top: 40%;
left: 70%;
animation-delay: 1.4s;
}

.thumb-particle:nth-child(5) {
top: 80%;
left: 50%;
animation-delay: 1.8s;
}

@keyframes thumb-particle-float {
0% {
  transform: translateY(0) scale(1);
  opacity: 0;
}
20% {
  opacity: 0.8;
}
100% {
  transform: translateY(-30px) scale(0);
  opacity: 0;
}
}

.toggle-data {
position: absolute;
width: 100%;
height: 100%;
z-index: 1;
}

.data-text {
position: absolute;
font-size: 12px;
font-weight: 500;
letter-spacing: 1px;
text-transform: uppercase;
transition: all 0.5s ease;
}

.data-text.off {
right: 12px;
top: 50%;
transform: translateY(-50%);
opacity: 1;
color: rgba(0, 150, 255, 0.6);
text-shadow: 0 0 5px rgba(0, 100, 255, 0.4);
}

.data-text.on {
left: 15px;
top: 50%;
transform: translateY(-50%);
opacity: 0;
color: rgba(0, 255, 150, 0.6);
text-shadow: 0 0 5px rgba(0, 255, 100, 0.4);
}

.status-indicator {
position: absolute;
width: 10px;
height: 10px;
border-radius: 50%;
background: radial-gradient(
  circle,
  rgba(0, 180, 255, 0.8) 0%,
  rgba(0, 80, 200, 0.4) 100%
);
box-shadow: 0 0 10px rgba(0, 150, 255, 0.5);
animation: blink 2s infinite alternate;
transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
}

.status-indicator.off {
top: 25px;
right: 15px;
}

.status-indicator.on {
top: 25px;
left: 15px;
opacity: 0;
background: radial-gradient(
  circle,
  rgba(0, 255, 150, 0.8) 0%,
  rgba(0, 200, 80, 0.4) 100%
);
box-shadow: 0 0 10px rgba(0, 255, 150, 0.5);
}

@keyframes blink {
0%,
100% {
  opacity: 0.5;
  transform: scale(0.9);
}
50% {
  opacity: 1;
  transform: scale(1.1);
}
}

.energy-rings {
position: absolute;
width: 54px;
height: 54px;
left: 3px;
top: 3px;
pointer-events: none;
z-index: 1;
transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
}

.energy-ring {
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
border-radius: 50%;
border: 2px solid transparent;
opacity: 0;
}

.energy-ring:nth-child(1) {
width: 50px;
height: 50px;
border-top-color: rgba(0, 150, 255, 0.5);
border-right-color: rgba(0, 150, 255, 0.3);
animation: spin 3s linear infinite;
}

.energy-ring:nth-child(2) {
width: 40px;
height: 40px;
border-bottom-color: rgba(0, 150, 255, 0.5);
border-left-color: rgba(0, 150, 255, 0.3);
animation: spin 2s linear infinite reverse;
}

.energy-ring:nth-child(3) {
width: 30px;
height: 30px;
border-left-color: rgba(0, 150, 255, 0.5);
border-top-color: rgba(0, 150, 255, 0.3);
animation: spin 1.5s linear infinite;
}

@keyframes spin {
0% {
  transform: translate(-50%, -50%) rotate(0deg);
}
100% {
  transform: translate(-50%, -50%) rotate(360deg);
}
}

.interface-lines {
position: absolute;
width: 100%;
height: 100%;
pointer-events: none;
}

.interface-line {
position: absolute;
background: rgba(0, 150, 255, 0.3);
transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
}

.interface-line:nth-child(1) {
width: 15px;
height: 1px;
bottom: -5px;
left: 20px;
}

.interface-line:nth-child(2) {
width: 1px;
height: 8px;
bottom: -12px;
left: 35px;
}

.interface-line:nth-child(3) {
width: 25px;
height: 1px;
bottom: -12px;
left: 35px;
}

.interface-line:nth-child(4) {
width: 15px;
height: 1px;
bottom: -5px;
right: 20px;
}

.interface-line:nth-child(5) {
width: 1px;
height: 8px;
bottom: -12px;
right: 35px;
}

.interface-line:nth-child(6) {
width: 25px;
height: 1px;
bottom: -12px;
right: 10px;
}

.toggle-reflection {
position: absolute;
width: 100%;
height: 100%;
top: 0;
left: 0;
background: linear-gradient(
  135deg,
  rgba(255, 255, 255, 0.1) 0%,
  rgba(255, 255, 255, 0) 40%
);
border-radius: 30px;
pointer-events: none;
}

.toggle-label {
position: relative;
margin-top: 20px;
font-size: 14px;
text-transform: uppercase;
letter-spacing: 2px;
text-align: center;
color: rgba(0, 150, 255, 0.7);
text-shadow: 0 0 10px rgba(0, 100, 255, 0.5);
transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
}

.holo-glow {
position: absolute;
width: 100%;
height: 100%;
border-radius: 30px;
background: radial-gradient(
  ellipse at center,
  rgba(0, 150, 255, 0.2) 0%,
  rgba(0, 0, 0, 0) 70%
);
filter: blur(10px);
opacity: 0.5;
transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
z-index: 0;
}

.toggle-input:checked + .toggle-track {
background: rgba(0, 60, 30, 0.4);
border-color: rgba(0, 255, 150, 0.3);
box-shadow:
  0 0 15px rgba(0, 255, 150, 0.2),
  inset 0 0 10px rgba(0, 0, 0, 0.8);
}

.toggle-input:checked + .toggle-track::before {
background: radial-gradient(
    ellipse at center,
    rgba(0, 255, 150, 0.1) 0%,
    rgba(0, 0, 0, 0) 70%
  ),
  linear-gradient(90deg, rgba(0, 120, 60, 0.1) 0%, rgba(0, 60, 30, 0.2) 100%);
}

.toggle-input:checked + .toggle-track::after {
background: linear-gradient(
  90deg,
  rgba(0, 255, 150, 0.3) 0%,
  rgba(0, 160, 80, 0.1) 100%
);
}

.toggle-input:checked + .toggle-track .track-line {
background: repeating-linear-gradient(
  90deg,
  rgba(0, 255, 150, 0.3) 0px,
  rgba(0, 255, 150, 0.3) 5px,
  transparent 5px,
  transparent 15px
);
animation-direction: reverse;
}

.toggle-input:checked + .toggle-track .toggle-thumb {
left: calc(100% - 57px);
background: radial-gradient(
  circle,
  rgba(10, 90, 40, 0.9) 0%,
  rgba(0, 50, 20, 0.8) 100%
);
border-color: rgba(0, 255, 150, 0.6);
box-shadow:
  0 2px 15px rgba(0, 0, 0, 0.5),
  inset 0 0 15px rgba(0, 255, 150, 0.5);
}

.toggle-input:checked + .toggle-track .thumb-core {
background: radial-gradient(
  circle,
  rgba(0, 255, 150, 0.6) 0%,
  rgba(0, 120, 50, 0.2) 100%
);
box-shadow: 0 0 20px rgba(0, 255, 150, 0.5);
}

.toggle-input:checked + .toggle-track .thumb-inner {
background: radial-gradient(
  circle,
  rgba(255, 255, 255, 0.8) 0%,
  rgba(100, 255, 200, 0.5) 100%
);
box-shadow: 0 0 10px rgba(100, 255, 200, 0.7);
}

.toggle-input:checked + .toggle-track .thumb-scan {
background: linear-gradient(
  90deg,
  rgba(0, 0, 0, 0) 0%,
  rgba(0, 255, 150, 0.5) 20%,
  rgba(255, 255, 255, 0.8) 50%,
  rgba(0, 255, 150, 0.5) 80%,
  rgba(0, 0, 0, 0) 100%
);
}

.toggle-input:checked + .toggle-track .thumb-particle {
background: rgba(100, 255, 200, 0.8);
box-shadow: 0 0 5px rgba(100, 255, 200, 0.8);
}

.toggle-input:checked + .toggle-track .data-text.off {
opacity: 0;
}

.toggle-input:checked + .toggle-track .data-text.on {
opacity: 1;
}

.toggle-input:checked + .toggle-track .status-indicator.off {
opacity: 0;
}

.toggle-input:checked + .toggle-track .status-indicator.on {
opacity: 1;
}

.toggle-input:checked + .toggle-track .energy-rings {
left: calc(100% - 57px);
}

.toggle-input:checked + .toggle-track .energy-ring {
opacity: 1;
}

.toggle-input:checked + .toggle-track .energy-ring:nth-child(1) {
border-top-color: rgba(0, 255, 150, 0.5);
border-right-color: rgba(0, 255, 150, 0.3);
}

.toggle-input:checked + .toggle-track .energy-ring:nth-child(2) {
border-bottom-color: rgba(0, 255, 150, 0.5);
border-left-color: rgba(0, 255, 150, 0.3);
}

.toggle-input:checked + .toggle-track .energy-ring:nth-child(3) {
border-left-color: rgba(0, 255, 150, 0.5);
border-top-color: rgba(0, 255, 150, 0.3);
}

.toggle-input:checked + .toggle-track .interface-line {
background: rgba(0, 255, 150, 0.3);
}

.toggle-input:checked ~ .toggle-label {
color: rgba(0, 255, 150, 0.7);
text-shadow: 0 0 10px rgba(0, 255, 150, 0.5);
}

.toggle-input:checked + .toggle-track .holo-glow {
background: radial-gradient(
  ellipse at center,
  rgba(0, 255, 150, 0.2) 0%,
  rgba(0, 0, 0, 0) 70%
);
}

.toggle-input:hover + .toggle-track {
box-shadow:
  0 0 20px rgba(0, 150, 255, 0.3),
  inset 0 0 10px rgba(0, 0, 0, 0.8);
}

.toggle-input:checked:hover + .toggle-track {
box-shadow:
  0 0 20px rgba(0, 255, 150, 0.3),
  inset 0 0 10px rgba(0, 0, 0, 0.8);
}

</style>

<script defer type="module" src="../scripts/sidebar.js"></script>
