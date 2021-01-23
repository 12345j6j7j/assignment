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
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{ $user->name }} {{ $user->surname }}</h4>
                  </div>
                </div>
              </div>
              <div class="tab-content pt-3">
                <div class="tab-pane active">
                  
                  <form class="form"  action="{{ route('users.update', $user) }}" method="post">
                    @csrf
                    @method('PATCH')
                    
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          
                          <div class="col">
                            <div class="form-group">
                              <label>First Name</label>
                              <input class="form-control" 
                              type="text" 
                              name="name" 
                              placeholder="First Name" 
                              value="{{ old('name', $user->name) }}">
                              @error('name')
                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>

                          <div class="col">
                            <div class="form-group">
                              <label>Last Name</label>
                              <input class="form-control" 
                              type="text" 
                              name="surname" 
                              placeholder="Last Name" 
                              value="{{ old('surname', $user->surname) }}">
                              @error('surname')
                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>

                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Email</label>
                              <input class="form-control" 
                              type="email" 
                              name="email"
                              placeholder="Email"
                              value="{{ old('email', $user->email) }}">
                              @error('email')
                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12 col-sm-12 mb-3">
                        <div class="mb-2"><b>Change Password</b></div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Current Password</label>
                              <input class="form-control"
                               type="password" 
                               placeholder="••••••"
                               value="">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>New Password</label>
                              <input class="form-control" type="password" placeholder="••••••">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                              <input class="form-control" type="password" placeholder="••••••"></div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12 col-sm-6 mb-3">
                        <div class="mb-2"><b>Select Ship</b></div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              
                              {{ Form::select('ship_id', $ships, $user->ship_id ?? null, ['label' => 'Select Ship']) }}

                              @error('ship_id')
                                <div class="invalid-feedback" style="display: block">{{ $message }}</div>
                              @enderror

                            </div>
                          </div>
                        </div>
                        
                        <div class="mb-2"><b>Select Rank</b></div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              
                              {{ Form::select('rank_id', $ranks, $user->rank_id ?? null, ['label' => 'Select Rank']) }}

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
                      <button class="btn btn-success" type="submit">Save Changes</button>
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
