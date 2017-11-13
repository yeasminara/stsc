
@if(count($lessons)>0)
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
  @else
  <div class="message_box">No results found</div>
  @endif

