@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
   
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">All Roles</li>
                </ol>
            </nav>
            @if(Session::has('message'))
                     <div class='alert alert-success'>
                          {{Session::get('message')}}
                      </div>
            @endif
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>  
                    </tr>
                </thead>
                
                <tbody>
                    @if(count($roles)>0)
                          @foreach($roles as
                          $key=>$role)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->description}}</td>
                           
                            <td>
                            @if(isset(Auth()->user()->role->permission['name']['role']['can-edit']))
                             <a href="{{Route('roles.edit', [$role->id])}}">
                                 <i class="fas fa-edit"></i></a> 
                             @endif   
                            </td>
                            

                            <td>

                                <!-- Button trigger modal -->
                                @if(isset(Auth()->user()->role->permission['name']['role']['can-delete']))

                                <a   data-bs-toggle="modal" data-bs-target="#exampleModal{{$role->id}}", href="#">
                                  <i class="fas fa-trash"></i>
                                </a>
                                @endif

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$role->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <!-- {{$role->id}} -->
                                        Are you sure? do you want to delete item?


                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="{{Route('roles.destroy', [$role->id])}}" method="post">@csrf
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
                     
                        <td> No Role to display</td>
                       
                      @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
