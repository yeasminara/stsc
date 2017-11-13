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
        function search_chapter(){
            var class_id = $('#class_id').val();
            var subject_id = $('#subject_id').val();
            var token = $('.token').val()
            $.ajax({
                type:'POST',
                url:'/search-chapter-list',
                data: {_token: token, class_id: class_id, subject_id:subject_id},
                success:function(result){
                    $('#loadChapterDiv').html(result);
                    load_lesson()
                }
            });
        }
 //search_chapter();
 </script>
<div class="callout" style="overflow: hidden">
  <ul class="breadcrumbs">
    <li><a href="{{ url('/home') }}">Home</a></li>
    <li class="current unavailable"><a href="#">Chapter List</a></li>
  </ul>
  <div style="clear:both"></div>
  <div class="large-7"> <a class="btn button" href="{{ url('/add-chapter') }}">Add New Chapter</a>
  
  @if( count($chapters)>0)
    
    
    @if(Session::has('flash_message'))
    <div class="message_box"> {{ Session::get('flash_message') }} </div>
    @endif
        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" name="_token" class="token"  value="{{ csrf_token() }}">
    <table class="table table-striped task-table">
      <thead>
        <tr>
          <th nowrap="nowrap">Class : </th>
          <th><select name="class_id" id="class_id" style="margin-bottom: 0rem;" onchange="load_subject()">
              <option value="">select</option>
             @foreach($classes as $classe)
             <option value="{{ $classe->id }}">{{ $classe->class_name }}</option>
             @endforeach
            </select></th>
          <th nowrap="nowrap">Subject : </th>
          <th id="loadSubjectDiv"><select name="subject_id" id="subject_id" style="margin-bottom: 0rem;" >
               <option value="">select</option>
             @foreach($subjects as $subject)
             <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
             @endforeach
            </select>
            </th>
        </tr>
      <tr><td colspan="4"><input type="button" onclick="search_chapter()" value="Search" class="btn secondary button"/></td></tr>
      </thead>
    </table>
            <div id="loadChapterDiv">

                <table class="table table-striped task-table">
                    <thead>
                    <tr><th colspan="5">Total : {{ count($chapters) }}</th></tr>
                    <tr>
                        <th>SI</th>
                        <th>Chapter Name</th>
                        <th>Subject Name</th>
                        <th>Class Name</th>
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
                    @foreach ($chapters as $chapter)
                        <tr>
                            <td>{{ $counter++ }} </td>
                            <td>{{ $chapter->chapter_name }}</td>
                            <td>{{ $chapter->subject_name }}</td>
                            <td>{{ $chapter->class_name }}</td>
                            <td align="center" nowrap="nowrap"><a href="{{ url('edit-chapter', $chapter->id) }}" class="btn btn-primary"><img src="{{ asset('/css/foundation-icons/svgs/fi-page-edit.svg') }}" alt="Edit Chapter" width="27" /></a> <a href="{{ url('delete-chapter', $chapter->id) }}" class="btn btn-primary"><img src="{{ asset('/css/foundation-icons/svgs/fi-page-delete.svg') }}" alt="Delete Chapter" width="27"/></a></td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
                {!! $chapters->render() !!}
            </div>

    
    @else
    <div class="message_box">No results found</div>
    @endif
  </form>
  </div>
</div>
@endsection 