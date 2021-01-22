@extends('layout')

@section('content')

<div class="card no-border-top">
    <div class="tab-content" id="userTabContent">
        <div class="tab-pane fade in active show"role="tabpanel">
            <div class="card no-border">
                <div class="card-header">
                    <h2><i class="ion-android-social-user"></i> Rank Details: </h2>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Rank Name</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ $rank->name }}
                          </div>
                        </div>
                        <hr>
                      </div>
                    </div>
              </div>
        </div>
    </div>
</div>

@endsection