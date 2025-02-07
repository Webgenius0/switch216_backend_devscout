<!-- All CSS files -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/plugins/bootstrap.min.css') }}" />
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/plugins/aos-2.3.1.min.css') }}" /> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/plugins/owl.carousel.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/plugins/owl.theme.default.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/plugins/nice-select.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/home.css') }}" />
<style>
    /* General styles */
    .profile-dropdown-container1 {
        position: relative;
        display: inline-block;

    }

    .profile-dropdown-btn img {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
        cursor: pointer;
        z-index: 1000;
    }

    /* Dropdown styles */
    .profile-dropdown1 {
        display: none;
        position: absolute;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        padding: 10px;
        z-index: 1000;
        top: 50px;
        /* Adjust based on your container's position */
        right: 0;
        width: 200px;
        /* Adjust as needed */
    }

    .profile-dropdown1.active {
        display: block;
    }

    .profile-dropdown1 a {
        display: flex;

        padding: 5px;
        color: #6b6b6b;
        text-decoration: none;
        font-size: 14px;
        transition: background-color 0.3s;
        display: block !important;
    }

    .profile-dropdown1 a:hover {
        background-color: #f8f8f8;

    }

    .profile-dropdown1 .dropdown-item1 {
        font-weight: bold;
        color: #f60;
        margin-bottom: 10px;
        text-decoration: none;
    }

    .profile-dropdown1 a svg {
        margin-right: 10px;
    }
</style>
@stack('styles')
