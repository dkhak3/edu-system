<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Contacts</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  @include('auth.layout')


  <div class="container">
    <div id="add-popup" class="card">
      <div class="card-header pt-3 d-flex">
        <h2 class="mx-auto">ADD CONTACT</h2>
        <button id="btn-close-add-popup" class="btn border-0 p-0 mr-3"><i class="fas fa-times fa-lg"></i></button>
      </div>
      <div class="card-body">
        <form action="{{ route('contacts.store') }}" method="post" class="py-4" onsubmit="return checkFormInput()">
          @csrf
          <div class="mx-auto w-50">
            <div>
              <label for="name">Name:</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
              <div class="valid-feedback">Valid</div>
              <div class="invalid-feedback">Invalid</div>
            </div>

            <div class="mt-3">
              <label for="address">Address:</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
              <div class="valid-feedback">Valid</div>
              <div class="invalid-feedback">Invalid</div>
            </div>

            <div class="mt-3">
              <label for="phone">Phone:</label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone">
              <div class="valid-feedback">Valid</div>
              <div class="invalid-feedback">Invalid</div>
            </div>

            <div class="mt-3">
              <label for="birthday">Birthday:</label>
              <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Enter birthday">
              <div class="valid-feedback">Valid</div>
              <div class="invalid-feedback">Invalid</div>
            </div>
          </div>
          <button id="btn-submit" class="btn btn-success px-4 mx-auto mt-3 d-block">ADD</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <div class="container-fluid px-3">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
            <form action="{{ url('contacts') }}" class="form-inline" method="GET" onsubmit="return checkInputSearch()">
              <input class="form-control" name="keywords" id="keywords" type="search" placeholder="Search..."
                aria-label="Search">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </form>
          </li>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <div class="content-wrapper pt-3">
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          @if (Session::has('message'))
          <div class="alert alert-success" role="alert">
            {{ Session::get('message') }}
          </div>
          @endif

          <div class="card">
            <div class="card-header">
              <div class="row mt-2">
                <div class="col-md-3">
                  <h3>LIST OF CONTACTS</h3>
                </div>
                <div class="col-md-6">
                  <button id="btn_delete_items_selected" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#myModal">
                    <i class="fas fa-trash"></i>
                    Delete items selected
                  </button>
                </div>
                <div class="col-md-3 ms-auto">
                  <a href="{{ route('contacts.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i>
                    Add
                  </a>
                  <button class="btn btn-success" id="btn-add-popup">
                    <i class="fas fa-plus"></i>
                    Add (pop up)
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th><input type="checkbox" name="" id="checkbox_all"></th>
                    <th>ID</th>
                    <th width="15%">Name</th>
                    <th width="30%">Address</th>
                    <th>Phone</th>
                    <th>Birthday</th>
                    <th>Created at</th>
                    <th width="17%">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($allContacts as $item)
                  <tr id="contacts_ids{{$item->id}}" class="contacts">
                    <td><input type="checkbox" name="ids" id="{{ $item->id }}" class="checkbox" value="{{ $item->id }}">
                    </td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->birthday }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td class="">
                      <div class="d-flex">
                        <a href="{{ route('contacts.edit', $item->id) }}" class="btn btn-warning text-light">
                          <i class="fas fa-edit"></i>
                          Edit
                        </a>
                        <div class="mx-1"></div>
                        <form action="{{ route('contacts.destroy', $item->id) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                            Delete
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <div class="card-footer">
              {{ $allContacts->links() }}
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
  </div>
  <!-- /.content-wrapper -->

  <script src="{{ asset('js/index.js') }}"></script>



</body>

</html>