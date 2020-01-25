@extends('layouts.main')

@section('page-title', 'Edit Business')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
    <style>
        .chosen-container-multi .chosen-choices {
            height: 50px !important;
            padding-top: 8px;
            border-radius: 15rem !important;
        }
    </style>
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Business Listing</h1>
    </div>

    @include('partials.messages')

    <div class="row">
        <div class="col-xl-9 col-lg-9 mx-none mx-md-auto">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('business.update', $business->id) }}" class="user" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Business Name</label>
                                    <input type="text" name="name" class="form-control form-control-user" value="{{ $business->name }}" />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Contact Person</label>
                                    <input type="text" name="contact_person" class="form-control form-control-user" value="{{ $business->contact_person }}" />
                                </div>
                            </div>                            
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="tel" name="phone" class="form-control form-control-user" value="{{ $business->phone }}" />
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control form-control-user" value="{{ $business->email }}" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" class="form-control form-control-user">{{ $business->description }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea name="address" class="form-control form-control-user">{{ $business->description }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <?php
                                        $selectedCategories = explode(",", $business->category_ids);
                                    ?>
                                    <label for="">Select Categories</label>
                                    <select data-placeholder="Select categories..." class="select chosen-select form-control" multiple style="height: 40px;" name="categories[]">
                                        @if(count($business_categories) > 0)
                                            @foreach($business_categories as $category)
                                                <option value="{{ $category->id }}" {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Photos</label>
                                    <input type="file" name="file" class="form-control form-control-user" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Website URL</label>
                                    <input type="text" name="website_url" class="form-control form-control-user" value={{ $business->website_url }} />
                                </div>                                
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-user">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
    <script>
        $(".chosen-select").chosen();     
    </script>
@endsection