@extends('default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
				@if(!auth()->guest())
                    <div class="panel-heading"><b>Visitors Access</b></div>
                    <div class="panel-body">
                        @if($key)
                            <p>Here is the link to share with your visitors : <a href="{{URL::action("BacklogController@show", [$project_id, $key]) }}">Visitor's Link</a></p>
                            <p>You ca block visitors by clicking here (Becareful the key will no longer be working) : <a href="{{ URL::action("VisitorController@forbid", [$project_id]) }}">Block access to visitors</a></p>
                        @else
                            <p>You haven't authorized visitors. To authorize them, just click here : <a href="{{ URL::action("VisitorController@allow", [$project_id]) }}">Authorize visitors access</a></p>
                        @endif
                    </div>
                </div>
				@endif
            </div>
        </div>
    </div>
@endsection