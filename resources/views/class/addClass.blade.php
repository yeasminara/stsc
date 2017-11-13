@extends('inner')

@section('content')

        
        	<div class="callout" style="overflow: hidden">
            	<ul class="breadcrumbs">
                  <li><a href="{{ url('/home') }}">Home</a></li>
                  <li class="current "><a href="{{ url('/class-list') }}">Classes List</a></li>
                  @if(isset($classe) && $classe->id!='')
                  <li class="unavailable">Edit Class : {{ @$classe->class_name }}</li>
                  @else
                  <li class="unavailable">Add New Class</li>
                  @endif 
				  
                </ul>

                <div style="clear:both"></div>
  				<div class="large-7">
					<div class="row">
                     @if (count($errors) > 0)
                   		 <div class="success button">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                   
                	@endif
                    @if(isset($classe) && $classe->id!='')
                     <form action="{{ url('/update-class',@$classe->id)}}" method="POST" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @else
                    <form action="{{ url('/add-class')}}" method="POST" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @endif
                    	<div class="large-12 columns">
                        	<div class="large-3 columns padding_right_none"><label>Class Name</label></div>
                            <div class="large-9 columns"><input type="text" name="class_name" id="class_name" placeholder="Class name" value=" {{ @$classe->class_name }}" /></div>
                        </div>
                        <div class="large-12 columns">
                        	<div class="large-3 columns padding_right_none"><label>Status</label></div>
                            <div class="large-9 columns"><input type="checkbox" checked="checked" name="status" id="status" value="1" /></div>
                        </div>
                        <div class="large-12 columns" style=" text-align: right">
                        
                        @if(isset($classe) && $classe->id!='')
                          <input type="submit" name="submit" value="Update Class" class="button" />
                          @else
                         <input type="submit" name="submit" value="Add New Class" class="button" />
                          @endif 
                  
                        	
                        </div>
                       </form>
                    </div>
              </div>
            </div>

@endsection
