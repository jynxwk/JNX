// Listen to popstate history events and get page depending on the path.
// addEventListener("popstate", (event) => {
//     const path = event.target.location.pathname;
//     getPage(path);
// });

// Prevent anchors from normally loading the page.
function setAnchors() {
    const links = document.querySelectorAll("a")
    links.forEach(link => {
        link.addEventListener("click", function(event) {
            event.preventDefault();
            const href = event.target.href;
            const path = href.replace(window.location.origin, "");
            history.pushState({}, "", path);
            getPage(path);
        })
    });
}

// Send fetch request to php file to load the page. "/" if no path is given.
function getPage(path = "/") {
    const data = {
        link: path
    }

    fetch("/modules/loadPage.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(response => response.text())
    .then(result => {
        document.querySelector("html").innerHTML = result;
        setAnchors();
    })
    .catch(error => {
        console.error("Request failed:", error);
    });;
}

getPage(window.location.pathname);
setAnchors();