@extends('master.layout')
@section('title', $title )
@section('header', $header )

@section('content')
<section class="">
    @if($is_login)
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 10px;">
                <?= link_to('/organization/new', $title = 'Add Organization', ['class' => 'btn btn-primary'], $secure = null); ?>
            </div>
        </div>
    @endif
    {!! Form::open(['url' => url()->current(),'class' => 'form-auth-small', 'method' => 'get']) !!}
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <input type="text" class="form-control" id="title" name="title" value="" placeholder="คำค้นหา" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <button type="submit" class="btn btn-success">Search</button>
                <a href="/organization"><button type="button" class="btn btn-warning">Reset</button></a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <div class="row">
        @foreach($get_ogz as $k => $v)
        <div class="col-md-4 featured-responsive">
            <div class="featured-place-wrap">
                <a href="{{ url('/organization/page/'.$v->url) }}">
                    <img src="{{ url($v->image) }}" class="img-responsive" alt="#">
                    <div class="featured-title-box">
                        <h5 style="word-break: break-all">{{ str_limit($v->title,30) }}</h5>
                    </div>
                </a>
            </div>
        </div>
        @endforeach                    
    </div>
</section>
@endsection