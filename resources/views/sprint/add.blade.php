@extends('default')
@section('content')
<div class="container">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <br/>
    <h2> Add a new Sprint</h2>
    <div class="row">
        <form action="{{  URL::action("SprintController@add", [$project_id]) }}" method="POST" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group form-group-label">
                <div class="row">
                    <div class="col-md-10 col-md-push-1">
                        <label class="floating-label" for="StartDate">Start date :</label>
                        <input type="date" name="StartDate" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="form-group form-group-label">
                <div class="row">
                    <div class="col-md-10 col-md-push-1">
                        <label class="floating-label" for="EndDate">End date :</label>
                        <input type="date" name="EndDate" class="form-control"/>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <div class="col-md-10 col-md-push-1">
                        <button class="btn btn-primary">Add</button>
                         <a href="{{ URL::previous()}}" class="btn btn-default" >Dismiss</a>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
</div>

@stop
