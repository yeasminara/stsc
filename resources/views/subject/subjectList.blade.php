@extends('inner')

@section('content')
 
        	<div class="callout" style="overflow: hidden">
            	<ul class="breadcrumbs">
                  <li><a href="{{ url('/home') }}">Home</a></li>
                  <li class="current unavailable"><a href="#">Subjects List</a></li>

                </ul>

                <div style="clear:both"></div>
  				<div class="large-7">
					<a class="btn button" href="{{ url('/add-subject') }}">Add New Subject</a>
                    @if( count($subjects)>0)
              
              
            	@if(Session::has('flash_message'))
                    <div class="message_box">
                        {{ Session::get('flash_message') }}
                    </div>
                @endif
                <table class=" display table table-striped task-table" id="example">
                                	<thead>
                                    	<tr>
                                        	<th></th>
                                            <th>Subject Name</th>
                                            <th>Class Name</th>
                                            <th>Status</th>
                                            <th align="center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      {{--*/  $counter = 1 /*--}}
                                      <?php  $counter = 1; ?>

                                      @if(isset($_GET['page']))
			                             {{--*/  $cpage = $_GET['page']-1 /*--}}
                                          <?php $cpage = $_GET['page']-1; ?>
		                              @else
			                             {{--*/ $cpage =0 /*--}}
                                          <?php $cpage =0; ?>
		                              @endif
                                      <?php $counter=$cpage*15+$counter; ?>
             					      {{--*/   $counter=$cpage*15+$counter /*--}}
                                    @foreach ($subjects as $subject)
                                    	<tr>
                                        	<td>{{ $counter++ }} </td>
                                            <td>{{ $subject->subject_name }}</td>
                                             <td>{{ $subject->class_name }}</td>
                                            <td></td>
                                            <td align="center">
                                           
                                                <a href="{{ url('edit-subject', $subject->id) }}" class="btn btn-primary"><img src="{{ asset('/css/foundation-icons/svgs/fi-page-edit.svg') }}" alt="Edit Subject" width="27" /></a>
                                                <a href="{{ url('delete-subject', $subject->id) }}" class="btn btn-primary"><img src="{{ asset('/css/foundation-icons/svgs/fi-page-delete.svg') }}" alt="Delete Subject" width="27"/></a>
                                                
                                                
                                                
                                            </td>
                                        </tr>
                                       @endforeach
                                    
                                    </tbody>
                                </table>
               {!! $subjects->render() !!}
                
             @endif
              </div>
            </div>

@endsection
