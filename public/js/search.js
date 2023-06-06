function fetchData(page) {
    let searchInput = document.getElementById("search-input");
    let query = searchInput.value;

    fetch(`/search?q=${query}&page=${page}`, {
        method: "GET",
    })
        .then((response) => response.json())
        .then((data) => {
            loadCoffee(data);
            updateLastPage(data.totalPages);
            updateButtons();
        });
}

function search() {
    resetCurrentPage();
    fetchData(1);
}

function loadCoffee(coffee) {
    coffeeList = document.getElementsByClassName("coffee-list");
    coffeeList[0].innerHTML = "";

    currentPage = coffee.page;
    maxPage = coffee.totalPages;

    if (maxPage == 0) {
        const div = document.createElement("div");
        div.classList.add("no-results-box");
        const text = document.createTextNode("No results found.");
        div.appendChild(text);
        coffeeList[0].appendChild(div);
        return;
    }

    coffee.coffee.forEach((element) => {
        createCoffee(element);
    });
}

function makeStars(rating) {
    let stars = "";
    for (let i = 0; i < rating; i++) {
        stars += `
        <div class="star filled">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                <path d="M8 .25a.75.75 0 0 1 .673.418l1.882 3.815 4.21.612a.75.75 0 0 1 .416 1.279l-3.046 2.97.719 4.192a.751.751 0 0 1-1.088.791L8 12.347l-3.766 1.98a.75.75 0 0 1-1.088-.79l.72-4.194L.818 6.374a.75.75 0 0 1 .416-1.28l4.21-.611L7.327.668A.75.75 0 0 1 8 .25Z"></path>
            </svg>
        </div>
        `;
    }
    for (let i = rating; i < 5; i++) {
        stars += `
        <div class="star">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
        <path d="M8 .25a.75.75 0 0 1 .673.418l1.882 3.815 4.21.612a.75.75 0 0 1 .416 1.279l-3.046 2.97.719 4.192a.751.751 0 0 1-1.088.791L8 12.347l-3.766 1.98a.75.75 0 0 1-1.088-.79l.72-4.194L.818 6.374a.75.75 0 0 1 .416-1.28l4.21-.611L7.327.668A.75.75 0 0 1 8 .25Z"></path>
        </svg>
        </div>`;
    }

    return stars;
}

function createCoffee(coffee) {
    const template = document.getElementById("coffee-template");

    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = "public/uploads/" + coffee.image_file;

    const coffeeTitle = clone.querySelector(".coffee-title");
    coffeeTitle.innerHTML = coffee.name ? coffee.name : "Unknown coffee";

    const coffeeDescription = clone.querySelector(".coffee-description");
    coffeeDescription.innerHTML = coffee.description ? coffee.description : "";

    const coffeeBrand = clone.querySelector(".coffee-brand");
    coffeeBrand.innerHTML = coffee.brand_name
        ? coffee.brand_name
        : "Unknown brand";

    const coffeeRating = clone.querySelector(".coffee-rating");
    coffeeRating.innerHTML =
        makeStars(coffee.rating) +
        " " +
        (coffee.rating ? coffee.rating : 0) +
        "/5";

    const productLink = clone.querySelector(".product-link");
    productLink.href = "product?id=" + coffee.id;

    coffeeList = document.getElementsByClassName("coffee-list");
    coffeeList[0].appendChild(clone);
}

search();
