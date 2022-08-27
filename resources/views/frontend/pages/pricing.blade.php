@extends('frontend.layouts.app')
@section('main')
<section class="page-title parallax">
    <div data-parallax="scroll" data-image-src="frontend/images/bg/10.jpg" class="parallax-bg"></div>
    <div class="parallax-overlay">
        <div class="centrize">
            <div class="v-center">
                <div class="container">
                    <div class="title center">
                        <h1 class="upper">Pricing Plans<span class="red-dot"></span></h1>
                        <h4>Pricing like it should be.</h4>
                        <hr>
                    </div>
                </div>
                <!-- end of container-->
            </div>
        </div>
    </div>
</section>
@include('frontend.sections.pricing-table')
@include('frontend.sections.counter')
@endsection