@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="px-4">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-4 bg-white border-b border-gray-200">
                    <h1 class="float-left h2">{{ $type->name }} template versies</h1>
                    <a href="{{URL::to('/template/create')}}" class="float-right btn border" title="Toevoegen">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-plus" viewBox="0 0 16 16">
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Toevoegen</a>
                    <p class="mb-5"></p>

                    <hr/>

                    <div id="templates">
                        @if(count($templates) === 0)
                            <div class="mt-4 bg-white">
                                <h2 class="float-left h3">Geen templates gevonden</h2>
                            </div>
                        @else
                            <span hidden>{{ $i = count($templates) }}</span>
                            @foreach ($templates as $template)
                                <div id='customer-field'
                                     class="row m-2 p-3 rounded border border-light shadow-sm bg-white">
                                    <div class="d-flex flex-column w-50">
                                        <div id="name"
                                             class="h5 m-0 fw-bold">{{ $template->created_at->format('Y-m-d H:i') }}
                                            @if($i == count($templates))
                                                [Actieve versie]
                                            @endif
                                        </div>
                                        <label class="">Versie {{ $i }}</label>
                                    </div>
                                    <div class="d-flex flex-column justify-content-end w-50 text-right pb-2">
                                        <a id="{{$template->id}}"
                                           href="{{ route('getTemplateEdit', $template->id) }}"
                                           title="versies">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                                 fill="currentColor"
                                                 class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                      d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <span hidden>{{ $i-- }}</span>
                            @endforeach
                        @endif
                    </div>
                    <br>
                    <a href="{{URL::to('/template')}}" class="btn btn-default"
                       title="Terug naar vorige pagina">Terug</a>
                </div>
            </div>
        </div>
    </div>
@endsection
