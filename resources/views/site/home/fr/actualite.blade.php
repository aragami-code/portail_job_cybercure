@extends('site.home.fr.master')
@section('name')

<section id="page-title" style="background-image: url({{asset('site/img/team/10.jpg')}}); background-repeat: no-repeat; background-size: cover;">

    <div class="container clearfix">
        <h1 style="color: aliceblue;">Cyber-Actu</h1>
        <span style="color:#0c5b88;"></span>
        <!-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>{{asset('site/img/team/10.jpg')}}
            <li class="breadcrumb-item active" aria-current="page">Events</li>
        </ol> -->
    </div>

</section>
<!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="row">
                <div class="postcontent col-lg-9">

                    <div class="row">
                        @if ($art->isEmpty())

                        Aucun Article trouvé

                         @else

                        @foreach ($art as $articles )

                        <div class="entry event col-12">
                            <div class="grid-inner row no-gutters p-4">
                                <div class="entry-image col-md-2">
                                    <a href="#">
                                        <img src="{{asset('backend/images/blog')}}/{{$articles->image_article}}" alt="Image"  style="width: 80%; heigth: 80%;">

                                    </a>
                                </div>
                                <div class="col-md-10 pl-md-4">
                                    <div class="entry-title title-sm">
                                        <h2><a href="{{route('actualite')}}">{{$articles->name_article}}</a></h2>
                                    </div>
                                    <div class="entry-meta">
                                        <ul>
                                            <li><span class="badge badge-info py-1 px-2">{{$articles->name_categorie}}</span></li>
                                            <li><a href="#"><i class="icon-time"></i>{{$articles->created_at}}</a></li>
                                            <li><a href="#"><i class="icon-users"></i> {{$articles->nom_admin}}</a></li>
                                        </ul>
                                    </div>
                                    <div class="entry-content">
                                        <p>{{$articles->sommaire_article}}</p>

                                        <a href="{{route('actud',Crypt::encrypt($articles->id))}}"  id="quick-contact-form-submit" name="quick-contact-form-submit" class="button button-small button-3d m-0">Lire plus</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                        @endif






                    </div>

                    <!-- Pager
                    ============================================= -->
                    <div class="d-flex justify-content-between"> {{$art->links()}}
                    </div>
                    <!-- .pager end -->

                </div>

                <div class="sidebar col-lg-3">
                    <div class="sidebar-widgets-wrap">



                        <div class="widget">
                            <h4>Prochains évènements</h4>

                            <div id="oc-portfolio-sidebar" class="owl-carousel carousel-widget" data-items="1" data-margin="10" data-loop="true" data-nav="false" data-autoplay="5000">

                                @if ($ev->isEmpty())

                                Aucun Evenement trouvé

                                 @else

                                 @foreach ($ev as $evenement)

                                 <div class="portfolio-item">
                                    <div class="portfolio-image">
                                        <a href="portfolio-single.html">
                                            <img src="{{asset('backend/images/blog')}}/{{$evenement->image_evenement}}" alt="Image"  style="width: 30%; heigth: 30%;">

                                        </a>
                                        <div class="bg-overlay">
                                            <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="350">
                                                <a href="images/blog/full/1.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="zoomIn" data-hover-speed="350" data-lightbox="image"><i class="icon-line-plus"></i></a>
                                            </div>
                                            <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="350"></div>
                                        </div>
                                    </div>
                                    <div class="portfolio-desc center pb-0">
                                        <h3><a href="portfolio-single.html">#{{$evenement->name_evenement}}</a></h3>
                                        <span><a href="#">{{$evenement->sommaire_evenement}}</a></span>
                                    </div>
                                </div>

                                 @endforeach

                                 {{$ev->links()}}


                                 @endif



                            </div>
                        </div>



                        <div class="widget quick-contact-widget form-widget clearfix">

                            <h4>Nous Contactez</h4>
                            <div class="form-result"></div>
                            <form id="quick-contact-form" name="quick-contact-form" action="http://themes.semicolonweb.com/html/canvas/include/form.php" method="post" class="quick-contact-form mb-0">
                                <div class="form-process">
                                    <div class="css3-spinner">
                                        <div class="css3-spinner-scaler"></div>
                                    </div>
                                </div>

                                <input type="text" class="required sm-form-control input-block-level" id="quick-contact-form-name" name="quick-contact-form-name" value="" placeholder="Nom Complet" />
                                <input type="text" class="required sm-form-control email input-block-level" id="quick-contact-form-email" name="quick-contact-form-email" value="" placeholder="email" />
                                <textarea class="required sm-form-control input-block-level short-textarea" id="quick-contact-form-message" name="quick-contact-form-message" rows="4" cols="30" placeholder="Message"></textarea>
                                <input type="text" class="d-none" id="quick-contact-form-botcheck" name="quick-contact-form-botcheck" value="" />
                                <input type="hidden" name="prefix" value="quick-contact-form-">
                                <button type="submit" id="quick-contact-form-submit" name="quick-contact-form-submit" class="button button-small button-3d m-0" value="submit">Envoyer le mail</button>
                            </form>


                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- #content end -->
@endsection
@section('scripts')

<script>
test.....................
    $(function(){
      $('nav a[href^="#"]').click(function(){
        var the_id = $(this).attr("href");
        if(the_id ==='#'){
          return;
        }

        var posCible = $(the_id).offset().top -65;
        $('html, body').animate({scrollTop: posCible}, 'slow');
        return false;
      });
    })

        </script>


@endsection

