@extends('layouts.main')

@section('page-title', 'Businesses')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Businesses</h1>
    </div>

    @include('partials.messages')
    
    <div class="row tab-search mb-4">
        <div class="col-md-2">
            <a href="{{ route('business.new') }}" class="btn btn-primary btn-user btn-block">Add New</a>
        </div>
        <div class="col-md-4"></div>
        <div class="col-lg-6 d-flex flex-row justify-content-end">
            <form method="GET" action="" accept-charset="UTF-8" id="category-form" class="form-inline">
                {!! Form::select('status', $statuses, Request::input('status'), ['id' => 'status', 'class' => 'form-control mr-3']) !!}
                <div class="input-group">
                    <input type="text" class="form-control" name="search" value="{{ Request::input('search') }}" placeholder="Search...">
                    <div class="input-group-prepend">
                        <button class="btn btn-primary" type="submit" id="search-company-btn">
                            <i class="fas fa-search"></i>
                        </button>
                        @if (Request::has('search') && Request::input('search') != '')
                            <a href="{{ route('business.category') }}" class="btn btn-danger" type="button" >
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>            
        </div>
    </div>  

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Contact Person</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Views</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($businesses) > 0)
                                    <?php $i = 0; ?>
                                    @foreach($businesses as $business)
                                    <?php $i++ ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $business->name }}</td>
                                        <td>{{ $business->contact_person }}</td>
                                        <td>{{ $business->phone }}</td>
                                        <td>{{ $business->email }}</td>
                                        <td>
                                            @if($business->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $business->views_count }}</td>
                                        <td>
                                            @if($business->status == 1)
                                                <a href="{{ route('business.deactivate', $business->id) }}"  onclick="return confirm('Are you sure you want to deactivate this business?')">Deactivate</a>
                                            @else
                                                <a href="{{ route('business.activate', $business->id) }}"  onclick="return confirm('Are you sure you want to activate this business?')">Activate</a>
                                            @endif
                                            ||
                                            <a href="{{ route('business.edit', $business->id) }}">Edit</a> || 
                                            <a href="{{ route('business.delete', $business->id) }}">Delete</a>
                                        </td>

                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">No record available</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $("#status").change(function () {
            $("#category-form").submit();
        });        
    </script>
@stop

