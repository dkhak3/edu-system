window.addEventListener("load", () => {
    const loader = document.querySelector(".loader");
    loader.classList.add("loader--hidden");
    // loader.addEventListener("transitionend", () => {
    //     document.body.removeChild(loader);
    // });

    // const menuItems = document.querySelectorAll(".menu-item");
    // const dashboardChildren = document.querySelectorAll(".dashboard-children");

    // [...menuItems].forEach((item) =>
    //     item.addEventListener("click", (event) => {
    //         [...menuItems].forEach((item) => item.classList.remove("active"));
    //         event.target.classList.add("active");

    //         const tabNumber = event.target.dataset.tab;
    //         [...dashboardChildren].forEach((item) => {
    //             item.classList.remove("active");
    //             if (item.getAttribute("data-tab") === tabNumber) {
    //                 item.classList.add("active");
    //             }
    //         });
    //     })
    // );
});
