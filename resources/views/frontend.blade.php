<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@lang('messages.pagetitle')</title>

    </head>
    <body>

@if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif

<form action="{{ route('frontend.store') }}" method="post">
  @csrf
  <input type="hidden" name="uuid" value="{{$uuid}}"/>
  <fieldset>
   @lang('messages.my_name'): <input type="text" id="name" name="name" required value="{{old('name')}}"><br/>
  </fieldset>
  <fieldset>
    <p>@lang('messages.select_service'):</><br/>
    <table>
@foreach ($services as $service)
    <tr><td>
    <input type="radio" id="service-{{ $service->id }}" name="service_id" value="{{$service->id}}" required>
    <label for="service-{{ $service->id }}">{{$service->description}}</label>
    </td><td>
       @lang('messages.currently_visitors', ['value' => $service->count_adults + $service->count_children])
    </td></tr>
@endforeach
    </table>
  </fieldset>

  <fieldset>
    <input type="number" id="quantityAdults" name="count_adults" min="1" max="9" value="{{old('count_adults', 1)}}" required>
    <label for="quantityAdults">@lang('messages.number_of_visitors')</label>
    <input type="hidden" id="quantityChildren" name="count_children" value="0"/>
  </fieldset>

  <input type="submit" value="@lang('messages.submit')">
</form>

    </body>
</html>
