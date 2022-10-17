@extends('layouts.main')

@section('content')




  <main>

   @include('homecomponent.hero')





    <div class="main">

      <div class="container">

        <!--
          - BLOG SECTION
        -->

        <div class="blog">

          <h2 class="h2">Latest Blog Post</h2>

          <div class="blog-card-group">

          @include('homecomponent.allBlogs')

          

          </div>

          <!-- <button class="btn load-more">Load More</button> -->
          {{ $blogs->links() }}

        </div>





        <!--
          - ASIDE
        -->

        @include('homecomponent.aside')

      </div>

    </div>

  </main>



@endsection