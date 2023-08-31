@extends('dashboard.producer.dashboard')
@section('title','MY PROJECT Details')
@section('content')
    <div class="py-3 py-md-5">
        @if(session('delete'))
            <h3 class="text-center text-danger">{{session('delete')}}</h3>
        @endif
        @if(session('message'))
            <h3 class="text-center text-success">{{session('message')}}</h3>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4>project Details
                        <a href="{{ route('my_project') }}" class="btn btn-warning float-end">Back</a>
                        </h4>
                        <hr>
                    </div>
                        <br/>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Project Details</h5>
                            <hr>
                            <h6>
                                Project ID: <span style="color: rgb(50, 205, 89)">{{ $orderDetails->project_id }}</span>
                            </h6>
                            <h6>
                                Order ID: <span style="color: rgb(50, 205, 89)">{{ $order->id }}</span>
                            </h6>
                            <h6>
                                Task Name: <span style="color: rgb(50, 205, 89)">{{ $orderDetails->Task->name }}</span>
                            </h6>
                            <h6>
                                started at: <span style="color: rgb(50, 205, 89)">{{ $orderDetails->created_at->format('y-m-d') }}</span>
                            </h6>
                            <h6>
                                experation time: <span style="color: rgb(50, 205, 89)">{{ $orderDetails->exp_time }}</span>
                            </h6>
                            <h6>
                                Status: <span style="color: rgb(50, 205, 89)">{{ $order->status_message }}</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h5>User Details</h5>
                            <hr>
                            <h6>
                                User ID: <span style="color: rgb(50, 205, 89)">{{ $order->user_id }}</span>
                            </h6>
                            <h6>
                                Name: <span style="color: rgb(50, 205, 89)">{{ $order->fullname }}</span>
                            </h6>
                            <h6>
                                Email: <span style="color: rgb(50, 205, 89)">{{ $order->email }}</span>
                            </h6>
                            <h6>
                                Phone: <span style="color: rgb(50, 205, 89)">{{ $order->phone }}</span>
                            </h6>
                        </div>

                        <h5 class="pt-5">Update the status</h5>
                        <hr>
                        <div class="p-2">
                            {{-- @dd($order) --}}
                            {{-- @foreach ($ordremach as $item)
                                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#compeleteProject{{ $item->id }}">compelete</a>
                                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelProject{{ $item->id }}">cancel</a>
                            @endforeach --}}
                            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#compeleteProject{{ $order->id }}">compelete</a>
                            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelProject{{ $order->id }}">cancel</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
      {{-- modal for delete task --}}
      <div class="modal right fade" id="cancelProject{{ $order->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title fs-5" id="staticBackdropLabel">Cancel task</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('project_cancel',['id' => $order->id]) }}" method="post">
                      @csrf
                      @method('delete')
                      <p>Are you Sure you want to delete this ?</p>
                      <div class="form-footer">
                          <button class="btn btn-warning w-100">delete</button>
                      </div>
                  </form>
              </div>
          </div>
          </div>
      </div>

      {{-- modal for compelete task --}}
      <div class="modal right fade" id="compeleteProject{{ $order->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
              <h4 class="modal-title fs-5" id="staticBackdropLabel">compelete task</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form action="{{ route('project_compelete',['id' => $order->id]) }}" method="post">
                      @csrf
                        <input type="hidden" name="status_message" id="status_message" value="compelete">
                      <p>Are you Sure you compelete this ?</p>
                      <div class="form-footer">
                          <button class="btn btn-success w-100">compelete</button>
                      </div>
                  </form>
              </div>
          </div>
          </div>
      </div>

@endsection
