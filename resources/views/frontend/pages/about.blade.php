@extends('frontend.layouts.app')
@section('main')
<section class="page-title parallax">
  <div data-parallax="scroll" data-image-src="frontend/images/bg/5.jpg" class="parallax-bg"></div>
  <div class="parallax-overlay">
    <div class="centrize">
      <div class="v-center">
        <div class="container">
          <div class="title center">
            <h1 class="upper">About Studio<span class="red-dot"></span></h1>
            <h4>We are a small agency.</h4>
            <hr>
          </div>
        </div>
        <!-- end of container-->
      </div>
    </div>
  </div>
</section>
<section>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="title txt-sm-center txt-xs-center mt-0">
            <h3>This Is Our Story<span class="red-dot"></span></h3>
            <p class="serif">Voluptate reiciendis ducimus alias perspiciatis repellendus dolore voluptatibus dolor quae.</p>
            <hr>
          </div>
        </div>
        <div class="col-md-7 col-md-offset-1">
          <ul role="tablist" class="nav nav-tabs outline">
            <li role="presentation" class="active"><a href="#method-tab" role="tab" data-toggle="tab">Method</a>
            </li>
            <li role="presentation"><a href="#skills-tab" role="tab" data-toggle="tab">Skills</a>
            </li>
          </ul>
          <div class="tab-content">
            <div id="method-tab" role="tabpanel" class="tab-pane fade in active">
              <p class="alt-paragraph mb-15">Consectetur adipisicing elit. Nisi quibusdam adipisci dignissimos nihil cumque sapiente dolorem, laborum.</p>
              <p class="alt-paragraph mb-15">Aperiam maxime qui sed necessitatibus earum voluptatem nobis modi soluta, unde aliquid veniam reiciendis repudiandae voluptas possimus!</p>
              <p class="alt-paragraph">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur assumenda qui facilis magni quod quia quas recusandae cum rem amet, minus natus impedit autem dolores dolor, sed perspiciatis voluptate, est!</p>
            </div>
            <div id="skills-tab" role="tabpanel" class="tab-pane fade">
                @foreach ($all_skills as $item)                   
                <div class="skill"><span class="skill-name">{{$item->name}}</span><span class="skill-perc">{{$item->percentage}}%</span>
                  <div class="progress">
                    <div role="progressbar" data-progress="{{$item->percentage}}" class="progress-bar colored"></div>
                  </div>
                </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
      <!-- end of row                    -->
    </div>
    <!-- end of container                  -->
  </section>
  @include('frontend.sections.service')
@include('frontend.sections.team')
@include('frontend.sections.testimonial2')
@include('frontend.sections.footer-client')
@endsection