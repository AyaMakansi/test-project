@extends('layouts.app')
@section('content')   
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      
      <li class="nav-item active">
        <a class="nav-link" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }} <span class="sr-only">(current)</span></a>
      </li>
      @endforeach
      
      
</nav>  
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('messeges.add offer') }}</div>
             @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{route('offers.update',$offer->id) }}"  enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('messeges.choose photo') }}</label>

                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control" name="photo">

                                @error('photo')
                                   <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                               </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('messeges.offer name en') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " name="name_en" value="{{$offer->name_en}}" >

                                @error('name_en')
                                   <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                               </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('messeges.offer name ar') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " name="name_ar" value="{{$offer->name_ar}}"  >

                                @error('name_ar')
                                   <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                               </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('messeges.offer price') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="integer" class="form-control" name="price" value="{{$offer->price}}" >

                                @error('price')
                                   <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                       </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('messeges.offer details en') }}</label>

                            <div class="col-md-6">
                                <input id="details" type="text" class="form-control " name="details_en" value="{{$offer->details_en}}"  >

                                @error('details_en')
                                   <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                               </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('messeges.offer details ar') }}</label>

                            <div class="col-md-6">
                                <input id="details" type="text" class="form-control " name="details_ar" value="{{$offer->details_ar}}"  >

                                @error('details_ar')
                                   <small class="form-text text-danger">{{$message}}</small>
                                @enderror
                               </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messeges.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </body>
    @endsection
</html>