@extends('layouts.app')

@push('head')
    <!-- Scripts -->
    <script src="{{ asset('js/components/pizza.js')}}"></script>
@endpush

@section('content')
    <div class="py-12">
        <div class="px-4">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-4 bg-white border-b border-gray-200">
                    <h1 class="float-left h2">Archief locaties overzicht</h1>
                    @if(count($locations) > 0)
                        <a href="{{URL::to('/customer/'.$customer_id.'/location/delete')}}"
                           class="float-right btn border mr-2" title="Verwijder alles">Verwijder alles</a>
                    @endif
                    <a href="{{ route('getCustomerEdit', $customer_id)}}" class="float-right btn btn-default" title="Terug naar vorige pagina">Terug</a>
                    <p class="mb-5"></p>
                    <hr/>
                    <div id="customers">
                        @if(count($locations) === 0)
                            <div class="mt-4 bg-white">
                                <h2 class="float-left h3">Geen locaties gevonden</h2>
                            </div>
                        @else
                            @foreach ($locations as $location)
                                <div id='customer-field'
                                     class="row m-2 p-3 rounded border border-light shadow-sm bg-white">
                                    <div class="d-flex flex-column w-50">
                                        <div id="name"
                                             class="h5 m-0 fw-bold">{{ $location->name }}</div>
                                        <p class="m-0">
                                            @if($location->street != null and $location->postal_code != null and $location->building_number == null and $location->number == null)
                                                {{ $location->street }},
                                                @else
                                                {{ $location->street }}
                                            @endif
                                            @if($location->number != null and $location->postal_code != null and $location->building_number == null)
                                                {{ $location->number }},
                                                @else
                                                    {{ $location->number }}
                                            @endif
                                                @if($location->building_number != null and $location->postal_code != null)
                                                    {{ $location->building_number }},
                                                    @else
                                                    {{ $location->building_number }}
                                                @endif
                                                @if($location->postal_code != null)
                                                    {{ $location->postal_code }}
                                                @endif
                                            @if($location->city != null)
                                                te {{ $location->city }}
                                            @endif
                                        </p>
                                        <p class="m-0">{{ date('d-m-Y', strtotime($location->updated_at))}}</p>
                                    </div>
                                    <div class="d-flex flex-column justify-content-end w-50 text-right pb-2">
                                        <form
                                            action="{{ route('restoreLocation',[$location->customer_id, $location->id])}}"
                                            method="post">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-info">Herstel locatie</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                            <div class="mt-4 ml-2">
                                {{$locations->links()}}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


