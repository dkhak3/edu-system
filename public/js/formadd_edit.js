const btnSubmit = document.querySelector(".btn-submit");
const form = document.querySelector(".form-main");

const spinner = document.querySelector(".spinner");

form.addEventListener("submit", (e) => {
    const lecturerName = form.elements["lecturer_name"].value;
    const lecturerAddress = form.elements["lecturer_address"].value;
    const lecturerPhone = form.elements["lecturer_phone"].value;
    const lecturerBirthday = form.elements["lecturer_birthday"].value;

    if (
        lecturerName !== "" &&
        lecturerAddress !== "" &&
        lecturerPhone !== "" &&
        lecturerBirthday !== ""
    ) {
        spinner.className = "spinner-border mx-auto";
        btnSubmit.disabled = true;
        btnSubmit.classList.add("opacity-25");
        btnSubmit.style.cursor = "wait";
    }
});
