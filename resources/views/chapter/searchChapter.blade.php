
@if(count($chapters)>0)
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
  @else
  <div class="message_box">No results found</div>
  @endif

