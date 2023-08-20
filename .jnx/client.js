// Listen to popstate history events and get page depending on the path.
addEventListener("popstate", async (event) => {
    event.preventDefault();
    const path = event.target.location.pathname;
    setPage(await loadPage(path));
});

// Prevent anchors from normally loading the page.
function setAnchors() {
    const links = document.querySelectorAll("a")
    let page, cachePath;
    links.forEach(link => {
        const path = link.getAttribute("href");
        if (!path.includes(`://`)) {
            link.addEventListener("mouseover", async function(event) {
                if (!page || cachePath != path) {
                    page = await loadPage(path);
                }
                cachePath = path;
            })
            link.addEventListener("click", function(event) {
                event.preventDefault();
                history.pushState({}, "", path);
                setPage(page);
            })
        }
    });
}

function setPage(page) {
    let app = page.app;
    app = app.replace("%JNX-HEAD%", page.head);
    app = app.replace("%JNX-BODY%", page.body);
    document.querySelector("html").innerHTML = app;
    setAnchors();
}

// Send fetch request to php file to load the page. "/" if no path is given.
async function loadPage(path = "/") {
    const data = {path}
    const response = await fetchPHP("router.php", data);
    return response;
}

async function fetchPHP(file, data) {
    return await new Promise((resolve, reject) => {
        fetch(`./.jnx/${file}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            resolve(result);
        })
    });
}

onload = () => {
    setAnchors();
}