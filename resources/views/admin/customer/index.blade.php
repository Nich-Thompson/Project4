@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <span class="h2">Customers</span>
                    <a href="customer/create">
                    <button class="btn float-right bg-success">Aanmaken</button>
                    </a>
                </div>
                <div class="mx-4">
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>ExampleID</td>
                            <td>ExampleName</td>
                            <td>
                            <input type="submit" class="btn sahdow-sm mr-4" value="Selecteer" />
                            <input type="submit" class="btn sahdow-sm" value="Aanpassen" />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection