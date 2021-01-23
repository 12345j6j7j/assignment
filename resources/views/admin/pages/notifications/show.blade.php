@extends('layout')

@section('content')

<div class="card no-border-top">
    <div class="tab-content" id="userTabContent">
        <div class="tab-pane fade in active show" id="user-podaci" role="tabpanel">
            <div class="card no-border">
                <div class="card-header">
                    <h2><i class="ion-android-social-user"></i> Notification Details: </h2>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Notification Name</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ $notification->name }}
                          </div>
                        </div>
                        <hr>

                        <div class="row">
                          <div class="col-sm-9">
                            <h6 class="mb-0">Notification Content</h6>
                              <div class="card-body">
                                  <textarea type="text"
                                   class="form-control text-area">{{ $notification->content }}</textarea>
                              </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col">
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Rank</label>
                                  
                                  {{ Form::select('rank_id[]', $ranks, $selectedRanks, 
                                  ['class' => 'form-control', 'multiple' => 'multiple']) }}
      
                                  @error('rank_id')
                                    <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                                  @enderror
      
                                </div>
                              </div>
                            </div>
                            
                          </div>
                        </div>

                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <a href="{{ \URL::previous() }}" class="btn btn-primary">Back</a>
                      </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
