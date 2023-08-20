export async function fetchPHP(file, data) {
    fetch(`/.jnx/${file}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        head.innerHTML = result.head;
        app.innerHTML = result.body;
        setAnchors();
    })
    .catch(error => {
        console.error("Request failed:", error);
    });
}