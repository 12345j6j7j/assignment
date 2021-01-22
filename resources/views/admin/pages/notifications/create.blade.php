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

                  <form class="form" novalidate="">
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Notification Name</label>
                              <input class="form-control" type="text" name="name" placeholder="John Smith" value="John Smith">
                            </div>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                    
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

@section('data-tables-js')
  <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
  </script>
@endsection