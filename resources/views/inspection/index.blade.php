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
                    <h1 class="float-left h2">Inspecties overzicht</h1>
                    @include('components.help-inspecties')
                    <p class="mb-5"></p>
                    <hr/>
                    {{--                    <p class="font-italic">Zoek op Inspectietype</p>--}}
                    {{--                    <label>Selecteer Inspectietype</label>--}}
                    {{--                    <select>--}}
                    {{--                        @foreach($inspectionTypes as $inspectionType)--}}
                    {{--                            <option class="form-select">{{$inspectionType->name}}</option>--}}
                    {{--                        @endforeach--}}
                    {{--                    </select>--}}

                    <div id="customers">
                        @if(count($inspections) === 0)
                            <div class="mt-4 bg-white">
                                <h2 class="float-left h3">Geen inspecties gevonden</h2>
                            </div>
                        @else
                            @foreach ($inspections as $inspection)
                                <div class="row m-2 p-3 rounded border border-light shadow-sm bg-white">
                                    <div class="d-flex flex-column w-50">
                                        <div
                                            class="h5 m-0 fw-bold">{{ date('d-m-Y', strtotime($inspection->created_at))}}</div>
                                        @if(!is_null($inspection->locked))
                                            <p class="text-danger">Nog niet uitgechecked
                                                door {{$users->firstWhere('id',$inspection->locked)->first_name . " " . $users->firstWhere('id',$inspection->locked)->last_name}}</p>
                                        @endif
                                    </div>
                                    <div class="d-flex flex-column justify-content-end w-50 text-right pb-2">
                                        @if(is_null($inspection->locked))
                                            <a
                                                href="{{ route('getInspectionCopy', $inspection->id) }}"
                                                title="Inspectie kopiëren">
                                                Kopiëer
                                            </a>
                                        @endif
                                        <a id="{{$inspection->id}}"
                                           href="{{URL::to('/inspection/'.$inspection->id.'/edit') /*route('getInspectionEdit', $inspection->id)*/ }}"
                                           title="Inspectie openen">
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
                            <div class="mt-4 ml-2">
                                {{$inspections->links()}}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
