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
  setTimeout(loader, 10);
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
document.querySelectorAll(".borrow-request").forEach(button => {
  button.addEventListener("click", async function () {
    let bookId = this.dataset.bookId;
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // CSRF token

    // Check if the button already has the 'cancel' class (i.e., the request was already made)
    if (this.classList.contains('cancel-request')) {
      // Sending an AJAX POST request to cancel the borrow request
      fetch('/cancel-borrow-request', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({
          book_id: bookId,
        })
      })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            this.innerText = "Request to Borrow";
            this.classList.remove('cancel-request');
          }
        })
        .catch(error => {
          console.log('Error:', error);
        });
    } else {
      // Sending an AJAX POST request to request the borrow
      fetch('/borrow-request', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({
          book_id: bookId,
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          this.innerText = "Cancel Request";
          this.classList.add('cancel-request');
        }
      })
      .catch(error => {
        console.log('Error:', error);
      });
    }
  });
});