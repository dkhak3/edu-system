const dropdownSelect = document.querySelector(".dropdown__select");
const dropdownSelected = document.querySelector(".dropdown__selected");
const dropdownList = document.querySelector(".dropdown__list");
const dropdownItems = document.querySelectorAll(".dropdown__item");
const dropdownCaret = document.querySelector(".dropdown__caret");
const dropdown = document.querySelector(".dropdown");

// Dropdown select
dropdownSelect.addEventListener("click", (e) => {
    dropdownList.classList.toggle("show");
    dropdownCaret.classList.toggle("fa-caret-up");
});

// Dropdown item
[...dropdownItems].forEach((item) =>
    item.addEventListener("click", (e) => {
        const text = e.target.querySelector(".dropdown__text").textContent;
        dropdownSelected.textContent = text;
        dropdownList.classList.remove("show");
        dropdownCaret.classList.toggle("fa-caret-up");
    })
);

// Click to document
document.addEventListener("click", (e) => {
    if (!dropdown.contains(e.target) && dropdownList.matches(".show")) {
        dropdownList.classList.remove("show");
        dropdownCaret.classList.toggle("fa-caret-up");
    }
});
