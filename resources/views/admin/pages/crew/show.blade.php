@extends('layout')

@section('content')

<div class="card no-border-top">
    <div class="tab-content" id="userTabContent">
        <div class="tab-pane fade in active show" id="user-podaci" role="tabpanel">
            <div class="card no-border">
                <div class="card-header">
                    <h2><i class="ion-android-social-user"></i> User Details: </h2>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">First Name</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            Kenneth Valdez
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Last Name</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            fip@jukmuh.al
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            (239) 816-9029
                          </div>
                        </div>
                      </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection