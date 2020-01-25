@extends('layouts.main')

@section('page-title', 'Business Categories')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Business Categories</h1>
    </div>

    @include('partials.messages')

    <div class="row tab-search mb-4">
        <div class="col-md-2">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#categoryModal" class="btn btn-primary btn-user btn-block">Add New</a>
        </div>
        <div class="col-md-4"></div>
        <div class="col-lg-6 d-flex flex-row justify-content-end">
            <form method="GET" action="" accept-charset="UTF-8" id="category-form" class="form-inline">
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
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($categories) > 0)
                                    <?php $i = 0; ?>
                                    @foreach($categories as $category)
                                    <?php $i++ ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td class="text-center"><a href="{{ route('business.category.delete', $category->id) }}" onclick="return confirm('Are you sure you want to deactivate this business?')">Delete</a></td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No record available</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Wallet Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{ route('category.add') }}" method="POST" id="categoryModalForm" class="user">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="display: inline-block;" id="categoryModalLabel">Add new Business category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="name" class="form-control form-control-user" required />
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop