@extends('default')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!--
            <ul class="nav nav-tabs">
              <li role="presentation" class="active"><a href="#">Home</a></li>
              <li role="presentation"><a href="#">Profile</a></li>
              <li role="presentation"><a href="#">Messages</a></li>
            </ul>
            -->
            <h2> Sprint List</h2>

            <div class="panel-body">
                @if(count($sprint))
                    <TABLE cellpadding="0" cellspacing="0" border="0" class="table table-striped table-condensed table-bordered" id="userstories">

                        <TR>
                            <TH> N° </TH>
                            <TH> Start Date  </TH>
                            <TH> End Date </TH>

                            @if(!auth()->guest())
                                <th> Display</th>
                                <th> Update</th>
                            @endif
                            <th> Kanban </th>
                            <th> PERT </th>
                        </TR>
                        <?php $i=1; ?>
                        @foreach($sprint as $us)
                            <TR>
                                <TH> <?php echo "Sprint   "; echo $i; ?> </TH>
                                <TD> {{$us->StartDate}} </TD>
                                <TD> {{$us->EndDate}} </TD>

                                @if(!auth()->guest())
                                    <td>
                                        <a href= {{ URL::action("SprintController@display", [$us->project_id, $us->id, $i]) }} class= 'btn btn-info btn-xs'> Us List </a>
                                        <a href= {{ route('taches.taches.show',$us->id) }} class= 'btn btn-info btn-xs'> Task List</a>
                                    </td>

                                    <td> <a href= {{ URL::action("SprintController@edit", [$us->project_id , $us->id]) }} class= 'btn btn-warning btn-xs'> Update</a> </td>
                                @endif

                                @if(auth()->guest())
                                    <td> <a href= {{ URL::action('Kanban\KanbanController@show', [$us->id, $us->project_id, $key]) }} class= 'btn btn-default btn-xs'>Kanban</a> </td>
                                    <td> <a href= {{ URL::action('Pert\PertController@show', [$us->id, $us->project_id, $key]) }} class= 'btn btn-default btn-xs'>PERT</a> </td>
                                @else
                                    <td> <a href= {{ route('kanban.taches.show',$us->id) }} class= 'btn btn-default btn-xs'>Kanban</a> </td>
                                    <td> <a href= {{ route('pert.taches.show',$us->id) }} class= 'btn btn-default btn-xs'>PERT</a> </td>
                                    @endif
                                    </td>

                            </TR>
                             <?php $i++; ?>
                        @endforeach
                    </TABLE>
                @else
                    <p> Aucun sprint ajouté!! </p>
                @endif

                @if(!auth()->guest())
                    <!-- <a href="{{ url('backlog/userstory/create') }}" class= 'btn btn-primary '> Add User Story</a>  -->
                    <a href= {{ URL::action("SprintController@show", [$idProject]) }} class= 'btn btn-primary '> Add Sprint</a>

                    <a href= {{ URL::action("BacklogController@show", [$idProject]) }} class= 'btn btn-info '> show Backlog</a>
                @endif

            </div>

        </div>
    </div>
    </div>
@endsection
