window.addEventListener("load", () => {
    const loader = document.querySelector(".loader");
    loader.classList.add("loader--hidden");

    const menuToggle = document.querySelector(".menu-toggle");
    const menu = document.querySelector(".menu");

    menuToggle.addEventListener("click", () => {
        menu.classList.toggle("is-show");
        menuToggle.classList.toggle("fa-times");
        menuToggle.classList.toggle("fa-bars");
    });

    document.addEventListener("click", (event) => {
        // event.target.matches: kiểm tra có khớp hay không
        // event.target.contains: kiểm tra element có chứa element khác không
        if (
            !menu.contains(event.target) &&
            !event.target.matches(".menu-toggle")
        ) {
            menu.classList.remove("is-show");
            menuToggle.classList.remove("fa-times");
            menuToggle.classList.add("fa-bars");
        }
    });
});
