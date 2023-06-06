let lastPage = 1;
let currentPage = 1;

function handleNext() {
    if (currentPage < lastPage) {
        currentPage++;
    }
}

function handlePrev() {
    if (currentPage > 1) {
        currentPage--;
    }
}

function next() {
    handleNext();
    fetchData(currentPage);
}

function previous() {
    handlePrev();
    fetchData(currentPage);
}

function resetCurrentPage() {
    currentPage = 1;
}

function updateLastPage(page) {
    lastPage = page;
    updateButtons();
    updateLabels();
}

function updateLabels() {
    document.getElementById("current-page").innerHTML = currentPage;
    document.getElementById("total-pages").innerHTML = lastPage;
}

function updateButtons() {
    if (currentPage == 1) {
        document.getElementById("previous").classList.add("button-disabled");
    }

    if (currentPage == lastPage) {
        document.getElementById("next").classList.add("button-disabled");
    }

    if (currentPage > 1) {
        document.getElementById("previous").classList.remove("button-disabled");
    }

    if (currentPage < lastPage) {
        document.getElementById("next").classList.remove("button-disabled");
    }
}
