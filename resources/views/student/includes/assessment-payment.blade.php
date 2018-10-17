<form action="{{ route('student.pay.with.paypal.post') }}" method="POST" id="hideOnPrint">
	{{ csrf_field() }}
	<input type="hidden" name="amount" value="{{ $assessment->student->balance->balance }}">
	<input type="hidden" name="code" value="{{ $assessment->assessment_number }}">
	<button class="btn" style="background-color:transparent" type="submit"><img src="{{ asset('uploads/imgs/paypal_pay_now.png') }}" height="35px" width="175px"></button>
</form>