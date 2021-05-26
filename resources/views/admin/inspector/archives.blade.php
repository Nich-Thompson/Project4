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
                    <h1 class="float-left h2">Archief inspecteurs overzicht</h1>
                    <p class="mb-5"></p>
                    <hr/>
                    <div id="customers">
                        @if(count($inspectors) === 0)
                            <div class="mt-4 bg-white">
                                <h2 class="float-left h3">Geen inspecteurs gevonden</h2>
                            </div>
                        @else
                            @foreach ($inspectors as $inspector)
                                <div id='customer-field'
                                     class="row m-2 p-3 rounded border border-light shadow-sm bg-white">
                                    <div class="d-flex flex-column w-50">
                                        <div id="name"
                                             class="h5 m-0 fw-bold">{{ $inspector->first_name}} {{ $inspector->last_name }}</div>
                                        <p class="m-0">{{ date('d-m-Y', strtotime($inspector->updated_at))}}</p>
                                    </div>
                                    <div class="d-flex flex-column justify-content-end w-50 text-right pb-2">
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

