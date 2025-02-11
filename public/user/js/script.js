searchForm = document.querySelector('.search-form');

window.onscroll = () => {
  searchForm.classList.remove('active');

  if (window.scrollY > 80) {
    document.querySelector('.header .header-2').classList.add('active');
  } else {
    document.querySelector('.header .header-2').classList.remove('active');
  }
}

window.onload = () => {
  if (window.scrollY > 80) {
    document.querySelector('.header .header-2').classList.add('active');
  } else {
    document.querySelector('.header .header-2').classList.remove('active');
  }

  fadeOut();
}

function loader() {
  document.querySelector('.loader-container').classList.add('active');
}

function fadeOut() {
  setTimeout(loader, 500);
}

/* Show and hide header dropdown menu */
document.querySelector('.user-profile .user-info').addEventListener('click', () => {
  document.getElementById('dropdown-menu').classList.toggle('show-dropdown-menu');
});

// Close dropdown when clicking outside
document.addEventListener('click', (event) => {
  const userInfo = document.querySelector('.user-profile .user-info');
  const dropdownMenu = document.getElementById('dropdown-menu');
  // Check if the click is outside the dropdown and profile picture area
  if (!dropdownMenu.contains(event.target) && !userInfo.contains(event.target)) {
    dropdownMenu.classList.remove('show-dropdown-menu');
  }
});

// AJAX for handle borrow request
document.addEventListener("click", async function (event) {
  let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // Send Borrow Request
  if (event.target.classList.contains("send-borrow-request")) {
      let bookId = event.target.dataset.bookId;

      fetch('/borrow-request', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': token
          },
          body: JSON.stringify({ book_id: bookId })
      })
      .then(response => response.json())
      .then(data => {
          if (data.status === 'success') {
              event.target.innerText = "Cancel Request";
              event.target.classList.add('cancel-request');
              event.target.classList.remove('send-borrow-request');
          }
      })
      .catch(error => console.log('Error:', error));
  }

  // Cancel Request
  if (event.target.classList.contains("cancel-request")) {
      let bookId = event.target.dataset.bookId;

      fetch('/cancel-borrow-request', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': token
          },
          body: JSON.stringify({ book_id: bookId })
      })
      .then(response => response.json())
      .then(data => {
          if (data.status === 'success') {
              event.target.innerText = "Request to Borrow";
              event.target.classList.remove('cancel-request');
              event.target.classList.add('send-borrow-request');
          }
      })
      .catch(error => console.log('Error:', error));
  }
});

var swiper = new Swiper(".books-slider", {
  spaceBetween: 5,
  loop:true,
  centeredSlides: true,
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    450: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 3,
    },
    1024: {
      slidesPerView: 4,
    },
  },
});

// Change user password
document.getElementById("change-password-form")?.addEventListener("submit", function(event) {
  event.preventDefault();

  let formData = new FormData(this); // Get form data

  fetch("/change-password", {
      method: "POST",
      body: formData,
      headers: {
          "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
      }
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          document.getElementById("success-msg").innerText = data.success;
          document.getElementById("error-msg").innerText = "";

          // Clear input fields after successful password change
          document.getElementById("change-password-form").reset();
      } else if (data.errors) {
          document.getElementById("error-msg").innerText = data.errors[0]; // Show first error
          document.getElementById("success-msg").innerText = "";
      }
  })
  .catch(error => console.log("Error:", error));
});