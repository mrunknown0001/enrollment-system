@extends('layouts.app')

@section('title') Admin @endsection

@section('headside')
    @include('admin.includes.header')
    @include('admin.includes.side-menu')
@endsection


@section('content')

<section class="section">
    <div class="row">
        <div class="col-md-8">
            <p><a href="{{ route('admin.view.curriculum') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Curiculum</a></p>
            <div class="card card-primary">
                <div class="card-header">
                    <div class="header-block">
                        <p class="title"> Add Curiculum </p>
                    </div>
                </div>
                
                <div class="card-block">
                    @include('includes.all')
                    <form id="signup-form" action="{{ route('admin.add.curriculum.post') }}" method="POST" role="form" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <select name="course" id="course" class="form-control">
                                <option value="">Select course</option>
                                @if(count($courses) > 0)
                                    @foreach($courses as $c)
                                        <option value="{{ $c->id }}">{{ $c->code . ' - ' . $c->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Curriculum Name</label>
                            <input type="text" name="name" id="name" class="form-control underlined" placeholder="Curriculum" required="">
                        </div>
                        <div class="form-group">
                            <label for="description">Curiculum Description</label>
                            <textarea name="description" id="description" class="form-control underlined" placeholder="Curiculum Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Add Subjects</label>
                            <p>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1">First Year First Semester</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal2">First Year Second Semester</button>
                            </p>
                            <p>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal3">Second Year First Semester</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal4">Second Year Second Semester</button>
                            </p>



                            {{-- modal for fisrt year first sem --}}
                              <!-- Modal -->
                              <div class="modal fade" id="modal1" role="dialog">
                                <div class="modal-dialog">
                                
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Modal Header <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                    </div>
                                    <div class="modal-body">
                                      <p>Some text in the modal.</p>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>


                              <!-- Modal -->
                              <div class="modal fade" id="modal2" role="dialog">
                                <div class="modal-dialog">
                                
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Modal Header <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                    </div>
                                    <div class="modal-body">
                                      <p>Some text in the modal.</p>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>


                              <!-- Modal -->
                              <div class="modal fade" id="modal3" role="dialog">
                                <div class="modal-dialog">
                                
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Modal Header <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                    </div>
                                    <div class="modal-body">
                                      <p>Some text in the modal.</p>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>


                              <!-- Modal -->
                              <div class="modal fade" id="modal4" role="dialog">
                                <div class="modal-dialog">
                                
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Modal Header <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                    </div>
                                    <div class="modal-body">
                                      <p>Some text in the modal.</p>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>



                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary"><i class="fa fa-plus"></i> Add Curiculum</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection