<title>Add New Lecturers</title>

{{-- New Lecturers --}}
<div class="dashboard-children active">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class>
            <h1 class="dashboard-heading">
                New Lecturers
            </h1>
            <p class="dashboard-short-desc">Add your lecturer</p>
        </div>
    </div>

    {{-- Form --}}
    <form action method="POST" class="form-main" id="form-1">
        @csrf
        {{-- Name, Address --}}
        <div class="row">
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="name">Name</label>
                    <div>
                        <input type="text" placeholder="Enter your name" name="name"
                            id="add_name" class="form-control">
                    </div>
                    <span class="form-message"></span>
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="address">Address</label>
                    <div>
                        <input type="text" placeholder="Enter your address" name="address"
                            id="add_address" class="form-control">
                    </div>
                    <span class="form-message"></span>
                </div>
            </div>
        </div>
        {{-- Phone, Birthday --}}
        <div class="row">
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="phone">Phone</label>
                    <div>
                        <input type="text" placeholder="Enter your phone" name="phone"
                            id="add_phone" class="form-control">
                    </div>
                    <span class="form-message"></span>
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="birthday">Birthday</label>
                    <div>
                        <input type="date" placeholder="Enter your birthday" name="birthday"
                            id="add_birthday" class="form-control">
                    </div>
                    <span class="form-message"></span>
                </div>
            </div>
        </div>

        <button type="submit" class="btn-primary-style btn-submit form-submit"
            id="btnAddLecturer">
            <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
            Add new lecturer
        </button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

{{-- Validator --}}
<script>
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


    Validator({
        form: '#form-1',
        formGroupSelector: '.form-group',
        errorSelector: '.form-message',
        rules: [
            Validator.isRequired('#add_name'),
            Validator.isRequired('#add_address'),
            Validator.isRequired('#add_phone'),
            Validator.isRequired('#add_birthday'),
            Validator.isName('#add_name'),
            Validator.isPhone('#add_phone'),
            Validator.isBirthday('#add_birthday'),
            Validator.maxLength('#add_name', 191),
            Validator.maxLength('#add_address', 191),
            Validator.maxLength('#add_phone', 191),
        ],
    });
</script>

{{-- Add --}}
<script>
    $(document).ready(function() {
        // Add lecturer
        $(document).on('click','#btnAddLecturer', function(e) {
            e.preventDefault();

            var data = {
                'name' : $('#add_name').val(),
                'address' : $('#add_address').val(),
                'phone' : $('#add_phone').val(),
                'birthday' : $('#add_birthday').val(),
                
            }
            if (data.name != "" && data.address != "" && data.phone != "" && data.birthday != "") {
                $('.spinner').addClass("spinner-border mx-auto");
                $('.btn-submit').addClass("opacity-25");
                $('.btn-submit').prop('disabled', true)
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/lecturers',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    showSuccessToast();

                    $('#add_name').val("");
                    $('#add_address').val("");
                    $('#add_phone').val("");
                    $('#add_birthday').val("");

                    $('.spinner').removeClass("spinner-border mx-auto");
                    $('.btn-submit').removeClass("opacity-25");
                    $('.btn-submit').prop('disabled', false)

                },
                error: function(res) {
                    showErrorToast();

                    $('.spinner').removeClass("spinner-border mx-auto");
                    $('.btn-submit').removeClass("opacity-25");
                    $('.btn-submit').prop('disabled', false)
                }
            });
        });
    }); 
</script>

{{-- Toast --}}
<script>
    // Toast function
    function toast({ 
        title = "", 
        message = "", 
        type = "info", 
        duration = 3000 
    }) {  
        const main = document.getElementById("toast");
        if (main) {
        const toast = document.createElement("div");
        
        // Auto remove toast
        const autoRemoveId = setTimeout(function () {
        main.removeChild(toast);
        }, duration + 1000);
    
        // Remove toast when clicked
        toast.onclick = function (e) {
            if (e.target.closest(".toast__close")) {
            main.removeChild(toast);
            clearTimeout(autoRemoveId);
            }
        };
        
        //icon
        const icons = {
            success: "fas fa-check-circle",
            error: "fas fa-exclamation-circle"
        };
        const icon = icons[type];
        const delay = (duration / 1000).toFixed(2);
    
        toast.classList.add("toast-main", `toast--${type}`);
        toast.style.animation = `slideInLeft ease .3s, fadeOut linear 1s ${delay}s forwards`;
    
        toast.innerHTML = `
                        <div class="toast__icon">
                            <i class="${icon}"></i>
                        </div>
                        <div class="toast__body">
                            <h3 class="toast__title">${title}</h3>
                            <p class="toast__msg">${message}</p>
                        </div>
                        <div class="toast__close">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
        main.appendChild(toast);
        }
        }
        // Hiển thị
        function showSuccessToast() {
            toast({
                title: "Successfully!",
                message: "You have successfully added lecturer.",
                type: "success",
                duration: 5000
            });
        }
        function showErrorToast(title = "Error!") {
            toast({
                title: title,
                message: "Can not add new lecturer.",
                type: "error",
                duration: 5000
            });
        }
</script>
