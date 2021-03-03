@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="px-4">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-4 bg-white border-b border-gray-200">
                    <span class="float-left h2">Inspecteur overzicht</span>
                    <a href="{{URL::to('/inspector/create')}}" class="float-right btn border">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-plus" viewBox="0 0 16 16">
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>Toevoegen</a>
                    <p class="mb-5"></p>
                    <hr/>
                    <form action="{{ route('postRestaurantReserve2', $restaurant -> id) }}" method="post">
                        @csrf
                        <input id="amount_of_people" name="amount_of_people" value = "{{ old('amount_of_people') }}" class="form-control" placeholder="Amount" />
                        <div class="w-100 mt-3">
                            <button type="submit" class="btn btn-primary w-25">Next</button>
                            <a href="{{URL::to('/restaurant')}}" class="float-right btn btn-primary w-20">Back</a>
                        </div>
                    </form>
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

