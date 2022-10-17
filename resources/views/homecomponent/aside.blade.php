<div class="aside">

          <div class="topics">

            <h2 class="h2">Topics</h2>

            <!-- <a href="#" class="topic-btn">
              <div class="icon-box">
                <ion-icon name="server-outline"></ion-icon>
              </div>

              <p>Database</p>
            </a>

            <a href="#" class="topic-btn">
              <div class="icon-box">
                <ion-icon name="accessibility-outline"></ion-icon>
              </div>

              <p>Accessibility</p>
            </a>

            <a href="#" class="topic-btn">
              <div class="icon-box">
                <ion-icon name="rocket-outline"></ion-icon>
              </div>

              <p>Web Performance</p>
            </a> -->

            @foreach($topics as $topic)
            <a href="{{url('/post/'.$topic->id)}}" class="topic-btn">
              <div class="icon-box">
                <ion-icon name="{{$topic->topic_icon}}"></ion-icon>
              </div>

              <p>{{$topic->topic_name}}</p>
            </a>
            @endforeach

          </div>
          <div class="tags">

            <h2 class="h2">Tags</h2>

            <div class="wrapper">
            @foreach($tags as $tag)
            <a href="{{url('/postByTag/'.$tag->id)}}"> <button class="hashtag" data-id="{{$tag->id}}">{{ $tag->tag_name }}</button></a>
            @endforeach
              <!-- <button class="hashtag">#mongodb</button>
              <button class="hashtag">#nodejs</button>
              <button class="hashtag">#a11y</button>
              <button class="hashtag">#mobility</button>
              <button class="hashtag">#inclusion</button>
              <button class="hashtag">#webperf</button>
              <button class="hashtag">#optimize</button>
              <button class="hashtag">#performance</button> -->

            </div>

          </div>

          <div class="contact">

            <h2 class="h2">Let's Talk</h2>

            <div class="wrapper">

              <p>
                Do you want to learn more about how I can help your company overcome problems? Let us have a
                conversation.
              </p>

              <ul class="social-link">

                <li>
                  <a href="#" class="icon-box discord">
                    <ion-icon name="logo-discord"></ion-icon>
                  </a>
                </li>

                <li>
                  <a href="#" class="icon-box twitter">
                    <ion-icon name="logo-twitter"></ion-icon>
                  </a>
                </li>

                <li>
                  <a href="#" class="icon-box facebook">
                    <ion-icon name="logo-facebook"></ion-icon>
                  </a>
                </li>

              </ul>

            </div>

          </div>

          <div class="newsletter">

            <h2 class="h2">Newsletter</h2>

            <div class="wrapper">

              <p>
                Subscribe to our newsletter to be among the first to keep up with the latest updates.
              </p>

              <!-- <form action="#"> -->
                <input type="email" name="email" id="subscribeemail" placeholder="Email Address" required>
                <span id="email-info">

                </span>

                <button onClick="sendSubscription();" type="submit" class="btn btn-sm btn-primary">Subscribe</button>
              <!-- </form> -->

            </div>

          </div>

        </div>