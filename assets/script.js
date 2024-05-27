document.addEventListener("DOMContentLoaded", (event) => {
  const stars = document.querySelectorAll(".star");
  const ratingInput = document.getElementById("rating");

  stars.forEach((star) => {
    star.addEventListener("click", function () {
      const selectedValue = this.getAttribute("data-value");
      ratingInput.value = selectedValue; // Set the rating input value
      stars.forEach((s) => {
        const starValue = s.getAttribute("data-value");
        s.classList.toggle("selected", starValue <= selectedValue);
      });
    });
  });
});
