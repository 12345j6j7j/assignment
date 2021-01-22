@extends('layout')

@section('content')

<div class="card no-border-top">
    <div class="tab-content">
        <div class="tab-pane fade in active show" role="tabpanel">
            <div class="card no-border">
                <div class="card-header">
                    <h2><i class="ion-android-social-user"></i> Ship Details: </h2>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Ship Name</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ $ship->name }}
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Serial Number</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            {{ $ship->serial_number }}
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Image</h6>
                            <div class="d-flex flex-column align-items-center text-center">
                              
                              <div class="product-details-image-holder bg-shade-whisper">
                                <img src="{{ $ship->image ? asset('storage/' . str_replace("public/","",$ship->image)) : "https://dummyimage.com/825x478/999999/000000&text=630x400" }}">
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