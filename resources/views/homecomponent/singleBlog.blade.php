@extends('layouts.main')

@section('content')




  <main>


    <div class="main">

      <div class="container">
      
        <div class="blog">
            <div class="blogMainImg">
                <img class="img-fluid"src="{{asset('/'.$blogDetails->blog_main_img)}}" alt="">
                <input type="hidden" name="blogId" id="blogId" value="{{$blogDetails->id}}">

            </div>
        <div class="blogHeading">
            <h2 class="blogHeadingTitle">
                {{$blogDetails->blog_name}}
            </h2>
            <div class="headingCom">
            <small>Posted By: <a href="">{{$blogDetails->users->name}}</a></small> | <small>Posted On: {{ \Carbon\Carbon::parse($blogDetails->created_at)->isoFormat('MMM Do YYYY')}}</small> | <small>Category: <a href="">{{$blogDetails->topics->topic_name}}</a></small>
            </div>
        </div>
        <div class="blog-description">
            {!! $blogDetails->blog_description !!}
        </div>
        <hr class="mt-4">


        <div class="section group" data-post="{{$blogDetails->id}}">
            <div class="col span_1_of_3">

             @auth
             <div class="panel-footer" data-id="{{ $blogDetails->id }}">
                    <span class="pull-right">
                        <span class="like-btn">
                            <i id="like{{$blogDetails->id}}" class="fas fa-thumbs-up pressLove {{$blogDetails->likes->contains('user_id',auth()->id()) ? 'redHeart' : ''}}"></i> <span id="like{{$blogDetails->id}}-bs3"> <span class="countLike"></span> people like this</span>
                        </span>
                    </span>
                </div>
                @else
                    <i class="fas fa-thumbs-up float-right pressWithoutLoginLike"> <span class="countLike"></span> people like this</i>
                @endauth

          <!-- fa-heart -->
            </div>
            <div class="col span_1_of_3">
                <i class="far fa-comment" aria-hidden="true"></i> {{count($blogDetails->comments)}}
                  comments
            </div>
            <div class="col span_1_of_3">
            </div>
        </div>


        @guest
            {{-- Show none --}}
        @else

        <div class="comment-area comment-area-style mt-5">
            <!-- <form action="{{route('comment.store', $blogDetails->id, $blogDetails->blog_name)}}" method="POST" > -->
                @csrf
                <div class="field has-margin-top">
                <label class="label mb-3">Add comment</label>
                <div class="control">
                    <textarea name="comment" class="form-control" autocomplete="true" id="comment" cols="30" rows="10" placeholder="Comments here" style="height: 100px"></textarea>
                </div>
                </div>
                <div class="control has-margin-top">
                <button id="buttonID" data-id="{{$blogDetails->id}}" data-title="{{$blogDetails->blog_name}}" type="submit" style="background-color: #47b784; padding:4px 10px; border-radius:20px; margin-top:10px;">
                    Submit
                </button>
                </div>
            <!-- </form> -->
        </div>

         <!-- load comment -->

        <div class="allcommentsStart mt-4">
            <h3>All Comments:</h3>
        <div class="commenShow" id="commenShow">
            
            </div>
        </div>

            <!-- load comment end -->
            
        @endguest


      

       </div>

       

        <!--
          - ASIDE
        -->

        @include('homecomponent.aside')

      </div>

    </div>

  </main>



@endsection

@section('script')

<script type="text/javascript">

var pusher = new Pusher('458fe42b72c3aa439607', {
    cluster: 'ap2'
    });

    var channel = pusher.subscribe('like-channel');
    channel.bind('like-event', function(data) {
        likesAll();
    });
    </script>

<script type="text/javascript">

// var meta_data = $('meta[name="meta_data"]');
//     $('.pressLove').click(function () {
//         if(meta_data.data('user') == 0){
//             toastr.error('Login First');
//             return;
//         }
//         var elem = $(this).parents('.section');
//         var data = {};
//         data.post_id = elem.data('post');
//         $.ajax({
//             url : 'like',
//             data,
//             success : function (data) {
//                 elem.find('.pressLove').text(data.likes);
//                 if(elem.find('.pressLove').hasClass('redHeart')){
//                     elem.find('.pressLove').removeClass('redHeart');
//                 }else{
//                     elem.find('.pressLove').addClass('redHeart');
//                 }
//             }
//      });
//     });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        $('.pressWithoutLoginLike').click(function(){  
            toastr.warning('Login first.');
            
        });

        likesAll();
        function likesAll(){
            var id = $('#blogId').val();
            console.log(id);
                // axios.post('/likesall',id).then(function(response){
                    axios.get('/likesall/'+id).then(function(response){
            console.log(response.data);
           var response = response.data
            $('.countLike').html(response.likes.length);
            }).catch(function(error){

            })
        }


    


    $('.pressLove').click(function(){    
            var id = $(this).parents(".panel-footer").data('id');
            console.log(id);
            var c = $('#'+this.id+'-bs3').html();
            var cObjId = this.id;
            var cObj = $(this);

            $.ajax({
               type:'POST',
               url:'/like',
               data:{id:id},
               success:function(data){
                console.log(data);
                  if(data==0){
                    // $('#'+cObjId+'-bs3').html(parseInt(c)-1);
                    $(cObj).removeClass("redHeart");
                    toastr.error('Like removed.');
                  }else{
                    // $('#'+cObjId+'-bs3').html(parseInt(c)+1);
                    $(cObj).addClass("redHeart");
                    toastr.success('Like added.');
                  }
               }
            });

        });      


// get all comment

// <div class='replies'><details open class='comment' id='comment-2'><a href='#comment-2' class='comment-border-link'><span class='sr-only'>Jump to comment-2</span></a><summary><div class='comment-heading'><div class='comment-voting'><button class='replayBtn' type='button'><span aria-hidden='true'>&#9650;</span><span class='sr-only'>Vote up</span></button><button class='replayBtn' type='button'><span aria-hidden='true'>&#9660;</span><span class='sr-only'>Vote down</span></button></div><div class='comment-info'><a href='#' class='comment-author'>"+jsonData[i].replies[i]?.userdata?.name+"</a><p class='m-0'> 3 days ago</p></div></div></summary><div class='comment-body'><p>"+jsonData[i].replies[i]?.message+"</p><button class='replayBtn repStyle' type='button' data-toggle='reply-form' data-target='comment-2-reply-form'>Reply</button><form method='POST' class='reply-form d-none' id='comment-2-reply-form'><textarea placeholder='Reply to comment' rows='4'></textarea><button class='replayBtn submitBtn' type='submit'>Submit</button><button type='button' class='replayBtn cancelBtn' data-toggle='reply-form' data-target='comment-2-reply-form'>Cancel</button></form></div></details><a href='#load-more'>Load more replies</a></div>


// <div class='comment-voting'><button type='button' class='replayBtn'><span aria-hidden='true'>&#9650;</span><span class='sr-only'>Vote up</span></button><button type='button' class='replayBtn'><span aria-hidden='true'>&#9660;</span><span class='sr-only'>Vote down</span></button></div>


getAllComment();

function getAllComment(){
    var id = $('#blogId').val();
    
  axios.get('/getAllComments/'+id).then(function(response){

     if (response.status == 200) {
       
        
           var jsonData = response.data;
           
           $('#commenShow').html('');

           var fragment="";

            $.each(jsonData, function(i, item){
                // console.log(jsonData[i].replies[i]?.userdata?.name);
                var rep = jsonData[i].replies;
                var nestedreply = item.nestedreplies;
                // console.log(nestedreply);
                // console.log(moment(jsonData[i].created_at, "YYYY-MM-DD").fromNow());
                // let date = moment(jsonData[i].created_at, "YYYY-MM-DD");
                // console.log(date.fromNow());

                fragment+="<div class='comment-thread my-2'><details open class='comment' id='comment-1'><a href='#comment-1' class='comment-border-link'><span class='sr-only'>Jump to comment-1</span></a><summary><div class='comment-heading'><img src='"+jsonData[i].user?.image+"' alt='"+jsonData[i].user?.name+"' style='width:40px; height:40px; border-radius:30px; margin:10px' /><div class='comment-info'><a href='#' class='comment-author'>"+jsonData[i].user?.name+"</a><p class='m-0'>"+moment(jsonData[i].created_at, "YYYY-MM-DD-hh-mm-ss").fromNow()+"</p></div></div></summary><div class='comment-body'> <p>"+jsonData[i].comment+"</p><button type='button' class='replayBtn repStyle' data-toggle='reply-form' data-target='"+jsonData[i].id+"'>Reply</button><div class='reply-form d-none' id='"+jsonData[i].id+"'><textarea id='replayCommenttext' class='replayCommenttext' placeholder='Reply to comment' rows='4'></textarea><button class='replayBtn submitBtn replayBtnSubmit' data-length='"+jsonData.length+"' data-id='"+jsonData[i].id+"' type='submit'>Submit</button><button class='replayBtn cancelBtn' type='button' data-toggle='reply-form' data-target='comment-1-reply-form'>Cancel</button></div><div class='replies repliesData'>";
                $.each(rep, function(i, value){
                    fragment+="<details open class='comment' id='comment-2'><a href='#comment-2' class='comment-border-link'><span class='sr-only'>Jump to comment-2</span></a><summary><div class='comment-heading'><img src='"+value?.userdata?.image+"' alt='"+value?.userdata?.name+"' style='width:40px; height:40px; border-radius:30px; margin:10px' /><div class='comment-info'><a href='#' class='comment-author'>"+value?.userdata?.name+"</a><p class='m-0'> "+moment(value.created_at, "YYYY-MM-DD-hh-mm-ss").fromNow()+"</p></div></div></summary><div class='comment-body'><p>"+value?.message+"</p><button class='replayBtn repStyle' type='button' data-toggle='reply-form' data-target='"+value.id+"'>Reply</button><div class='reply-form d-none' id='"+value.id+"'><textarea id='subTextArea' placeholder='Reply to comment' rows='4'></textarea><button class='replayBtn submitBtn subRepBtn' type='submit' data-id='"+value.comment_id+"' data-pid='"+value.id+"'>Submit</button><button type='button' class='replayBtn cancelBtn' data-toggle='reply-form' data-target='comment-2-reply-form'>Cancel</button></div></div> <div class='nestedReply'>";
                    if (nestedreply) {
                        $.each(nestedreply, function(index, val){

                            console.log(val?.userdata?.image);

                            fragment+="<details open class='comment' id='comment-2'><a href='#comment-2' class='comment-border-link'><span class='sr-only'>Jump to comment-2</span></a><summary><div class='comment-heading'><img src='"+val?.userdata?.image+"' alt='' style='width:40px; height:40px; border-radius:30px; margin:10px' /><div class='comment-info'><a href='#' class='comment-author'>"+val?.userdata?.name+"</a><p class='m-0'> "+moment(val.created_at, "YYYY-MM-DD-hh-mm-ss").fromNow()+"</p></div></div></summary><div class='comment-body'><p>"+val?.message+"</p><button class='replayBtn repStyle' type='button' data-toggle='reply-form' data-target='"+val.id+"'>Reply</button><div class='reply-form d-none' id='"+val.id+"'><textarea id='subTextArea' placeholder='Reply to comment' rows='4'></textarea><button class='replayBtn submitBtn subRepBtn' type='submit' data-id='"+val.comment_id+"' data-pid='"+val.id+"'>Submit</button><button type='button' class='replayBtn cancelBtn' data-toggle='reply-form' data-target='comment-2-reply-form'>Cancel</button></div></div></details>";

                        });
                    }
                    
                    fragment+="</div></details>";

                });
                fragment+="</div></details></div>";

                
                
             
            //  $('<div class="replies">').html(
            //      "<div class='comment-thread my-5'><details open class='comment' id='comment-1'><a href='#comment-1' class='comment-border-link'><span class='sr-only'>Jump to comment-1</span></a><summary><div class='comment-heading'><div class='comment-voting'><button type='button' class='replayBtn'><span aria-hidden='true'>&#9650;</span><span class='sr-only'>Vote up</span></button><button type='button' class='replayBtn'><span aria-hidden='true'>&#9660;</span><span class='sr-only'>Vote down</span></button></div><div class='comment-info'><a href='#' class='comment-author'>"+jsonData[i].user?.name+"</a><p class='m-0'>22 points &bull;"+moment(jsonData[i].created_at, "YYYY-MM-DD-hh-mm-ss").fromNow()+"</p></div></div></summary><div class='comment-body'> <p>"+jsonData[i].comment+"</p><button type='button' class='replayBtn repStyle' data-toggle='reply-form' data-target='"+jsonData[i].id+"'>Reply</button><div class='reply-form d-none' id='"+jsonData[i].id+"'><textarea id='replayCommenttext' class='replayCommenttext' placeholder='Reply to comment' rows='4'></textarea><button class='replayBtn submitBtn replayBtnSubmit' data-length='"+jsonData.length+"' data-id='"+jsonData[i].id+"' type='submit'>Submit</button><button class='replayBtn cancelBtn' type='button' data-toggle='reply-form' data-target='comment-1-reply-form'>Cancel</button></div><div class='replies repliesData'></div></div></details></div>"
            //   ).appendTo('#commenShow');

//                     $.each(rep, function(i, item){
// $('<div>').html("<details open class='comment' id='comment-2'><a href='#comment-2' class='comment-border-link'><span class='sr-only'>Jump to comment-2</span></a><summary><div class='comment-heading'><div class='comment-voting'><button class='replayBtn' type='button'><span aria-hidden='true'>&#9650;</span><span class='sr-only'>Vote up</span></button><button class='replayBtn' type='button'><span aria-hidden='true'>&#9660;</span><span class='sr-only'>Vote down</span></button></div><div class='comment-info'><a href='#' class='comment-author'>"+rep[i]?.userdata?.name+"</a><p class='m-0'> 3 days ago</p></div></div></summary><div class='comment-body'><p>"+rep[i]?.message+"</p><button class='replayBtn repStyle' type='button' data-toggle='reply-form' data-target='"+rep[i].id+"'>Reply</button><div class='reply-form d-none' id='"+rep[i].id+"'><textarea id='subTextArea' placeholder='Reply to comment' rows='4'></textarea><button class='replayBtn submitBtn subRepBtn' type='submit' data-id='"+jsonData[i].id+"' data-pid='"+rep[i].id+"'>Submit</button><button type='button' class='replayBtn cancelBtn' data-toggle='reply-form' data-target='comment-2-reply-form'>Cancel</button></div></div></details>").appendTo('.repliesData');

//                 });

            });

            $("#commenShow").append(fragment);
           

            // replay comment post
    $(".replayBtnSubmit").click(function (e) {
          e.preventDefault();
         //some logic here

         var id =$(this).data('id');
         var lengthData =$(this).data('length');

         let comment = $(this).closest('.reply-form').find('#replayCommenttext').val();

        //  var comment =$('#replayCommenttext').val();
        //  console.log(id);
         var form_data = new FormData(); 
        form_data.append("message", comment);
        form_data.append("id", id) ;

        axios.post('/comment-reply/', form_data
            ).then(function(response){
                if(response.status==200){
                        if (response.data == 1) {
                            $('#replayCommenttext').val('');
                            toastr.success('Add Success');

                            getAllComment();

                        } else {
                            toastr.error('Add Fail');
                        }
                    }
            }).catch(function(error){
                toastr.error('Something Went Wromg');
            });

    });
    // sub replay
    $(".subRepBtn").click(function (e) {
          e.preventDefault();
         //some logic here

         var id =$(this).data('id');
         var pid =$(this).data('pid');
        //  var comment =$('#subTextArea').val();
         let comment = $(this).closest('.reply-form').find('#subTextArea').val();

         console.log(id);
         console.log(pid);
         console.log(comment);

         var form_data = new FormData(); 
        form_data.append("message", comment);
        form_data.append("id", id) ;
        form_data.append("pid", pid) ;

        axios.post('/reply-comment-reply', form_data
            ).then(function(response){
                if(response.status==200){
                        if (response.data == 1) {
                            $('#subTextArea').val('');
                            toastr.success('Add Success');

                            getAllComment();

                        } else {
                            toastr.error('Add Fail');
                        }
                    }
            }).catch(function(error){
                toastr.error('Something Went Wromg');
            });
    });

           

     }else{
        $('#commenShow').html('<h4>Nothing Found</h4>');
     }

  }).catch(function(error){

  });
}



// end get all comment


     $("#buttonID").click(function (e) {
          e.preventDefault();
         //some logic here

         var id =$(this).data('id');
         var title =$(this).data('title');
         var comment =$('#comment').val();

         var form_data = new FormData(); 
        form_data.append("comment", comment) ;
        form_data.append("id", id) ;
        form_data.append("title", title) ;

        axios.post('/blogdeatilsComment', form_data
            ).then(function(response){
                if(response.status==200){
                        if (response.data == 1) {
                            $('#comment').val('');
                            toastr.success('Add Success');

                            getAllComment();

                        } else {
                            toastr.error('Add Fail');
                        }
                    }
            }).catch(function(error){
                toastr.error('Something Went Wromg');
            });

    });

    </script>


<script type="text/javascript">
    document.addEventListener(
        "click",
        function(event) {
            var target = event.target;
            var replyForm;
            if (target.matches("[data-toggle='reply-form']")) {
                replyForm = document.getElementById(target.getAttribute("data-target"));
                replyForm.classList.toggle("d-none");
            }
        },
        false
    );

   
</script>

<script type="text/javascript">

// Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;

    var pusher = new Pusher('458fe42b72c3aa439607', {
    cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
    // alert(JSON.stringify(data));

    // $('.comment-body').html(data);
    // $('#pval').html('');
    // $('#pval').html(JSON.stringify(data));
    getAllComment();
    });
</script>

@endsection