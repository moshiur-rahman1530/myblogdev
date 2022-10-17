
@extends('admin.layouts.app')
@section('title','Manage Tags')
@section('content')
<div id="TagMainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

    <div class="row">
      <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary float-left">Tags Lists</h6></div>
      <div class="col-md-6"> <button id="addNewTag" class="btn btn-primary btn-sm font-weight-bold float-right"><i class="fa fa-plus"></i> Add New</button></div>
    </div>

     
      <table id="TagDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
        	<th class="th-sm">ID</th>
            <th class="th-sm">Tag Name</th>
            <th class="th-sm">Status</th>
        	<th class="th-sm">Edit</th>
        	<th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="TagTableBody">

        </tbody>
      </table>
    </div>
  </div>
</div>
<div id="loaderTagDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
  </div>
</div>
<div id="WrongTagDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !</h3>
    </div>
  </div>
</div>

<!-- modal for delete Tag -->
<div class="modal fade" id="deleteTagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Delete Tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
         <h5 class="modal-title" id="deleteModalTagId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this Tag!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id="TagDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- modal for update Tags -->
<div class="modal fade" id="UpdateTagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="width:40%;"> 
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Tag</h5>
        <h5 id="UpdateTagId" class="d-none"> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div id="UpdateTagLoader" class="container">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          </div>
        </div>
      </div>

      <div id="WrongTagUpdate" class="container d-none">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <h3>Something Went Wrong !</h3>
          </div>
        </div>
      </div>


      <div class="modal-body d-none text-center" id="updateTagModalDNone">

                <div class="mg-b-5">
                        <input id="UpdateTagNameId" type="text" class="form-control w-100 mb-3" placeholder="Tag Name ex: #mongodb">
                        <select name="updatestatus" id="UpdateTagStatus" class="TagStatus form-control">
                        <option>Status Select</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        </select>

                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button  id="TagUpdateConfirmBtn" type="button" class="btn  btn-sm btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>


<!-- modal for adding Tag -->

 <!-- LARGE MODAL -->
       <div id="addTagModal" class="modal fade">
          <div class="modal-dialog modal-lg" role="document" style="width:40%;">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add New Tag</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body pd-20 mg-b-5">
                <div class="mg-b-5">
                        <input id="TagNameId" type="text" class="form-control w-100 mb-3" placeholder="Tag Name. ex: #mongodb">
                      
                        <select name="status" id="TagStatus" class="TagStatus form-control">
                        <option>Status Select</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        </select>

                </div>
              </div><!-- modal-body -->
              <div class="modal-footer">
                <button id="TagAddConfirmBtn" type="button" class="btn btn-info pd-x-20">Save changes</button>
                <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div><!-- modal-dialog -->
        </div><!-- modal -->



        <!-- modal for updae status -->
        <div class="modal fade" id="TagStatusUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Change Tag Status</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                <div class="container">
                    <h5 class="modal-title" id="TagStatusTagId"> </h5>
                    <h5 class="modal-title">Are you sure to change Tag status!!</h5>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">No</button>
                    <button  id="TagStatusConfirmBtn" type="button" class="btn btn-sm btn-primary">Yes</button>
                </div>
                </div>
            </div>
        </div>


@endsection
@section('script')
<script type="text/javascript">
getAllTag();

function getAllTag(){
  axios.get('/ShowAllTag').then(function(response){

     if (response.status == 200) {
         $('#TagMainDiv').removeClass('d-none');
         $('#loaderTagDiv').addClass('d-none');

         $('#TagDataTable').DataTable().destroy();
         $('#TagTableBody').empty();


         

           var jsonData = response.data;
            $.each(jsonData, function(i, item){

                if (jsonData[i].status==1) {
                var status= 'Active';
                var finalStatus = "<a class='TagStatusBtns btn btn-sm btn-success active text-white' data-id=" + jsonData[i].id + ">"+ status +"</a>"
                }else{
                  var status= 'Inactive';
                   var finalStatus = "<a class='TagStatusBtns btn btn-sm btn-danger active text-white' data-id=" + jsonData[i].id + ">"+ status +"</a> "
                }
             $('<tr>').html(
                 "<td>"+jsonData[i].id+"</td>"+
                 "<td>"+jsonData[i].tag_name+"</td>"+
                   "<td>"+ finalStatus +"</td>" +
                 "<td><a  class='TagEditBtn' data-id=" + jsonData[i].id + "><i class='fa fa-edit fa-lg text-primary'></i></a></td>" +
                 "<td><a class='TagDeleteBtn' data-id='" + jsonData[i].id + "'><div><i class='fa fa-lg fa-trash text-danger'></i></div></a></td>"
              ).appendTo('#TagTableBody');
            });
             // show edit modal
             $('.TagEditBtn').click(function(){
                $('#UpdateTagModal').modal('show');
                var id = $(this).data('id');
                $('#UpdateTagId').html(id);
                updateTagDetails(id);
            });

            $('.TagDeleteBtn').click(function(){
                $('#deleteTagModal').modal('show');
                var id = $(this).data('id');
                $('#deleteModalTagId').html(id);
            });

            $('.TagStatusBtns').click(function(){
                $('#TagStatusUpdate').modal('show');
                var id = $(this).data('id');
                $('#TagStatusTagId').html(id);
            });


       $('#TagDataTable').DataTable({"order":false});
  
       $('.dataTables_length').addClass('bs-select');


     }else{
       $('#loaderTagDiv').addClass('d-none');
        $('#WrongUpdate').removeClass('d-none');
     }

  }).catch(function(error){

    $('#loaderTagDiv').addClass('d-none');
    $('#WrongTagDiv').removeClass('d-none');
  });
}

// show edit data in update Tag form

function updateTagDetails(id){
  axios.post('/TagsDetails',{
    id:id
  }).then(function(response){
        if(response.status==200 && response.data){
            $('#updateTagModalDNone').removeClass('d-none');
            $('#UpdateTagLoader').addClass('d-none');
            var jsonData = response.data;
            $('#UpdateTagNameId').val(jsonData?.tag_name);
            $('#UpdateTagStatus').val(jsonData?.status);
        } else{
          $('#UpdateTagLoader').addClass('d-none');
          $('#WrongTagUpdate').removeClass('d-none');
        }
  }).catch(function(error){
    $('#UpdateTagLoader').addClass('d-none');
    console.log(error);
    $('#WrongTagUpdate').removeClass('d-none');
  })
}


// update Tag

$('#TagUpdateConfirmBtn').click(function(){
   var id = $('#UpdateTagId').html();
   var name = $('#UpdateTagNameId').val();
   var status =$('#UpdateTagStatus').val();
  
   $('#TagUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/updateTag',{id:id, name:name, status:status}
  
  ).then(function(response){
          $('#TagUpdateConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#UpdateTagModal').modal('hide');
                toastr.success('Update Tag Success');
              getAllTag();
            } else {
                $('#UpdateTagModal').modal('hide');
                toastr.error('Update Tag Fail');
              getAllTag();
            }
          }
          else{
            $('#UpdateTagModal').modal('hide');
             toastr.error('Something Went Wrong !');
          }
  }).catch(function(error){
    $('#UpdateTagModal').modal('hide');
     toastr.error('Something Went Wrong !');
  })
})

// status update
$('#TagStatusConfirmBtn').click(function(){
  var id = $('#TagStatusTagId').html();
  $('#TagStatusConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/TagsStatus',{
    id:id
  }).then(function(response){
    $('#TagStatusConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#TagStatusUpdate').modal('hide');
        toastr.success('Tag Status Change!!');
        getAllTag();
      } else {
        $('#TagStatusUpdate').modal('hide');
        toastr.error('Tag Status Change fail!!');
        getAllTag();
      }
    } else {
      $('#TagStatusUpdate').modal('hide');
      toastr.error('Something Went Worng!!');
    }
  }).catch(function(error){
    $('#TagStatusUpdate').modal('hide');
    toastr.error(error);
  })
})

// delete TagDeleteBtn

$('#TagDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalTagId').html();
  $('#TagDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/TagDelete',{
    id:id
  }).then(function(response){
    $('#TagDeleteConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#deleteTagModal').modal('hide');
        toastr.success('Tag delete successfully!!');
        getAllTag();
      } else {
        $('#deleteTagModal').modal('hide');
        toastr.error('Tag delete fail!!');
        getAllTag();
      }
    } else {
      $('#deleteTagModal').modal('hide');
      toastr.error('Something Went Worng!!');
    }

  }).catch(function(error){
    $('#deleteTagModal').modal('hide');
    toastr.error('Something Went Worng!!');
  })
})

// add new Tag
$('#addNewTag').click(function(){
  $('#addTagModal').modal('show');
})

$('#TagAddConfirmBtn').click(function(){
  var TagName =$('#TagNameId').val();
  var status =$('#TagStatus').val();
  addTag(TagName, status);
})
function addTag(TagName, status){
  $('#TagAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

  var form_data = new FormData(); 
  form_data.append("TagName", TagName);
  form_data.append("status", status);


  axios.post('/CreateNewTag', form_data
  ).then(function(response){
      $('#TagAddConfirmBtn').html("Save");
      if(response.status==200){
              if (response.data == 1) {
                $('#addTagModal').modal('hide');
                $('#TagNameId').val('');
                $('#TagIcon').val('');
                $('#TagStatus').val('');
                toastr.success('Add Success');
                getAllTag();
            } else {
                $('#addTagModal').modal('hide');
                toastr.error('Add Fail');
                getAllTag();
            }
          }
  }).catch(function(error){
    $('#addTagModal').modal('hide');
    toastr.error('Something Went Wromg');
  });
}

</script>
@endsection
