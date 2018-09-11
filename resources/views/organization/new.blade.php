@extends('master.layout')
@section('title', $title )

@section('content')
<section class="">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    {!! Form::open(['url' => '/organization/save','class' => 'form-auth-small', 'method' => 'post','files' => true]) !!}
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="control-label">Title : </label>
                <input type="text" class="form-control" id="title" name="title" value="" placeholder="ชื่อ" required>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="URL" class="control-label">Url : </label>
                <div class="input-group">
                    <span class="input-group-addon">/organization/page/</span>
                    <input type="text" name="url" id="url" class="form-control" placeholder="my-organization">
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="description" class="control-label">Description : </label>
                <textarea class="form-control" id="description" name="description" rows="3" style="resize : none;"></textarea>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="Image" class="control-label">Image : </label>
                <input class="form-control" type="file" name="image" id="image" required>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="" class="control-label">สถานะ : </label>
                <select class="form-control use-select2" name="status" id="status">
                    <option value="pb">Public</option>
                    <option value="pv">Private</option>
                </select>
            </div>
        </div>

        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-success">Create Organization</button>
            <?= link_to('/organization', $title = 'Cancel', ['class' => 'btn btn-warning'], $secure = null); ?>
        </div>
    </div>
    {!! Form::close() !!}
</section>
@endsection