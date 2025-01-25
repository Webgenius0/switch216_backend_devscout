<!-- All javascript files -->
<script type="text/javascript" src="{{ asset('frontend/assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/assets/js/plugins/jquery-3.7.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/assets/js/plugins/aos-2.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/assets/js/plugins/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/assets/js/plugins/easepick-1.2.1.umd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/assets/js/plugins/nice-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/assets/js/main.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const dropdownContainer = document.querySelector(".profile-dropdown-container1");
        const dropdown = document.querySelector(".profile-dropdown1");
        if (dropdownContainer) {
            dropdownContainer.addEventListener("click", (event) => {
                event.stopPropagation(); // Prevent click event from propagating to the document
                dropdown.classList.toggle("active");
            });
        }
        if (dropdown) {
            // Close dropdown when clicking outside
            document.addEventListener("click", () => {
                dropdown.classList.remove("active");
            });
        }

    });
</script>

@stack('scripts')
