<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="{{ asset ('/css/style.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
            crossorigin="anonymous">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
            integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
            crossorigin="anonymous"
          />

    </head>
    <body>
        {{-- loader --}}
        <div class="loader"></div>

        {{-- Header --}}
        <div class="container-fluid">
            {{-- Header --}}
            <div class="row">
                <div class="col-12">
                    <div class="nav-main">
                        <a href="/" class="logo">
                            <img
                                srcSet="https://hoangkhang.com.vn/wp-content/uploads/2022/04/logo.svg 2x"
                                alt="logo" class="img-fluid">
                            <span class="inline-block">Admin HOANG KHANG INCOTECH</span>
                        </a>
                        <div class="header-right">
                            <div class="header-avatar">
                                <img
                                    srcSet="https://plus.unsplash.com/premium_photo-1663091709556-1fd0bbad313b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80 2x"
                                    alt="avatar" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row dashboard-main">

                {{-- MAIN LEFT --}}
                <div class="col-lg-2 col-md-12 col-12">
                    <div class="dashboard-left">
                        {{-- Lecturer --}}
                        <a href class="menu-item active" aria-current="page">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path
                                        stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </span>
                            <span class="menu-text">Lecturer</span>
                        </a>

                        {{-- Logout --}}
                        <a href class="menu-item" aria-current="page">
                            <span class="menu-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path
                                        stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </span>
                            <span class="menu-text">Logout</span>
                        </a>
                    </div>
                </div>

                {{-- MAIN RIGHT --}}
                <div class="col-lg-9 col-md-12 col-12">

                    {{-- 1. Lecturers Table --}}
                    <div class="dashboard-children active">
                        {{-- Heading --}}
                        <div class="mb-5 d-flex justify-content-between align-items-center">
                            <div class>
                                <h1 class="dashboard-heading">
                                    Lecturers
                                </h1>
                                <p class="dashboard-short-desc">Manage your lecturer</p>
                            </div>
                            <a href class="inline-block">
                                <button class="btn-style menu-item" data-tab="4">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="icon">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Create lecturer</button>
                            </a>
                        </div>

                        {{-- Dropdown --}}
                        {{-- Search --}}
                        <form action="" class="mb-5 d-flex justify-content-end" autocomplete="off">
                            <div class="dropdown">
                                <div class="dropdown__select">
                                    <span class="dropdown__selected">Filter</span>
                                    <i class="fa fa-caret-down dropdown__caret"></i>
                                </div>
                                <ul class="dropdown__list">
                                    <li class="dropdown__item">
                                        <span class="dropdown__text">Created at low to high</span>
                                    </li>
                                    <li class="dropdown__item">
                                        <span class="dropdown__text">Created at hight to low</span>
                                    </li>
                                </ul>
                            </div>

                            <input type="text" placeholder="Search lecturer..." id="search"
                                name="search" class="input-search" style="margin-left: 10px;">
                            <button class="btn btn-primary menu-item" style="margin-left: 10px;">Search</button>
                        </form>

                        {{-- Table --}}
                        <div class="table-main">
                            <div id="deleteAllSelectedRecord">
                                <button type="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"
                                    class="btn-style icon-delete menu-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete all selected</button>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="select_all_ids">
                                        </th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Birthday</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id>
                                        <td>
                                            <input type="checkbox" name="ids" class="checkbox_ids"
                                                value>
                                        </td>
                                        <td>1</td>
                                        <td>Kha</td>
                                        <td>HCM</td>
                                        <td>033.80.88888</td>
                                        <td>2001-01-01</td>
                                        <td>
                                            <div class="actions-style">
                                                <a href class="menu-item">
                                                    <span
                                                        class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon-action" fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <button type="button" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">
                                                    <span
                                                        class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon-action" fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    {{-- 2. New Lecturers --}}
                    <div class="dashboard-children active">
                        {{-- Heading --}}
                        <div class="mb-5 d-flex justify-content-between align-items-center">
                            <div class="">
                                <h1 class="dashboard-heading">
                                    New Lecturers
                                </h1>
                                <p class="dashboard-short-desc">Add your lecturer</p>
                            </div>
                        </div>
                        
                        {{-- Form --}}
                        <form action="" method="POST" autocomplete="off" enctype="multipart/form-data" class="form-main" id="form-1">
                            {{-- Name, Address --}}
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-input form-group">
                                        <label for="lecturer_name">Name</label>
                                        <div>
                                            <input type="text" placeholder="Enter your name" name="lecturer_name" id="lecturer_name" class="form-control" >
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-input form-group">
                                        <label for="lecturer_address">Address</label>
                                        <div>
                                            <input type="text" placeholder="Enter your address" name="lecturer_address" id="lecturer_address" class="form-control" >
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                            </div>
                            {{-- Phone, Birthday --}}
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-input form-group">
                                        <label for="lecturer_phone">Phone</label>
                                        <div>
                                            <input type="text" placeholder="Enter your phone" name="lecturer_phone" id="lecturer_phone" class="form-control" >
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-input form-group">
                                        <label for="lecturer_birthday">Birthday</label>
                                        <div>
                                            <input type="date" placeholder="Enter your birthday" name="lecturer_birthday" id="lecturer_birthday" class="form-control" >
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn-primary-style btn-submit form-submit">
                                <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
                                Add new lecturer
                            </button>
                        </form>
                    </div>


                    {{-- 3. Update Lecturers --}}
                    <div class="dashboard-children active">
                        {{-- Heading --}}
                        <div class="mb-5 d-flex justify-content-between align-items-center">
                            <div class="">
                                <h1 class="dashboard-heading">
                                    Update Lecturers
                                </h1>
                                <p class="dashboard-short-desc">Update your lecturer id: <strong>1</strong></p>
                            </div>
                        </div>
                        
                        {{-- Form --}}
                        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off" class="form-main" id="form-1">
                            {{-- Name, Address --}}
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-input form-group">
                                        <label for="lecturer_name">Name</label>
                                        <div>
                                            <input type="text" placeholder="Enter your name" name="lecturer_name" id="lecturer_name" class="form-control" value="Kha">
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-input form-group">
                                        <label for="lecturer_address">Address</label>
                                        <div>
                                            <input type="text" placeholder="Enter your address" name="lecturer_address" id="lecturer_address" class="form-control" value="HCM">
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                            </div>
                            {{-- Phone, Birthday --}}
                            <div class="row">
                                <div class="col-md">
                                    <div class="form-input form-group">
                                        <label for="lecturer_phone">Phone</label>
                                        <div>
                                            <input type="text" placeholder="Enter your phone" name="lecturer_phone" id="lecturer_phone" class="form-control" value="033.80.88888">
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-input form-group">
                                        <label for="lecturer_birthday">Birthday</label>
                                        <div>
                                            <input type="date" placeholder="Enter your birthday" name="lecturer_birthday" id="lecturer_birthday" class="form-control" value="2001-01-01">
                                        </div>
                                        <span class="form-message"></span>
                                    </div>
                                </div>
                            </div>
                    
                            <button type="submit" class="btn-primary-style btn-submit form-submit">
                                <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
                                Update lecturer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-confirm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">
                            <div class="material-icons">!</div>
                        </div>
                        <h2 class="modal-title">Are you sure?</h2>
                    </div>
                    <div class="modal-body">
                        <p>You won't be able to revert this!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="btnDelete"
                            data-bs-dismiss="modal">Yes, delete it!</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset ('/js/main.js') }}"></script>
        <script src="{{ asset ('/js/dropdown.js') }}"></script>
        <script src="{{ asset ('/js/form.js') }}"></script>
        <script src="{{ asset ('/js/formadd_edit.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>

        <script>
        Validator({
            form: '#form-1',
            formGroupSelector: '.form-group',
            errorSelector: '.form-message',
            rules: [
                Validator.isRequired('#lecturer_name'),
                Validator.isRequired('#lecturer_address'),
                Validator.isRequired('#lecturer_phone'),
                Validator.isRequired('#lecturer_birthday'),
                Validator.isName('#lecturer_name'),
                Validator.isPhone('#lecturer_phone'),
                Validator.isBirthday('#lecturer_birthday'),
                Validator.maxLength('#lecturer_name', 191),
                Validator.maxLength('#lecturer_address', 191),
                Validator.maxLength('#lecturer_phone', 191),
            ],
        });
    </script>
    </body>
</html>