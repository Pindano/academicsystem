<x-layout></x-layout>
<x-teachernav>
    @foreach($exams as $exam)
        <h1>{{$exam}}</h1>
    @endforeach

</x-teachernav>
