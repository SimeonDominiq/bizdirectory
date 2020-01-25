<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Business Listing Directory</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />

</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-md-auto">
                    <div class="intro-text">
                        <div class="intro-lead-in">
                            <h3>Search & Connect with Businesses.</h3>
                        </div>
        
                        <div class="form-container mt-4">
                            <form action="" class="" method="GET">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <input type="text" name="search" id="search" class="form-control input-rounded" placeholder="Enter text to search.." />
                                    </div>
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-primary btn-block btn-rounded">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <h3 class="mb-4">Recent Listing</h3>

            <div class="row">
                @if(count($businesses) > 0)
                    @foreach($businesses as $business)
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <img class="mr-3" src="https://via.placeholder.com/100" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h5 class="mt-0"><a href="{{ route('business.view', $business->id ) }}">{{ ucfirst($business->name) }}</a></h5>
                                        {{ strlen($business->description) > 80 ? substr($business->description, 0, 80).'...' : $business->description }}
                                        <p class="mt-3"><i class="fas fa-map-marker-alt"></i> {{ $business->address }}</p>

                                        <div class="text-right">
                                            <i class="far fa-eye"></i> {{$business->views_count}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h5>No record available</h5>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row justify-content-end">
                <div>
                    {!! $businesses->links() !!}
                </div>
            </div>
        </div>
    </section>
</body>
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
</html>