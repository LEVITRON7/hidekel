@extends('layout')

@section('styles')
    {!! Html::style('css/bootstrap-datetimepicker.min.css') !!} 
@endsection

@section('menu-user')    
@endsection
@section('content')

<div class="container"  style=" margin-top:60px;">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar border-right">
        <h3>Opciones principales</h3>          
        <div class="list-group">        
            <a href="/admin/members"  class="list-group-item {{ (Request::is('admin/members*') ? 'active' : '') }}">
            Miembros <?php  if(Request::is("admin/members*")){echo '&nbsp;<i class="fa fa-arrow-right"></i>';}?></a>
            @if (Auth::user()->type != 'admin')
            @else
            <a href="/admin/users" class="list-group-item {{ (Request::is('admin/users*') ? 'active' : '') }}">
            Usuarios <?php  if(Request::is("admin/users*")){echo '&nbsp;<i class="fa fa-arrow-right"></i>';}?></a>
            @endif
            <a href="/admin/events"     class="list-group-item {{ (Request::is('admin/events*') ? 'active' : '') }}" >
            Próximos eventos  <?php  if(Request::is("admin/events*")){echo '&nbsp;<i class="fa fa-arrow-right"></i>';}?></a>
            <a href="/admin/activities" class="list-group-item {{ (Request::is('admin/activities*') ? 'active' : '') }}" >
            Actividades <?php  if(Request::is("admin/activities*")){echo '&nbsp;<i class="fa fa-arrow-right"></i>';}?></a>

            <a href="/admin/materials"  class="list-group-item {{ (Request::is('admin/materials*') ? 'active' : '') }}">Materiales
            <?php  if(Request::is("admin/materials*")){echo '&nbsp;<i class="fa fa-arrow-right"></i>';}?>
            </a>
            
            <a href="/admin/materials/types"  class="list-group-item" ><small>Tipos  </small> <?php  if(Request::is("admin/materials/types*")){echo '&nbsp;<i class="fa fa-arrow-right"></i>';}?> </a>
            
            <a href="/admin/materials/topics"  class="list-group-item"> <small>Tópicos  </small><?php  if(Request::is("admin/materials/topics*")){echo '&nbsp;<i class="fa fa-arrow-right"></i>';}?></a>
            
            <a href="/admin/clubs"      class="list-group-item {{ (Request::is('admin/clubs*') ? 'active' : '') }}">
            Clubs  <?php  if(Request::is("admin/clubs*")){echo '&nbsp;<i class="fa fa-arrow-right"></i>';}?></a>
            
            <a href="/admin/clubs/roles"  class="list-group-item" ><small>Roles  </small> <?php  if(Request::is("admin/clubs/roles*")){echo '&nbsp;<i class="fa fa-arrow-right"></i>';}?> </a>
            
            <a href="/admin/clubs/classes"  class="list-group-item"> <small>Classes  </small><?php  if(Request::is("admin/clubs/classes*")){echo '&nbsp;<i class="fa fa-arrow-right"></i>';}?></a>
            
            <a href="/admin/clubs/ideals"  class="list-group-item"> <small>Ideales  </small><?php  if(Request::is("admin/clubs/ideals*")){echo '&nbsp;<i class="fa fa-arrow-right"></i>';}?></a>

            <a href="/admin/slides"     class="list-group-item {{ (Request::is('admin/slides*') ? 'active' : '') }}">
            Slides <?php  if(Request::is("admin/slides*")){echo '&nbsp;<i class="fa fa-arrow-right"></i>';}?></a>
        </div>
        </div>
        <div class="col-sm-6 col-md-8">
        @if(Session::has('messages'))
            <div class="alert alert-success">
                {{Session::get('messages')}}
                <i class="fa fa-check-circle"></i>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif            
        </div>

    @yield('side-center')

        <div class="col-sm-3 col-md-2 sidebar border-left fixme">

          <ul class="nav nav-sidebar">
           @if(isset($menu))
            <h3>Opciones</h3>
                @foreach($menu as $item)

                <{{{$item['type']}}} href="{{$item['href']}}" class="{{$item['class']}}"><?php if(!empty($item['i'])){ echo $item['i'];} ?>{{$item['text']}}</{{{$item['type']}}}>
                <hr style="margin-top:10px;" />
                @endforeach
          @endif
          @if(isset($members)&&Request::is('admin/members'))
                <br style="margin-top:10px;" />
                @include('app.admin.members.filter')
          @endif
          @if(isset($activities)&&Request::is('admin/activities'))
                <br style="margin-top:10px;" />
                @include('app.admin.activities.filter')
          @endif
          @if(isset($events))
                <br style="margin-top:10px;" />
                @include('app.admin.events.filter')
          @endif
          @if(isset($materials))
                <br style="margin-top:10px;" />
                @include('app.admin.materials.filter')
          @endif
          </ul>
        </div>

    </div>
</div>
@endsection
@section('scripts')
    {!! Html::script('js/fileinput.min.js') !!}
    {!! Html::script('js/fileinput_locale_es.js') !!}
    {!! Html::script('js/moment-with-locales.min.js') !!}
    {!! Html::script('js/bootstrap-datetimepicker.min.js') !!}
@endsection