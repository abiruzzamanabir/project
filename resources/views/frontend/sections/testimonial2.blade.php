<section class="parallax">
    <div data-parallax="scroll" data-image-src="frontend/images/bg/27.jpg" class="parallax-bg"></div>
    <div class="parallax-overlay">
        <div class="container">
            <div class="title center">
                <h3>Customers Love Us<span class="red-dot"></span></h3>
                <hr>
            </div>
            <div class="section-content p-0">
                <div id="testimonials-slider"
                    data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true}"
                    class="flexslider nav-outside">
                    <ul class="slides">
                        @foreach ($all_testimonial as $item)
                        <li>
                            <blockquote>
                                <p>"{{$item->testimonial}}"</p>
                                <footer>{{$item->name}} - {{$item->company}}.</footer>
                            </blockquote>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- end of section content-->
        </div>
        <!-- end of container-->
    </div>
</section>