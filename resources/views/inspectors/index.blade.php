@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="px-4">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-4 bg-white border-b border-gray-200">
                    <span class="float-left h2">Inspecteur overzicht</span>
                    <a href="{{URL::to('/inspector/create')}}" class="float-right btn bi bi-plus">Toevoegen</a>
                    <p class="mb-5"></p>
                    <hr/>
                    @if(count($inspectors) === 0)
                        <div class="bg-white">
                            <p class="float-left h3">No inspectors available</p>
                        </div>
                    @else
                        @foreach ($inspectors as $inspector)
                            <div class="row mb-2 mt-2 p-3 rounded border border-light shadow-sm bg-white">
                                <div class="d-flex flex-column w-50">
                                    <div
                                        class="h5 m-0 fw-bold">{{ $inspector->first_name }} {{ $inspector->last_name }}</div>
                                    <p class="italic">{{ $inspector->phone_number }}</p>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-end w-50">
                                <a class="bi bi-arrow-right-short"
                                   href="{{URL::to('/restaurant/'.$inspector->id.'/details')}}">Details</a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

