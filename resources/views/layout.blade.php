<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/png" href="https://hoangkhang.com.vn/wp-content/uploads/2022/04/logo.svg"/>

    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
  
        <link rel="stylesheet" href="{{ asset('/css/styleCourses.css') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    {{-- loader --}}
    <div class="loader"></div>

    {{-- toast --}}
    <div id="toast"></div>


    {{-- Header --}}
    <div class="container-fluid">
        {{-- Header --}}
        <div class="row">
            <div class="col-12">
                <div class="nav-main">
                    <a href="/" class="logo">
                        <img srcSet="https://hoangkhang.com.vn/wp-content/uploads/2022/04/logo.svg 2x" alt="logo"
                            class="img-fluid">
                        <span class="inline-block">Admin HOANG KHANG INCOTECH</span>
                    </a>
                    <div class="header-right">
                        <div class="header-avatar">
                            <img srcSet="https://plus.unsplash.com/premium_photo-1663091709556-1fd0bbad313b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80 2x"
                                alt="avatar" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <header class="header">
            <i class="fa fa-bars menu-toggle"></i>
            <!-- fa-times -->
        </header>
    </div>

    <div class="container-fluid">
        <div class="row dashboard-main">
            <div class="col-lg-2 col-md-12 col-12">
                <div class="dashboard-left menu">
                    {{-- dashboard --}}
                    <a href="/" class="menu-item" id="dashboard" aria-current="page">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </span>
                        <span class="menu-text">Dashboard</span>
                    </a>

                    {{-- Lecturer --}}
                    <a href="{{ url('lecturers') }}" class="menu-item" id="lecturer" aria-current="page">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                        </span>
                        <span class="menu-text">Lecturer</span>
                    </a>

                    {{-- Contact --}}
                    <a href="{{ url('contacts') }}" id="menuItem_contact" class="menu-item" aria-current="page">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="icon" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 9v.906a2.25 2.25 0 01-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 001.183 1.981l6.478 3.488m8.839 2.51l-4.66-2.51m0 0l-1.023-.55a2.25 2.25 0 00-2.134 0l-1.022.55m0 0l-4.661 2.51m16.5 1.615a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V8.844a2.25 2.25 0 011.183-1.98l7.5-4.04a2.25 2.25 0 012.134 0l7.5 4.04a2.25 2.25 0 011.183 1.98V19.5z" />
                            </svg>
                        </span>
                        <span class="menu-text">Contact</span>
                    </a>

                    {{-- courses --}}
                    <a href="{{ route('courses.index') }}" id="courses-page" class="menu-item" aria-current="page">
                        <span class="menu-icon">
                            {{-- <i class="fa-solid fa-book-open"></i> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="icon" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                            </svg>
                        </span>
                        <span class="menu-text">Courses</span>
                    </a>

                    {{-- subject --}}
                    <a href="{{ route('subject') }}" id="subject-page" class="menu-item"
                        aria-current="page">
                        <span class="menu-icon">
                            {{-- <i class="fa-solid fa-book-open"></i> --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="icon"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                        </span>
                        <span class="menu-text">Subjects</span>
                    </a>

                    {{-- Logout --}}
                    <a href="/" class="menu-item" aria-current="page">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </span>
                        <span class="menu-text">Logout</span>
                    </a>
                </div>
            </div>


            <div class="col-lg-9 col-md-12 col-12 subjectRender coursesRender">
                
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
</body>

</html>