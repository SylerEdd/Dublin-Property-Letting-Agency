document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.querySelector("#search");

    searchInput.addEventListener("input", e => {
        const value = e.target.value;
        console.log(value);
    });
});

