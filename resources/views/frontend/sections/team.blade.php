<section>
  <div class="container">
    <div class="title center">
      <h4 class="upper">Passion. Dedition. Determination.</h4>
      <h2>The Team<span class="red-dot"></span></h2>
      <hr>
    </div>
    <div class="section-content">
      <div data-options="{&quot;items&quot;: 3, &quot;autoplay&quot;: true, &quot;margin&quot;: 30}"
        class="owl-carousel">
        @foreach ($all_teams as $item)
        <div class="team-member">
          <div class="team-image">
            <img src="{{ url('storage/teams/'. $item->photo)}}" alt="">
          </div>
          <div class="team-info">
            <h3>{{$item->name}}</h3><span>{{$item->designation}}</span>
          </div>
          <div class="team-social">
            <ul>
              @isset($item->facebook)
              <li><a href="{{$item->facebook}}" target="blank"><i class="ti-facebook"></i></a>
              </li>
              @endisset
              @isset($item->twitter)
              <li><a href="{{$item->twitter}}" target="blank"><i class="ti-twitter-alt"></i></a>
              </li>
              @endisset
              @isset($item->linkedin)
              <li><a href="{{$item->linkedin}}" target="blank"><i class="ti-linkedin"></i></a>
              </li>
              @endisset
              @isset($item->instagram)
              <li><a href="{{$item->instagram}}" target="blank"><i class="ti-instagram"></i></a>
              </li>
              @endisset
              @isset($item->dribble)
              <li><a href="{{$item->dribble}}" target="blank"><i class="ti-dribbble"></i></a>
              </li>
              @endisset
            </ul>
          </div>
        </div>
        @endforeach
        <!-- end of team member                      -->
      </div>
    </div>
    <!-- end of section content-->
  </div>
  <!-- end of container-->
</section>