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
                  @if (Auth::check())
                      <div class="profile-dropdown-container1">
                          <div class="profile-dropdown-btn">
                              <img src="{{ asset('frontend/assets/images/profile.jpg') }}" alt="Profile" />
                          </div>
                          <div class="profile-dropdown1">
                              <a class="dropdown-item1 mb-2">{{ Auth::user()->name ?? 'Mr. John Doe'}}</a>
                              <a href="#">
                                  <svg width="18" height="18" fill="#6B6B6B" xmlns="http://www.w3.org/2000/svg"
                                      viewBox="0 0 448 512">
                                      <path
                                          d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z" />
                                  </svg>

                                  <span>My Profile</span>
                              </a>
                              <a href="#">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25"
                                      viewBox="0 0 24 25" fill="none">
                                      <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M20.8054 7.97835L20.183 6.89826C19.6564 5.98434 18.4895 5.66906 17.5743 6.19345V6.19345C17.1387 6.45008 16.6189 6.52289 16.1295 6.39582C15.6401 6.26876 15.2214 5.95225 14.9656 5.51611C14.8011 5.23889 14.7127 4.92313 14.7093 4.60078V4.60078C14.7242 4.08396 14.5292 3.58314 14.1688 3.21241C13.8084 2.84167 13.3133 2.6326 12.7963 2.63281H11.5423C11.0357 2.63281 10.5501 2.83465 10.1928 3.19368C9.83547 3.55271 9.63595 4.03933 9.63839 4.54586V4.54586C9.62338 5.59166 8.77126 6.43155 7.72535 6.43144C7.40299 6.42809 7.08724 6.33968 6.81001 6.17515V6.17515C5.89484 5.65075 4.72789 5.96603 4.20132 6.87995L3.53313 7.97835C3.00719 8.89113 3.31818 10.0573 4.22878 10.587V10.587C4.82068 10.9288 5.18531 11.5603 5.18531 12.2438C5.18531 12.9273 4.82068 13.5588 4.22878 13.9005V13.9005C3.31934 14.4267 3.00801 15.5901 3.53313 16.5001V16.5001L4.1647 17.5893C4.41143 18.0345 4.82538 18.363 5.31497 18.5022C5.80456 18.6413 6.32942 18.5796 6.7734 18.3308V18.3308C7.20986 18.0761 7.72997 18.0063 8.21812 18.1369C8.70627 18.2676 9.12201 18.5878 9.37294 19.0264C9.53748 19.3036 9.62589 19.6194 9.62924 19.9417V19.9417C9.62924 20.9983 10.4857 21.8548 11.5423 21.8548H12.7963C13.8493 21.8548 14.7043 21.0039 14.7093 19.9509V19.9509C14.7069 19.4428 14.9076 18.9548 15.2669 18.5955C15.6262 18.2362 16.1143 18.0354 16.6224 18.0378C16.944 18.0465 17.2584 18.1345 17.5377 18.2941V18.2941C18.4505 18.8201 19.6167 18.5091 20.1464 17.5985V17.5985L20.8054 16.5001C21.0605 16.0622 21.1305 15.5407 21 15.0511C20.8694 14.5615 20.549 14.1441 20.1098 13.8914V13.8914C19.6705 13.6387 19.3502 13.2213 19.2196 12.7317C19.089 12.242 19.159 11.7206 19.4141 11.2827C19.58 10.9931 19.8202 10.7529 20.1098 10.587V10.587C21.0149 10.0576 21.3252 8.89823 20.8054 7.9875V7.9875V7.97835Z"
                                          stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round" />
                                      <circle opacity="0.4" cx="12.1752" cy="12.2436" r="2.63616" stroke="#6B6B6B"
                                          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                  </svg>

                                  <span>Settings</span>
                              </a>
                              <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21"
                                      viewBox="0 0 21 21" fill="none">
                                      <path
                                          d="M13.0174 5.74495V4.81195C13.0174 2.77695 11.3674 1.12695 9.33244 1.12695H4.45744C2.42344 1.12695 0.773438 2.77695 0.773438 4.81195V15.942C0.773438 17.977 2.42344 19.627 4.45744 19.627H9.34244C11.3714 19.627 13.0174 17.982 13.0174 15.953V15.01"
                                          stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round" />
                                      <path d="M19.8105 10.377H7.76953" stroke="#6B6B6B" stroke-width="1.5"
                                          stroke-linecap="round" stroke-linejoin="round" />
                                      <path d="M16.8828 7.46094L19.8108 10.3759L16.8828 13.2919" stroke="#6B6B6B"
                                          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                  </svg>

                                  <span>Logout</span>
                              </a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                  @csrf
                              </form>
                          </div>
                      </div>
                  @else
                      @if (request()->routeIs('login') !== true)
                          <a href="{{ route('login') }}" class="auth-btn">Sign In</a>
                      @endif
                      <a href="{{ route('provider.index') }}" class="auth-btn auth-btn-sec">Join As service
                          provider</a>

                  @endif


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
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  fill="none">
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
              @if (Auth::check())
              @else
                  <a href="{{ route('login') }}" class="auth-btn">Sign In</a>
                  <a href="{{ route('provider.index') }}" class="auth-btn auth-btn-sec">Join As service
                      provider</a>
              @endif
          </div>
      </div>
      <!-- mobile navbar section end -->
  </header>
  <!-- header section end -->
