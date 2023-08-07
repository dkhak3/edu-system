@extends('layout')
@section('content')

    <div class="dashboard-children active">
        <div class="mb-5 d-flex justify-content-between align-items-center">
            <div class="">
                <h1 class="dashboard-heading">
                    Create New Course
                </h1>
            </div>
        </div>
        <form id="form-1" action="{{route('courses.store')}}" method="POST">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-md">
                    <div class="form-input form-group">
                        <label for="lecturer_name">Name</label>
                        <div>
                            <input type="text" id="course-name" value="{{isset($request['name']) ? $request['name'] : ''}}" placeholder="Enter your name..." name="name"
                                >
                            @isset($validate['name'])
                               
                               
                                <span style="color: red" class="validate">{{$validate['name'][0]}}</span>
                                
                            @endisset
                        </div>

                    </div>
                </div>
                <div class="col-md">
                    <div class="form-input form-group">
                        <label for="lecturer_address">Start Date</label>
                        <div>
                            <input type="datetime-local" id="start-date" placeholder="Enter your address" value="{{isset($request['startdate']) ? $request['startdate'] : ''}}" name="startdate"
                                class="form-control" >
                            @isset($validate['startdate'])
                               
                                <span style="color: red" class="validate">{{$validate['startdate'][0]}}</span>
                                
                            @endisset
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-input form-group">
                        <label for="lecturer_phone">End Date</label>
                        <div>
                            <input type="datetime-local" value="{{isset($request['enddate']) ? $request['enddate'] : ''}}" id="end-date" name="enddate" class="form-control"
                                >
                            @isset($validate['enddate'])
                                @if($validate['enddate'])
                                <span style="color: red" class="validate">{{$validate['enddate'][0]}}</span>
                                @endif
                            @endisset
                        </div>

                    </div>
                </div>
                <div class="col-md">
                    <div class="form-input form-group">
                        <label for="lecturer_birthday">Description</label>
                        <div>
                            <textarea name="description" id="decription-text" cols="70" rows="10">{{isset($request['description']) ? $request['description'] : ''}}</textarea>
                            @isset($validate['description'])
                                @if($validate['description'])
                                <span style="color: red" class="validate">{{$validate['description'][0]}}</span>
                                @endif
                            @endisset
                        </div>

                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center mx-auto gap-3">
                
                <button type="submit" class="btn-primary-style-2  btn-submit form-submit ">
                    <span class="spinner-border-xl spinner" role="status" aria-hidden="true"></span>
                    Create course
                </button>
                <a href="{{route('courses.index')}}" class="btn-cancel">
                    Cancel
                </a>
                
               </div>
        </form>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.querySelector('#menuItem_contact').classList.remove('active');
        document.querySelector('#courses-page').classList.add('active');
        document.querySelector('#lecturer').classList.remove('active');
        document.querySelector("#dashboard").classList.remove("active");
        $(document).ready(function() {
           
            $('#course-name').keydown(function(e) {
                $(".validate:eq(0)").text("");

            });
            $('#start-date').change(function(e) {
                $(".validate:eq(1)").text("");

            });
            $('#end-date').change(function(e) {
                $(".validate:eq(2)").text("");

            });
            $('#decription-text').change(function(e) {
                $(".validate:eq(3)").text("");

            });
           
        })

       
    </script>
@endsection
