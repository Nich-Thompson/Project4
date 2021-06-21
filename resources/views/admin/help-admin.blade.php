@extends('layouts.app')

@section('content')
    <div class="py-12 px-4">
        <h1>Beheerders handleiding</h1>
        <br>
        <h4>Applicatie</h4>
        <p>Als Beheerder is het uw taak om de gehele applicatie te beheren en in orde te houden. Deze handleiding zorgt voor meer duidelijkheid te geven over de
            functionaliteiten binnen de applicatie.</p>
        <h4>Klanten</h4>
        <p>Op het tab Klanten, komt u bij het klanten overzicht terecht. De belangrijkste gegevens van de klant die te zien zijn in het overzicht is de klantnaam en telefoonnummer.
            Het aanmaken van de klanten wordt gedaan door op de toevoegen knop te drukken. Hierna kan de informatie van de klant ingevuld worden.
            Naast het aanmaken kunt u klanten ook bewerken en archiveren. Doe dit door op een klant te klikken in de lijst.
            Het archief is hier ook te vinden en is beschikbaar onder het knopje Archief, hier kunt u gearchiveerde klanten terughalen of
            alle gearchiveerde klanten definitief verwijderen</p>
        <h5>Locatie</h5>
        <p>Onder een geselecteerde klant, is de locatie overzicht te zien van een klant. Daarin staan de gegevens van de locaties die nodig
            is om bij een toegewezewn inspectieplaats te komen. De inspecties zijn ook uitgevoerd per locatie</p>

        <h4>Inspecteurs beheer</h4>
        <p>Het aanmaken van de inspecteurs wordt gedaan door op de toevoegen knop te drukken. Hierna kunt u de informatie van de inspecteur invullen.
            Naast het aanmaken kunt u inspecteurs ook bewerken en archiveren. Doe dit door op een inspecteur te klikken in de lijst.
            Het archief is hier ook te vinden en is beschikbaar onder het knopje Archief, hier kunt u gearchiveerde inspecteurs terughalen of alle
            gearchiveerde inspecteurs definitief verwijderen</p>

        <h4>Inspectietypes</h4>
        <p>Bij het inspectietypes overzicht worden de aangemaakt inspectietypes weergegeven.
            Bij het Toevoegen van een inspectietype kunt u de naam, beschrijving, kleur en icoon van een inspectietype instellen.
            Om een inspectietype aan te passen kunt u op de blauwe pijl klikken om bij de detail pagina te komen van een inspectietype,
            hieruit kunt u via de "Bewerken" knop het inspectietype aanpassen.</p>
        <h4>Inspectietemplates</h4>
        <p>Bij het Templates overzicht worden de templates weergegeven van inspectieformulieren die gebruikt worden voor inspecties.
            Door op de "+ Toevoegen" knop te klikken kunt u een inspectieformulier template aanmaken met diverse input velden. Bij
            het aanmaken van een inspectietemplate kunt u een lijst toevoegen via de "+Dynamische lijst" knop. De inspecteur zal
            hiermee een waarde kunnen kiezen van de geselecteerde lijst.
            Nadat er een inspectieformulier template is aangemaakt wordt deze voor de inspecteur getoond
            als keuze om een inspectie uit te voeren.</p>
        <h4>Lijsten</h4>
        <p>De menu-toets "Lijsten" wordt gebruikt om specifieke data weer te geven in het inspectieformulier, het geeft aan wat een klant gebruikt.
            Het wordt dan bijvoorbeeld gebruikt om het merk "IP6" aan te geven bij een klant als merk voor brandblussers tijdens het uitvoeren van een inspectie.
            Door op de knop "+ Nieuwe lijst" te klikken uit de "Lijsten" menu-toets kunt u een nieuwe lijst aanmaken. U kunt hier de naam instellen en
            aangeven of het de sublijst is van een bestaande lijst.
            Wanneer de lijst is aangemaakt, komt het onder de "Lijsten" menu-toets terecht. Bij het selecteren van de aangemaakte
            lijst wordt er een overzicht getoond van de lijst.
            Vanuit het overzicht kunt u een typenaam aanmaken via de "+ Toevoegen" toets. Voor bijvoorbeeld de lijst "Blus - Merken" kunt u
            via de "+Toevoegen" knop de merknaam "Ajax" aanmaken.</p>
        <a href="{{ url()->previous() }}" class="btn btn-primary"> Terug</a>
        <br>
    </div>
@endsection
