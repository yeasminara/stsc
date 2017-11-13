@if(count($contents)>0)
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
  @else
  <div class="message_box">No results found</div>
  @endif

