// scripts.js
document.addEventListener("DOMContentLoaded", (event) => {
  const ratingForm = document.getElementById("ratingForm");

  ratingForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent default form submission

    const formData = new FormData(this);

    // Submit form data using AJAX
    fetch("submit.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        // Create and append popup element
        const popup = document.createElement("div");
        popup.classList.add("popup");
        if (data.includes("successfully")) {
          popup.classList.add("success");
        } else {
          popup.classList.add("error");
        }
        popup.textContent = data;
        document.body.appendChild(popup);

        // Automatically close popup after 3 seconds
        setTimeout(() => {
          popup.remove();
        }, 3000);
      })
      .catch((error) => {
        console.error("Error:", error);
        // Create and append error popup element
        const popup = document.createElement("div");
        popup.classList.add("popup");
        popup.classList.add("error");
        popup.textContent = "An error occurred. Please try again later.";
        document.body.appendChild(popup);

        // Automatically close error popup after 3 seconds
        setTimeout(() => {
          popup.remove();
        }, 3000);
      });
  });
});
