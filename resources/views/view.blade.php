<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$business->name}} || Business Listing Directory</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />

</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-left">
                    <a href="{{ url('/') }}" class="d-inline-block py-4"><i class="fas fa-arrow-left"></i> Back to listing</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-md-auto">
                    <div class="intro-text">
                        <div class="intro-lead-in">
                            <h3>{{$business->name}}</h3>
                            <p><i class="fas fa-map-marker-alt"></i> {{ $business->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h5 class="font-weight-bold">Description</h5>
                    {{ $business->description }}

                    <h5 class="mt-4 font-weight-bold">Categories</h5>
                    @if(count($business->categories) > 0)
                        @foreach ($business->categories as $category)
                            <span class="badge badge-primary">{{ $category['name'] }}</span>
                        @endforeach
                    @else
                        None
                    @endif
                </div>

                <div class="col-lg-5">
                    MAP
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