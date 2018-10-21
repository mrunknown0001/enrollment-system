@extends('layouts.app')

@section('title') Faculty @endsection

@section('headside')
    @include('faculty.includes.header')
    @include('faculty.includes.side-menu')
@endsection


@section('content')
<section class="section">
    <div class="row">

        <div class="col-md-8">
            <p><a href="{{ route('faculty.view.subject.assignments') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Subjects Assigned</a></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Groups in {{ $subject->code }} - {{ $subject->description }} </p>
                    </div>
                </div>
                <div class="card-block">
					
		        	@if(count($gn) > 0)
						@foreach($gn as $g)
							<a href="{{ route('faculty.subject.students.enrolled', ['id' => $subject->id, 'gid' => $g->group_number]) }}" class="btn btn-primary">Students Section 
                            @if($g->group_number == 1)
                            A
                            @elseif($g->group_number == 2)
                            B
                            @elseif($g->group_number == 3)
                            C
                            @elseif($g->group_number == 4)
                            D
                            @else
                            {{ $g->group_number }}
                            @endif
                            </a>
						@endforeach
		        	@endif
                </div>
                <div class="card-footer"> <small>Students in {{ $subject->code }} - {{ $subject->description }}</small> </div>
            </div>
        </div>

    </div>
</section>
@endsection