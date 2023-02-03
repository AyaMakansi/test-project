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
    </ul>
  </div>
     </nav>  
 <body>
  <table class="table">
    @if(Session::has('success'))
     <div class="alert alert-success" role="alert">
      {{Session::get('success')}}
     </div>
     
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
      {{Session::get('error')}}
     </div>
    @endif
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">{{ __('messeges.offer name') }}</th>
      <th scope="col">{{ __('messeges.offer price') }}</th>
      <th scope="col">{{ __('messeges.offer details') }}</th>
      <th scope="col">{{ __('messeges.photo') }}</th>
      <th scope="col">{{ __('messeges.operation') }}</th>
    </tr>
  </thead>
  <tbody>
    @foreach($offers as $offer)
    <tr>
      <th scope="row">{{$offer->id}}</th>
      <td>{{$offer->name}}</td>
      <td>{{$offer->price}}</td>
      <td>{{$offer->details}}</td>
      <td><img  style="width: 90px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>

      <td> <a href="{{url('offers/edit/'.$offer->id)}}" class="btn btn-success">{{__('messeges.update')}}</a></td>
      <td> <a href="{{route('offers.delete',$offer->id)}}" class="btn btn-danger">{{__('messeges.delete')}}</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
</body>
@endsection
</html>