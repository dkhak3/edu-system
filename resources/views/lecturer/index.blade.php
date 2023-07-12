@extends('layout')
<title>Lecturers</title>

@section('content')
    {{-- Lecturers --}}
<div class="dashboard-children active">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class="">
            <h1 class="dashboard-heading">
                Lecturers
            </h1>
            <p class="dashboard-short-desc">Manage your lecturer</p>
        </div>
        <a href="{{ route('add') }}" class="inline-block">
            <button class="btn-style menu-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            Create lecturer</button>
        </a>
    </div>

    {{-- Search --}}
    <form action="{{ route('search') }}" method="GET" class="mb-5 d-flex justify-content-end" autocomplete="off">
        <input type="text" placeholder="Search lecturer..." id="search" name="search" class="input-search">
        <button class="btn btn-primary menu-item" style="margin-left: 10px;">Search</button>
    </form>

    {{-- Table --}}
    <div class="table-main">
        {{-- Thông báo alert --}}
        @if (Session::has('thongbao'))
            <div class="alert alert-success alert-dismissible fade show d-flex" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-alert">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>                  
                {{Session::get('thongbao')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Data is empty --}}
        @if ($lecturer->isEmpty())
            <div class="alert alert-info d-flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon-alert">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
                Data is empty
            </div>
        @endif

        @if ($lecturer->isNotEmpty())
            {{-- Delete all selected --}}
            <a id="deleteAllSelectedRecord" href="" >
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn-style icon-delete menu-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
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
                    <th>Id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Birthday</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lecturer as $item)
                <tr id="lecturer_ids{{ $item->id }}">
                    <td>
                        <input type="checkbox" name="ids" class="checkbox_ids" value="{{$item->id}}">
                    </td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->lecturer_name}}</td>
                    <td>{{$item->lecturer_address}}</td>
                    <td>{{$item->lecturer_phone}}</td>
                    <td>{{$item->lecturer_birthday}}</td>
                    <td>
                        <form action="{{ route('delete', $item->id) }}"class="actions-style">
                        <form class="actions-style">
                            <a  href="{{ route('editScreenLecturer', $item->id) }}" class="menu-item">
                                <span class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </span>
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <span 
                                    class="flex align-items-center justify-content-center w-10 h-10 border border-gray-200 rounded cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon-action" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                </span>
                            </button>
                        </form>
                    </td>
                </tr>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="{{ route('delete', $item->id) }}">
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes, delete it!</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
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
            <button type="button" class="btn btn-danger" id="btnDelete" data-bs-dismiss="modal">Yes, delete it!</button>
        </div>
        </div>
    </div>
</div>

{{ $lecturer->links() }}

@endsection
