<body>

        <form id="test">
        @csrf
            
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
        

<script>

  $("test").validate({
    rules: {
      package: "required", 
      treatment: "required", 
      type: "required",      
      commission: "required",     
    },
    messages: {
    package: "Please enter a value",
    treatment: "Please enter a value",
    type: "Please enter a value",    
    commission: "Please enter a value",
    },    
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

</script>
</body>
