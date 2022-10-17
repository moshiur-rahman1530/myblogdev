@extends('admin.layouts.app')
@section('title','Settings')
@section('content')
<!-- ########## START: MAIN PANEL ########## -->

      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <a class="breadcrumb-item" href="index.html">Pages</a>
        <span class="breadcrumb-item active">Blank Page</span>
      </nav>

      @php 
        $data = App\Models\Settings::first();
      @endphp

      <div class="sl-pagebody">
        <div class="sl-page-title">
            <div class="card">
                <h5 class="card-header">Website Settings</h5>
                <div class="card-body">
                    <div class="form-group">
                        <label for="title_first_letter" class="col-form-label">Title First Letter <span class="text-danger">*</span></label>
                        <input type="text" id="title_first_letter" class="form-control" name="title_first_letter" required value="{{$data->title_first_letter}}">
                        @error('title_first_letter')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="title_remain_letter" class="col-form-label">Title Remaining<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title_remain_letter" name="title_remain_letter" required value="{{$data->title_remain_letter}}">
                        @error('title_remain_letter')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="title_sort_desc" class="col-form-label">Sort description for site<span class="text-danger">*</span></label>
                        <textarea class="form-control" name="title_sort_desc" id="title_sort_desc" cols="30" rows="10" required >{{$data->title_sort_desc}}</textarea>
                        @error('title_sort_desc')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="hero_title" class="col-form-label">Hero title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="hero_title" name="hero_title" required value="{{$data->hero_title}}">
                        @error('hero_title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="hero_designation" class="col-form-label">Hero designation<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="hero_designation" name="hero_designation" required value="{{$data->hero_designation}}">
                        @error('hero_designation')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="hero_sort_desc" class="col-form-label">Hero sort description<span class="text-danger">*</span></label>
                        <textarea class="form-control" name="hero_sort_desc" id="hero_sort_desc" cols="30" rows="10" required >{{$data->hero_sort_desc}}</textarea>
                        @error('hero_sort_desc')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                    <!-- vendor image 8 -->
                    <div class="vendor8 col-12 col-md-3">
                    <label for="hero_sort_desc" class="col-form-label">Hero image<span class="text-danger">*</span></label>
                        <input type="hidden" id="profile-photo8"  name="profile-photo8" value="{{$data->hero_image}}">
                        <img src="{{$data->hero_image}}" id="profile-photo8-preview" style="width:140px">
                        <input type="file" name="hero_img" id="hero_imgId">

                    </div>

                    <div class="vendor8 col-12 col-md-3">
                    <label for="hero_sort_desc" class="col-form-label">Site logo<span class="text-danger">*</span></label>
                        <input type="hidden" id="logo-photo"  name="logo-photo" value="{{$data->site_logo}}">
                        <img src="{{$data->site_logo}}" id="logo-photo-preview" style="width:140px">
                        <input type="file" name="logo_img" id="logo_imgId">

                    </div>


                    <div class="form-group mb-3 mt-3">
                    <button class="btn btn-success" id="settingsubmit" type="submit">Update</button>
                    </div>
                <!-- </form> -->
                </div>

                
            </div>
        </div><!-- sl-page-title -->

      </div><!-- sl-pagebody -->
    <!-- ########## END: MAIN PANEL ########## -->

@endsection
@section('script')

<script type="text/javascript">


    // $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    $("#settingsubmit").click(function(e) {
        e.preventDefault();
        var title_first_letter = $('#title_first_letter').val();
        var title_remain_letter = $('#title_remain_letter').val();
        var title_sort_desc = $('#title_sort_desc').val();
        var hero_title = $('#hero_title').val();
        var site_logo = $('#logo_imgId')[0].files[0];
        var hero_image = $('#hero_imgId')[0].files[0];
        var hero_designation = $('#hero_designation').val();
        var hero_sort_desc = $('#hero_sort_desc').val();    
        
        

        var form_data = new FormData(); 
        
        form_data.append("title_first_letter", title_first_letter);
        form_data.append("title_remain_letter", title_remain_letter);
        form_data.append("title_sort_desc", title_sort_desc);
        form_data.append("hero_title", hero_title);
        form_data.append("site_logo", site_logo);
        form_data.append("hero_image", hero_image);
        form_data.append("hero_designation", hero_designation);
        form_data.append("hero_sort_desc", hero_sort_desc);
        
console.log(form_data);
        axios.post('/setting/update', form_data
        ).then(function (response) {
                
            if (response.data==1) {
            toastr.success('Update Successfull!!');
            }else{
            toastr.error('Update Failed!!');
            }
        }).catch(function (error) {
        toastr.error('Something went wrong!!');
        })

    });



</script>

@endsection