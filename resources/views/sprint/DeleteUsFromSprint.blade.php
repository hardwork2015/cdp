@extends('default')

@section('content')

<div class="container">
    <br/>
    <div class="row">
    	<h2> User Stories list</h2>
    	<p> Remove userstories that you don't want to add to the Sprint  </p>
  
@if(count($userstories))

	<TABLE cellpadding="0" cellspacing="0" border="0" class="table table-striped table-condensed table-bordered" id="us">


		<TR>
			<TH> N° </TH>
			<TH> Description </TH>
			<TH> Priority </TH>
			<TH> Difficulty </TH>
			<th> Add</th>
		</TR>

		@foreach($userstories as $us)
			<TR>
				<TH> {{$us->id}} </TH>
				<TD> {{$us->description}} </TD>
				<TD> {{$us->priority}} </TD>
				<TD> {{$us->difficulty}} </TD>
				<td>   		
						
					<a href= {{ URL::action("UsSprintController@delete", [$us->project_id, $us->id]) }} class= 'btn btn-danger btn-xs'>Remove</a>

				</td>

			</TR>

		@endforeach

	</TABLE>
	<a href="{{ URL::previous()}}" class="btn btn-default" >Back</a>

@else 
<p> This sprint is empty. </p>
@endif 

</div>
</div>
@stop