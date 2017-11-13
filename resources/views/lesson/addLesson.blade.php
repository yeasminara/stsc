@extends('inner')

@section('content')

        
        	<div class="callout" style="overflow: hidden">
            	<ul class="breadcrumbs">
                  <li><a href="{{ url('/home') }}">Home</a></li>
                  <li class="current "><a href="{{ url('/class-list') }}">Classes List</a></li>
                  @if(isset($lesson) && $lesson->id!='')
                  <li class="unavailable">Edit Lesson : {{ @$lesson->lesson_name }}</li>
                  @else
                  <li class="unavailable">Add New Lesson</li>
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
                    @if(isset($lesson) && $lesson->id!='')
                     <form action="{{ url('/update-lesson',@$lesson->id)}}" method="POST" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @else
                    <form action="{{ url('/add-lesson')}}" method="POST" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @endif
                        
                       
                        
                        <div class="large-12 columns">
                        	<div class="large-3 columns padding_right_none"><label>Class Name</label></div>
                            <div class="large-9 columns">
                            <select id="class_id" name="class_id">
                            	<option value="">Select Class</option>
                               @foreach ($classes as $class)
                               
                               @if(!empty($lesson->class_id) && $lesson->class_id==$class->id)
                                <?php  $select = 'selected=selected'; ?>
                                @else
                               <?php  $select = '';?>
                               @endif
                              
                                	<option value="{{ $class->id }}" {{ $select }}>{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="large-12 columns">
                            <div class="large-3 columns padding_right_none"><label>Subject Name</label></div>
                            <div class="large-9 columns">
                                <select id="class_id" name="class_id">
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)

                                        @if(!empty($lesson->subject_id) && $lesson->subject_id==$subject->id)
                                            <?php  $select1 = 'selected=selected'; ?>
                                        @else
                                            <?php  $select1 = '';?>
                                        @endif

                                        <option value="{{ $subject->id }}" {{ $select1 }} >{{ $subject->subject_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="large-12 columns">
                            <div class="large-3 columns padding_right_none"><label>Chapter Name</label></div>
                            <div class="large-9 columns">
                                <select id="class_id" name="class_id">
                                    <option value="">Select Chapter</option>
                                    @foreach ($chapters as $chapter)

                                        @if(!empty($lesson->chapter_id) && $lesson->chapter_id==$chapter->id)
                                            <?php  $select2 = 'selected=selected'; ?>
                                        @else
                                            <?php  $select2 = '';?>
                                        @endif

                                        <option value="{{ $chapter->id }}" {{ $select2 }} >{{ $chapter->chapter_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    	<div class="large-12 columns">
                        	<div class="large-3 columns padding_right_none"><label>Lesson Name</label></div>
                            <div class="large-9 columns"><input type="text" name="lesson_name" id="lesson_name" placeholder="Lesson name" value=" {{ @$lesson->lesson_name }}" /></div>
                        </div>
                        <div class="large-12 columns">
                        	<div class="large-3 columns padding_right_none"><label>Status</label></div>
                            <div class="large-9 columns"><input type="checkbox" checked="checked" name="status" id="status" value="1" /></div>
                        </div>
                        <div class="large-12 columns" style=" text-align: right">
                        
                        @if(isset($lesson) && $lesson->id!='')
                          <input type="submit" name="submit" value="Update Chapter" class="button" />
                          @else
                         <input type="submit" name="submit" value="Add New Chapter" class="button" />
                          @endif 
                  
                        	
                        </div>
                       </form>
                    </div>
              </div>
            </div>

@endsection
