const namee = document.querySelector("#name");
const address = document.querySelector("#address");
const phone = document.querySelector("#phone");
const birthday = document.querySelector("#birthday");
const btn_submit = document.querySelector("#btn-submit");

namee.addEventListener("input", checkName);
namee.addEventListener("focusout", checkName);
address.addEventListener("input", checkAddress);
address.addEventListener("focusout", checkAddress);
phone.addEventListener("input", checkPhone);
phone.addEventListener("focusout", checkPhone);
birthday.addEventListener("input", checkBirthday);
birthday.addEventListener("focusout", checkBirthday);

function checkFormInput() {
    if (checkName() && checkAddress() && checkPhone() && checkBirthday()) {
        return true;
    }
    return false;
}

function checkName() {
    const regex =
        /^[A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*(?:[ ][A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*)*$/gm;
    if (regex.test(namee.value)) {
        namee.classList.add("is-valid");
        namee.classList.remove("is-invalid");
        return true;
    }
    namee.classList.add("is-invalid");
    namee.classList.remove("is-valid");
    return false;
}

function checkAddress() {
    //const regex = /^[0-9A-Za-z]+[0-9A-Za-z\s]{5,150}$/;
    if (address.value.length > 1 && address.value.length <= 150) {
        address.classList.add("is-valid");
        address.classList.remove("is-invalid");
        return true;
    }
    address.classList.add("is-invalid");
    address.classList.remove("is-valid");
    return false;
}

function checkPhone() {
    const regex = /^0{1}[0-9]{9}$/;
    if (regex.test(phone.value)) {
        phone.classList.add("is-valid");
        phone.classList.remove("is-invalid");
        return true;
    }
    phone.classList.add("is-invalid");
    phone.classList.remove("is-valid");
    return false;
}

function checkBirthday() {
    let curDate = new Date();
    const day = +birthday.value.slice(8, 10);
    const month = +birthday.value.slice(5, 7);
    const year = +birthday.value.slice(0, 4);

    if (year <= curDate.getFullYear() && birthday.value != "") {
        if (month < curDate.getMonth() + 1) {
            birthday.classList.add("is-valid");
            birthday.classList.remove("is-invalid");
            return true;
        } else if (month == curDate.getMonth() + 1) {
            if (day <= curDate.getDate()) {
                birthday.classList.add("is-valid");
                birthday.classList.remove("is-invalid");
                return true;
            } else {
                birthday.classList.add("is-invalid");
                birthday.classList.remove("is-valid");
                return false;
            }
        } else {
            birthday.classList.add("is-invalid");
            birthday.classList.remove("is-valid");
            return false;
        }
    } else {
        birthday.classList.add("is-invalid");
        birthday.classList.remove("is-valid");
        return false;
    }
}

function refreshForm() {
    // Delete values of fields
    $("#name").val("");
    $("#address").val("");
    $("#phone").val("");
    $("#birthday").val("");

    // Remove classes valid, invalid
    $("#name").removeClass("is-invalid");
    $("#name").removeClass("is-valid");
    $("#address").removeClass("is-invalid");
    $("#address").removeClass("is-valid");
    $("#phone").removeClass("is-invalid");
    $("#phone").removeClass("is-valid");
    $("#birthday").removeClass("is-invalid");
    $("#birthday").removeClass("is-valid");
}
