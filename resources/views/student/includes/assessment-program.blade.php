<h3 class="text-center showOnPrint">International Computer Technology Colleges</h3>
<p class="text-center showOnPrint">Your Gateway to a Global Job Opportunity</p>
<p class="text-center showOnPrint">2<sup>nd</sup> of AA building, Barangay Sto Cristo, Tarlac City</p>
<p class="showOnPrint"><strong>{{ ucwords(Auth::user()->firstname . ' ' . Auth::user()->lastname) }} - {{ Auth::user()->student_number }}</strong></p>

<div class="courseAssessment">

<p>Assessment for <strong>{{ $assessment->program->title }}</strong></p>
<p>Tuition Fee: <strong>&#8369; {{ $assessment->tuition_fee }}</strong></p>
<p>Miscellaneous Fee: <strong>&#8369; {{ $assessment->misc_fee }}</strong></p>
<hr>
<p>Total: <strong>&#8369; {{ $assessment->student->balance->balance }}</strong></p>
<hr>

</div>