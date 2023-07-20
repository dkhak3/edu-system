@extends('layout')
<title>Contacts</title>

@section('content')

<div class="dashboard-children active">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class="">
            <h1 class="dashboard-heading">
                Contacts
            </h1>
            <p class="dashboard-short-desc">Manage your contacts</p>
        </div>
        <a href="" class="inline-block" id="btnAdd">
            <button class="btn-style menu-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Create contact</button>
        </a>
    </div>

    {{-- Search --}}
    <form action="{{ url('contacts') }}" method="GET" class="mb-5 d-flex justify-content-end" autocomplete="off">
        <input type="text" placeholder="Search..." id="keywords" name="keywords" class="input-search">
        <button class="btn btn-primary menu-item" style="margin-left: 10px;">Search</button>
    </form>

    {{-- Table --}}
    <div class="table-main">
        {{-- Thông báo alert --}}
        @if (Session::has('thongbao'))
        <div class="alert alert-success alert-dismissible fade show d-flex" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="icon-alert">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{Session::get('thongbao')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- Data is empty --}}
        @if ($allContacts->isEmpty())
        <div class="alert alert-info d-flex">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="icon-alert">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
            </svg>
            Data is empty
        </div>
        @else
        {{-- Delete all selected --}}
        <a id="deleteAllSelectedRecord" href="">
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2"
                class="btn-style icon-delete menu-item">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                    </path>
                </svg>
                Delete all selected</button>
        </a>
        @endif

        <table>
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="select_all_ids">
                    </th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Birthday</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allContacts as $item)
                <tr id="contacts_ids{{ $item->id }}">
                    <td>
                        <input type="checkbox" name="ids" class="checkbox_ids" value="{{$item->id}}">
                    </td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->address}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->birthday}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>
                        <div class="actions-style">
                            {{-- Edit --}}
                            <button type="button" id="btn_edit_contact" value="{{$item->id}}" class="menu-item">
                                <span
                                    class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </span>
                            </button>
                            {{-- Delete --}}
                            <button type="button" id="btn_delete_contact" value="{{$item->id}}" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                <span
                                    class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </span>
                            </button>

                        </div>
                    </td>
                </tr>

                <!-- The Modal for Delete Contact -->
                <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                <input type="hidden" id="contact_id">
                                <p>You won't be able to revert this!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" id="btn_confirm_delete_contact" class="btn btn-danger"
                                    data-bs-dismiss="modal">Yes, delete it!</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        {{ $allContacts->links() }}
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
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
                <button type="button" class="btn btn-danger" id="btnDelete" data-bs-dismiss="modal">Yes, delete
                    it!</button>
            </div>
        </div>
    </div>
</div>

<!-- The Modal for Add Contact -->
<div class="modal fade" id="modalAdd">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Contact</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="">
                <!-- Modal body -->
                <div class="modal-body">
                    <input type="text" class="form-control" name="name" id="add_name" placeholder="Enter your name...">
                    <input type="text" class="form-control mt-3" name="address" id="add_address"
                        placeholder="Enter your address...">
                    <input type="text" class="form-control mt-3" name="phone" id="add_phone"
                        placeholder="Enter your phone...">
                    <input type="date" class="form-control mt-3" name="birthday" id="add_birthday"
                        placeholder="Enter your birthday...">
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" id="" class="btn-primary-style btn-submit form-submit" data-bs-dismiss="modal">Add</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- The Modal for Edit Contact -->
<div class="modal fade" id="modalEdit">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Contact</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="">
                <!-- Modal body -->
                <div class="modal-body">
                    <input type="text" name="id" id="edit_id">
                    <input type="text" class="form-control" name="name" id="edit_name" placeholder="Enter your name...">
                    <input type="text" class="form-control mt-3" name="address" id="edit_address"
                        placeholder="Enter your address...">
                    <input type="text" class="form-control mt-3" name="phone" id="edit_phone"
                        placeholder="Enter your phone...">
                    <input type="date" class="form-control mt-3" name="birthday" id="edit_birthday"
                        placeholder="Enter your birthday...">
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" id="btn_confirm_edit_contact" class="btn-primary-style btn-submit form-submit" data-bs-dismiss="modal">Update contact</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    // Change menu item active
    document.querySelector('#menuItem_contact').classList.add('active');
    document.querySelector('#lecturer').classList.remove('active');
    document.querySelector("#dashboard").classList.remove("active");
    document.querySelector("#dashboard-content").classList.add("d-none");

        $(document).ready(function() {
            //loadDataTable()

            function loadDataTable() {
                $.ajax({
                    url: '/loadDataTable',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('tbody').html('');
                        $.each(response.allContacts.data, function(key, item) {
                            $('tbody').append('<tr>\
                            <td><input type="checkbox" name="ids" class="checkbox_ids" value="'+ item.id +'"></td>\
                            <td>' + item.id + '</td>\
                            <td>' + item.name + '</td>\
                            <td>' + item.address + '</td>\
                            <td>' + item.phone + '</td>\
                            <td>' + item.birthday + '</td>\
                            <td>' + item.created_at + '</td>\
                            <td>\
                                <div class="actions-style">\
                                    <button type="button" id="btn_edit_contact" value="'+ item.id +'" data-bs-toggle="modal" data-bs-target="#modalEdit" class="menu-item">\
                                        <span\
                                            class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">\
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none"\
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">\
                                                <path stroke-linecap="round" stroke-linejoin="round"\
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">\
                                                </path>\
                                            </svg>\
                                        </span>\
                                    </button>\
                                    <button type="button" id="btn_delete_contact" value="'+ item.id +'" data-bs-toggle="modal" data-bs-target="#modalDelete">\
                                        <span\
                                            class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">\
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none"\
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">\
                                                <path stroke-linecap="round" stroke-linejoin="round"\
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">\
                                                </path>\
                                            </svg>\
                                        </span>\
                                    </button>\
                                </div>\
                            </td>\
                            \</tr>');
                        });
                    }
                });
            }

            // Chuyển sang trang Add
            $(document).on('click', '#btnAdd', function (e) {
                e.preventDefault();
                //$(this.container).html('<div id="loader" class="loader"></div>');

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/contacts/create',
                    type: 'GET',
                    dataType: 'html',
                    success: function(response) {
                        $('.subjectRender').html(response);
                        //loadDataTable()
                    }
                });
            });

            // Add contact
            $(document).on('click','#btn_confirm_add_contact', function(e) {
                e.preventDefault();
                $(this.container).html('<div id="loader" class="loader"></div>');
                var data = {
                    'name' : $('#add_name').val(),
                    'address' : $('#add_address').val(),
                    'phone' : $('#add_phone').val(),
                    'birthday' : $('#add_birthday').val(),
                    
                }
                console.log(data);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/contacts',
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response.message);
                        loadDataTable()
                    }
                });
            });

            // Delete contact
            $(document).on('click', '#btn_delete_contact', function () {
                var contact_id = $(this).val();
                $('#contact_id').val(contact_id);
            });

            $(document).on('click', '#btn_confirm_delete_contact', function (e) {
                e.preventDefault();

                var contact_id = $('#contact_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "DELETE",
                    url: "/delete-contact/" + contact_id,
                    dataType: "json",
                    success: function (response) {
                        loadDataTable();
                        showSuccessToast(response.message);
                    }
                });
            });

            // Edit contact
            // $(document).on('click', '#btn_edit_contact', function () {
            //     var contact_id = $(this).val();
            //     $.ajax({
            //         type: "GET",
            //         url: "/edit-contact/" + contact_id,
            //         success: function (response) {
            //             //loadDataTable();
            //             //console.log(response);
            //             $('#edit_id').val(contact_id);
            //             $('#edit_name').val(response.item.name);
            //             $('#edit_address').val(response.item.address);
            //             $('#edit_phone').val(response.item.phone);
            //             $('#edit_birthday').val(response.item.birthday);
                        
            //         }
            //     });
            // });

            // Update contact
            $(document).on('click', '#btn_edit_contact', function () {
                //var contact_id = $('#edit_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "http://127.0.0.1:8000/api/contacts/edit/" + $(this).val(),
                    type: "GET",
                    
                    dataType: "html",
                    success: function (response) {
                        $('.subjectRender').html(response);
                        
                    }
                });
            });

        });   
    
    // Toast
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
    
        toast.classList.add("toast", `toast--${type}`);
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
        function showSuccessToast(message) {
            toast({
                title: "Successfully!",
                message: message,
                type: "success",
                duration: 5000
            });
        }
        function showErrorToast(message) {
            toast({
                title: "Error!",
                message: message,
                type: "error",
                duration: 5000
            });
        }

</script>

@endsection