@extends('inner')

@section('content')

        
        	<div class="callout" style="overflow: hidden">
            	<ul class="breadcrumbs">
                  <li><a href="{{ url('/home') }}">Home</a></li>
                  <li class="current "><a href="{{ url('/subject-list') }}">Classes List</a></li>
                  @if(isset($subject) && $subject->id!='')
                  <li class="unavailable">Edit Subject : {{ @$subject->subject_name }}</li>
                  @else
                  <li class="unavailable">Add New Subject</li>
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
                    @if(isset($subject) && $subject->id!='')
                     <form action="{{ url('/update-subject',@$subject->id)}}" method="POST" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @else
                    <form action="{{ url('/add-subject')}}" method="POST" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @endif
                        
                       
                        
                        <div class="large-12 columns">
                        	<div class="large-3 columns padding_right_none"><label>Class Name</label></div>
                            <div class="large-9 columns">
                            <select id="class_id" name="class_id">
                            	<option value="">Select Class</option>
                               @foreach ($classes as $class)
                               
                               @if(!empty($subject->class_id) && $subject->class_id==$class->id)
                                {{--*/   /*--}}

                                   <?php $select = 'selected'; ?>
                                @else
                               {{--*/  $select = '' /*--}}

                                        <?php $select = ''; ?>
                               @endif
                              
                                	<option value="{{ $class->id }}" {{ $select }}>{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        
                    	<div class="large-12 columns">
                        	<div class="large-3 columns padding_right_none"><label>Subject Name</label></div>
                            <div class="large-9 columns"><input type="text" name="subject_name" id="subject_name" placeholder="Subject name" value=" {{ @$subject->subject_name }}" /></div>
                        </div>
                        <div class="large-12 columns">
                        	<div class="large-3 columns padding_right_none"><label>Status</label></div>
                            <div class="large-9 columns"><input type="checkbox" checked="checked" name="status" id="status" value="1" /></div>
                        </div>
                        <div class="large-12 columns" style=" text-align: right">
                        
                        @if(isset($subject) && $subject->id!='')
                          <input type="submit" name="submit" value="Update Subject" class="button" />
                          @else
                         <input type="submit" name="submit" value="Add New Subject" class="button" />
                          @endif 
                  
                        	
                        </div>
                       </form>
                    </div>
              </div>
            </div>

@endsection
