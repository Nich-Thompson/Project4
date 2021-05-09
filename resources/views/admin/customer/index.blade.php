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
                    <span class="float-left h2">Klanten overzicht</span>
                    @if(Auth::user()->hasRole('admin'))
                        <a href="{{URL::to('/customer/create')}}" class="float-right btn border">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                            Toevoegen</a>
                    @endif
                    <p class="mb-5"></p>
                    <hr/>

                    <div class="input-group border w-25">
                        <input type="text" id="search" name="search" value="{{ old('search') }}"
                               class="form-control"
                               placeholder="Klant zoeken"/>
                        <span class="input-group-btn">
                                <button id='searchBtn' class="btn btn-default" type="submit">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-search" viewBox="0 0 16 16"><path
                                           d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                                </button>
                            </span>
                    </div>
                    <p class="font-italic">Zoek op eerste letter van de naam</p>

                    <div id="customers">
                        @if(count($customers) === 0)
                            <div class="mt-4 bg-white">
                                <p class="float-left h3">Geen klanten gevonden</p>
                            </div>
                        @else
                            @foreach ($customers as $customer)
                                <div id='customer-field'
                                     class="row m-2 p-3 rounded border border-light shadow-sm bg-white">
                                    <div class="d-flex flex-column w-50">
                                        <div id="name"
                                             class="h5 m-0 fw-bold">{{ $customer->name }}</div>
                                        <p>{{ $customer->contact_phone_number }}</p>
                                    </div>
                                    <div class="d-flex flex-column justify-content-end w-50 text-right pb-2">
                                        <a id="{{$customer->id}}"
                                           href="{{/*URL::to('/customer/'.$customer->id.'/details')*/ route('getCustomerEdit', $customer->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                                 fill="currentColor"
                                                 class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                      d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/searchCustomer.js') }}"></script>

