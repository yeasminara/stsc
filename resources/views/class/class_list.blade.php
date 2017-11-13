@extends('inner')

@section('content')


    <div class="callout" style="overflow: hidden">
        <ul class="breadcrumbs">
            <li><a href="{{ url('/home') }}">Home</a></li>
            <li class="current unavailable"><a href="#">Classes List</a></li>

        </ul>

        <div style="clear:both"></div>
        <div class="large-7">
            <a class="btn button" href="{{ url('/add-class') }}">Add New Class</a>
            @if( count($class)>0)


                @if(Session::has('flash_message'))
                    <div class="message_box">
                        {{ Session::get('flash_message') }}
                    </div>
                @endif
                <table class="table table-striped task-table">
                    <thead>
                    <tr>
                        <th>Class Name</th>
                        <th>Status</th>
                        <th align="center">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($class as $class_only)
                        <tr>
                            <td>{{ $class_only->class_name }}</td>
                            <td></td>
                            <td align="center">

                                <a href="{{ url('edit-class', $class_only->id) }}" class="btn btn-primary"><img src="{{ asset('/css/foundation-icons/svgs/fi-page-edit.svg') }}" alt="Edit Class" width="27" /></a>
                                <a href="{{ url('delete-class', $class_only->id) }}" class="btn btn-primary"><img src="{{ asset('/css/foundation-icons/svgs/fi-page-delete.svg') }}" alt="Delete Class" width="27"/></a>



                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            @endif
        </div>
    </div>

@endsection
