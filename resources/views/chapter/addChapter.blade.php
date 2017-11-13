@extends('inner')

@section('content')

        
        	<div class="callout" style="overflow: hidden">
            	<ul class="breadcrumbs">
                  <li><a href="{{ url('/home') }}">Home</a></li>
                  <li class="current "><a href="{{ url('/class-list') }}">Classes List</a></li>
                  @if(isset($chapter) && $chapter->id!='')
                  <li class="unavailable">Edit Chapter : {{ @$chapter->chapter_name }}</li>
                  @else
                  <li class="unavailable">Add New Chapter</li>
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
                    @if(isset($chapter) && $chapter->id!='')
                     <form action="{{ url('/update-chapter',@$chapter->id)}}" method="POST" class="form-horizontal">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @else
                    <form action="{{ url('/add-chapter')}}" method="POST" class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @endif
                        
                       
                        
                        <div class="large-12 columns">
                        	<div class="large-3 columns padding_right_none"><label>Class Name</label></div>
                            <div class="large-9 columns">
                            <select id="class_id" name="class_id">
                            	<option value="">Select Class</option>
                               @foreach ($classes as $class)
                               
                               @if(!empty($chapter->class_id) && $chapter->class_id==$class->id)
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

                                        @if(!empty($chapter->subject_id) && $chapter->subject_id==$subject->id)
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
                            <div class="large-9 columns"><input type="text" name="chapter_name" id="chapter_name" placeholder="Subject name" value=" {{ @$chapter->chapter_name }}" /></div>
                        </div>
                        <div class="large-12 columns">
                        	<div class="large-3 columns padding_right_none"><label>Status</label></div>
                            <div class="large-9 columns"><input type="checkbox" checked="checked" name="status" id="status" value="1" /></div>
                        </div>
                        <div class="large-12 columns" style=" text-align: right">
                        
                        @if(isset($chapter) && $chapter->id!='')
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
