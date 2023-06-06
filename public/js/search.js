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

    const coffeeRatingNumber = clone.querySelector(".coffee-rating-number");
    coffeeRatingNumber.innerHTML = (coffee.rating ? coffee.rating : 0) + "/5";

    const productLink = clone.querySelector(".product-link");
    productLink.href = "product?id=" + coffee.id;

    coffeeList = document.getElementsByClassName("coffee-list");
    coffeeList[0].appendChild(clone);
}

search();
