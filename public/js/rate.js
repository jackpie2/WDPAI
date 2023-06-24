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
    }).then(function (response) {
        console.log(response);
    });

    updateStars(rating);
}

function updateStars(rating) {
    const stars = document.querySelectorAll(".stars svg");
    const filledStarsCount = document.querySelectorAll(
        "div.stars > svg.filled"
    ).length;
    const starsMobile = document.querySelectorAll(".stars-mobile svg");

    console.log(document.querySelectorAll("div.stars svg.filled"));

    if (filledStarsCount / 2 == rating) {
        for (let i = 0; i < stars.length; i++) {
            stars[i].classList.remove("filled");
        }
        for (let i = 0; i < stars.length; i++) {
            starsMobile[i].classList.remove("filled");
        }
        return;
    }

    for (let i = 0; i < stars.length; i++) {
        if (i < rating) {
            stars[i].classList.add("filled");
        } else {
            stars[i].classList.remove("filled");
        }
    }

    for (let i = 0; i < starsMobile.length; i++) {
        if (i < rating) {
            starsMobile[i].classList.add("filled");
        } else {
            starsMobile[i].classList.remove("filled");
        }
    }
}
