@extends('inner')

@section('content')
    <script src="{{ asset('../js/jquery.min.js') }}"></script>
    <script type="text/javascript" language="javascript">

       function load_subject(){
           var class_id = $('#class_id').val();
           var token = $('.token').val()
           $.ajax({
               type:'POST',
               url:'/search-subject',
               data: {_token: token, id: class_id},
               success:function(result){
                   $('#loadSubjectDiv').html(result);
                   load_chapter();
               }
           });
       }
       function load_chapter(){
           var class_id = $('#class_id').val();
           var subject_id = $('#subject_id').val();
           var token = $('.token').val()
           $.ajax({
               type:'POST',
               url:'/search-chapter',
               data: {_token: token, class_id: class_id, subject_id:subject_id},
               success:function(result){
                   $('#loadChapterDiv').html(result);
                   load_lesson()
               }
           });
       }

       function load_lesson(){
           var class_id = $('#class_id').val();
           var subject_id = $('#subject_id').val();
           var chapter_id = $('#chapter_id').val();
           var token = $('.token').val()
           $.ajax({
               type:'POST',
               url:'/search-lesson',
               data: {_token: token, class_id: class_id, subject_id:subject_id, chapter_id:chapter_id},
               success:function(result){
                   $('#loadLessonDiv').html(result);
               }
           });
       }
    </script>

    <?php // echo isset($_POST['class_id']) ? ''.$_POST['class_id']:'';?>
        	<div class="callout" style="overflow: hidden">
            	<ul class="breadcrumbs">
                  <li><a href="{{ url('/home') }}">Home</a></li>
                  <li class="current "><a href="{{ url('/content-list') }}">Content List</a></li>
                  @if(isset($content) && $content->id!='')
                  <li class="unavailable">Edit Content : {{ @$content->lesson_name }}</li>
                  @else
                  <li class="unavailable">Add New Content</li>
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
                    @if(isset($content) && $content->id!='')
                     <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <input type="hidden" name="_token" class="token" value="{{ csrf_token() }}">
                    @else
                    <form action="{{ url('/add-content')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="_token" class="token"  value="{{ csrf_token() }}">
                        @endif
                        
                       
                        
                        <div class="large-12 columns">
                        	<div class="large-3 columns padding_right_none"><label>Class</label></div>
                            <div class="large-9 columns">
                            <select id="class_id" name="class_id" onchange="load_subject()">
                            	<option value="">Select Class</option>
                               @foreach ($classes as $class)
                               
                               @if(!empty($content->class_id) && $content->class_id==$class->id)
                                <?php  $select = 'selected=selected'; ?>
                                @else
                               <?php  $select = '';?>
                               @endif
                              
                                	<option value="{{ $class->id }}" {{ $select }}>{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="large-12 columns" style="margin-bottom: 11px;">
                            <div class="large-3 columns padding_right_none"><label>Subject</label></div>
                            <div class="large-9 columns" id="loadSubjectDiv">
                                <select id="subject_id" name="subject_id" onchange="load_chapter()">
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)

                                        @if(!empty($content->subject_id) && $content->subject_id==$subject->id)
                                            <?php  $select1 = 'selected=selected'; ?>
                                        @else
                                            <?php  $select1 = '';?>
                                        @endif

                                        <option value="{{ $subject->id }}" {{ $select1 }} >{{ $subject->subject_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="large-12 columns" style="margin-bottom: 11px;">
                            <div class="large-3 columns padding_right_none"><label>Chapter</label></div>
                            <div class="large-9 columns" id="loadChapterDiv">
                                <select id="chapter_id" name="chapter_id"  onchange="load_lesson()">
                                    <option value="">Select Chapter</option>
                                    @foreach ($chapters as $chapter)

                                        @if(!empty($content->chapter_id) && $content->chapter_id==$chapter->id)
                                            <?php  $select2 = 'selected=selected'; ?>
                                        @else
                                            <?php  $select2 = '';?>
                                        @endif

                                        <option value="{{ $chapter->id }}" {{ $select2 }} >{{ $chapter->chapter_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="large-12 columns" style="margin-bottom: 11px;">
                            <div class="large-3 columns padding_right_none"><label>Lesson</label></div>
                            <div class="large-9 columns" id="loadLessonDiv">
                                <select id="lesson_id" name="lesson_id">
                                    <option value="">Select Lesson</option>
                                    @foreach ($lessons as $lesson)

                                        @if(!empty($content->chapter_id) && $content->chapter_id==$lesson->id)
                                            <?php  $select2 = 'selected=selected'; ?>
                                        @else
                                            <?php  $select2 = '';?>
                                        @endif

                                        <option value="{{ $lesson->id }}" {{ $select2 }} >{{ $lesson->lesson_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="large-12 columns">
                            <div class="large-3 columns padding_right_none"><label>Content Type</label></div>
                            <div class="large-9 columns">
                                <select id="content_type_id" name="content_type_id">
                                    <option value="">Select</option>
                                    @foreach($content_types as $content_type)

                                        @if(!empty($content->content_type_id) && $content->content_type_id==$content_type->id)
                                            <?php  $select4 = 'selected=selected'; ?>
                                        @else
                                            <?php  $select4 = '';?>
                                        @endif

                                        <option value="{{ @$content_type->id }}" {{ $select4 }}>{{ @$content_type->content_type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="large-12 columns">
                        	<div class="large-3 columns padding_right_none"><label>Content Title</label></div>
                            <div class="large-9 columns"><input type="text" name="title" id="title" placeholder="Content Title" value=" {{ @$content->title }}" /></div>
                        </div>


                        <div class="large-12 columns">
                            <div class="large-3 columns padding_right_none"><label>Description</label></div>
                            <div class="large-9 columns">
                                <textarea id="description" name="description" style="height: 100px;">{{ @$content->description }}</textarea>
                            </div>
                        </div>

                        <div class="large-12 columns">
                            <div class="large-3 columns padding_right_none"><label>Flash File</label></div>
                            <div class="large-9 columns">
                                <input type="file" name="flash_file" id="flash_file">
                                {{ @$content->flash_file }}
                                <input type="hidden" name="old_flash_file" value="{{ @$content->flash_file }}">
                        </div>
                    </div>
                        <div class="large-12 columns">
                            <div class="large-3 columns padding_right_none"><label>Audio Link </label></div>
                            <div class="large-9 columns">
                                <textarea id="audio_file" name="audio_file">{{ @$content->audio_file }}</textarea>
                            </div>
                        </div>

                        <div class="large-12 columns">
                            <div class="large-3 columns padding_right_none"><label>Video Link</label></div>
                            <div class="large-9 columns">
                                <textarea id="vedio_link" name="vedio_link">{{ @$content->vedio_link }}</textarea>
                            </div>
                        </div>
                            <div class="large-12 columns">
                                <div class="large-3 columns padding_right_none"><label>Content File</label></div>
                                <div class="large-9 columns">
                                    <input type="file" name="content_file" id="content_file">
                                    {{ @$content->file }}
                                    <input type="hidden" name="old_content_file" value="{{ @$content->file }}">
                                </div>
                            </div>

                        <div class="large-12 columns">
                            <div class="large-3 columns padding_right_none"><label>Lesson Plan</label></div>
                            <div class="large-9 columns">
                                <input type="file" name="lesson_plan" id="lesson_plan">
                                {{ @$content->lesson_plan }}
                                <input type="hidden" name="old_lesson_plan" value="{{ @$content->lesson_plan }}">
                            </div>
                        </div>

                        <div class="large-12 columns">
                            <div class="large-3 columns padding_right_none"><label>Image</label></div>
                            <div class="large-9 columns">
                                <input type="file" name="image" id="image">
                                {{ @$content->image }}
                                <input type="hidden" name="old_image" value="{{ @$content->image }}">
                            </div>
                        </div>
                        <div class="large-12 columns">
                        	<div class="large-3 columns padding_right_none"><label>Status</label></div>
                            <div class="large-9 columns"><input type="checkbox" checked="checked" name="status" id="status" value="1" /></div>
                        </div>
                        <div class="large-12 columns" style=" text-align: right">
                        
                        @if(isset($content) && $content->id!='')
                          <input type="submit" name="submit" value="Update Content" class="button" />
                          @else
                         <input type="submit" name="submit" value="Add New Content" class="button" />
                          @endif 
                  
                        	
                        </div>
                       </form>
                    </div>
              </div>
            </div>

@endsection
