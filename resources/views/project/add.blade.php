@extends('default')
@section('content')
<div class="container">
    <h2> Add a new Project</h2>
</br>
<div class="row">
    <div class="col-md-10 col-md-push-1">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (count($errors) > 0)

            <strong>Oups !</strong> There was a problem :<br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
    
    @endif

        <form action="{{  URL::action("ProjectController@add", null) }}" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group form-group-label">
                <div class="row">
                    <div class="col-md-10 col-md-push-1">
                        <label class="floating-label" for="title">Name </label>
                        <input type="text" class="form-control" name="title" placeholder="Name of the project" data-hint="This field is required"/>
                    </div>
                </div>
            </div>


            <div class="form-group form-group-label">
                <div class="row">
                    <div class="col-md-10 col-md-push-1">
                        <label class="floating-label" for="description">Description </label>
                        <textarea name="description" class="form-control" placeholder="Description of the project"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group form-group-label">
                <div class="row">
                    <div class="col-md-10 col-md-push-1">
                        <label class="floating-label" for="repo">Repo</label>
                        <input type="text" class="form-control" name="repo" placeholder="comptedemo/mondepot"/>
                    </div>
                </div>
            </div>

            <div class="form-group form-group-label">
                <div class="row">
                    <div class="col-md-10 col-md-push-1">
                        <label class="floating-label" for="branch">Branch </label>
                        <input type="text" class="form-control" name="branch" placeholder="master"/>
                    </div>
                </div>
            </div>

            <div class="form-group form-group-label">
                <div class="row">
                    <div class="col-md-10 col-md-push-1">
                        <label class="floating-label" for="startDate">Start date </label>
                        <input type="date" name="startDate" class="form-control"/>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <div class="col-md-10 col-md-push-1">
                        <button class="btn btn-primary">Add</button>
                        <a href="{{ URL::previous()}}" class="btn btn-default" >Back</a>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
</div>
@stop
