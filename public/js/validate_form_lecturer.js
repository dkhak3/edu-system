// Đối tượng Validator
function Validator(options) {
    function getParent(element, selector) {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }

            element = element.parentElement;
        }
    }

    let selectorRules = {};

    // Hàm thực hiện validate
    function Validate(inputElement, rule) {
        let errorElement = getParent(
            inputElement,
            options.formGroupSelector
        ).querySelector(options.errorSelector);
        let errorMessage;

        // Lấy ra các rules của selector
        let rules = selectorRules[rule.selector];

        // Lặp lại các rules & kiểm tra
        // Nếu có lỗi thì dừng việc kiểm tra
        for (const element of rules) {
            switch (inputElement.type) {
                case "radio":
                case "checkbox":
                    errorMessage = element(
                        formElement.querySelector(`${rule.selector}:checked`)
                    );
                    break;

                default:
                    errorMessage = element(inputElement.value);
            }
            if (errorMessage) break;
        }

        if (errorMessage) {
            errorElement.innerText = errorMessage;
            getParent(inputElement, options.formGroupSelector).classList.add(
                "invalid"
            );
        } else {
            errorElement.innerText = "";
            getParent(inputElement, options.formGroupSelector).classList.remove(
                "invalid"
            );
        }

        return !errorMessage;
    }

    // Lấy element của form cần validate
    let formElement = document.querySelector(options.form);

    if (formElement) {
        formElement.onsubmit = function (e) {
            e.preventDefault();

            let isFormValid = true;

            // Lặp qua từng rules và Validate
            options.rules.forEach(function (rule) {
                let inputElement = formElement.querySelector(rule.selector);
                let isValid = Validate(inputElement, rule);

                if (!isValid) {
                    isFormValid = false;
                }
            });

            if (isFormValid) {
                // Trường này submit với javascript
                if (typeof options.onSubmit === "function") {
                    let enableInputs = formElement.querySelectorAll(
                        "[name]:not([disabled])"
                    );
                    let formValues = Array.from(enableInputs).reduce(function (
                        values,
                        input
                    ) {
                        switch (input.type) {
                            case "radio":
                                values[input.name] = formElement.querySelector(
                                    'input[name="' + input.name + '"]:checked'
                                ).value;
                                break;
                            case "checkbox":
                                if (!values[input.name]) {
                                    values[input.name] = [];
                                }
                                if (input.matches(":checked")) {
                                    values[input.name].push(input.value);
                                }
                                break;
                            case "file":
                                values[input.name] = input.files;
                                break;
                            default:
                                values[input.name] = input.value;
                        }

                        return values;
                    },
                    {});

                    options.onSubmit(formValues);
                }
                // Trường này submit với hành vi mặc định
                else {
                    formElement.submit();
                }
            }
        };

        // Xử lý lặp ra mỗi rules và xử lý (lắng nghe sự kiện)
        options.rules.forEach(function (rule) {
            // lưu lại các rules cho mỗi input
            if (Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test);
            } else {
                selectorRules[rule.selector] = [rule.test];
            }

            let inputElements = formElement.querySelectorAll(rule.selector);

            Array.from(inputElements).forEach(function (inputElement) {
                // Xử lý trường hợp blur khỏi input
                inputElement.onblur = function () {
                    Validate(inputElement, rule);
                };

                // Xử lý mỗi khi người dùng nhập vào input
                inputElement.oninput = function () {
                    let errorElement = getParent(
                        inputElement,
                        options.formGroupSelector
                    ).querySelector(options.errorSelector);
                    errorElement.innerText = "";
                    getParent(
                        inputElement,
                        options.formGroupSelector
                    ).classList.remove("invalid");
                };
            });
        });
    }
}

// Định nghĩa rules
//Nguyên tắc của các rules:
// 1. Khi có lỗi => trả ra messae lỗi
// 2. Khi hợp lệ => không trả ra cái gì (undefined)
Validator.isRequired = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            return value ? undefined : message || "Vui lòng nhập trường này";
        },
    };
};

Validator.isEmail = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value)
                ? undefined
                : message || "Trường này phải là email";
        },
    };
};

Validator.isName = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            let regex =
                /^[A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*(?:[ ][A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*)*$/gm;
            return regex.test(value)
                ? undefined
                : message || "Trường này phải là name";
        },
    };
};

Validator.isPhone = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            let regex =
                /^(0|84)(2(0[3-9]|1[0-6|8|9]|2[0-2|5-9]|3[2-9]|4[0-9]|5[1|2|4-9]|6[0-3|9]|7[0-7]|8[0-9]|9[0-4|6|7|9])|3[2-9]|5[5|6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])([0-9]{7})$/;
            return regex.test(value)
                ? undefined
                : message || "Trường này phải là phone";
        },
    };
};

Validator.isBirthday = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            let regex = /([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/;
            return regex.test(value)
                ? undefined
                : message || "Trường này phải là birthday";
        },
    };
};

Validator.minLength = function (selector, min, message) {
    return {
        selector: selector,
        test: function (value) {
            return value.length >= min
                ? undefined
                : message || `Vui lòng nhập tối thiểu ${min} kí tự`;
        },
    };
};

Validator.maxLength = function (selector, max, message) {
    return {
        selector: selector,
        test: function (value) {
            return value.length <= max
                ? undefined
                : message || `Vui lòng nhập tối đa ${max} kí tự`;
        },
    };
};

Validator.isConfirmed = function (selector, getConformValue, message) {
    return {
        selector: selector,
        test: function (value) {
            return value === getConformValue()
                ? undefined
                : message || "Giá trị nhập vào không chính xác";
        },
    };
};
