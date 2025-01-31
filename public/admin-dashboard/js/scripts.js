// Loader 
window.onload = () => {
    fadeOut();
}
  
function loader() {
    document.querySelector('.loader-container').classList.add('active');
}
  
function fadeOut() {
    setTimeout(loader, 700);
}


window.addEventListener('DOMContentLoaded', event => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    // AJAX for handling manually book assignment
    document.getElementById("assignBookForm").addEventListener("submit", function(e) {
        e.preventDefault();
    
        let bookId = document.getElementById("book_id").value;
        let regNo = document.getElementById("reg_no").value;
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
        fetch('/admin/get-book-user-info', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ book_id: bookId, reg_no: regNo })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById("error-msg").textContent = data.error;
                document.getElementById("error-msg").style.display = "block";
                document.getElementById("info-container").style.display = "none";
            } else {
                document.getElementById("error-msg").style.display = "none";
                document.getElementById("info-container").style.display = "block";
    
                // Show book and user details
                document.getElementById("book-cover").src = data.book.cover_image;
                document.getElementById("book-id").textContent = data.book.book_id;
                document.getElementById("book-title").textContent = data.book.title;
                document.getElementById("book-author").textContent = data.book.author;
                document.getElementById("book-copies").textContent = data.book.available_copies;

                document.getElementById("user-image").src = data.user.image;
                document.getElementById("user-name").textContent = data.user.name;
                document.getElementById("user-regno").textContent = data.user.reg_no;

                document.getElementById("confirm-form").action = "{{ route('admin/assign-book-manually/'" + data.book.book_id + "/" + data.user.reg_no + ") }}";
            }
        })
        .catch(error => {
            console.log("Error:", error);
            errorMsg.textContent = "An error occurred while fetching data.";
            errorMsg.style.display = "block";
        });
    });

    document.getElementById("assignBook").addEventListener("click", function () {
        let bookId = document.getElementById("book-id").textContent.trim();
        let regNo = document.getElementById("user-regno").textContent.trim();
        let form = document.getElementById("confirm-form");
    
        if (!bookId || !regNo) {
            alert("Book ID or User Registration Number is missing!");
            return;
        }
    
        // Set the form action dynamically
        form.action = `/admin/assign-book-manually/${bookId}/${regNo}`;
    });
});
