
@extends('admin.layouts.app')
@section('title','Manage Blog')
@section('content')
<div id="BlogMainDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">

    <div class="row">
      <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary float-left">Blogs Lists</h6></div>
      <div class="col-md-6"> <button id="addNewBlog" class="btn btn-primary btn-sm font-weight-bold float-right"><i class="fa fa-plus"></i> Add New</button></div>
    </div>

     
      <table id="BlogDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
        	<th class="th-sm">ID</th>
            <th class="th-sm">Blog Title</th>
        	<th class="th-sm">Author</th>
        	<th class="th-sm">Description</th>
        	<th class="th-sm">Main Image</th>
            <th class="th-sm">Status</th>
        	<th class="th-sm">Edit</th>
        	<th class="th-sm">Delete</th>
          </tr>
        </thead>
        <tbody id="BlogTableBody">

        </tbody>
      </table>
    </div>
  </div>
</div>
<div id="loaderBlogDiv" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    </div>
  </div>
</div>
<div id="WrongBlogDiv" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !</h3>
    </div>
  </div>
</div>

<!-- modal for delete Blog -->
<div class="modal fade" id="deleteBlogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Delete Blog</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
         <h5 class="modal-title" id="deleteModalBlogId"> </h5>
       	<h5 class="modal-title">Are you sure to delete this Blog!!</h5>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id="BlogDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- modal for update Blogs -->
<div class="modal fade" id="UpdateBlogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="width:40%;"> 
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Blog</h5>
        <h5 id="UpdateBlogId" class="d-none"> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div id="UpdateBlogLoader" class="container">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          </div>
        </div>
      </div>

      <div id="WrongBlogUpdate" class="container d-none">
        <div class="row">
          <div class="col-md-12 text-center p-5">
            <h3>Something Went Wrong !</h3>
          </div>
        </div>
      </div>


      <div class="modal-body d-none" id="updateBlogModalDNone">

                <div class="mg-b-5">
                        <input id="UpdateBlogNameId" type="text" class="form-control w-100 mb-3" placeholder="Blog Name">
                       
                        <div class="mb-3">
                        <label for="">Select Tags</label><br>
                        @foreach($tags as $tag)
                            
                            <label for="UpdateTagName"><input type="checkbox" name="UpdateTagName[]" class="UpdateTagName mr-1" value="{{$tag->id}}"><span class="mr-3">{{$tag->tag_name}}</span></label>
                        @endforeach
                        </div>

                        <select name="UpdateBlogTopic" id="UpdateBlogTopic" class="UpdateBlogTopic form-control my-3">
                        <option>Select Topic</option>
                        @foreach($topics as $topic)
                            <option value="{{$topic->id}}">{{$topic->topic_name}}</option>
                        @endforeach
                        </select>

                        <textarea name="" id="UpdateblogDescId" class="summernote form-control mb-3" cols="30" rows="10"></textarea>

                        <img id="UpdateBlogImgView" class="UpdateBlogImgView img-fluid my-3" src="" alt="">

                        <input type="file" name="" id="UpdateBlogImg" class="form-control mb-3">
                   
                        <select name="updatestatus" id="UpdateBlogStatus" class="BlogStatus form-control">
                        <option>Status Select</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        </select>

                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button  id="BlogUpdateConfirmBtn" type="button" class="btn  btn-sm btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>


<!-- modal for adding Blog -->

 <!-- LARGE MODAL -->
       <div id="addBlogModal" class="modal fade">
          <div class="modal-dialog modal-lg" role="document" style="width:40%;">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add New Blog</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body pd-20 mg-b-5">
                <div class="mg-b-5">
                        <input id="BlogNameId" type="text" class="form-control w-100 mb-3" placeholder="Blog Name">
                   
                        <div class="mb-3">
                        <label for="">Select Tags</label><br>
                        @foreach($tags as $tag)
                            
                            <label for="tagName"><input type="checkbox" name="" class="tagName mr-1" value="{{$tag->id}}"><span class="mr-3">{{$tag->tag_name}}</span></label>
                        @endforeach
                        </div>

                        <select name="BlogTopic" id="BlogTopic" class="BlogTopic form-control my-3">
                        <option>Select Topic</option>
                        @foreach($topics as $topic)
                            <option value="{{$topic->id}}">{{$topic->topic_name}}</option>
                        @endforeach
                        </select>

                       <input type="file" name="" id="BlogImg" class="form-control mb-3">
                   
                        <select name="status" id="BlogStatus" class="BlogStatus form-control mb-3">
                        <option>Status Select</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        </select>

                        <textarea name="" id="blogDescId" class="summernote form-control mb-3" cols="30" rows="10" ></textarea>
                   
                        

                </div>
              </div><!-- modal-body -->
              <div class="modal-footer">
                <button id="BlogAddConfirmBtn" type="button" class="btn btn-info pd-x-20">Save changes</button>
                <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div><!-- modal-dialog -->
        </div><!-- modal -->



        <!-- modal for updae status -->
        <div class="modal fade" id="BlogStatusUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Change Blog Status</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  text-center">
                <div class="container">
                    <h5 class="modal-title" id="BlogStatusBlogId"> </h5>
                    <h5 class="modal-title">Are you sure to change Blog status!!</h5>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">No</button>
                    <button  id="BlogStatusConfirmBtn" type="button" class="btn btn-sm btn-primary">Yes</button>
                </div>
                </div>
            </div>
        </div>


@endsection
@section('script')
<script type="text/javascript">
getAllBlog();

function getAllBlog(){
  axios.get('/ShowAllBlog').then(function(response){

     if (response.status == 200) {
         $('#BlogMainDiv').removeClass('d-none');
         $('#loaderBlogDiv').addClass('d-none');

         $('#BlogDataTable').DataTable().destroy();
         $('#BlogTableBody').empty();


         

           var jsonData = response.data;
            $.each(jsonData, function(i, item){

                if (jsonData[i].status==1) {
                var status= 'Active';
                var finalStatus = "<a class='BlogStatusBtns btn btn-sm btn-success active text-white' data-id=" + jsonData[i].id + ">"+ status +"</a>"
                }else{
                  var status= 'Inactive';
                   var finalStatus = "<a class='BlogStatusBtns btn btn-sm btn-danger active text-white' data-id=" + jsonData[i].id + ">"+ status +"</a> "
                }
             $('<tr>').html(
                 "<td>"+jsonData[i].id+"</td>"+
                 "<td>"+jsonData[i].blog_name+"</td>"+
                 "<td>"+jsonData[i].blog_author+"</td>"+
                 "<td>"+jsonData[i].blog_description+"</td>"+
                 "<td><img class='img-fluid' src='"+jsonData[i].blog_main_img+"'></td>"+
                   "<td>"+ finalStatus +"</td>" +
                 "<td><a  class='BlogEditBtn' data-id=" + jsonData[i].id + "><i class='fa fa-edit fa-lg text-primary'></i></a></td>" +
                 "<td><a class='BlogDeleteBtn' data-id='" + jsonData[i].id + "'><div><i class='fa fa-lg fa-trash text-danger'></i></div></a></td>"
              ).appendTo('#BlogTableBody');
            });
             // show edit modal
             $('.BlogEditBtn').click(function(){
                $('#UpdateBlogModal').modal('show');
                var id = $(this).data('id');
                $('#UpdateBlogId').html(id);
                updateBlogDetails(id);
            });

            $('.BlogDeleteBtn').click(function(){
                $('#deleteBlogModal').modal('show');
                var id = $(this).data('id');
                $('#deleteModalBlogId').html(id);
            });

            $('.BlogStatusBtns').click(function(){
                $('#BlogStatusUpdate').modal('show');
                var id = $(this).data('id');
                $('#BlogStatusBlogId').html(id);
            });


       $('#BlogDataTable').DataTable({"order":false});
  
       $('.dataTables_length').addClass('bs-select');


     }else{
       $('#loaderBlogDiv').addClass('d-none');
        $('#WrongUpdate').removeClass('d-none');
     }

  }).catch(function(error){

    $('#loaderBlogDiv').addClass('d-none');
    $('#WrongBlogDiv').removeClass('d-none');
  });
}

// show edit data in update Blog form

function updateBlogDetails(id){
  axios.post('/BlogsDetails',{
    id:id
  }).then(function(response){
        if(response.status==200 && response.data){
            $('#updateBlogModalDNone').removeClass('d-none');
            $('#UpdateBlogLoader').addClass('d-none');
            var jsonData = response.data;
            $('#UpdateBlogNameId').val(jsonData?.blog_name);
            $('#UpdateBlogAuthorId').val(jsonData?.blog_author);
            $('#UpdateblogDescId').summernote('code',jsonData?.blog_description);
           
            var selectedCountries = JSON.parse(jsonData?.tag_name);
            console.log(jsonData);

            $('.UpdateTagName').each(function(i){
                
                if ( $(this).val()==parseInt(selectedCountries[i])) {
                    $(this).attr('checked',true);
                } else{
                    $(this).attr('checked',false);
                }
    
            });

            $('#UpdateBlogTopic').val(parseInt(jsonData?.topic_name));
            $('#UpdateBlogImgView').attr('src', jsonData?.blog_main_img);
            $('#UpdateBlogStatus').val(jsonData?.status);
        } else{
          $('#UpdateBlogLoader').addClass('d-none');
          $('#WrongBlogUpdate').removeClass('d-none');
        }
  }).catch(function(error){
    $('#UpdateBlogLoader').addClass('d-none');
    console.log(error);
    $('#WrongBlogUpdate').removeClass('d-none');
  })
}


// update Blog

$('#BlogUpdateConfirmBtn').click(function(){
   var id = $('#UpdateBlogId').html();
   var name = $('#UpdateBlogNameId').val();
   var description =$('#UpdateblogDescId').val();
//    var author = $('#UpdateBlogLocationId').val();
   var status =$('#UpdateBlogStatus').val();

   var updateblogTagName1 = [];
  $('.UpdateTagName:checked').each(function(i){
        updateblogTagName1[i] = $(this).val();
    });
    var updateblogTagName = JSON.stringify(updateblogTagName1);

  var UpdateBlogImg =$('#UpdateBlogImg')[0].files[0];
  
  var UpdateBlogTopic = $('#UpdateBlogTopic').val();

  var fd = new FormData();
  fd.append("id", id);
  fd.append("name", name);
  fd.append("description", description);
  fd.append("updateblogTagName", updateblogTagName);
  fd.append("UpdateBlogImg", UpdateBlogImg);
  fd.append("UpdateBlogTopic", UpdateBlogTopic);
  fd.append("status", status);

  
  
   $('#BlogUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/updateBlog',fd
  
  ).then(function(response){
          $('#BlogUpdateConfirmBtn').html("Save");
            if(response.status==200){
              if (response.data == 1) {
                $('#UpdateBlogModal').modal('hide');
                toastr.success('Update Blog Success');
              getAllBlog();
            } else {
                $('#UpdateBlogModal').modal('hide');
                toastr.error('Update Blog Fail');
              getAllBlog();
            }
          }
          else{
            $('#UpdateBlogModal').modal('hide');
             toastr.error('Something Went Wrong !');
          }
  }).catch(function(error){
    $('#UpdateBlogModal').modal('hide');
     toastr.error('Something Went Wrong !');
  })
})

// status update
$('#BlogStatusConfirmBtn').click(function(){
  var id = $('#BlogStatusBlogId').html();
  $('#BlogStatusConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/BlogsStatus',{
    id:id
  }).then(function(response){
    $('#BlogStatusConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#BlogStatusUpdate').modal('hide');
        toastr.success('Blog Status Change!!');
        getAllBlog();
      } else {
        $('#BlogStatusUpdate').modal('hide');
        toastr.error('Blog Status Change fail!!');
        getAllBlog();
      }
    } else {
      $('#BlogStatusUpdate').modal('hide');
      toastr.error('Something Went Worng!!');
    }
  }).catch(function(error){
    $('#BlogStatusUpdate').modal('hide');
    toastr.error(error);
  })
})

// delete BlogDeleteBtn

$('#BlogDeleteConfirmBtn').click(function(){
  var id = $('#deleteModalBlogId').html();
  $('#BlogDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
  axios.post('/BlogDelete',{
    id:id
  }).then(function(response){
    $('#BlogDeleteConfirmBtn').html('Yes');
    if (response.status==200) {
      if (response.data==1) {
        $('#deleteBlogModal').modal('hide');
        toastr.success('Blog delete successfully!!');
        getAllBlog();
      } else {
        $('#deleteBlogModal').modal('hide');
        toastr.error('Blog delete fail!!');
        getAllBlog();
      }
    } else {
      $('#deleteBlogModal').modal('hide');
      toastr.error('Something Went Worng!!');
    }

  }).catch(function(error){
    $('#deleteBlogModal').modal('hide');
    toastr.error('Something Went Worng!!');
  })
})

// add new Blog
$('#addNewBlog').click(function(){
  $('#addBlogModal').modal('show');
})

$('#BlogAddConfirmBtn').click(function(){
  var BlogName =$('#BlogNameId').val();
  var BlogImg =$('#BlogImg')[0].files[0];
  var blogDescId =$('#blogDescId').val();
  var BlogAuthorId =$('#BlogAuthorId').val();
  var blogTagName1 = [];
  $('.tagName:checked').each(function(i){
        blogTagName1[i] = $(this).val();
    });
    var blogTagName = JSON.stringify(blogTagName1);
// console.log(blogTagName);
  var BlogTopic = $('#BlogTopic').val();
  var status =$('#BlogStatus').val();
  addBlog(BlogName, BlogImg, BlogAuthorId, blogDescId, status, blogTagName, BlogTopic);
})
function addBlog(BlogName, BlogImg, BlogAuthorId, blogDescId, status, blogTagName, BlogTopic){
  $('#BlogAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

  var form_data = new FormData(); 
  form_data.append("blog_main_img", BlogImg);
  form_data.append("blog_name", BlogName);
  form_data.append("blog_author", BlogAuthorId);
  form_data.append("blog_description", blogDescId);
  form_data.append("blogTagName", blogTagName);
  form_data.append("BlogTopic", BlogTopic);
  form_data.append("status", status);


  axios.post('/CreateNewBlog', form_data
  ).then(function(response){
      $('#BlogAddConfirmBtn').html("Save");
      if(response.status==200){
              if (response.data == 1) {
                $('#addBlogModal').modal('hide');
                $('#BlogNameId').val('');
                $('#BlogUrlId').val('');
                $('#BlogLocationId').val('');
                $('#BlogStatus').val('');
                toastr.success('Add Success');
                getAllBlog();
            } else {
                $('#addBlogModal').modal('hide');
                toastr.error('Add Fail');
                getAllBlog();
            }
          }
  }).catch(function(error){
    $('#addBlogModal').modal('hide');
    toastr.error('Something Went Wromg');
  });
}
$('.summernote').summernote({
height: 150,
placeholder: 'Write blog description...'
})
</script>
@endsection
