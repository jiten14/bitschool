<x-layout>
    <div class="alert alert-success" role="alert">
        You have successfully applied.
    </div>
    <h2>Hello, {{$student->full_name}}</h2>
    <h3>Your Registration no. is {{$student->reg_no}}</h3>
    <p class="lead">Keep your registration no. handy and contact Admission In-Charge for further process.</p>
</x-layout>