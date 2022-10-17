
@extends('admin.layouts.app')
@section('title','Manage Menu')
@section('content')
<div id="MenuMainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

    <div class="row">
      <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary float-left">Menus Lists</h6></div>
      <div class="col-md-6"> <button id="addNewMenu" class="btn btn-primary btn-sm font-weight-bold float-right"><i class="fa fa-plus"></i> Add New</button></div>
    </div>

     
      <table id="MenuDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
        	<th class="th-sm">ID</th>
            <th class="th-sm">Menu Name</th>
        	<th class="th-sm">Url</th>
        	<th class="th-sm">Location</th>
            <th class="th-sm">Status</th>
        	<th class="th-sm">Edit</th>
        	<th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="MenuTableBody">

        </tbody>
      </table>
    </div>
  </div>
</div>
<div id="loaderMenuDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
  </div>
</div>
<div id="WrongMenuDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !</h3>
    </div>
  </div>
</div>

<!-- modal for delete Menu -->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Delete Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
         <h5 class="modal-title" id="deleteModalMenuId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this Menu!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id="MenuDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- modal for update Menus -->
<div class="modal fade" id="UpdateMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="width:40%;"> 
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Menu</h5>
        <h5 id="UpdateMenuId" class="d-none"> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div id="UpdateMenuLoader" class="container">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          </div>
        </div>
      </div>

      <div id="WrongMenuUpdate" class="container d-none">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <h3>Something Went Wrong !</h3>
          </div>
        </div>
      </div>


      <div class="modal-body d-none text-center" id="updateMenuModalDNone">

                <div class="mg-b-5">
                        <input id="UpdateMenuNameId" type="text" class="form-control w-100 mb-3" placeholder="Menu Name">
                        <input id="UpdateMenuUrlId" type="text" class="form-control mb-3" placeholder="Menu Url">
                   
                        <select name="updatelocation" id="UpdateMenuLocationId" class="UpdateMenuLocationId form-control mb-3">
                        <option>Location Select</option>
                        <option value="main">Main</option>
                        <option value="footer1">Fotter First</option>
                        <option value="footer2">Fotter Second</option>
                        </select>
                   
                        <select name="updatestatus" id="UpdateMenuStatus" class="MenuStatus form-control">
                        <option>Status Select</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        </select>

                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button  id="MenuUpdateConfirmBtn" type="button" class="btn  btn-sm btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>


<!-- modal for adding Menu -->

 <!-- LARGE MODAL -->
       <div id="addMenuModal" class="modal fade">
          <div class="modal-dialog modal-lg" role="document" style="width:40%;">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add New Menu</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body pd-20 mg-b-5">
                <div class="mg-b-5">
                        <input id="MenuNameId" type="text" class="form-control w-100 mb-3" placeholder="Menu Name">
                        <input id="MenuUrlId" type="text" class="form-control mb-3" placeholder="Menu Url">
                   
                        <select name="location" id="MenuLocationId" class="MenuLocationId form-control mb-3">
                        <option>Location Select</option>
                        <option value="main">Main</option>
                        <option value="footer1">Fotter First</option>
                        <option value="footer2">Fotter Second</option>
                        </select>
                   
                        <select name="status" id="MenuStatus" class="MenuStatus form-control">
                        <option>Status Select</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        </select>

                </div>
              </div><!-- modal-body -->
              <div class="modal-footer">
                <button id="MenuAddConfirmBtn" type="button" class="btn btn-info pd-x-20">Save changes</button>
                <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div><!-- modal-dialog -->
        </div><!-- modal -->



        <!-- modal for updae status -->
        <div class="modal fade" id="MenuStatusUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Change Menu Status</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                <div class="container">
                    <h5 class="modal-title" id="MenuStatusMenuId"> </h5>
                    <h5 class="modal-title">Are you sure to change Menu status!!</h5>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">No</button>
                    <button  id="MenuStatusConfirmBtn" type="button" class="btn btn-sm btn-primary">Yes</button>
                </div>
                </div>
            </div>
        </div>


@endsection
@section('script')
<script type="text/javascript">
getAllMenu();

function getAllMenu(){
  axios.get('/ShowAllMenu').then(function(response){

     if (response.status == 200) {
         $('#MenuMainDiv').removeClass('d-none');
         $('#loaderMenuDiv').addClass('d-none');

         $('#MenuDataTable').DataTable().destroy();
         $('#MenuTableBody').empty();


         

           var jsonData = response.data;
            $.each(jsonData, function(i, item){

                if (jsonData[i].status==1) {
                var status= 'Active';
                var finalStatus = "<a class='MenuStatusBtns btn btn-sm btn-success active text-white' data-id=" + jsonData[i].id + ">"+ status +"</a>"
                }else{
                  var status= 'Inactive';
                   var finalStatus = "<a class='MenuStatusBtns btn btn-sm btn-danger active text-white' data-id=" + jsonData[i].id + ">"+ status +"</a> "
                }
             $('<tr>').html(
                 "<td>"+jsonData[i].id+"</td>"+
                 "<td>"+jsonData[i].menu_name+"</td>"+
                 "<td>"+jsonData[i].menu_url+"</td>"+
                 "<td>"+jsonData[i].location+"</td>"+
                   "<td>"+ finalStatus +"</td>" +
                 "<td><a  class='MenuEditBtn' data-id=" + jsonData[i].id + "><i class='fa fa-edit fa-lg text-primary'></i></a></td>" +
                 "<td><a class='MenuDeleteBtn' data-id='" + jsonData[i].id + "'><div><i class='fa fa-lg fa-trash text-danger'></i></div></a></td>"
              ).appendTo('#MenuTableBody');
            });
             // show edit modal
             $('.MenuEditBtn').click(function(){
                $('#UpdateMenuModal').modal('show');
                var id = $(this).data('id');
                $('#UpdateMenuId').html(id);
                updateMenuDetails(id);
            });

            $('.MenuDeleteBtn').click(function(){
                $('#deleteMenuModal').modal('show');
                var id = $(this).data('id');
                $('#deleteModalMenuId').html(id);
            });

            $('.MenuStatusBtns').click(function(){
                $('#MenuStatusUpdate').modal('show');
                var id = $(this).data('id');
                $('#MenuStatusMenuId').html(id);
            });


       $('#MenuDataTable').DataTable({"order":false});
  
       $('.dataTables_length').addClass('bs-select');


     }else{
       $('#loaderMenuDiv').addClass('d-none');
        $('#WrongUpdate').removeClass('d-none');
     }

  }).catch(function(error){

    $('#loaderMenuDiv').addClass('d-none');
    $('#WrongMenuDiv').removeClass('d-none');
  });
}

// show edit data in update Menu form

function updateMenuDetails(id){
  axios.post('/MenusDetails',{
    id:id
  }).then(function(response){
        if(response.status==200 && response.data){
            $('#updateMenuModalDNone').removeClass('d-none');
            $('#UpdateMenuLoader').addClass('d-none');
            var jsonData = response.data;
            $('#UpdateMenuNameId').val(jsonData?.menu_name);
            $('#UpdateMenuUrlId').val(jsonData?.menu_url);
            $('#UpdateMenuLocationId').val(jsonData?.location);
            $('#UpdateMenuStatus').val(jsonData?.status);
        } else{
          $('#UpdateMenuLoader').addClass('d-none');
          $('#WrongMenuUpdate').removeClass('d-none');
        }
  }).catch(function(error){
    $('#UpdateMenuLoader').addClass('d-none');
    console.log(error);
    $('#WrongMenuUpdate').removeClass('d-none');
  })
}


// update Menu

$('#MenuUpdateConfirmBtn').click(function(){
   var id = $('#UpdateMenuId').html();
   var name = $('#UpdateMenuNameId').val();
   var url =$('#UpdateMenuUrlId').val();
   var location = $('#UpdateMenuLocationId').val();
   var status =$('#UpdateMenuStatus').val();
  
   $('#MenuUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/updateMenu',{id:id, name:name, url:url, location:location, status:status}
  
  ).then(function(response){
          $('#MenuUpdateConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#UpdateMenuModal').modal('hide');
                toastr.success('Update Menu Success');
              getAllMenu();
            } else {
                $('#UpdateMenuModal').modal('hide');
                toastr.error('Update Menu Fail');
              getAllMenu();
            }
          }
          else{
            $('#UpdateMenuModal').modal('hide');
             toastr.error('Something Went Wrong !');
          }
  }).catch(function(error){
    $('#UpdateMenuModal').modal('hide');
     toastr.error('Something Went Wrong !');
  })
})

// status update
$('#MenuStatusConfirmBtn').click(function(){
  var id = $('#MenuStatusMenuId').html();
  $('#MenuStatusConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/MenusStatus',{
    id:id
  }).then(function(response){
    $('#MenuStatusConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#MenuStatusUpdate').modal('hide');
        toastr.success('Menu Status Change!!');
        getAllMenu();
      } else {
        $('#MenuStatusUpdate').modal('hide');
        toastr.error('Menu Status Change fail!!');
        getAllMenu();
      }
    } else {
      $('#MenuStatusUpdate').modal('hide');
      toastr.error('Something Went Worng!!');
    }
  }).catch(function(error){
    $('#MenuStatusUpdate').modal('hide');
    toastr.error(error);
  })
})

// delete MenuDeleteBtn

$('#MenuDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalMenuId').html();
  $('#MenuDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/MenuDelete',{
    id:id
  }).then(function(response){
    $('#MenuDeleteConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#deleteMenuModal').modal('hide');
        toastr.success('Menu delete successfully!!');
        getAllMenu();
      } else {
        $('#deleteMenuModal').modal('hide');
        toastr.error('Menu delete fail!!');
        getAllMenu();
      }
    } else {
      $('#deleteMenuModal').modal('hide');
      toastr.error('Something Went Worng!!');
    }

  }).catch(function(error){
    $('#deleteMenuModal').modal('hide');
    toastr.error('Something Went Worng!!');
  })
})

// add new Menu
$('#addNewMenu').click(function(){
  $('#addMenuModal').modal('show');
})

$('#MenuAddConfirmBtn').click(function(){
  var MenuName =$('#MenuNameId').val();
  var MenuUrl =$('#MenuUrlId').val();
  var MenuLocation =$('#MenuLocationId').val();
  var status =$('#MenuStatus').val();
  addMenu(MenuName, MenuUrl, MenuLocation, status);
})
function addMenu(MenuName, MenuUrl, MenuLocation, status){
  $('#MenuAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

  var form_data = new FormData(); 
  form_data.append("MenuLocation", MenuLocation) ;
  form_data.append("MenuName", MenuName);
  form_data.append("MenuUrl", MenuUrl);
  form_data.append("status", status);


  axios.post('/CreateNewMenu', form_data
  ).then(function(response){
      $('#MenuAddConfirmBtn').html("Save");
      if(response.status==200){
              if (response.data == 1) {
                $('#addMenuModal').modal('hide');
                $('#MenuNameId').val('');
                $('#MenuUrlId').val('');
                $('#MenuLocationId').val('');
                $('#MenuStatus').val('');
                toastr.success('Add Success');
                getAllMenu();
            } else {
                $('#addMenuModal').modal('hide');
                toastr.error('Add Fail');
                getAllMenu();
            }
          }
  }).catch(function(error){
    $('#addMenuModal').modal('hide');
    toastr.error('Something Went Wromg');
  });
}


$('.summernote').summernote({
height: 150
})

</script>
@endsection
