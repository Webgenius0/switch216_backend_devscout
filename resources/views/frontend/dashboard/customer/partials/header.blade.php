 <!-- main container header start -->
 <div class="main-content-header">
     <svg class="menu-icon" width="24px" height="24px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
         <path
             d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
     </svg>
     <div class="section-title">Welcome {{ Auth::user()->name ?? 'Mr. John Doe' }} 👋</div>
     <div class="header-actions">
         <div >
            <a type="button" class="btn bg-warning" href="{{route('home')}}">Visit Site</a>
        </div>
         <div class="notification-container">
             <div class="notification-btn" onclick="markAllRead()">
                 <svg xmlns="http://www.w3.org/2000/svg" width="40" height="41" viewBox="0 0 40 41"
                     fill="none">
                     <rect x="0.5" y="1" width="39" height="39" rx="7.5" fill="white" stroke="#E8E8E8" />
                     <path
                         d="M20.0199 29.03C17.6899 29.03 15.3599 28.66 13.1499 27.92C12.3099 27.63 11.6699 27.04 11.3899 26.27C11.0999 25.5 11.1999 24.65 11.6599 23.89L12.8099 21.98C13.0499 21.58 13.2699 20.78 13.2699 20.31V17.42C13.2699 13.7 16.2999 10.67 20.0199 10.67C23.7399 10.67 26.7699 13.7 26.7699 17.42V20.31C26.7699 20.77 26.9899 21.58 27.2299 21.99L28.3699 23.89C28.7999 24.61 28.8799 25.48 28.5899 26.27C28.2999 27.06 27.6699 27.66 26.8799 27.92C24.6799 28.66 22.3499 29.03 20.0199 29.03ZM20.0199 12.17C17.1299 12.17 14.7699 14.52 14.7699 17.42V20.31C14.7699 21.04 14.4699 22.12 14.0999 22.75L12.9499 24.66C12.7299 25.03 12.6699 25.42 12.7999 25.75C12.9199 26.09 13.2199 26.35 13.6299 26.49C17.8099 27.89 22.2399 27.89 26.4199 26.49C26.7799 26.37 27.0599 26.1 27.1899 25.74C27.3199 25.38 27.2899 24.99 27.0899 24.66L25.9399 22.75C25.5599 22.1 25.2699 21.03 25.2699 20.3V17.42C25.2699 14.52 22.9199 12.17 20.0199 12.17Z"
                         fill="#A9A9A9" />
                     <path
                         d="M21.8796 12.4401C21.8096 12.4401 21.7396 12.4301 21.6696 12.4101C21.3796 12.3301 21.0996 12.2701 20.8296 12.2301C19.9796 12.1201 19.1596 12.1801 18.3896 12.4101C18.1096 12.5001 17.8096 12.4101 17.6196 12.2001C17.4296 11.9901 17.3696 11.6901 17.4796 11.4201C17.8896 10.3701 18.8896 9.68005 20.0296 9.68005C21.1696 9.68005 22.1696 10.3601 22.5796 11.4201C22.6796 11.6901 22.6296 11.9901 22.4396 12.2001C22.2896 12.3601 22.0796 12.4401 21.8796 12.4401Z"
                         fill="#A9A9A9" />
                     <path
                         d="M20.0195 31.3101C19.0295 31.3101 18.0695 30.9101 17.3695 30.2101C16.6695 29.5101 16.2695 28.5501 16.2695 27.5601H17.7695C17.7695 28.1501 18.0095 28.7301 18.4295 29.1501C18.8495 29.5701 19.4295 29.8101 20.0195 29.8101C21.2595 29.8101 22.2695 28.8001 22.2695 27.5601H23.7695C23.7695 29.6301 22.0895 31.3101 20.0195 31.3101Z"
                         fill="#A9A9A9" />
                 </svg>
                 <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notification-count">
                    {{ Auth::user()->notifications()->whereNull('read_at')->count() }}
                </span>
             </div>
             <div class="notification-dropdown">
                <div style="font-size: 20px;" class="mb-3 d-flex justify-content-between align-items-center title" >
                   <span id="notification-count"> Notifications ({{ Auth::user()->notifications()->whereNull('read_at')->count() }})</span>
                    
                    <button class="p-0 m-0  border-0 fs-08 btn btn-outline-danger btn-sm"  onclick="deleteAllNotification()">Clear All</button>
                </div>
                <div class="max-h-217" data-simplebar id="notification-list">
                @foreach (Auth::user()->notifications as $notification)
                <div class="notification-menu {{ $notification->read_at ? '' : 'unseen' }}"  id="notification_{{ $notification->id }}">
                   <a href="{{ $notification->data['url'] ?? '' }}" class="dropdown-item" >
                       <div class="d-flex align-items-center">
                           <div class="flex-shrink-0">
                               <div class="d-flex align-items-center">
                                   <div class="rounded bg-light" style="width: 40px; height: 40px; overflow: hidden;">
                                       <img src="{{ $notification->data['thumbnail'] ?? 'default-thumbnail.jpg' }}" 
                                            alt="Notification Thumbnail" 
                                            class="img-fluid rounded">
                                   </div>
                               </div>
                               {{-- <i
                                   class="material-symbols-outlined text-primary">sms</i> --}}
                           </div>
                           <div class="flex-grow-1 ms-3">
                               <p>{{ $notification->data['title'] ?? 'Untitled Notification' }}</p>
                               <span class="fs-13">{{ $notification->created_at->diffForHumans() }}</span>
                           </div>
                       </div>
                   </a>
               </div>
                @endforeach
            </div>
            </div>
         </div>

         <div class="profile-dropdown-container">
             <div style="width: 36px; cursor: pointer; height: 36px;" class="profile-dropdown-btn">
                     <img style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; "
                      src="{{auth()->user()->avatar ? asset(auth()->user()->avatar) : asset('backend/assets/images/user.png')}}"
                                            alt="{{auth()->user()->name}}" class="w-12 h-12 rounded-full">
             </div>
             <div class="profile-dropdown">
                 <a style="color: #F60;" class="mb-2">{{ Auth::user()->name ?? 'Mr. John Doe' }}</a>
                 <a href="">
                     <svg width="18" height="18" fill="#6B6B6B" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 448 512">
                         <path
                             d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z" />
                     </svg>
                     <span>My Profile</span>
                 </a>
                 <a href="">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25"
                         fill="none">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M20.8054 7.97835L20.183 6.89826C19.6564 5.98434 18.4895 5.66906 17.5743 6.19345V6.19345C17.1387 6.45008 16.6189 6.52289 16.1295 6.39582C15.6401 6.26876 15.2214 5.95225 14.9656 5.51611C14.8011 5.23889 14.7127 4.92313 14.7093 4.60078V4.60078C14.7242 4.08396 14.5292 3.58314 14.1688 3.21241C13.8084 2.84167 13.3133 2.6326 12.7963 2.63281H11.5423C11.0357 2.63281 10.5501 2.83465 10.1928 3.19368C9.83547 3.55271 9.63595 4.03933 9.63839 4.54586V4.54586C9.62338 5.59166 8.77126 6.43155 7.72535 6.43144C7.40299 6.42809 7.08724 6.33968 6.81001 6.17515V6.17515C5.89484 5.65075 4.72789 5.96603 4.20132 6.87995L3.53313 7.97835C3.00719 8.89113 3.31818 10.0573 4.22878 10.587V10.587C4.82068 10.9288 5.18531 11.5603 5.18531 12.2438C5.18531 12.9273 4.82068 13.5588 4.22878 13.9005V13.9005C3.31934 14.4267 3.00801 15.5901 3.53313 16.5001V16.5001L4.1647 17.5893C4.41143 18.0345 4.82538 18.363 5.31497 18.5022C5.80456 18.6413 6.32942 18.5796 6.7734 18.3308V18.3308C7.20986 18.0761 7.72997 18.0063 8.21812 18.1369C8.70627 18.2676 9.12201 18.5878 9.37294 19.0264C9.53748 19.3036 9.62589 19.6194 9.62924 19.9417V19.9417C9.62924 20.9983 10.4857 21.8548 11.5423 21.8548H12.7963C13.8493 21.8548 14.7043 21.0039 14.7093 19.9509V19.9509C14.7069 19.4428 14.9076 18.9548 15.2669 18.5955C15.6262 18.2362 16.1143 18.0354 16.6224 18.0378C16.944 18.0465 17.2584 18.1345 17.5377 18.2941V18.2941C18.4505 18.8201 19.6167 18.5091 20.1464 17.5985V17.5985L20.8054 16.5001C21.0605 16.0622 21.1305 15.5407 21 15.0511C20.8694 14.5615 20.549 14.1441 20.1098 13.8914V13.8914C19.6705 13.6387 19.3502 13.2213 19.2196 12.7317C19.089 12.242 19.159 11.7206 19.4141 11.2827C19.58 10.9931 19.8202 10.7529 20.1098 10.587V10.587C21.0149 10.0576 21.3252 8.89823 20.8054 7.9875V7.9875V7.97835Z"
                             stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                         <circle opacity="0.4" cx="12.1752" cy="12.2436" r="2.63616" stroke="#6B6B6B"
                             stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                     </svg>
                     <span>Setting</span>
                 </a>
                 <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                     <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21"
                         fill="none">
                         <path
                             d="M13.0174 5.74495V4.81195C13.0174 2.77695 11.3674 1.12695 9.33244 1.12695H4.45744C2.42344 1.12695 0.773438 2.77695 0.773438 4.81195V15.942C0.773438 17.977 2.42344 19.627 4.45744 19.627H9.34244C11.3714 19.627 13.0174 17.982 13.0174 15.953V15.01"
                             stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                         <path d="M19.8105 10.377H7.76953" stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round"
                             stroke-linejoin="round" />
                         <path d="M16.8828 7.46094L19.8108 10.3759L16.8828 13.2919" stroke="#6B6B6B"
                             stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                     </svg>
                     <span>Logout</span>
                 </a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- main container header end -->
