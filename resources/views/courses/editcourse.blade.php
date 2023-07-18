@extends('layouts.layout')
@section('add')
<div class="edit-item">
    <form class="form-control text-center form-edit mt-5">
        @csrf
        <h1>EDIT COURSES</h1>
        <div class="text-right">
            <label for="nameED" class="d-block">
                <span>Name:</span>
                <div>
                    <input type="text"  class="mt-3 ml-5 info inforEdit" placeholder="Name..." id="nameED" name="nameEdit" >
                <div class="error-text"></div>
                </div>
            </label>
            <label for="startED" class="d-block">
                <span>Start Date:</span> 
                <div>
                    <input type="datetime-local"  class="mt-3 ml-5 info inforEdit" placeholder="Start Date..." id="startED" name="startEdit">
                <div class="error-text"></div>
                </div>
           
            </label>
            <label for="endED" class="d-block">
                <span>End Date:</span> 
                <div>
                    <input type="datetime-local"  class="mt-3 ml-5 info inforEdit" placeholder="End Date..." id="endED" name="endEdit">
                <div class="error-text"></div>
                </div>
            
            </label>
            <label for="desciptionED" class="d-block">
                <span>Description:</span>
                <div>
                    <textarea name="desciption" id="desciptionED" class="mt-3 ml-5 info inforEditDescription" cols="30" rows="10"></textarea>
                <div class="error-text"></div>
                </div>

            </label>
            <div class="text-center">
                <button class="btn btn-primary" id="update">Update</button>
            <button class="btn btn-danger" id="cancelEdit">Cancel</button>
            </div>
        </div>
    </form>
</div>
@endsection