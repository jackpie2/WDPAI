function bookmark() {
    const urlParams = new URLSearchParams(window.location.search);
    const coffeeID = urlParams.get("id");

    fetch("/bookmarkProduct", {
        credentials: "include",
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            coffeeID: coffeeID,
        }),
    }).then(function (response) {
        console.log(response);
    });

    updateBookmark();
}

function updateBookmark() {
    const bookmark = document.getElementsByClassName("bookmark");

    console.log(bookmark);

    for (let i = 0; i < bookmark.length; i++) {
        if (bookmark[i].classList.contains("bookmarked")) {
            bookmark[i].classList.remove("bookmarked");
        } else {
            bookmark[i].classList.add("bookmarked");
        }
    }
}
