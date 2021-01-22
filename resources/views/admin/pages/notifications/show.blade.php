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
                            Kenneth Valdez
                          </div>
                        </div>
                        <hr>

                        <div class="row">
                          <div class="col-sm-9">
                            <h6 class="mb-0">Notification Content</h6>
                              <div class="card-body">
                                  <form method="post" action="" enctype="multipart/form-data">
                                      @csrf
                                      <div class="form-group">
                                          <textarea class="ckeditor form-control" name="wysiwyg-editor"></textarea>
                                      </div>
                                  </form>
                              </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col">
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <label>Rank</label>
                                  
                                  <select class="form-select" multiple aria-label="multiple select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                  </select>
      
                                </div>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                       
                      </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
