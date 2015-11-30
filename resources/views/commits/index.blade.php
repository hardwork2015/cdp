@extends('default')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2> Commits List </h2>


            @if(count($commits))

                <TABLE cellpadding="0" cellspacing="0" border="0" class="table table-striped table-condensed table-bordered" id="userstories">


                    <TR>
                        <TH> Commit message </TH>
                        <TH> Developer </TH>
                        <TH> Date </TH>
                    </TR>

                    @for($i = 0; $i < count($commits); $i++)
                        <TR>
                            <TH> <a href="{{$commits[$i]["url"]}}">{{$commits[$i]["message"]}}</a> </TH>
                            <TD> {{$commits[$i]["user"]}} </TD>
                            <TD> {{date("d-m-Y H:i:s", strtotime($commits[$i]["date"]))}} </TD>
                        </TR>

                    @endfor

                </TABLE>
            @else
                <p> There is no commits for this task in the repository for the moment.</p>
            @endif
        </div>
    </div>
@stop