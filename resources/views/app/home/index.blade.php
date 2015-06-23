@extends('layout')

@section('content')
    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel" style=" margin-top:-10px;">
      <!-- Indicators -->
    <div class="carousel-inner" role="listbox">

        <?php $i=0; ?>
        @foreach($slides as $image)
            @if($i==0)
                <div class="item active">

                    <img class="img" src=
                    @if ($image->file== '')
                        'http://placehold.it/1200x600'
                    @else
                        '/images/slides/{{$image->file}}'
                    @endif
                    >
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>  {{ $image->title }} </h1>
                            <p>{{ str_limit($image->description,$limit = 100,'...') }} </p>
                            @if($image->event != null)
                            <?php 
                                $datetime2 = new DateTime('now');
                                $datetime1 = new DateTime($image->event->datetime_end);
                                 if($datetime1 > $datetime2 ){
                                    echo '<p><a class="btn btn-lg btn-success" href="'.route('events.show',$image->event->id).'"role="button"><i class="fa fa-eye"></i>Ver más</a></p>';
                                }else{
                                    echo '<p><a class="btn btn-lg btn-primary" href="'.route('activities.show',$image->event->id).'" role="button"><i class="fa fa-eye"></i>Ver más</a></p>';
                                }
                            ?>  
                            @endif                         
                        </div>
                    </div>
                </div>
            @else
                <div class="item">
                    <img class="img" src=
                    @if ($image->file== '')
                        'http://placehold.it/1200x600'
                    @else
                        '/images/slides/{{$image->file}}'
                    @endif
                    >
                    <div class="container">
                        <div class="carousel-caption">
                            <h1> {{ $image->title }} </h1>
                            <p>{{ str_limit($image->description,$limit = 100,'...') }} </p>
                            @if($image->event != null)
                            <?php 
                                $datetime2 = new DateTime('now');
                                $datetime1 = new DateTime($image->event->datetime_end);
                                 if($datetime1 > $datetime2 ){
                                    echo '<p><a class="btn btn-lg btn-success" href="'.route('events.show',$image->event->id).'"role="button"><i class="fa fa-eye"></i>Ver más</a></p>';
                                }else{
                                    echo '<p><a class="btn btn-lg btn-primary" href="'.route('activities.show',$image->event->id).'" role="button"><i class="fa fa-eye"></i>Ver más</a></p>';
                                }
                            ?>  
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            <?php $i++; ?>
        @endforeach
    </div>

    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div><!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class=" ">
    <center>
        @foreach($clubs as $club)
        <div class="col-lg-4">
            <img class="img" src=
            @if ($club->logo == '')
                'http://placehold.it/300x200'
            @else
                '/images/logos/{{$club->logo}}'
            @endif
            style="width: 140px; height: 140px;">

            <h2>{{$club->type }}<br>{{$club->name}}</h2>
            <p style="text-align:justify">{!! str_limit($club->description,$limit = 100,'...') !!} </p>
            <p><a class="btn btn-primary" href="" role="button"><i class="fa fa-eye"></i>Ver más</a></p>
        </div>
        @endforeach
    </center>
    </div><!-- /.row -->
 </div>
@endsection
