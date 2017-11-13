
@extends('inner')

@section('content')

        
        	<div class="callout" style="overflow: hidden">
            	<ul class="breadcrumbs">
                  <li><a href="{{ url('/home') }}">Home</a></li>
                  <li class="current "><a href="{{ url('/class-list') }}">Classes List</a></li>
                  @if(isset($contentType) && $contentType->id!='')
                  <li class="unavailable">Edit Content Type : {{ @$contentType->class_name }}</li>
                  @else
                  <li class="unavailable">Add New Content Type</li>
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
                    @if(isset($contentType) && $contentType->id!='')
                     <form action="{{ url('/update-content-type',@$contentType->id)}}" method="POST" class="form-horizontal" autocomplete="off">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @else
                    <form action="{{ url('/add-content-type')}}" method="POST" class="form-horizontal" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @endif
                    	<div class="large-12 columns">
                        	<div class="large-3 columns padding_right_none"><label>Content Type Title</label></div>
                            <div class="large-9 columns"><input type="text" name="content_type_name" id="content_type_name" placeholder="Content Type" value=" {{ @$contentType->content_type_name }}" /></div>
                        </div>
                        <div class="large-12 columns">
                        	<div class="large-3 columns padding_right_none"><label>Status</label></div>
                            <div class="large-9 columns"><input type="checkbox" checked="checked" name="status" id="status" value="1" /></div>
                        </div>
                        <div class="large-12 columns" style=" text-align: right">
                        
                        @if(isset($contentType) && $contentType->id!='')
                          <input type="submit" name="submit" value="Update Content Type" class="button" />
                          @else
                         <input type="submit" name="submit" value="Add New Content Type" class="button" />
                          @endif 
                  
                        	
                        </div>
                       </form>
                    </div>
              </div>
            </div>

@endsection
