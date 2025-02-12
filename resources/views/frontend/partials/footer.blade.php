@php
    $systemSetting = App\Models\SystemSetting::first();
    $SocialLink = App\Models\CMS::where('page', 'home_page')
        ->where('status', 'active')
        ->where('section', 'social_link_container')
        ->get();
@endphp
<!-- footer section start -->
<footer class="footer">
    <div class="container">
        <div class="footer-section">
            <div class="logo-section">
                <img class="footer-logo" src="{{ asset($systemSetting->logo ?? 'frontend/assets/images/dark-logo.png') }}"
                    alt="site logo" />
                <div class="footer-text">
                    {{ $systemSetting->description ??
                        'Effortlessly manage and organize chats, tasks, and files in one
                                                                                                    centeral location with Qoterra chat management solutions.' }}

                </div>
                <div class="social-section">
                    @if (isset($SocialLink) && count($SocialLink) > 0)
                        @foreach ($SocialLink as $key => $d)
                            <a href="{{ $d->description ?? ' ' }}" target="_blank" class="social-item">
                                @if (!empty($d->image))
                                    <img src="{{ asset($d->image) }}" width="31" height="26"
                                        alt="Service card image" />
                                @else
                                    <img src="{{ asset('frontend/assets/images/service.png') }}" width="31"
                                        height="26" alt="Service card image" />
                                @endif
                            </a>
                        @endforeach
                    @else
                        <a href="https://x.com/?lang=en" target="_blank" class="social-item">
                            <svg width="31" height="26" viewBox="0 0 31 26" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M27.1751 6.55552C27.1944 6.82457 27.1944 7.09367 27.1944 7.36272C27.1944 15.569 20.9483 25.0246 9.53244 25.0246C6.01542 25.0246 2.74827 24.006 0 22.238C0.499702 22.2956 0.980119 22.3148 1.49905 22.3148C4.40101 22.3148 7.07244 21.3347 9.20572 19.6627C6.47667 19.605 4.18964 17.8177 3.40167 15.3577C3.78607 15.4153 4.17042 15.4537 4.57405 15.4537C5.13137 15.4537 5.68875 15.3768 6.20762 15.2424C3.36327 14.6658 1.22994 12.1674 1.22994 9.15004V9.0732C2.05631 9.53445 3.01732 9.82272 4.03583 9.86112C2.36381 8.74641 1.26839 6.84379 1.26839 4.69129C1.26839 3.5382 1.57583 2.48117 2.11399 1.55867C5.16976 5.32552 9.76304 7.78546 14.9136 8.05457C14.8175 7.59332 14.7598 7.1129 14.7598 6.63243C14.7598 3.21147 17.5273 0.424805 20.9674 0.424805C22.7548 0.424805 24.3691 1.17433 25.503 2.3851C26.906 2.11606 28.2513 1.59713 29.4429 0.886055C28.9816 2.32748 28.0014 3.53826 26.7138 4.30695C27.963 4.17248 29.1738 3.82647 30.2885 3.34606C29.443 4.576 28.3859 5.67141 27.1751 6.55552V6.55552Z"
                                    fill="#919EAB" />
                            </svg>
                        </a>
                        <a href="https://www.facebook.com" target="_blank" class="social-item">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M29.7757 14.8146C29.7757 6.71002 23.2092 0.143555 15.1046 0.143555C7.00006 0.143555 0.433594 6.71002 0.433594 14.8146C0.433594 22.1371 5.79858 28.2066 12.8123 29.3081V19.0556H9.08536V14.8146H12.8123V11.5822C12.8123 7.90559 15.0011 5.87472 18.3535 5.87472C19.9591 5.87472 21.638 6.16104 21.638 6.16104V9.76964H19.7875C17.9655 9.76964 17.397 10.9007 17.397 12.0608V14.8146H21.4658L20.8151 19.0556H17.397V29.3081C24.4107 28.2066 29.7757 22.1371 29.7757 14.8146Z"
                                    fill="#919EAB" />
                            </svg>
                        </a>
                        <a href="https://www.linkedin.com" target="_blank" class="social-item">
                            <svg width="27" height="27" viewBox="0 0 27 27" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M25.0899 0.473633H2.36759C1.32642 0.473633 0.480469 1.33141 0.480469 2.38442V25.0654C0.480469 26.1184 1.32642 26.9761 2.36759 26.9761H25.0899C26.1311 26.9761 26.983 26.1184 26.983 25.0654V2.38442C26.983 1.33141 26.1311 0.473633 25.0899 0.473633ZM8.49038 23.1901H4.56233V10.5422H8.49629V23.1901H8.49038ZM6.52635 8.81482C5.2663 8.81482 4.24879 7.7914 4.24879 6.53726C4.24879 5.28313 5.2663 4.25971 6.52635 4.25971C7.78049 4.25971 8.80391 5.28313 8.80391 6.53726C8.80391 7.79732 7.78641 8.81482 6.52635 8.81482ZM23.2147 23.1901H19.2866V17.0377C19.2866 15.5706 19.257 13.6835 17.2457 13.6835C15.1988 13.6835 14.8853 15.2807 14.8853 16.9312V23.1901H10.9572V10.5422H14.7256V12.2696H14.7788C15.3053 11.2758 16.589 10.2287 18.4998 10.2287C22.4752 10.2287 23.2147 12.8494 23.2147 16.2568V23.1901Z"
                                    fill="#919EAB" />
                            </svg>
                        </a>
                        <a href="https://www.youtube.com" target="_blank" class="social-item">
                            <svg width="34" height="24" viewBox="0 0 34 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M32.539 3.92056C32.1674 2.52149 31.0727 1.41963 29.6826 1.04569C27.1631 0.366211 17.0602 0.366211 17.0602 0.366211C17.0602 0.366211 6.95728 0.366211 4.43771 1.04569C3.04769 1.41969 1.95292 2.52149 1.58135 3.92056C0.90625 6.45646 0.90625 11.7474 0.90625 11.7474C0.90625 11.7474 0.90625 17.0383 1.58135 19.5742C1.95292 20.9733 3.04769 22.0292 4.43771 22.4032C6.95728 23.0826 17.0602 23.0826 17.0602 23.0826C17.0602 23.0826 27.1631 23.0826 29.6826 22.4032C31.0727 22.0292 32.1674 20.9733 32.539 19.5742C33.2141 17.0383 33.2141 11.7474 33.2141 11.7474C33.2141 11.7474 33.2141 6.45646 32.539 3.92056V3.92056ZM13.7559 16.5511V6.94362L22.2 11.7475L13.7559 16.5511V16.5511Z"
                                    fill="#919EAB" />
                            </svg>
                        </a>
                    @endif

                </div>
            </div>
            <div class="footer-nav-section">
                <h6 class="footer-nav-section-title">Navigate</h6>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{route('service.emergency')}}">Services</a></li>
                </ul>
            </div>
            <div class="footer-nav-section">
                <h6 class="footer-nav-section-title">Support Us</h6>
                <ul>
                    <li><a href="#">FAQ`s</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Support Center</a></li>
                </ul>
            </div>
            <div class="footer-nav-section">
                <h6 class="footer-nav-section-title">Resources</h6>
                <ul>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Tems of service</a></li>
                </ul>
            </div>
            <div class="footer-nav-section">
                <h6 class="footer-nav-section-title">Contact US</h6>
                <a href="mailto:{{ $systemSetting->email ?? 'switch@business.com' }}"
                    class="mail-nav">{{ $systemSetting->email ?? 'switch@business.com' }} </a>
                <a href="tel:{{ $systemSetting->contact_number ?? '' }}"
                    class="phone-nav">{{ $systemSetting->contact_number ?? '+91-80-65652545' }} </a>
                <a class="mail-nav">{{ $systemSetting->address ?? 'Morocco' }} </a>
                {{-- <a class="button" href="#">Contact Us</a> --}}
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 copy-right-text">
                    {{ $systemSetting->copyright_text ?? '© 2023 Holzbau, All right reserved' }}
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-end">
                        <a class="meta-link" href="#">Terms & Conditions</a>
                        <span>,</span>
                        <a class="meta-link" href="#">Privacy Policy</a>
                        <span>,</span>
                        <a class="meta-link" href="#">Cookies Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer section end -->
