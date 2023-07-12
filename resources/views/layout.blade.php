<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="{{ asset ('/css/style.css') }}"> 
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

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
                        <img srcSet="https://hoangkhang.com.vn/wp-content/uploads/2022/04/logo.svg 2x" alt="logo" class="img-fluid">
                        <span class="inline-block">Admin HOANG KHANG INCOTECH</span>
                    </a>
                    <div class="header-right">
                        <div class="header-avatar">
                            <img srcSet="https://plus.unsplash.com/premium_photo-1663091709556-1fd0bbad313b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80 2x" alt="avatar" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row dashboard-main">
            <div class="col-lg-2 col-md-12 col-12">
                <div class="dashboard-left">
                    {{-- Lecturer --}}
                    <a href="{{ route('index') }}" class="menu-item active" aria-current="page">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </span>
                        <span class="menu-text">Lecturer</span>
                    </a>

                    {{-- Logout --}}
                    <a href="{{ route('index') }}" class="menu-item" aria-current="page">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </span>
                        <span class="menu-text">Logout</span>
                    </a>
                </div>
            </div>


            <div class="col-lg-9 col-md-12 col-12">

                
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset ('/js/main.js') }}"></script>
    <script src="{{ asset ('/js/form.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

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
    <script>
        var temp = 0;
        $(function (e) {
            $("#select_all_ids").click(function () {
                $(".checkbox_ids").prop("checked", $(this).prop("checked"));

                if ($(this).prop('checked')) {
                    $('#deleteAllSelectedRecord').css({display:'block'});
                } else {
                    $('#deleteAllSelectedRecord').css({display:'none'});
                    temp = 0;
                }
            });

            var arr_checkbox = $('.checkbox_ids');
            $(arr_checkbox).each(function() {
                console.log(arr_checkbox.length);
                $(this).on('click',function (e) {
                if ($(this).prop('checked')) {
                    temp++;
                    if (temp == arr_checkbox.length) {
                        $('#select_all_ids').prop('checked', true);
                        $('#deleteAllSelectedRecord').css({display:'block'});
                    }
                }
                else{
                    temp--;
                    $('#select_all_ids').prop('checked', false);
                    $('#deleteAllSelectedRecord').css({display:'none'});
                }  
                console.log('temp: '+temp);
                if (temp >= 1){
                    $('#deleteAllSelectedRecord').css({display:'block'});
                }
                else{
                    $('#select_all_ids').prop('checked', false);
                    $('#deleteAllSelectedRecord').css({display:'none'});
                }
                });
            });

            $('#deleteAllSelectedRecord').click(function(e) {
                e.preventDefault();
                var all_ids = [];
                $('input:checkbox[name=ids]:checked').each(function () {
                    all_ids.push($(this).val())
                });


                $('#btnDelete').click(function(e) {
                    $.ajax({
                        url: "{{ route('deleteAll') }}",
                        type: "DELETE",
                        data: {
                            ids:all_ids,
                            _token:'{{ csrf_token() }}'
                        },
                        success:function(response) {
                            $.each(all_ids, function(key, val) {
                                $('#lecturer_ids'+val).remove();
                            })
                        }
                    })
                })
            })
        });
</script>
</body>
</html>