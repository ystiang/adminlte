@extends('layouts.app')

@section('header')
    User Role
@endsection

@section('style')
<style>
    .addBtn {
      margin-bottom: 8px;
    }
  </style>
@endsection

@section('content')
<!-- Content Header (Page header) -->

<div class="content">
<html>

<body>
     
   
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th> 
            <th>Action</th>                          
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>                   
            <td>                 
                <div class="btn-toolbar">
                <button type="button" class="btn btn-primary editBtn" value="{{ $user->id }}">Edit</button>
                
                <form method="POST" action="/user/{{ $user->id }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    
                        <input type="submit" class="btn btn-danger delBtn" value="Delete">
                    
                </form>
                </div>
            </td>                 
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>  
            <th>Action</th>
        </tr>
    </tfoot>
    

     <!-- Modal Add -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form action="{{ route('user') }} " method="POST">
        @csrf
            <input type="hidden" id="id" name="id">
            <!-- <div class="form-group">
                <label for="id">ID</label>
                <input type="text" class="form-control" id="id" name="id">
            </div> -->
            <div class="form-group">
                <label for="package">Name</label>
                <input type="text" class="form-control" id="name" name="name" disabled>
            </div>
            <div class="form-group">
                <label for="treatment">Email</label>
                <input type="text" class="form-control" id="email" name="email" disabled>
            </div>
            <div class="form-group">
                <label for="type">Role</label>
                <input type="text" class="form-control" id="role" name="role">
            </div>
            

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
        </div>
        </div>
    </div>
    </div>
     
</body>
</html>
</div>
@endsection
@section('script')
<script>
    $(document).on('click', '.addBtn', function() {    
            $('#id').val('');
            $('#name').val('');
            $('#email').val('');
            $('#role').val('');            
            $('#exampleModal').modal('show');
    })
    
</script>
<script>
    $(document).on('click', '.editBtn', function() {
        var id = $(this).val();
        $.get('user/' + id + '/edit', function (data) {
            // success
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#role').val(data.role);            
            $('#exampleModal').modal('show');
        })
    });
</script>
<script>
    $('.delBtn').click(function(e) {
        e.preventDefault()
        if (confirm("Are you sure you want to DELETE?")) {
            $(e.target).closest('form').submit() 
        }
    });
</script>
@endsection