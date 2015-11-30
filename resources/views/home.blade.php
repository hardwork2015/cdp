@extends('default')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				
				<div class="panel-body">
					
					<div class="alert">
    					<?php echo "You are logged in!"; ?>
    					<a href="#" class="close" onclick="$(this).parent().fadeOut();return false;">&times;</a>
					</div>
					<!--
					<div>
						<a href= "#" class="btn btn-default btn-lg" > 
							<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>   Project List 

						</a> </br>
						<a href="{{ url('/') }}" class="btn btn-default btn-lg" > 
							<span class="glyphicon glyphicon-user" aria-hidden="true"></span>  Memeber List 
						</a> </br>

					</div>
						-->
				</div>

				
			</div>
		</div>
	</div>
</div>
@endsection