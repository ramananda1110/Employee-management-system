@extends('admin.layouts.master')

@section('content')
<div class="container mt-5" >
    <div class="row justify-content-center">
   
        <div class="col-md-10">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">All Rooms</li>
                </ol>
            </nav>
            @if(Session::has('message'))
                     <div class='alert alert-success'>
                          {{Session::get('message')}}
                      </div>
            @endif
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Capacity</th>
                        <th>Facilities</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if(count($rooms)>0)
                          @foreach($rooms as
                          $key=>$room)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$room->name}}</td>
                            <td>{{$room->location}}</td>
                            <td>{{$room->capacity}}</td>
                            <td>{{$room->facilities}}</td>
                           
                            <td>
                            @if(isset(Auth()->user()->role->permission['name']['role']['can-edit']))
                            <a style="margin-right: 5px;" href="{{Route('rooms.edit', [$room->id])}}">
                                 <i style="color:gray" class="fas fa-edit"></i></a> 
                             @endif   
                            <!-- </td> -->
                            
                           

                            <!-- <td> -->

                                <!-- Button trigger modal -->
                                @if(isset(Auth()->user()->role->permission['name']['role']['can-delete']))

                                <a  data-bs-toggle="modal"  data-bs-target="#exampleModal{{$room->id}}", href="#">
                                  <i style="color:gray" class="fas fa-trash"></i>
                                </a>
                                @endif

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$room->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                      
                                        Are you sure? do you want to delete item?


                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{Route('rooms.destroy', [$room->id])}}" method="post">@csrf
                                                    {{method_field('DELETE')}}
                                                    <button class="btn btn-outline-danger">
                                                        Delete
                                                    </button>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                              </td>
                        </tr>
                    @endforeach
                     @else
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> No Rooms to display</td>
                        <td></td>
                        <td></td>
                      @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
