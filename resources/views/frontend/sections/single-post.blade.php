<section class="page-title parallax">
    <div data-parallax="scroll" data-image-src="{{ asset('frontend/images/bg/18.jpg') }}" class="parallax-bg"></div>
    <div class="parallax-overlay">
        <div class="centrize">
            <div class="v-center">
                <div class="container">
                    <div class="title center">
                        <h1 class="upper">This is our blog<span class="red-dot"></span></h1>
                        <h4>We have a few tips for you.</h4>
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
            <div class="col-md-8">
                <article class="post-single">
                    <div class="post-info text-center">
                        <h2><a href="#">{{$single_post->title}}</a></h2>
                        <h6 class="upper"><span>By</span><a href="#"> {{$single_post->author->fast_name}}
                                {{$single_post->author->last_name}}</a><span class="dot"></span><span>{{date('d F
                                Y',strtotime($single_post->created_at))}}</span><span class="dot"></span>
                            @foreach ($single_post->tag as $tag)
                            <a href="{{ route('blog.tag.page', $tag->slug) }}" class="post-tag">{{$tag->name}}</a>
                            @if (!$loop->last)
                            |
                            @endif
                            @endforeach
                        </h6>
                    </div>
                    @php
                    $featured= json_decode($single_post->featured);
                    @endphp

                    @if ($featured->post_type=='gallery')
                    <div class="post-media">
                        <div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true"
                            class="flexslider nav-outside">
                            <ul class="slides">
                                @foreach (json_decode($featured->gallery) as $item)
                                <li>
                                    <img src="{{ url('storage/posts/'.$item)}}" alt="">
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    @if ($featured->post_type=='standard')
                    <div class="post-media">
                        <a href="#">
                            <img src="{{ url('storage/posts/'.$featured->standard)}}" alt="">
                        </a>
                    </div>
                    @endif
                    @if ($featured->post_type=='video')
                    <div class="post-media">
                        <div class="media-video">
                            <iframe src="{{$featured->video}}" frameborder="0"></iframe>
                        </div>
                    </div>
                    @endif
                    @if ($featured->post_type=='audio')
                    <div class="post-media">
                        <div class="media-audio">
                            <iframe src="{{$featured->audio}}" frameborder="0"></iframe>
                        </div>
                    </div>
                    @endif
                    @if ($featured->post_type=='quote')
                    <blockquote class="italic">
                        <p>{{$featured->quote}}</p>
                    </blockquote>
                    @endif

                    <div class="post-body">
                        <p>
                            {!! htmlspecialchars_decode($single_post->content) !!}
                        </p>
                        
                    </div>
                </article>
                
                <!-- end of article-->
                {{-- <div id="comments">
                    <h5 class="upper">3 Comments</h5>
                    <ul class="comments-list">
                        <li>
                            <div class="comment">
                                <div class="comment-pic">
                                    <img src="frontend/images/team/1.jpg" alt="" class="img-circle">
                                </div>
                                <div class="comment-text">
                                    <h5 class="upper">Jesse Pinkman</h5><span class="comment-date">Posted on 29
                                        September at 10:41</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime distinctio et
                                        quam possimus velit dolor sunt nisi neque, harum, dolores rem incidunt, esse
                                        ipsa nam facilis eum doloremque numquam veniam.</p><a href="#"
                                        class="comment-reply">Reply</a>
                                </div>
                            </div>
                            <ul class="children">
                                <li>
                                    <div class="comment">
                                        <div class="comment-pic">
                                            <img src="frontend/images/team/2.jpg" alt="" class="img-circle">
                                        </div>
                                        <div class="comment-text">
                                            <h5 class="upper">Arya Stark</h5><span class="comment-date">Posted on 29
                                                September at 10:41</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque porro
                                                quae harum dolorem exercitationem voluptas illum ipsa sed hic, cum
                                                corporis autem molestias suscipit, illo laborum, vitae, dicta ullam
                                                minus.</p><a href="#" class="comment-reply">Reply</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="comment">
                                <div class="comment-pic">
                                    <img src="frontend/images/team/3.jpg" alt="" class="img-circle">
                                </div>
                                <div class="comment-text">
                                    <h5 class="upper">Rust Cohle</h5><span class="comment-date">Posted on 29 September
                                        at 10:41</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A deleniti sit beatae
                                        natus! Beatae velit labore, numquam excepturi, molestias reiciendis, ipsam quas
                                        iure distinctio quia, voluptate expedita autem explicabo illo.</p>
                                    <a href="#" class="comment-reply">Reply</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- end of comments-->
                <div id="respond">
                    <h5 class="upper">Leave a comment</h5>
                    <div class="comment-respond">
                        <form class="comment-form">
                            <div class="form-double">
                                <div class="form-group">
                                    <input name="author" type="text" placeholder="Name" class="form-control">
                                </div>
                                <div class="form-group last">
                                    <input name="email" type="text" placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea placeholder="Comment" class="form-control"></textarea>
                            </div>
                            <div class="form-submit text-right">
                                <button type="button" class="btn btn-color-out">Post Comment</button>
                            </div>
                        </form>
                    </div>
                </div> --}}
                <!-- end of comment form-->
            </div>
            @include('frontend.layouts.side-bar')
        </div>
    </div>
</section>