<title>Contacts</title>

@extends('layout')

@section('content')

<div class="dashboard-children active main-content">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class="">
            <h1 class="dashboard-heading">
                Contacts
            </h1>
            <p class="dashboard-short-desc">Manage your contacts</p>
        </div>
        <a href="{{ route('contacts.create') }}" class="inline-block" id="btnAdd">
            <button class="btn-style menu-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Create contact</button>
        </a>
    </div>

    {{-- Search --}}
    <form id="formSearch" class="mb-5 d-flex justify-content-end" autocomplete="off">
        <input type="text" placeholder="Search..." id="keywords" name="keywords" class="input-search">
        <button type="submit" id="btnSearch" class="btn btn-primary menu-item"
            style="margin-left: 10px;">Search</button>
    </form>

    {{-- Table --}}
    <div class="table-main">
        {{-- Thông báo alert --}}
        @if (Session::has('message'))
        <div id="alert" class="alert alert-success alert-dismissible fade show d-flex" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="icon-alert">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            {{Session::get('message')}}
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
        @endif

        {{-- Button delete all selected record --}}
        <a id="btn_delete_all_selected" style="display: none">
            <button type="button" data-bs-toggle="modal" data-bs-target="#modalDeleteAllSelectedRecord"
                class="btn-style icon-delete menu-item">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                    </path>
                </svg>
                Delete all selected</button>
        </a>

        <table>
            <thead>
                <tr>
                    <th>
                        @if (!($allContacts->isEmpty()))
                        <input type="checkbox" id="select_all">
                        @endif

                    </th>
                    <th>ID</th>
                    <th>
                        Name
                        <button class="btn_sort" value="asc"><i id="name"
                                class="fa-solid fa-arrow-down-a-z icon-sort"></i></button>
                    </th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Birthday</th>
                    <th>
                        Created at
                        <button class="btn_sort" value="asc"><i id="created_at"
                                class="fa-solid fa-arrow-down-short-wide icon-sort"></i></button>
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($allContacts as $item)
                <tr id="{{ $item->id }}">
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
                            <a href="{{ route('contacts.edit', $item->id) }}" id="btn_edit_contact" class="menu-item">
                                <span
                                    class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </span>
                            </a>
                            {{-- Delete --}}
                            <button type="button" id="btn_delete_contact" value="{{$item->id}}" data-bs-toggle="modal"
                                data-bs-target="#modalDelete">
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

                                <form action="{{ route('contacts.destroy', $item->id) }}" id="modal_submit_delete"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" id="btn_submit_delete_contact" class="btn btn-danger">Yes,
                                        delete it!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        <div id="pagination" class="float-end mt-3">
            {{ $allContacts->links() }}
        </div>
    </div>
</div>

{{-- <div id="spinner" class="text-center d-none mt-5">
    <div class="spinner-grow text-info"></div>
    <div class="spinner-grow text-info"></div>
    <div class="spinner-grow text-info"></div>
</div> --}}

{{-- The Modal for Delete All Selected Record --}}
<div class="modal fade" id="modalDeleteAllSelectedRecord" tabindex="-1" aria-labelledby="exampleModalLabel2"
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
                <button type="button" class="btn btn-danger" id="btn_submit_delete_all_selected"
                    data-bs-dismiss="modal">Yes, delete
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
                    <button type="button" id="" class="btn-primary-style btn-submit form-submit"
                        data-bs-dismiss="modal">Add</button>
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
                    <button type="button" id="btn_confirm_edit_contact" class="btn-primary-style btn-submit form-submit"
                        data-bs-dismiss="modal">Update
                        contact</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="{{ asset ('/js/toast.js') }}"></script>
<script>
    $(document).ready(function() {
        // Change menu item active
        document.querySelector('#menuItem_contact').classList.add('active');
        // Function remove alert after 5s
        removeAlert();

        // Change into Create contact page
        // $(document).on('click', '#btnAdd', function (e) {
        //     e.preventDefault();
        //     // Display loader spinner
        //     displayLoader($('.main-content'));

        //     $.ajax({
        //         url: 'contacts/create',
        //         type: 'GET',
        //         dataType: 'html',
        //         success: function(response) {
        //             //Romove loader spinner
        //             removeLoader();
        //             // Load content
        //             $('.subjectRender').html(response);
                    
        //         }
        //     });
        // });

        // Delete contact (Save ID which is deleted)
        // $(document).on('click', '#btn_delete_contact', function () {
        //     var contact_id = $(this).val();
        //     $('#contact_id').val(contact_id);
        // });

        // Submit delete contact (Delete contact in database)
        // $(document).on('click', '#btn_submit_delete_contact', function (e) {
        //     e.preventDefault();

        //     // Display loader spinner
        //     displayLoader($('tbody'));

        //     var contact_id = $('#contact_id').val();

        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     $.ajax({
        //         url: "contacts/destroy/" + contact_id,
        //         type: "DELETE",
        //         dataType: "json",
        //         success: function (response) {
        //             // Load data
        //             loadDataTable(response.allContacts.data);
        //             // Refresh pagination
        //             $('#pagination').html(response.pagination);
        //             // Display success message
        //             showSuccessToast(response.message);
        //             //Romove loader spinner
        //             removeLoader();
        //         }
        //     });
        // });

        var temp = 0;
        var arr_checkbox = $('.checkbox_ids');
        $(document).on('click', '#select_all', function (e) {
            if ($(this).prop('checked')) {
                $('#btn_delete_all_selected').css('display', 'block');
                temp = arr_checkbox.length;
            }
            else {
                $('#btn_delete_all_selected').css('display', 'none');
                temp = 0;
            }
            $('.checkbox_ids').prop('checked', $(this).prop('checked'));
        });

        $(arr_checkbox).each(function() {
            $(this).on('click',function (e) {
            if ($(this).prop('checked')) {
                temp++;
                if (temp == arr_checkbox.length) {
                    $('#select_all').prop('checked', true);
                    $('#btn_delete_all_selected').css({display:'unset'});
                }
            }
            else{
                temp--;
                
                $('#select_all').prop('checked', false);
                $('#btn_delete_all_selected').css({display:'none'});
            }  
            console.log('temp: '+temp);
            if (temp >= 2 || temp == arr_checkbox.length){
                $('#btn_delete_all_selected').css({display:'unset'});
            }
            else{
                $('#select_all').prop('checked', false);
                $('#btn_delete_all_selected').css({display:'none'});
            }
            });
        });

        // Delete all selected contacts
        $(document).on('click','#btn_submit_delete_all_selected', function (e) {
            e.preventDefault();
            $('#btn_delete_all_selected').css('display', 'none');
            $('#select_all').prop('checked', false);
            var all_ids = [];
            $('input:checkbox[name=ids]:checked').each(function () {
                all_ids.push($(this).val());
            });
            
            // Display loader
            displayLoader($('tbody'));
            
            $.ajax({
                url: "{{ route('contacts.destroyAllSelectedRecord') }}",
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}",
                    ids: all_ids
                },
                success: function (response) {
                    // Load data
                    loadDataTable(response.allContacts.data);
                    // Remove loader
                    removeLoader();
                    // Update pagination
                    $('#pagination').html(response.pagination);
                    // Show success toast
                    showSuccessToast('Delete all selected successfully!');
                }
            });
        });

        // Update contact (Change into Update contact page)
        // $(document).on('click', '#btn_edit_contact', function () {
        //     // Display loader spinner
        //     displayLoader($('.main-content'))

        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     $.ajax({
        //         url: "contacts/edit/" + $(this).val(),
        //         type: "GET",
        //         dataType: "html",
        //         success: function (response) {
        //             //Romove loader spinner
        //             removeLoader();
        //             // Load content
        //             $('.subjectRender').html(response);
        //         }
        //     });
            
        // });

        // Search
        $('#formSearch').submit(function(e) {
            e.preventDefault();
            displayLoader($('tbody'));
            $.ajax({
                url: 'searchContacts',
                data: {keywords: $('#keywords').val()},
                dataType: "json",
                success: function (response) {
                    removeLoader();
                    if (response.result.data.length == 0) {
                        showWarningToast('Not found any contact!');
                    }
                    else {
                        loadDataTable(response.result.data);
                    }
                    
                    
                },
                error: function () {
                    showErrorToast('Can not search !');

                }
            });
        });

        //Update Pagination using Ajax
        $(document).on('click', '.page-link',function (e) {
            e.preventDefault();
            displayLoader($('tbody'));

            $.ajax({
                url: $(this).attr('href'),
                data: {
                    sortField: 'name',
                    sortType: 'asc',
                },
                type: 'GET',
                success: function (response) {
                    removeLoader();
                    
                    if (typeof(response) != 'string') {
                        loadDataTable(response.allContacts.data);
                    }
                    else {
                        $('body').html(response);
                        $('.loader').css('display', 'none');
                    }
                    
                    $('#pagination').html(response.pagination);
                }
            });
        });

        // Sort
        $('.btn_sort').on('click', function () {
            // Display loader
            displayLoader($('tbody'));
            var btn = $(this);
            $.ajax({
                url: 'sortContacts',
                data: {
                    sortField: btn.children().attr('id'),
                    sortType: btn.val(),
                },
                dataType: "json",
                success: function (response) {
                    // Load data 
                    loadDataTable(response.allContacts.data);
                    // Remove loader
                    removeLoader();
                    // Change icon
                    changeIconSort(btn);
                    // Change status
                    if (btn.val() == 'asc') {
                        btn.val('desc');
                    }
                    else {
                        btn.val('asc');
                    }
                    
                    $('#pagination').html(response.pagination);
                },
                error: function () {
                    showErrorToast('Can not sort Name field !');
                }
            });
        });

        function changeIconSort(btn) {
            var icon = btn.children();
            // Nếu là asc
            if (btn.val() == 'asc') {
                // Nếu là trường name
                if (icon.attr('id') == 'name') {
                    icon.removeClass('fa-arrow-down-a-z');
                    icon.addClass('fa-arrow-down-z-a');
                }
                // Nếu là trường created_at
                else if (icon.attr('id') == 'created_at') {
                    icon.removeClass('fa-arrow-down-short-wide');
                    icon.addClass('fa-arrow-down-wide-short');
                }
            }
            // Nếu là desc
            else {
                // Nếu là trường name
                if (icon.attr('id') == 'name') {
                    icon.addClass('fa-arrow-down-a-z');
                    icon.removeClass('fa-arrow-down-z-a');
                }
                // Nếu là trường created_at
                else if (icon.attr('id') == 'created_at') {
                    icon.addClass('fa-arrow-down-short-wide');
                    icon.removeClass('fa-arrow-down-wide-short');
                }
            }
        }

    });   

    function displayLoader(element) {
        element.html('');
        element.html('<div class="load d-block text-center m-auto mt-5"></div>');
        for (let i = 0; i < 3; i++) {
            $('.load').append('<div class="spinner-grow text-info ms-1"></div>');
        }
    }

    function removeLoader() {
        $('.load').remove();
    }

    function loadDataTable(data) {
        if (data.length == 0) {
            $('#select_all').css('display', 'none');
        }
        else {
            $('#select_all').css('display', 'unset');
        }
        $('tbody').html('');
        $.each(data, function(key, item) {
            $('tbody').append('<tr id="'+ item.id +'">\
            <td><input type="checkbox" name="ids" class="checkbox_ids" value="'+ item.id +'"></td>\
            <td>' + item.id + '</td>\
            <td>' + item.name + '</td>\
            <td>' + item.address + '</td>\
            <td>' + item.phone + '</td>\
            <td>' + item.birthday + '</td>\
            <td>' + moment(item.created_at).format('DD-MM-YYYY HH:mm:ss') + '</td>\
            <td>\
                <div class="actions-style">\
                    <a href="http://127.0.0.1:8000/contacts/' + item.id + '/edit" id="btn_edit_contact" value="'+ item.id +'" class="menu-item">\
                        <span\
                            class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">\
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none"\
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">\
                                <path stroke-linecap="round" stroke-linejoin="round"\
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">\
                                </path>\
                            </svg>\
                        </span>\
                    </a>\
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

    function removeAlert() {
        //const alert = document.querySelector('.alert');
        setTimeout(function () {
            $('#alert').alert('close');
        }, 5000);
    }
    
</script>

@endsection