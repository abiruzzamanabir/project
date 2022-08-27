<section class="pb-50 pt-50">
    <div class="container">
        <div data-options="{&quot;items&quot;: 6, &quot;autoplay&quot;: true, &quot;margin&quot;: 100, &quot;mdItems&quot;: 5, &quot;smItems&quot;: 4, &quot;xsItems&quot;: 3}"
            class="owl-carousel">
            @foreach ($all_client as $item)    
            <div class="client">
                <img src="{{ url('storage/clients/'. $item->photo) }}" alt="">
            </div>
            @endforeach
        </div>
    </div>
    <!-- end of container-->
</section>