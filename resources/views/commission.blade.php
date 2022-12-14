@extends('layouts.app')

@section('header')
    Commission Report
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
    @role('admin')
    @else
    <button type="button" class="btn btn-primary addBtn">
    Add
    </button>
    @endrole
   
    <thead>
        <tr>
            <th>Date</th>
            <th>Name</th>
            <th>Card</th>
            <th>Treatment</th>   
            <th>Product/Course</th> 
            <th>Product</th>     
            <th>Course</th> 
            <th>Service</th> 
            <th>Commission</th>     
            <th>Action</th>                   
        </tr>
    </thead>
    <tbody>
        @foreach ($commissions as $commission)
        <tr>
            <td>{{ $commission->date }}</td>
            <td>{{ $commission->user_name }}</td>
            <td>{{ $commission->card }}</td>
            <td>{{ $commission->treatment }}</td>
            <td>{{ $commission->productcourse }}</td> 
            <td>{{ $commission->product }}</td>
            <td>{{ $commission->course }}</td>
            <td>{{ $commission->service }}</td>
            <td>{{ $commission->commission }}</td>        
            <td>                 
                <div class="btn-toolbar">
                <button type="button" class="btn btn-primary editBtn" value="{{ $commission->id }}">Edit</button>
                
                <form method="POST" action="/commission/{{ $commission->id }}">
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
            <th>Date</th>
            <th>Name</th>
            <th>Card</th>
            <th>Treatment</th>   
            <th>Product/Course</th> 
            <th>Product</th>     
            <th>Course</th> 
            <th>Service</th> 
            <th>Commission</th>
            <th>Action</th>
        </tr>
    </tfoot>
    

     <!-- Modal Add -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Commission Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form action="{{ route('commission') }} " method="POST">
        @csrf
            <input type="hidden" id="id" name="id">
            @role('admin')
            <input type="hidden" id="user_id" name="user_id">
            <div class="form-group">
                <label for="package">Name</label>
                <input type="text" class="form-control" id="user_name" name="user_name">
            </div>
            @else
            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" id="user_name" name="user_name" value="{{ Auth::user()->name }}">
            <div class="form-group">
                <label for="package">Name</label>
                <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
            </div>
            @endrole
            <div class="form-group">
                <label for="treatment">Card</label>
                <input type="text" class="form-control" id="card" name="card">
            </div>
            <div class="form-group">
                <label for="type">Treatment</label>
                <input type="text" class="form-control" id="treatment" name="treatment">
            </div>
            <div class="form-group">
                <label for="commission">Product/Course</label>
                <input type="text" class="form-control" id="productcourse" name="productcourse">
            </div>  
            <div class="form-group">
                <label for="package">Product</label>
                <input type="text" class="form-control" id="product" name="product">
            </div>
            <div class="form-group">
                <label for="treatment">Course</label>
                <input type="text" class="form-control" id="course" name="course">
            </div>
            <div class="form-group">
                <label for="type">Service</label>
                <input type="text" class="form-control" id="service" name="service">
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
            
            $('#card').val('');
            $('#treatment').val('');
            $('#productcourse').val('');
            $('#product').val('');
            $('#course').val('');
            $('#service').val('');            
            $('#commission').val('');
            $('#exampleModal').modal('show');
    })
    
</script>
<script>
    $(document).on('click', '.editBtn', function() {
        var id = $(this).val();
        $.get('commission/' + id + '/edit', function (data) {
            // success
            $('#id').val(data.id);
            $('#user_id').val(data.user_id);
            $('#user_name').val(data.user_name);
            $('#card').val(data.card);
            $('#treatment').val(data.treatment);
            $('#productcourse').val(data.productcourse);
            $('#product').val(data.product);
            $('#course').val(data.course);
            $('#service').val(data.service);            
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