// Listen to popstate history events and get page depending on the path.
addEventListener("popstate", (event) => {
    const path = event.target.location.pathname;
    getPage(path);
});

function isValidURL(str) {
    let pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
    return !!pattern.test(str); 
}

async function load(path) {
    const response = await fetch(path);
    const data = await response.json();
    return data;
}

const config = load("/.jnx/config.json");
// Prevent anchors from normally loading the page.
function setAnchors() {
    const links = document.querySelectorAll("a")
    links.forEach(link => {
        const path = link.getAttribute("href");
        if (!path.includes(`://`)) {
            link.addEventListener("click", function(event) {
                event.preventDefault();
                history.pushState({}, "", path);
                getPage(path);
            })
        }
    });
}

// Send fetch request to php file to load the page. "/" if no path is given.
function getPage(path = "/") {
    const data = {
        link: path
    }

    fetch("/.jnx/loadPage.php", {
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