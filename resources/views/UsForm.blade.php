
    @extends('default')

    @section('content')
<div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                        <div class="panel-body">
                            
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                       <h2>Add User Story</h2>

                            @if($us)
                                <form action="{{  URL::action("UsController@modifyConfirm", $us->project_id) }}" class="form-horizontal" method="POST">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="us" value="{{ $us->id }}">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-10 col-md-push-1">
                                                <label class="floating-label" for="description">Description</label>
                                                 <textarea id="description" name="description" class="form-control" placeholder="Description" > <?php echo $us->description; ?> </textarea>
                                                <!-- <input type ="text" name="description" id="description" size="100" maxlength="500" class="form-control" value ="<?php echo $us->description; ?>"/>  -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-10 col-md-push-1">
                                                <label class="floating-label" for="priority">Priority</label>
                                                <input type ="number" name="priority" id="priority" min="0" class="form-control" value="<?php echo $us->priority; ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-10 col-md-push-1">
                                                <label class="floating-label" for="difficulty">Difficulty</label>
                                                <input type ="number" name="difficulty" id="difficulty" min="0" class="form-control" value="<?php echo $us->difficulty; ?>" /> 
                                            </div>
                                       </div>
                                    </div>

                                    <div class="form-group">
                                        
                                            <div class="col-md-6 col-md-offset-4">
                                               
                                                <label for="done">Finished
                                                 <input type ="checkbox" name="done" id="done" value="done" class="form-control" <?php if($us->status == 1) echo 'checked="checked"' ?> />
                                                 </label> 
                                            </div>
                                        </div>
                                    
                                    <button type="submit" class="btn  btn-warning"> Update</button>
                                    <a href="{{ URL::previous()}}" class="btn btn-default" >Cancel </a>
                                </form>
                            @else

                                <form action="{{  URL::action("UsController@createConfirm", $idProject) }}" class="form-horizontal" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-10 col-md-push-1">
                                                <label class="floating-label" for="description">Description</label>
                                                <textarea type ="text" name="description" id="description" class="form-control"> </textarea>
                                                </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-1 col-md-push-1">
                                                <label class="floating-label" for="priority">Priority</label>
                                                <input type ="number" name="priority" id="priority" min="0" class="form-control"  />
                                            </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-1 col-md-push-1">
                                                <label class="floating-label"for="difficulty">Difficulty</label>
                                                <input type ="number" name="difficulty" id="difficulty" min="0" class="form-control" /> 
                                            </div>
                                       </div>
                                    </div>

                                    <br />
                                    <button type="submit" class="btn btn-primary ">Add</button>
                                    <a href="{{ URL::previous()}}" class="btn btn-default" >Cancel</a>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    @endsection

