document.addEventListener("DOMContentLoaded", (event) => {
  const stars = document.querySelectorAll(".star");
  const ratingInput = document.getElementById("rating");

  stars.forEach((star) => {
    star.addEventListener("click", function () {
      console.log("Star clicked!"); // Added console log statement
      ratingInput.value = this.getAttribute("data-value");
      stars.forEach((s) => s.classList.remove("selected"));
      this.classList.add("selected");
      let previousStar = this.previousElementSibling;
      while (previousStar) {
        previousStar.classList.add("selected");
        previousStar = previousStar.previousElementSibling;
      }
    });
  });
});
