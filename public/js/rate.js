function rate(rating) {
    const urlParams = new URLSearchParams(window.location.search);
    const coffeeID = urlParams.get("id");

    fetch("/rateProduct", {
        credentials: "include",
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            coffeeID: coffeeID,
            rating: rating,
        }),
    });

    const filledStarsCount = document
        .getElementById("actions-menu")
        .getElementsByClassName("filled").length;

    if (filledStarsCount == rating) {
        rating = 0;
    }

    updateStars(rating);
}

function updateStars(rating) {
    const stars = document.querySelectorAll(".stars svg");
    const starsMobile = document.querySelectorAll(".stars-mobile svg");

    for (let i = 0; i < 5; i++) {
        if (i < rating) {
            stars[i].classList.add("filled");
            starsMobile[i].classList.add("filled");
        } else {
            stars[i].classList.remove("filled");
            starsMobile[i].classList.remove("filled");
        }
    }
}
