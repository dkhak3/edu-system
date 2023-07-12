@extends('layout')
<title>Update Lecturers</title>


@section('content')

{{-- New Lecturers --}}
<div class="dashboard-children active">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class="">
            <h1 class="dashboard-heading">
                Update Lecturers
            </h1>
            <p class="dashboard-short-desc">Update your lecturer id: <strong>{{$lecturer[0]->id}}</strong></p>
        </div>
    </div>
    
    {{-- Form --}}
    <form action="{{ route('edit',$lecturer[0]->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off" class="form-main" id="form-1">
        @csrf
        {{-- Name, Address --}}
        <div class="row">
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="lecturer_name">Name</label>
                    <div>
                        <input type="text" placeholder="Enter your name" name="lecturer_name" id="lecturer_name" class="form-control" value="{{$lecturer[0]->lecturer_name}}">
                    </div>
                    @if ($errors->has('lecturer_name'))
                        <span class="text-danger">{{ $errors->first('lecturer_name') }}</span>
                    @endif
                    <span class="form-message"></span>
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="lecturer_address">Address</label>
                    <div>
                        <input type="text" placeholder="Enter your address" name="lecturer_address" id="lecturer_address" class="form-control" value="{{$lecturer[0]->lecturer_address}}">
                    </div>
                    @if ($errors->has('lecturer_address'))
                        <span class="text-danger">{{ $errors->first('lecturer_address') }}</span>
                    @endif
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
                        <input type="text" placeholder="Enter your phone" name="lecturer_phone" id="lecturer_phone" class="form-control" value="{{$lecturer[0]->lecturer_phone}}">
                    </div>
                    @if ($errors->has('lecturer_phone'))
                        <span class="text-danger">{{ $errors->first('lecturer_phone') }}</span>
                    @endif
                    <span class="form-message"></span>
                </div>
            </div>
            <div class="col-md">
                <div class="form-input form-group">
                    <label for="lecturer_birthday">Birthday</label>
                    <div>
                        <input type="date" placeholder="Enter your birthday" name="lecturer_birthday" id="lecturer_birthday" class="form-control" value="{{$lecturer[0]->lecturer_birthday}}">
                    </div>
                    @if ($errors->has('lecturer_birthday'))
                        <span class="text-danger">{{ $errors->first('lecturer_birthday') }}</span>
                    @endif
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

<script src="{{ asset ('/js/formadd_edit.js') }}"></script>
@endsection