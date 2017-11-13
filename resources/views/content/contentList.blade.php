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
        function search_content(){
            var class_id = $('#class_id').val();
            var subject_id = $('#subject_id').val();
            var chapter_id = $('#chapter_id').val();
            var lesson_id = $('#lesson_id').val();
            var token = $('.token').val()
            $.ajax({
                type:'POST',
                url:'/search-content-list',
                data: {_token: token, class_id: class_id, subject_id:subject_id, chapter_id:chapter_id,lesson_id:lesson_id},
                success:function(result){
                    $('#searchContentList').html(result);
                }
            });
        }
    </script>
<div class="callout" style="overflow: hidden">
  <ul class="breadcrumbs">
    <li><a href="{{ url('/home') }}">Home</a></li>
    <li class="current unavailable"><a href="#">Content List</a></li>
  </ul>
  <div style="clear:both"></div>
  <div class="large-12"> <a class="btn button" href="{{ url('/add-content') }}">Add New Content</a>
  
  @if( count($contents)>0)
    
    
    @if(Session::has('flash_message'))
    <div class="message_box"> {{ Session::get('flash_message') }} </div>
    @endif

        <form action="{{ url('/add-content')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" name="_token" class="token"  value="{{ csrf_token() }}">
    <table class="table table-striped task-table">
      <thead>
        <tr>
          <th><select name="class_id" id="class_id" style="margin-bottom: 0rem;" onchange="load_subject()">
              <option value="">select Class</option>
             @foreach($classes as $classe)
             <option value="{{ $classe->id }}">{{ $classe->class_name }}</option>
             @endforeach
            </select></th>
          <th id="loadSubjectDiv"><select name="subject_id" id="subject_id" style="margin-bottom: 0rem;" onchange="search_chapter();">
               <option value="">select Subject</option>
             @foreach($subjects as $subject)
             <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
             @endforeach
            </select>
            </th>

            <th id="loadChapterDiv"><select name="chapter_id" id="chapter_id" style="margin-bottom: 0rem;" onchange="search_chapter();">
                    <option value="">select Chapter</option>
                    @foreach($chapters as $chapter)
                        <option value="{{ $chapter->id }}">{{ $chapter->chapter_name }}</option>
                    @endforeach
                </select>
            </th>
            <th id="loadLessonDiv"><select name="lesson_id" id="lesson_id" style="margin-bottom: 0rem;" onchange="search_chapter();">
                    <option value="">select Lesson</option>
                    @foreach($lessons as $lesson)
                        <option value="{{ $lesson->id }}">{{ $lesson->lesson_name }}</option>
                    @endforeach
                </select>
            </th>
        </tr>
      <tr><th colspan="8">
              <input type="button" name="search" id="search" value="Search Content" class="btn button" onclick="search_content()"> </th></tr>
      </thead>
    </table>
<div id="searchContentList">
    <table class="table table-striped task-table">
        <thead>
        <tr>
            <th>SI</th>
            <th>Title</th>
            <th nowrap="nowarp">Class</th>
            <th  nowrap="nowarp">Subject</th>
            <th nowrap="nowarp">Chapter</th>
            <th>Lesson</th>

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
        @foreach ($contents as $content)
            <tr>
                <td>{{ $counter++ }} </td>
                <td>{{ $content->title }}</td>
                <td>{{ $content->class_name }}</td>
                <td>{{ $content->subject_name }}</td>
                <td>{{ $content->chapter_name }}</td>
                <td>{{ $content->lesson_name }}</td>
                <td align="center" nowrap="nowrap"><a href="{{ url('edit-content', $content->id) }}" class="btn btn-primary"><img src="{{ asset('/css/foundation-icons/svgs/fi-page-edit.svg') }}" alt="Edit Content" width="27" /></a>
                    <a href="{{ url('delete-content', $content->id) }}" class="btn btn-primary"><img src="{{ asset('/css/foundation-icons/svgs/fi-page-delete.svg') }}" alt="Delete Content" width="27"/></a></td>
            </tr>
        @endforeach
        </tbody>

    </table>
    {!! $contents->render() !!}
</div>


    
    @else
    <div class="message_box">No results found</div>
    @endif </div>
    </form>
</div>
@endsection 