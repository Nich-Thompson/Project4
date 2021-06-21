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
                    <h1 class="float-left h2">Klanten overzicht</h1>
                        @include('components.help-klanten')
                    @if(Auth::user()->hasRole('admin'))
                        <a href="{{URL::to('/customer/create')}}" class="float-right btn border" title="Toevoegen">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                            Toevoegen</a>
                        <a href="{{URL::to('/customer/archives')}}" class="float-right btn border mr-2" title="Archief">
                            Archief</a>
                    @endif
                    <p class="mb-5"></p>

                    <hr/>

                    <form action="{{ route('getSearchCustomers') }}">
                        <div class="input-group">
                            <input type="text" name="searchTerm" class="form-control" value="{{ old('search') }}"
                                   placeholder="Klant zoeken">
                            <button type="submit" class="btn btn-primary">Zoek</button>
                        </div>
                    </form>
                    <p class="font-italic">Zoek op eerste letter van de naam</p>

                    <div id="customers">
                        @if(count($customers) === 0)
                            <div class="mt-4 bg-white">
                                <h2 class="float-left h3">Geen klanten gevonden</h2>
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
                                           href="{{/*URL::to('/customer/'.$customer->id.'/details')*/ route('getCustomerEdit', $customer->id) }}"
                                           title="{{$customer->name . " bekijken"}}">
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
                    <div class="mt-4 ml-2">
                        {{$customers->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/searchCustomer.js') }}"></script>

