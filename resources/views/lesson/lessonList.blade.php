@extends('inner')

@section('content')
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
                }
            });
        }

        function search_lesson(){
            var class_id = $('#class_id').val();
            var subject_id = $('#subject_id').val();
            var chapter_id = $('#chapter_id').val();
            var token = $('.token').val()
            $.ajax({
                type:'POST',
                url:'/search-lesson-list',
                data: {_token: token, class_id: class_id, subject_id:subject_id, chapter_id:chapter_id},
                success:function(result){
                    $('#loadLessonDiv').html(result);
                }
            });
        }
        //search_chapter();

    </script>
<div class="callout" style="overflow: hidden">
  <ul class="breadcrumbs">
    <li><a href="{{ url('/home') }}">Home</a></li>
    <li class="current unavailable"><a href="#">Lesson List</a></li>
  </ul>
  <div style="clear:both"></div>
  <div class="large-9"> <a class="btn button" href="{{ url('/add-lesson') }}">Add New Lesson</a>
  
  @if( count($lessons)>0)
    
    
    @if(Session::has('flash_message'))
    <div class="message_box"> {{ Session::get('flash_message') }} </div>
    @endif
        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" name="_token" class="token" value="{{ csrf_token() }}">
            <table class="table table-striped task-table">
      <thead>
        <tr>
          <th><select name="class_id" id="class_id" style="margin-bottom: 0rem;" onchange="load_subject()">
              <option value="">Class</option>
             @foreach($classes as $classe)
             <option value="{{ $classe->id }}">{{ $classe->class_name }}</option>
             @endforeach
            </select></th>
          <th id="loadSubjectDiv" ><select name="subject_id" id="subject_id" style="margin-bottom: 0rem;" onchange="load_chapter();">
               <option value="">Subject</option>
             @foreach($subjects as $subject)
             <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
             @endforeach
            </select>
            </th>
            <th id="loadChapterDiv">

                <select name="chapter_id" id="chapter_id" style="margin-bottom: 0rem;">
                    <option value="">Chapter</option>
                    @foreach($chapters as $chapter)
                        <option value="{{ $chapter->id }}">{{ $chapter->chapter_name }}</option>
                    @endforeach
                </select>

            </th>
        </tr>
        <tr><td colspan="4"><input type="button" onclick="search_lesson()" value="Search" class="btn secondary button"/></td></tr>
      </thead>
    </table>
            <div id="loadLessonDiv">
                <table class="table table-striped task-table" id="search_chapter_list">
                    <thead>
                    <tr><th colspan="6">Total : {{ count($lessons) }}</th></tr>
                    <tr>
                        <th>SI</th>
                        <th>Lesson Name</th>
                        <th nowrap="nowarp">Chapter Name</th>
                        <th  nowrap="nowarp">Subject Name</th>
                        <th nowrap="nowarp">Class Name</th>
                        <th align="center">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php  $counter = 1; ?>

                    @if(isset($_GET['page']))
                        {{--*/  $cpage = $_GET['page']-1 /*--}}
                        <?php $cpage = $_GET['page']-1; ?>
                    @else
                        {{--*/ $cpage =0 /*--}}
                        <?php $cpage =0; ?>
                    @endif
                    {{--*/   $counter=$cpage*15+$counter /*--}}
                    <?php $counter=$cpage*15+$counter; ?>
                    @foreach ($lessons as $lesson)
                        <tr>
                            <td>{{ $counter++ }} </td>
                            <td>{{ $lesson->lesson_name }}</td>
                            <td>{{ $lesson->chapter_name }}</td>
                            <td>{{ $lesson->subject_name }}</td>
                            <td>{{ $lesson->class_name }}</td>
                            <td align="center" nowrap="nowrap"><a href="{{ url('edit-lesson', $lesson->id) }}" class="btn btn-primary"><img src="{{ asset('/css/foundation-icons/svgs/fi-page-edit.svg') }}" alt="Edit Lesson" width="27" /></a>
                                <a href="{{ url('delete-lesson', $lesson->id) }}" class="btn btn-primary"><img src="{{ asset('/css/foundation-icons/svgs/fi-page-delete.svg') }}" alt="Delete Lesson" width="27"/></a></td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                {!! $lessons->render() !!}
            </div>

    
    @else
    <div class="message_box">No results found</div>
    @endif
      </form>
  </div>
</div>
@endsection 