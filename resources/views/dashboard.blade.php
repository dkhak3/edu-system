<title>Dashboard</title>
@extends('layout')
@section('content')

<div class="dashboard-children active subjectRender">
    {{-- Heading --}}
    <div class="mb-5 d-flex justify-content-between align-items-center">
        <div class="">
            <h1 class="dashboard-heading">
                Dashboard
            </h1>
            <p class="dashboard-short-desc">Overview dashboard monitor</p>
        </div>
    </div>
</div>

<script>
    // Change menu item active
    document.querySelector('#dashboard').classList.add('active');

</script>

@endsection
