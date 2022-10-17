
@extends('admin.layouts.app')
@section('title','Manage Topics')
@section('content')
<div id="TopicMainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

    <div class="row">
      <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary float-left">Topics Lists</h6></div>
      <div class="col-md-6"> <button id="addNewTopic" class="btn btn-primary btn-sm font-weight-bold float-right"><i class="fa fa-plus"></i> Add New</button></div>
    </div>

     
      <table id="TopicDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
        	<th class="th-sm">ID</th>
            <th class="th-sm">Topic Name</th>
            <th class="th-sm">Topic Icon</th>
            <th class="th-sm">Status</th>
        	<th class="th-sm">Edit</th>
        	<th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="TopicTableBody">

        </tbody>
      </table>
    </div>
  </div>
</div>
<div id="loaderTopicDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
  </div>
</div>
<div id="WrongTopicDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !</h3>
    </div>
  </div>
</div>

<!-- modal for delete Topic -->
<div class="modal fade" id="deleteTopicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Delete Topic</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
         <h5 class="modal-title" id="deleteModalTopicId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this Topic!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id="TopicDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- modal for update Topics -->
<div class="modal fade" id="UpdateTopicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="width:40%;"> 
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Topic</h5>
        <h5 id="UpdateTopicId" class="d-none"> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div id="UpdateTopicLoader" class="container">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          </div>
        </div>
      </div>

      <div id="WrongTopicUpdate" class="container d-none">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <h3>Something Went Wrong !</h3>
          </div>
        </div>
      </div>


      <div class="modal-body d-none text-center" id="updateTopicModalDNone">

                <div class="mg-b-5">
                        <input id="UpdateTopicNameId" type="text" class="form-control w-100 mb-3" placeholder="Topic Name">
                        <input id="UpdateTopicIconId" type="text" class="form-control w-100 mb-3" placeholder="Topic Icon">
                        
                        <select name="updatestatus" id="UpdateTopicStatus" class="TopicStatus form-control">
                        <option>Status Select</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        </select>

                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button  id="TopicUpdateConfirmBtn" type="button" class="btn  btn-sm btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>


<!-- modal for adding Topic -->

 <!-- LARGE MODAL -->
       <div id="addTopicModal" class="modal fade">
          <div class="modal-dialog modal-lg" role="document" style="width:40%;">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add New Topic</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body pd-20 mg-b-5">
                <div class="mg-b-5">
                        <input id="TopicNameId" type="text" class="form-control w-100 mb-3" placeholder="Topic Name">
                        <input id="TopicIcon" type="text" class="form-control w-100 mb-3" placeholder="Topic Icon">
                        
                        <select name="status" id="TopicStatus" class="TopicStatus form-control">
                        <option>Status Select</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        </select>

                </div>
              </div><!-- modal-body -->
              <div class="modal-footer">
                <button id="TopicAddConfirmBtn" type="button" class="btn btn-info pd-x-20">Save changes</button>
                <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div><!-- modal-dialog -->
        </div><!-- modal -->



        <!-- modal for updae status -->
        <div class="modal fade" id="TopicStatusUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Change Topic Status</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                <div class="container">
                    <h5 class="modal-title" id="TopicStatusTopicId"> </h5>
                    <h5 class="modal-title">Are you sure to change Topic status!!</h5>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">No</button>
                    <button  id="TopicStatusConfirmBtn" type="button" class="btn btn-sm btn-primary">Yes</button>
                </div>
                </div>
            </div>
        </div>


@endsection
@section('script')
<script type="text/javascript">
getAllTopic();

function getAllTopic(){
  axios.get('/ShowAllTopic').then(function(response){

     if (response.status == 200) {
         $('#TopicMainDiv').removeClass('d-none');
         $('#loaderTopicDiv').addClass('d-none');

         $('#TopicDataTable').DataTable().destroy();
         $('#TopicTableBody').empty();


         

           var jsonData = response.data;
            $.each(jsonData, function(i, item){

                if (jsonData[i].status==1) {
                var status= 'Active';
                var finalStatus = "<a class='TopicStatusBtns btn btn-sm btn-success active text-white' data-id=" + jsonData[i].id + ">"+ status +"</a>"
                }else{
                  var status= 'Inactive';
                   var finalStatus = "<a class='TopicStatusBtns btn btn-sm btn-danger active text-white' data-id=" + jsonData[i].id + ">"+ status +"</a> "
                }
             $('<tr>').html(
                 "<td>"+jsonData[i].id+"</td>"+
                 "<td>"+jsonData[i].topic_name+"</td>"+
                 "<td>"+jsonData[i].topic_icon+"</td>"+
                   "<td>"+ finalStatus +"</td>" +
                 "<td><a  class='TopicEditBtn' data-id=" + jsonData[i].id + "><i class='fa fa-edit fa-lg text-primary'></i></a></td>" +
                 "<td><a class='TopicDeleteBtn' data-id='" + jsonData[i].id + "'><div><i class='fa fa-lg fa-trash text-danger'></i></div></a></td>"
              ).appendTo('#TopicTableBody');
            });
             // show edit modal
             $('.TopicEditBtn').click(function(){
                $('#UpdateTopicModal').modal('show');
                var id = $(this).data('id');
                $('#UpdateTopicId').html(id);
                updateTopicDetails(id);
            });

            $('.TopicDeleteBtn').click(function(){
                $('#deleteTopicModal').modal('show');
                var id = $(this).data('id');
                $('#deleteModalTopicId').html(id);
            });

            $('.TopicStatusBtns').click(function(){
                $('#TopicStatusUpdate').modal('show');
                var id = $(this).data('id');
                $('#TopicStatusTopicId').html(id);
            });


       $('#TopicDataTable').DataTable({"order":false});
  
       $('.dataTables_length').addClass('bs-select');


     }else{
       $('#loaderTopicDiv').addClass('d-none');
        $('#WrongUpdate').removeClass('d-none');
     }

  }).catch(function(error){

    $('#loaderTopicDiv').addClass('d-none');
    $('#WrongTopicDiv').removeClass('d-none');
  });
}

// show edit data in update Topic form

function updateTopicDetails(id){
  axios.post('/TopicsDetails',{
    id:id
  }).then(function(response){
        if(response.status==200 && response.data){
            $('#updateTopicModalDNone').removeClass('d-none');
            $('#UpdateTopicLoader').addClass('d-none');
            var jsonData = response.data;
            $('#UpdateTopicNameId').val(jsonData?.topic_name);
            $('#UpdateTopicIconId').val(jsonData?.topic_icon);
            $('#UpdateTopicStatus').val(jsonData?.status);
        } else{
          $('#UpdateTopicLoader').addClass('d-none');
          $('#WrongTopicUpdate').removeClass('d-none');
        }
  }).catch(function(error){
    $('#UpdateTopicLoader').addClass('d-none');
    console.log(error);
    $('#WrongTopicUpdate').removeClass('d-none');
  })
}


// update Topic

$('#TopicUpdateConfirmBtn').click(function(){
   var id = $('#UpdateTopicId').html();
   var name = $('#UpdateTopicNameId').val();
   var icon = $('#UpdateTopicIconId').val();
   var status =$('#UpdateTopicStatus').val();
  
   $('#TopicUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/updateTopic',{id:id, name:name,icon:icon, status:status}
  
  ).then(function(response){
          $('#TopicUpdateConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#UpdateTopicModal').modal('hide');
                toastr.success('Update Topic Success');
              getAllTopic();
            } else {
                $('#UpdateTopicModal').modal('hide');
                toastr.error('Update Topic Fail');
              getAllTopic();
            }
          }
          else{
            $('#UpdateTopicModal').modal('hide');
             toastr.error('Something Went Wrong !');
          }
  }).catch(function(error){
    $('#UpdateTopicModal').modal('hide');
     toastr.error('Something Went Wrong !');
  })
})

// status update
$('#TopicStatusConfirmBtn').click(function(){
  var id = $('#TopicStatusTopicId').html();
  $('#TopicStatusConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/TopicsStatus',{
    id:id
  }).then(function(response){
    $('#TopicStatusConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#TopicStatusUpdate').modal('hide');
        toastr.success('Topic Status Change!!');
        getAllTopic();
      } else {
        $('#TopicStatusUpdate').modal('hide');
        toastr.error('Topic Status Change fail!!');
        getAllTopic();
      }
    } else {
      $('#TopicStatusUpdate').modal('hide');
      toastr.error('Something Went Worng!!');
    }
  }).catch(function(error){
    $('#TopicStatusUpdate').modal('hide');
    toastr.error(error);
  })
})

// delete TopicDeleteBtn

$('#TopicDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalTopicId').html();
  $('#TopicDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/TopicDelete',{
    id:id
  }).then(function(response){
    $('#TopicDeleteConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#deleteTopicModal').modal('hide');
        toastr.success('Topic delete successfully!!');
        getAllTopic();
      } else {
        $('#deleteTopicModal').modal('hide');
        toastr.error('Topic delete fail!!');
        getAllTopic();
      }
    } else {
      $('#deleteTopicModal').modal('hide');
      toastr.error('Something Went Worng!!');
    }

  }).catch(function(error){
    $('#deleteTopicModal').modal('hide');
    toastr.error('Something Went Worng!!');
  })
})

// add new Topic
$('#addNewTopic').click(function(){
  $('#addTopicModal').modal('show');
})

$('#TopicAddConfirmBtn').click(function(){
  var TopicName =$('#TopicNameId').val();
  var TopicIcon =$('#TopicIcon').val();
  var status =$('#TopicStatus').val();
  addTopic(TopicName, TopicIcon, status);
})
function addTopic(TopicName,TopicIcon, status){
  $('#TopicAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

  var form_data = new FormData(); 
  form_data.append("TopicName", TopicName);
  form_data.append("TopicIcon", TopicIcon);
  form_data.append("status", status);


  axios.post('/CreateNewTopic', form_data
  ).then(function(response){
      $('#TopicAddConfirmBtn').html("Save");
      if(response.status==200){
              if (response.data == 1) {
                $('#addTopicModal').modal('hide');
                $('#TopicNameId').val('');
                $('#TopicIcon').val('');
                $('#TopicStatus').val('');
                toastr.success('Add Success');
                getAllTopic();
            } else {
                $('#addTopicModal').modal('hide');
                toastr.error('Add Fail');
                getAllTopic();
            }
          }
  }).catch(function(error){
    $('#addTopicModal').modal('hide');
    toastr.error('Something Went Wromg');
  });
}

</script>
@endsection
