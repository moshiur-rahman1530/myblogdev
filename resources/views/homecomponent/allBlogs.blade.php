
@forelse($blogs as $blog)
<div class="blog-card">

              <div class="blog-card-banner">
                <img src="{{$blog->blog_main_img}}" alt="Building microservices with Dropwizard, MongoDB & Docker"
                  width="250" class="blog-banner-img">
              </div>

              <div class="blog-content-wrapper">

                <button class="blog-topic text-tiny">{{$blog->topics->topic_name}}</button>

                <h3>
                  <a href="{{url('/blogdeatils/'.$blog->id.'/'.$blog->blog_name)}}" class="h3">
                    {{$blog->blog_name}}
                  </a>
                </h3>

                <p class="blog-text">
                  
              
                  {!! Str::limit(strip_tags($blog->blog_description), $limit = 170, $end = '...') !!}
                  
                </p>


                <div class="wrapper-flex">

                  <div class="profile-wrapper">
                    <img src="{{$blog->users->image}}" alt="Julia Walker" class="img-fluid" width="50">
                  </div>

                  <div class="wrapper">
                    <a href="#" class="h4">{{$blog->users->name}}</a>

                    <p class="text-sm">
                      <time datetime="2022-01-17">{{ \Carbon\Carbon::parse($blog->created_at)->isoFormat('MMM Do YYYY')}}</time>
                      <span class="separator"></span>
                      <ion-icon name="time-outline"></ion-icon>
                      <!-- <time datetime="PT3M">{{ \Carbon\Carbon::now()->subMinutes(1)->diffForHumans(null, true) }}</time> -->
                      <time datetime="PT3M">{{ $blog->created_at->diffForHumans(null, true)}}</time>
                    </p>
                  </div>

                </div>

              </div>
             
            </div>
             @empty
            <h3>No post found</h3>
            @endforelse