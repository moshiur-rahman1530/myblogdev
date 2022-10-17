 <!--
      - #HERO SECTION
    -->
    <div class="hero">

      <div class="container">

        <div class="left">

          <h1 class="h1">
            Hi, I'm <b>{{$data->hero_title}}</b>
            <br>{{$data->hero_designation}}
          </h1>

          <p class="h3">
            Specialized in <abbr title="Accessibility">PHP</abbr>
            and Laravel
          </p>

          <div class="btn-group">
            <a href="#" class="btn btn-sm btn-primary">Contact Me</a>
            <a href="#" class="btn btn-sm btn-secondary">About Me</a>
          </div>

        </div>

        <div class="right">

          <div class="pattern-bg"></div>
          <div class="img-box">
            <img src="{{$data->hero_image}}" alt="Julia Walker" class="hero-img">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
          </div>

        </div>

      </div>

    </div>