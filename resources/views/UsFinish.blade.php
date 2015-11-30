@extends('default')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">			
				<div class="panel-body">
					<h2>Finished User Stories</h2>
						@if(count($userstories))
							<TABLE cellpadding="0" cellspacing="0" border="0" class="table table-striped table-condensed table-bordered" id="userstories">

								<TR>
									<TH> Number</TH>
									<TH> Description</TH>
									<TH> Priority</TH>
									<TH> Difficulty</TH>
								</TR>
								<?php $i=1; ?>
								@foreach($userstories as $us)
									<TR>
										<TH> <?php echo $i++; ?> </TH>
										<TD> {{$us->description}} </TD>
										<TD> {{$us->priority}} </TD>
										<TD> {{$us->difficulty}} </TD>
									</TR>
                          
								@endforeach
							</TABLE>
						@else
						<p>There is no finished User Story</p>
						@endif

						@if(!auth()->guest())
							<a href= {{ URL::action("UsController@create", [$idProject]) }} class= 'btn btn-primary btn-xs'> Add User Story</a>
						@endif
						</br>
					</br>
							<a href= {{ URL::action("SprintController@listSprint", [$idProject]) }} class= 'btn btn-info '> show Sprint List</a>
	
				<a href="{{ URL::previous()}}" class="btn btn-default" >Back</a>
			</div>
		</div>
	</div>
</div>
@endsection