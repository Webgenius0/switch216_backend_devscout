  <!-- header section start -->
  <header>
      <!-- navbar section start -->
      <nav class="navbar banner-navbar">
          <div class="nav-container">
              <div class="logo">
                  <a href="{{ route('home') }}" class="site-logo">
                      <img src="{{ asset('frontend/assets/images/dark-logo.png') }}" alt="Site logo" />
                  </a>
              </div>
              <div class="nav-items">
                  <a class="nav-item active" href="{{ route('home') }}">Home</a>
                  <div class="nav-item dropdown-items">
                      <span class="dropdown-item-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          Category
                      </span>
                      <div class="dropdown-item-menu">
                          <a class="dropdown-item" href="{{ route('house.index') }}">Real Estate</a>
                          <a class="dropdown-item" href="{{ route('food.index') }}">Foods</a>
                          <a class="dropdown-item" href="{{ route('car.index') }}">Car Rent</a>
                      </div>
                  </div>
                  <a href="{{ route('house.index') }}" class="nav-item">Real Estate</a>
                  <a href="{{ route('food.index') }}" class="nav-item">Foods</a>
                  <a href="{{ route('car.index') }}" class="nav-item">Car Rent</a>
                  <a href="{{ route('service.emergency') }}" class="nav-item">Emergency</a>
              </div>
              <div class="nav-actions">
                  <select class="select">
                      <option value="connected">English</option>
                      <option value="connected">Spanish</option>
                      <option value="connected">Chinese</option>
                  </select>
                  <a href="{{ route('login') }}" class="auth-btn">Sign In</a>
                  <a href="{{ route('provider.register') }}" class="auth-btn auth-btn-sec">Join As service provider</a>
                  <button type="button" class="menu-open button">
                      <svg xmlns="http://www.w3.org/2000/svg" width="28" height="26" viewBox="0 0 28 26"
                          fill="none">
                          <path
                              d="M24.5 6.14999H3.5C3.3793 6.14999 3.125 5.98708 3.125 5.59999C3.125 5.2129 3.3793 5.04999 3.5 5.04999H24.5C24.6207 5.04999 24.875 5.2129 24.875 5.59999C24.875 5.98708 24.6207 6.14999 24.5 6.14999Z"
                              stroke="white" />
                          <path
                              d="M24.5 13.15H3.5C3.3793 13.15 3.125 12.9871 3.125 12.6C3.125 12.2129 3.3793 12.05 3.5 12.05H24.5C24.6207 12.05 24.875 12.2129 24.875 12.6C24.875 12.9871 24.6207 13.15 24.5 13.15Z"
                              stroke="white" />
                          <path
                              d="M24.5 20.15H3.5C3.3793 20.15 3.125 19.9871 3.125 19.6C3.125 19.2129 3.3793 19.05 3.5 19.05H24.5C24.6207 19.05 24.875 19.2129 24.875 19.6C24.875 19.9871 24.6207 20.15 24.5 20.15Z"
                              stroke="white" />
                      </svg>
                  </button>
              </div>
          </div>
      </nav>
      <!-- navbar section end -->

      <!-- mobile navbar section start -->
      <div class="mobile-navbar">
          <button type="button" class="menu-close">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path
                      d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 6.07 6.07 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75ZM12 2.75C6.9 2.75 2.75 6.9 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75Z"
                      fill="white" />
                  <path
                      d="M9.16937 15.58C8.97937 15.58 8.78938 15.51 8.63938 15.36C8.34938 15.07 8.34938 14.59 8.63938 14.3L14.2994 8.63999C14.5894 8.34999 15.0694 8.34999 15.3594 8.63999C15.6494 8.92999 15.6494 9.40998 15.3594 9.69998L9.69937 15.36C9.55937 15.51 9.35937 15.58 9.16937 15.58Z"
                      fill="white" />
                  <path
                      d="M14.8294 15.58C14.6394 15.58 14.4494 15.51 14.2994 15.36L8.63938 9.69998C8.34938 9.40998 8.34938 8.92999 8.63938 8.63999C8.92937 8.34999 9.40937 8.34999 9.69937 8.63999L15.3594 14.3C15.6494 14.59 15.6494 15.07 15.3594 15.36C15.2094 15.51 15.0194 15.58 14.8294 15.58Z"
                      fill="white" />
              </svg>
          </button>
          <div class="logo">
              <a href="{{ route('home') }}" class="site-logo">
                  <img src="{{ asset('frontend/assets/images/dark-logo.png') }}" alt="Site logo" />
              </a>
          </div>
          <div class="nav-items">
              <a class="nav-item active" href="{{ route('home') }}">Home</a>
              <a class="nav-item" href="./service.html">Service</a>
              <div class="nav-item dropdown-items">
                  <span class="dropdown-item-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Category
                  </span>
                  <div class="dropdown-item-menu">
                      <a class="dropdown-item" href="{{ route('house.index') }}">Real Estate</a>
                      <a class="dropdown-item" href="{{ route('food.index') }}">Foods</a>
                      <a class="dropdown-item" href="{{ route('car.index') }}">Car Rent</a>
                  </div>
              </div>
              <a class="nav-item" href="./emergency.html"> Emergency Service</a>
              <a href="{{ route('house.index') }}" class="nav-item">Real Estate</a>
              <a href="{{ route('food.index') }}" class="nav-item">Foods</a>
              <a href="{{ route('car.index') }}" class="nav-item">Car Rent</a>
              <a href="{{ route('service.emergency') }}" class="nav-item">Emergency</a>
          </div>
          <div class="nav-actions">
              <select class="select">
                  <option value="connected">English</option>
                  <option value="connected">Spanish</option>
                  <option value="connected">Chinese</option>
              </select>
              <a href="{{ route('login') }}" class="auth-btn">Sign In</a>
              <a href="{{ route('provider.register') }}" class="auth-btn auth-btn-sec">Join As service provider</a>
          </div>
      </div>
      <!-- mobile navbar section end -->
  </header>
  <!-- header section end -->
