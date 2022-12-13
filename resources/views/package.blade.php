@extends('layouts.app')

@section('header')
    Package List
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
        <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary addBtn">
    Add Package
    </button>
   
    <thead>
        <tr>
            <th>Package</th>
            <th>Treatment</th>
            <th>Type</th>
            <th>Commission</th>   
            <th>Action</th>                
        </tr>
    </thead>
    <tbody>
        @foreach ($packages as $package)
        <tr>
            <td>{{ $package->package }}</td>
            <td>{{ $package->treatment }}</td>
            <td>{{ $package->type }}</td>
            <td>{{ $package->commission }}</td>        
            <td> 
                <div class="btn-toolbar">
                <button type="button" class="btn btn-primary editBtn" value="{{ $package->id }}">Edit</button>
                
                <form method="POST" action="/package/{{ $package->id }}">
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
            <th>Package</th>
            <th>Treatment</th>
            <th>Type</th>
            <th>Commission</th>
            <th>Action</th> 
        </tr>
    </tfoot>
    

     <!-- Modal Add -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Package Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form id="packageForm" action="{{ route('package') }} " method="POST">
        @csrf
            <input type="hidden" id="id" name="id">
            <!-- <div class="form-group">
                <label for="id">ID</label>
                <input type="text" class="form-control" id="id" name="id">
            </div> -->
            <div class="form-group">
                <label for="package">Package</label>
                <input type="text" class="form-control" id="package" name="package">
            </div>
            <div class="form-group">
                <label for="treatment">Treatment</label>
                <input type="text" class="form-control" id="treatment" name="treatment">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" class="form-control" id="type" name="type">
            </div>
            <div class="form-group">
                <label for="commission">Commission</label>
                <input type="text" class="form-control" id="commission" name="commission">
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
            $('#package').val('');
            $('#treatment').val('');
            $('#type').val('');
            $('#commission').val('');
            $('#exampleModal').modal('show');
    })
    
</script>
<script>
    $(document).on('click', '.editBtn', function() {
        var id = $(this).val();
        $.get('package/' + id + '/edit', function (data) {
            // success
            $('#id').val(data.id);
            $('#package').val(data.package);
            $('#treatment').val(data.treatment);
            $('#type').val(data.type);
            $('#commission').val(data.commission);
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