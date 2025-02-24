@extends('site.home.fr.master2L')
@section('name')
<section id="page-title" style="background-image: url({{asset('site/img/team/1.jpg')}}); background-repeat: no-repeat; background-size: cover;">

    <div class="container clearfix">
        <h1 style="color: aliceblue;">Articles</h1>
    </div>

</section>
<!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="row gutter-40 col-mb-80">
                <!-- Post Content
                ============================================= -->
                <div class="postcontent col-lg-9">

                    <div class="single-post mb-0">

                        <!-- Single Post
                        ============================================= -->
                        <div class="entry clearfix">

                            <!-- Entry Title
                            ============================================= -->
                            <div class="entry-title"></div>
                                <h3>{!!$ev->name_article!!}</h3>

                            <!-- .entry-title end -->

                            <!-- Entry Meta
                            ============================================= -->
                            <div class="entry-meta">
                                <ul>
                                    <li><i class="icon-calendar3"></i> {!!$ev->created_at!!}</li>
                                     Partager sur : 
                                     <li>
                                       
                                        <a href="https://facebook.com/sharer/sharer.php?u={{route('actud',Crypt::encrypt($ev->id))}}" class="social-icon si-borderless si-facebook">


                                            <i class="icon-facebook"></i>
                                            <i class="icon-facebook"></i>
                                        </a>
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{route('actud',Crypt::encrypt($ev->id))}}" class="social-icon si-borderless si-linkedin">

                                            <i class="icon-linkedin"></i>
                                            <i class="icon-linkedin"></i>
                                        </a>

                                    </li>


                                </ul>
                            </div>
                            <!-- .entry-meta end -->

                            <!-- Entry Image
                            ============================================= -->
                            <div class="entry-image">
                                <a href="#"><img src="{{asset('backend/images/blog')}}/{{$ev->image_article}}" alt="CYBER-CURE"  style="width: 20%; heigth: 20%;"></a>
                            </div>
                            <!-- .entry-image end -->

                            <!-- Entry Content
                            ============================================= -->
                             <div>

                                </div>
                                <div class="entry-content mt-0">
                                <p>{!!$ev->description_article!!}</p>
                                Mots Clés: @php

                                $Mat =  $ev->mot_cle_article;

                                $pars = explode(";", $Mat);


                                  if($pars == true){

                                      foreach ($pars as $part) {
                                     echo'<span class="btn btn-primary">';

                                     echo trim($part)." ";

                                     echo'</span>';

                                     echo" ";


                                 }



                             }

                            @endphp



                                <div class="clear"></div>

                                <!-- Post Single - Share
                                ============================================= -->
                              
                                <!-- Post Single - Share End -->

                            </div>
                        </div>
                        <!-- .entry end -->

                      

                        <!-- Post Author Info
                        ============================================= -->

                        <!-- Post Single - Author End -->

                       

                        


                        <!-- Comments
                        ============================================= -->

                        <!-- #comments end -->

                    </div>

                </div>
                <!-- .postcontent end -->

                <!-- Sidebar
                ============================================= -->
                <div class="sidebar col-lg-3">
                    <div class="sidebar-widgets-wrap">

                        <div class="widget clearfix">

                            <h4> </h4>
                            <div id="flickr-widget" class="flickr-feed masonry-thumbs grid-container" data-id="613394@N22" data-count="16" data-type="group" data-lightbox="gallery"></div>

                        </div>

                        <div class="widget clearfix">

                            <div class="tabs mb-0 clearfix" id="sidebar-tabs">

                                <ul class="tab-nav clearfix">
                                    <li><a href="#tabs-1">Articles recents</a></li>
                                </ul>

                                <div class="tab-container">


                                       <div class="tab-content clearfix" id="tabs-1">
                                        <div class="posts-sm row col-mb-30" id="popular-post-list-sidebar">
                                            @if ($art->isEmpty())
                                            Aucun Article trouvé
                                            @else
                                            @foreach ($art as $ar )
                                                <div class="entry col-12">
                                                    <div class="grid-inner row no-gutters">
                                                        <div class="col-auto">
                                                           
                                                        </div>
                                                        <div class="col pl-3">
                                                            <div class="entry-title"></div>
                                                                <h6><a href="{{route('actud',Crypt::encrypt($ev->id))}}">{{$ar->name_article}}</a></h6>
                                                            
                                                            <div class="entry-meta">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @endif
                                             

                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>



                    </div>
                </div>
                <!-- .sidebar end -->
            </div>

        </div>
    </div>
</section>
<!-- #content end -->

@endsection



