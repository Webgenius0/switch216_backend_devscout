function authStepForm() {
  const authStepForm = document.querySelector(".auth-step-form");

  if (authStepForm) {
    const steps = authStepForm.querySelectorAll(".step-content");
    const nextButtons = authStepForm.querySelectorAll(".button-next");
    const prevButtons = authStepForm.querySelectorAll(".button-prev");

    let currentStep = 0;

    const updateStep = (stepIndex) => {
      steps.forEach((step, index) => {
        step.classList.toggle("active", index === stepIndex);
      });
    };

    // Add event listeners to Next buttons
    nextButtons.forEach((btn) => {
      btn.addEventListener("click", () => {
        if (currentStep < steps.length - 1) {
          currentStep++;
          updateStep(currentStep);
        }
      });
    });

    // Add event listeners to Previous buttons
    prevButtons.forEach((btn) => {
      btn.addEventListener("click", () => {
        if (currentStep > 0) {
          currentStep--;
          updateStep(currentStep);
        }
      });
    });

    // Initialize the first step
    updateStep(currentStep);
  }
}

function profileUpload(profileUploadBox) {
  const fileInput = profileUploadBox.querySelector("input[type='file']");
  const content = profileUploadBox.querySelector("div.content");

  profileUploadBox.addEventListener("click", function (e) {
    e.stopPropagation();
    fileInput.click();
  });

  fileInput.addEventListener("change", function (e) {
    const file = e.target.files[0];
    if (file) {
      const img = document.createElement("img");

      const reader = new FileReader();

      reader.onload = function (e) {
        img.setAttribute("src", e.target.result);
      };

      reader.readAsDataURL(file);
      content.innerHTML = "";
      content.appendChild(img);
    }
  });
}

function fileUpload(fileUploadContainer) {
  const fileInput = fileUploadContainer.querySelector("input[type='file']");
  const imagePreviewContainer = document.getElementById("imagePreviewContainer");

  const galleryInput = document.createElement("input");
  galleryInput.setAttribute("type", "hidden");
  galleryInput.setAttribute("name", "gallery_images[]");
  galleryInput.setAttribute("multiple", true);
  fileUploadContainer.appendChild(galleryInput);

  fileUploadContainer.addEventListener("click", function (e) {
    e.stopPropagation();
    fileInput.click();
  });

  fileInput.addEventListener("change", function (e) {
    const files = e.target.files;
    handleFiles(files);

    // Reset the file input after handling files to allow the same files to be selected again
    fileInput.value = '';
  });

  fileUploadContainer.addEventListener("dragover", function (e) {
    e.preventDefault();
    if (!fileUploadContainer.classList.contains("dragover")) {
      fileUploadContainer.classList.add("dragover");
    }
  });

  fileUploadContainer.addEventListener("dragleave", function (e) {
    e.preventDefault();
    fileUploadContainer.classList.remove("dragover");
  });

  fileUploadContainer.addEventListener("drop", function (e) {
    e.preventDefault();
    fileUploadContainer.classList.remove("dragover");
    const files = e.dataTransfer.files;
    handleFiles(files);
  });

  function handleFiles(files) {
    // Clear the image preview container before adding new previews
    // imagePreviewContainer.innerHTML = ''; // Remove all previous previews

    // Prepare the `galleryInput` to hold the new list of files
    // galleryInput.value = '';

    // Loop through all the files and create an image preview for each
    Array.from(files).forEach((file) => {
      const imgContainer = document.createElement("div");
      imgContainer.setAttribute("class", "image-container");

      const img = document.createElement("img");
      const reader = new FileReader();

      reader.onload = function (e) {
        img.setAttribute("src", e.target.result);
        img.setAttribute("class", "preview-img");

        // Apply CSS directly in JavaScript to control width, height, and aspect ratio
        img.style.width = "300px";
        img.style.height = "200px";
        img.style.objectFit = "cover";
        img.style.margin = "5px";

        // Create the close button
        const closeButton = document.createElement("button");
        closeButton.textContent = "×";
        closeButton.setAttribute("class", "close-btn");
        closeButton.setAttribute("type", "button");

        // Add close button functionality
        closeButton.addEventListener("click", function () {
          imgContainer.remove();
          // Update the `galleryInput` value after removing a file
          const updatedFiles = Array.from(files).filter((f) => f !== file);
          updateGalleryInput(updatedFiles);
        });

        // Append the image and the close button to the container
        imgContainer.appendChild(img);
        imgContainer.appendChild(closeButton);

        // Append the container to the image preview container
        imagePreviewContainer.appendChild(imgContainer);
      };

      reader.readAsDataURL(file);
      console.log(file);
      // Add the file to the `galleryInput` value
      galleryInput.value += `${file},`; 
    });
  }

  function updateGalleryInput(files) {
    galleryInput.value = files.map((f) => f).join(',');
  }
}




document.addEventListener("DOMContentLoaded", function () {
  // initial aos animation start
  AOS.init({
    disable: () => window.innerWidth < 768,
    duration: 1000,
    once: true,
  });
  // initial aos animation end

  authStepForm();

  const profileUploadBox = document.querySelector(".profile-upload-box");
  if (profileUploadBox) profileUpload(profileUploadBox);

  const fileUploadContainer = document.querySelector(".file-upload-container");
  if (fileUploadContainer) fileUpload(fileUploadContainer);

  // nice select start
  $(".select").niceSelect();
  // nice select end

  // navbar start
  const navbar = document.querySelector("nav.navbar");
  if (navbar) {
    window.addEventListener("scroll", function () {
      if (window.scrollY >= 100) {
        navbar.classList.add("sticky");
      } else {
        navbar.classList.remove("sticky");
      }
    });
  }
  // navbar end

  // mobile menu start
  const menuOpen = document.querySelector(".menu-open");
  const menuClose = document.querySelector(".menu-close");
  const mobileMenu = document.querySelector(".mobile-navbar");

  if (mobileMenu && menuOpen && menuClose) {
    menuOpen.addEventListener("click", function (e) {
      e.stopPropagation();
      mobileMenu.classList.add("show");
      document.body.classList.add("no-scroll");
    });
    menuClose.addEventListener("click", function (e) {
      e.stopPropagation();
      mobileMenu.classList.remove("show");
      document.body.classList.remove("no-scroll");
    });
    document.addEventListener("click", function (e) {
      // Check if the click target is outside the mobile menu
      if (!mobileMenu.contains(e.target) && !menuOpen.contains(e.target)) {
        mobileMenu.classList.remove("show");
        document.body.classList.remove("no-scroll");
      }
    });
  }
  // mobile menu end

  // all pasword field show and hide password
  const passwordWrappers = $(".password-wrapper");

  if (Object.keys(passwordWrappers).length > 0) {
    for (let wrapper of passwordWrappers) {
      const passwordWrapper = $(wrapper);

      const passField = $("input[type='password']", passwordWrapper);
      const passBtn = $("button.pass-show-btn", passwordWrapper);
      const passShowBtnIcon = $("span.show-eye", passBtn);
      const passHideBtnIcon = $("span.hide-eye", passBtn);

      passBtn.on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        if (passwordWrapper.hasClass("show-pass")) {
          passField.attr("type", "password");
          passwordWrapper.removeClass("show-pass");

          passShowBtnIcon.addClass("hide-icon");
          passHideBtnIcon.removeClass("hide-icon");
        } else {
          passField.attr("type", "text");
          passwordWrapper.addClass("show-pass");

          passHideBtnIcon.addClass("hide-icon");
          passShowBtnIcon.removeClass("hide-icon");
        }
      });
    }
  }

  // banner slide start
  const banner = document.querySelector(".banner");
  if (banner) {
    const slides = banner.querySelectorAll(".slide-item");
    const trackerItems = banner.querySelectorAll(".tracker-item");
    const thumbnailItems = banner.querySelectorAll(".thumbnail-item");
    const nextBtn = banner.querySelector("#slide-next-btn");
    const prevBtn = banner.querySelector("#slide-prev-btn");

    let currentIndex = 0;
    let intervalId;

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.toggle("active", i === index);
      });
      trackerItems.forEach((item, i) => {
        item.classList.toggle("active", i === index);
      });
      thumbnailItems.forEach((item, i) => {
        item.classList.toggle("active", i === index);
      });
      currentIndex = index;
    }

    function moveActiveThumbnailToFirst() {
      const activeThumbnail = document.querySelector(".thumbnail-item.active");
      const thumbnailContainer = activeThumbnail.parentNode;

      // Move active thumbnail to the first position
      thumbnailContainer.insertBefore(
        activeThumbnail,
        thumbnailContainer.firstChild
      );
    }

    function nextSlide() {
      const newIndex = (currentIndex + 1) % slides.length;
      showSlide(newIndex);
      moveActiveThumbnailToFirst();
    }

    function prevSlide() {
      const newIndex = (currentIndex - 1 + slides.length) % slides.length;
      showSlide(newIndex);
      moveActiveThumbnailToFirst();
    }

    nextBtn.addEventListener("click", () => {
      nextSlide();
      resetInterval();
    });

    prevBtn.addEventListener("click", () => {
      prevSlide();
      resetInterval();
    });

    trackerItems.forEach((item, index) => {
      item.addEventListener("click", () => {
        showSlide(index);
        resetInterval();
      });
    });

    thumbnailItems.forEach((item, index) => {
      item.addEventListener("click", () => {
        showSlide(index);
        resetInterval();
      });
    });

    function startAutoSlide() {
      intervalId = setInterval(nextSlide, 5000);
    }

    function resetInterval() {
      clearInterval(intervalId);
      startAutoSlide();
    }

    startAutoSlide();
  }
  // banner slide end

  // work video start
  const videoContainers = document.querySelectorAll(".video-container");
  if (videoContainers.length > 0) {
    videoContainers.forEach((videoContainer) => {
      const videoItem = videoContainer.querySelector("video");
      const playButton = videoContainer.querySelector(".play-button");

      playButton.addEventListener("click", () => {
        if (videoItem.paused) {
          videoItem.play();
          playButton.style.display = "none";
        } else {
          videoItem.pause();
          playButton.style.display = "block";
        }
      });

      videoItem.addEventListener("click", () => {
        if (videoItem.paused) {
          videoItem.play();
          playButton.style.display = "none";
        } else {
          videoItem.pause();
          playButton.style.display = "block";
        }
      });

      videoItem.addEventListener("play", () => {
        playButton.style.display = "none";
      });

      videoItem.addEventListener("pause", () => {
        playButton.style.display = "block";
      });
    });
  }

  // user review start
  const userReviewCarousel = $(".user-review-carousel");

  if (userReviewCarousel.length > 0) {
    userReviewCarousel.owlCarousel({
      loop: true,
      margin: 32,
      responsiveClass: true,
      nav: false,
      dots: false,
      center: true,
      autoplay: true,
      autoplayTimeout: 2000,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1,
        },
        575: {
          items: 2,
        },
        767: {
          items: 3,
        },
        1023: {
          items: 4,
        },
        1200: {
          items: 6,
        },
      },
    });
  }
  // user review end

  // testimonial carousel start
  const testimonialCarousel = $(".testimonial-carousel");

  if (testimonialCarousel.length > 0) {
    testimonialCarousel.owlCarousel({
      loop: true,
      margin: 10,
      responsiveClass: true,
      center: true,
      nav: false,
      dots: true,
      autoplay: true,
      autoplayTimeout: 2000,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1,
        },
        600: {
          items: 2,
        },
        1025: {
          items: 3,
        },
      },
    });
  }
  // testimonial carousel end

  // counter animation start
  const counterItems = document.querySelectorAll(".count");
  if (counterItems.length > 0) {
    let speed = 2000;
    counterItems.forEach((counterItem) => {
      // const current = counterItem.querySelector("span");
      const endValue = +counterItem.dataset.target;

      let startValue = endValue > 100 ? endValue - 500 : 0;

      const duration = Math.floor(speed / endValue);

      const counter = setInterval(() => {
        startValue++;
        // current.textContent = startValue.toLocaleString("en-US");
        counterItem.textContent = startValue.toLocaleString("en-US");
        if (startValue === endValue) {
          clearInterval(counter);
        }
      }, duration);
    });
  }
  // counter animation end

  // choose item select start
  const chooseItems = document.querySelectorAll(".choose-item");
  chooseItems.forEach((item) => {
    item.addEventListener("click", function () {
      if (item.classList.contains("active")) {
        item.classList.remove("active");
      } else {
        chooseItems.forEach((subItem) => {
          subItem.classList.remove("active");
        });
        item.classList.add("active");
        const link = item.dataset.link;
        window.location.href = link;
      }
    });
  });
  // choose item select end

  // item link start
  const itemLinks = document.querySelectorAll(".item-link");
  if (itemLinks.length > 0) {
    itemLinks.forEach((itemLink) => {
      itemLink.addEventListener("click", function (e) {
        e.stopPropagation();
        const link = itemLink.dataset.href;
        window.location.href = link;
      });
    });
  }
  // item link end
});

// input otp

// Function to get all OTP values at once
function getOtpValues() {
  return [
    document.getElementById("otp-input-1").value,
    document.getElementById("otp-input-2").value,
    document.getElementById("otp-input-3").value,
    document.getElementById("otp-input-4").value,
  ];
}

// Function to move to the next input
function moveToNext(event, currentInput) {
  const inputValue = event.target.value;

  if (inputValue && currentInput < 4) {
    const nextInput = document.getElementById(`otp-input-${currentInput + 1}`);
    nextInput.focus();
  }

  if (!inputValue && currentInput > 1) {
    const prevInput = document.getElementById(`otp-input-${currentInput - 1}`);
    prevInput.focus();
  }

  const otpValues = getOtpValues(); // Get all OTP values
  const submitButton = document.querySelector('button[type="submit"]');
  submitButton.disabled = otpValues.some((value) => value === ""); // Disable if any field is empty
}

function handlePaste(event) {
  const pasteData = event.clipboardData.getData("Text");

  if (pasteData.length === 4 && /^\d{4}$/.test(pasteData)) {
    for (let i = 0; i < pasteData.length; i++) {
      const inputField = document.getElementById(`otp-input-${i + 1}`);
      inputField.value = pasteData.charAt(i);
    }
  }

  event.preventDefault();

  const otpValues = getOtpValues(); // Get all OTP values
  const submitButton = document.querySelector('button[type="submit"]');
  submitButton.disabled = otpValues.some((value) => value === "");
}

// Example of how to get the OTP values when you need them (e.g., before submitting)
function getOtpValuesForSubmission() {
  const otpValues = getOtpValues();
  return otpValues.join("");
}

// password and confirm passowrd check

document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector(".auth-form");
  const passwordField = document.querySelector("#userPassword");
  const confirmPasswordField = document.querySelector("#userConfirmPassword");
  const submitButton = document.querySelector(".button");

  // Only proceed if all necessary elements exist
  if (form && passwordField && confirmPasswordField && submitButton) {
    // Function to validate password match
    function validatePasswordMatch() {
      const password = passwordField.value;
      const confirmPassword = confirmPasswordField.value;

      // Check if passwords match
      if (password !== confirmPassword) {
        submitButton.disabled = true; // Disable submit button
        confirmPasswordField.setCustomValidity("Passwords do not match");
      } else {
        submitButton.disabled = false; // Enable submit button
        confirmPasswordField.setCustomValidity(""); // Reset custom validity
      }
    }

    // Event listener to check password match on input change
    passwordField.addEventListener("input", validatePasswordMatch);
    confirmPasswordField.addEventListener("input", validatePasswordMatch);

    // Event listener for form submission
    form.addEventListener("submit", function (event) {
      // Validate again before form submission
      if (passwordField.value !== confirmPasswordField.value) {
        event.preventDefault();
        alert("Passwords do not match. Please try again.");
      }
    });
  }
});
