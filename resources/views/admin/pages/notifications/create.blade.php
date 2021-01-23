@extends('layout')

@section('content')

<div class="col">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">
              <div class="row">
                
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-center text-sm-left mb-2 mb-sm-0">
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">Create Notification</h4>
                  </div>
                </div>
              </div>
              <div class="tab-content pt-3">
                <div class="tab-pane active">

                  <form class="form" action="{{ route('notifications.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Notification Name</label>
                              <input class="form-control" 
                              type="text" 
                              name="name" 
                              placeholder="Name" 
                              value="{{ old('name') }}">
                            </div>
                            @error('name')
                              <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-sm-9">
                        <h6 class="mb-0">Notification Content</h6>
                          <div class="card-body">
                              <div class="form-group">
                                  <textarea class="ckeditor form-control" 
                                  name="content"></textarea>
                              </div>
                              @error('content')
                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Rank</label>
                              <div id="example">
                                <select id="multiselect"  
                                class="form-control" 
                                name="rank_id[]" 
                                multiple="multiple">
                                  <option value="1">JavaScript</option>
                                  <option value="2">CSS</option>
                                  <option value="3">HTML</option>
                                  <option value="4">Ruby</option>
                                  <option value="5">Go</option>
                                  <option value="6">PHP</option>
                                  <option value="7">ASP.Net</option>
                                  <option value="8">Java</option>         
                                </select>
                              </div>
                              @error('rank_id')
                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>
                        </div>
                        
                      </div>
                    </div>

                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <a href="{{ \URL::previous() }}" class="btn btn-primary">Back</a>
                      </div>
                      <button class="btn btn-success" type="submit">Save</button>
                    </div>

                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection

@section('data-tables-js')
  <link rel="stylesheet" href="MSFmultiSelect.css" />
  <script src="MSFmultiSelect.js"></script>
  <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
  <script>
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });

    var mySelect = new MSFmultiSelect(
      document.querySelector('#multiselect'),
      {
        appendTo: '#example',
        // options here
      }
    );
  </script>
@endsection