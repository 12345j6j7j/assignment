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
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">Create Rank</h4>
                  </div>
                </div>
              </div>
              <div class="tab-content pt-3">
                <div class="tab-pane active">

                  <form class="form" action="{{ route('ranks.store') }}" method="post">
                    @csrf
                    @method('POST')

                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Name</label>
                              <input class="form-control" 
                              type="text" 
                              name="name" 
                              required="required" 
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
                      <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Save</button>
                      </div>
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