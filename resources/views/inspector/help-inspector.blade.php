@extends('layouts.app')

@section('content')
    <div class="py-12 px-4">
        <h1>Inspecteur's handleiding</h1>



        <p>Als inspecteur is het uw taak om bij het inspecteren van klanten een inspectie formulier in te vullen.</p>
        <p>U heeft daarom de mogelijkheid om klantgegevens te bekijken met de bijbehorende locatie en inspecties.</p>
        <p>Voor het aanmaken van een inspectie krijgt u de keuze uit meerdere inspectietemplates.
             Via het inspectietemplate kunt u een inspectieformulier invullen door de vakken in te vullen met de juiste gegevens.</p>
        <p>Elke keer wanneer u de gegevens invoert, kunt u op de knop "Invoeren" drukken om het formulier aan te vullen.</p>
        <p>Nadat u klaar bent met het aanvullen van de formulier met de benodigde gegevens kunt u het afronden door op "Uitchecken" te klikken.</p>
        <p>Zo wordt het inspectie formulier toegevoegd aan het inspecties overzicht van de geïnspecteerde klant.</p>
        <p>Om een inspectie aan te kunnen passen kunt u via het inspectie overzicht op de blauwe pijl een inspectie aanpassen,
            u kunt hier de inspecteur die de inspectie heeft uitgevoerd aanpassen voor in het geval dat er een nieuwe ' +
            inspecteur verantwoordelijk voor is.</p>

        <a href="{{ url()->previous() }}" class="btn btn-primary"> Terug</a>
    </div>
@endsection

