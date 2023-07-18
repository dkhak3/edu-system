@extends('layout')
<title>Courses</title>
@section('content')
    <div class=" tableC mt-5">
        <h1 class="text-center">COURSES</h1>
       <form class="form-search mt-3" >
        <input type="text" id="search" placeholder="Search..." class="search-courses">
       <span class="icon-search"><i class="fa-solid fa-magnifying-glass"></i></span>
       </form>
       <button type="button"  class="btn mt-3 btn-lg btnAdd btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap" ><i class="fa-sharp fa-light fa-plus" style="font-size: 30px;"></i> Add New Courses</button> 
       <button id="btnAll" class="btn float-right mt-3 btn-danger">Delete Selected</button>
        <table class="table mt-5 table-striped">
            <thead class="thead-light">
                <tr>
                    <td scope="col" style="white-space: nowrap">Check All <input type="checkbox" id="checkall" name="checkall"> </td>
                    <td scope="col" style="white-space: nowrap">Name <i style="margin-left: 3px; padding: 5px; cursor: pointer;" id="sort" class="fa-solid fa-arrow-down-a-z"></i></td>
                    <td scope="col" class="mbl-none">Description</td>
                    <td scope="col" class="mbl-none">Start Date</td>
                    <td scope="col" class="mbl-none">End Date</td>
                    <td scope="col">Event</td>
                </tr>
                
            </thead>
            <tbody id="renderTB"  >
                @include('componentChirld.tablelist')
                
            </tbody>
        </table> 
        <div>
            <ul class="page-url">
                <li class="rounded-circle page"><span>Pre</span></li>
                <li class="rounded-circle page active"><span>1</span></li>
                <li class="rounded-circle page"><span>2</span></li>
                <li class="rounded-circle page"><span>3</span></li>
                <li class="rounded-circle page"><span>Next</span></li>
            </ul>
        </div>
    </div>
    
    
    
    
@endsection