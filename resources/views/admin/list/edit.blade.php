@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="px-4">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-4 bg-white border-b border-gray-200">
                    <span class="float-left h2">{{ $list->name }}</span>
                    <p class="mb-5"></p>
                    <hr/>
                </div>
            </div>
        </div>
    </div>
@endsection
