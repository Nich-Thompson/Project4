@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="px-4">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-4 bg-white border-b border-gray-200">
                    <h1 class="float-left h2">{{ $list->name }}</h1>
                    @include('components.help-lijsten')
                    <br><br>
                    @if($headlist != null)
                        <h2 class="float-left h4">Sublijst van: {{ $headlist->name }}</h2>
                    @else
                        <h2 class="float-left h4">Hoofdlijst</h2>
                    @endif
                    <a href="{{ route('getListValueCreate', $list->id) }}" class="float-right btn border"
                       title="Toevoegen">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-plus" viewBox="0 0 16 16">
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Toevoegen</a>
                    <p class="mb-5"></p>
                    <hr/>
                    <div class="d-flex flex-column">
                        <form action="{{ route('postListEdit', $id ) }}" method="post">
                            @csrf
                            <button type="submit" id="saveButton" class="float-right btn btn-primary text-light">
                                Opslaan
                            </button>
                            <div class="form-group ml-2 w-75">
                                <input type="text" name="name" placeholder="Lijstnaam"
                                       class="form-control @error('first_name') is-invalid @enderror"
                                       @if(old('name') != null)
                                       value="{{ old('name') }}"
                                       @else
                                       value="{{ $list->name }}"
                                    @endif>
                            </div>
                        </form>
                    </div>

                    @if(count($values) === 0)
                        <div class="mt-4 bg-white">
                            <h2 class="float-left h3">Deze lijst heeft geen waardes</h2>
                        </div>
                    @else
                        <div class="mt-3 ml-6 d-flex">
                            <table class="table w-99">
                                @php
                                    $list_id = $list->id;
                                @endphp
                                <thead>
                                <tr>
                                    <th>Type naam</th>
                                    @while($list->sublist()->first()!==null)
                                        @php
                                            $list = $list->sublist()->first();
                                        @endphp
                                        <th>{{$list->name}}</th>
                                    @endwhile
                                    <th class="w-11">Aanpassen</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($values as $value)
                                    @php
                                        $id = $value->id;
                                    @endphp
                                    <tr>
                                        <th>
                                            {{ $value->name }}
                                        </th>
                                        @while($value->linked_value() !==null)
                                            @php
                                                $value = $value->linked_value();
                                            @endphp
                                            <th>{{$value->name}}</th>
                                        @endwhile
                                        <th>
                                            <a id="{{$id}}" href="{{ route('getListValueEdit', [
                                            'id' => $id,
                                            'list_id' => $list_id
                                        ]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                                     fill="currentColor" class="bi bi-arrow-right-short"
                                                     viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                          d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                                </svg>
                                            </a>
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
