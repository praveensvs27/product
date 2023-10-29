<!--<!DOCTYPE html>
<html>
<head>
    <title>Laravel Ajax CRUD Product</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>-->
@extends('layout')

@section('content')
<div class="container">
    <h1>Laravel Ajax CRUD Product</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> Create New Product</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Details</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
     
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" >
                        </div>
						
                    </div>
       
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Details</label>
                        <div class="col-sm-12">
                            <textarea id="detail" name="detail"  placeholder="Enter Details" class="form-control"></textarea>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-4 control-label">Unit Type</label>
                        <div class="col-sm-12">
                            <select id="unit_type" name="unit_type"   class="form-control">
							     <option>Select</option>
								 
							</select>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-sm-4 control-label">Category</label>
                        <div class="col-sm-12">
                            <select id="category_id" name="category_id"   class="form-control" multiple>
							     <option>Select</option>
								 
							</select>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="" maxlength="50" >
						</div>
                    </div>
					
					<div class="form-group">
                        <label class="col-sm-2 control-label">Discount Percentage</label>
                        <div class="col-sm-12">
                            
							<input type="text" class="form-control" id="discount_percentage" name="discount_percentage" placeholder="Enter Discount Percentage" value="" maxlength="50" >
						</div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-2 control-label">Discount Amount</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="discount_amount" name="discount_amount" placeholder="Enter Discount Amount" value="" maxlength="50" >
						</div>
                    </div>
					
					<div class="form-group">
                        <label class="col-sm-2 control-label">Tax Percentage</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="tax_percentage" name="tax_percentage" placeholder="Enter Tax Percentage" value="" maxlength="50" >
						</div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-2 control-label">Tax Amount</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="tax_amount" name="tax_amount" placeholder="Enter Tax Amount" value="" maxlength="50" >
						</div>
                    </div>
					
					
        
                    <div class="col-sm-offset-2 col-sm-10">
					<div id="error_status"></div>
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
					
					
                </form>
            </div>
        </div>
    </div>
</div>
      
</body>
      
<script type="text/javascript">
  $(function () {
      
    /*------------------------------------------
     --------------------------------------------
     Pass Header Token
     --------------------------------------------
     --------------------------------------------*/ 
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
     
	$.ajax({
          //data: $('#productForm').serialize(),
          url: "{{ url('unit-view') }}",
		  
          type: 'get',
          dataType: 'json',
          success: function (data) {
               console.log(data);
              //data = $.parseJSON(data);
				$.each(data, function(i, item) {
				unit_option = '<option value='+item.id+'>'+item.unit_type+'</option>';
			//alert(set_unit);
			$("#unit_type").append(unit_option);
			});
		  }
		}); 
		
	$.ajax({
          //data: $('#productForm').serialize(),
          url: "{{ url('category-view') }}",
		  
          type: 'get',
          dataType: 'json',
          success: function (data) {
               console.log(data);
              //data = $.parseJSON(data);
				$.each(data, function(i, item) {
				category_option = '<option value='+item.id+'>'+item.category+'</option>';
			//alert(set_unit);
			$("#category_id").append(category_option);
			});
           
          }
		
		
		});
	 
    /*------------------------------------------
    --------------------------------------------
    Render DataTable
    --------------------------------------------
    --------------------------------------------*/
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('products-ajax-crud.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'detail', name: 'detail'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
      
    /*------------------------------------------
    --------------------------------------------
    Click to Button
    --------------------------------------------
    --------------------------------------------*/
    $('#createNewProduct').click(function () {
        $('#saveBtn').val("create-product");
        $('#product_id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("Create New Product");
        $('#ajaxModel').modal('show');
		
    });
      
    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.editProduct', function () {
      var product_id = $(this).data('id');
      $.get("{{ route('products-ajax-crud.index') }}" +'/' + product_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Product");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#product_id').val(data.id);
          $('#name').val(data.name);
          $('#detail').val(data.detail);
		  $('#unit_type').val(data.unit_id).change();
      })
    });
      
    /*------------------------------------------
    --------------------------------------------
    Create Product Code
    --------------------------------------------
    --------------------------------------------*/
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
      
        $.ajax({
          data: $('#productForm').serialize(),
          url: "{{ route('products-ajax-crud.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
       
              $('#productForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
           
          },
          error: function (data) {
			  
              console.log('Error:', data.status);
			  if(data.status=='422'){
				  console.log('Error1:', data.status);
				  $('#error_status').html('Enter All Entries');
			  }
              $('#saveBtn').html('Save Changes');
          }
      });
    });
      
    /*------------------------------------------
    --------------------------------------------
    Delete Product Code
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.deleteProduct', function () {
     
        var product_id = $(this).data("id");
        confirm("Are You sure want to delete !");
        
        $.ajax({
            type: "DELETE",
            url: "{{ route('products-ajax-crud.store') }}"+'/'+product_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
       
  });
</script>
@endsection
</html>