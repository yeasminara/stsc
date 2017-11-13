@extends('inner')

@section('content')


    <div class="callout" style="overflow: hidden">
        <ul class="breadcrumbs">
            <li><a href="{{ url('/home') }}">Home</a></li>
            <li class="current unavailable"><a href="#">Content Type List</a></li>

        </ul>

        <div style="clear:both"></div>
        <div class="large-7">
            <a class="btn button" href="{{ url('/add-content-type') }}">Add New Content Type</a>
            @if( count($content_types)>0)


                @if(Session::has('flash_message'))
                    <div class="message_box">
                        {{ Session::get('flash_message') }}
                    </div>
                @endif
                <table class="table table-striped task-table">
                    <thead>
                    <tr>
                        <th>Content Type</th>
                        <th align="center">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($content_types as $content)
                        <tr>
                            <td>{{ $content->content_type_name }}</td>
                            <td></td>
                            <td align="center">

                                <a href="{{ url('edit-content-type', $content->id) }}" class="btn btn-primary"><img src="{{ asset('/css/foundation-icons/svgs/fi-page-edit.svg') }}" alt="Edit Content Type" width="27" /></a>
                                <a href="{{ url('delete-content-type', $content->id) }}" class="btn btn-primary"><img src="{{ asset('/css/foundation-icons/svgs/fi-page-delete.svg') }}" alt="Delete Content Type" width="27"/></a>



                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @else
                <div class="message_box">
                        <p>No Result Found</p>
                    </div>
            @endif
        </div>
    </div>

@endsection
