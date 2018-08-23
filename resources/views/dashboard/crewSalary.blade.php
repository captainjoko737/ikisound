@extends ('layout.app_home')

<style type="text/css">
.bg {
  /*width: 520px;*/
  background-image: url(assets/image/table-bg.png);
  background-size:100% 100%;
  color:white;
}
</style>
@section('content')


<div class="container " style="overflow-x:auto;" id="page">
	<hr>
	<div class="text-instead-box">
	  <h2>My Salary</h2>           
	  <table class="table text-instead-box bg">
	    <thead>
	      <tr>
	        <th>#</th>
	        <th>Event Date</th>
	        <th>Event Name</th>
	        <th>Event Location</th>
	        <th>Payment Date</th>
	        <th>Salary</th>
	        <th>Status</th>
	      </tr>
	    </thead>
	    <tbody>

	    	@foreach ($resultCrewSalary as $key => $value)
	                
		        <tr>
		          <td>{{$key + 1}}.</td>
		          <td>{{ $value['booking_date'] }}</td>
		          <td>{{ $value['event_name'] }}</td>
		          <td>{{ $value['event_location'] }}</td>
		          <td>{{ $value['payment_date'] }}</td>
		          <td>{{ $value['salary'] }}</td>
		          <td>{{ $value['status_salary'] }}</td>
		        </tr>

		   	@endforeach
	      
	    </tbody>
	  </table>
	</div>
</div>

<div id="loading"></div>

@endsection

@section('js')

<script type="text/javascript">

	function onReady(callback) {
	      var intervalID = window.setInterval(checkReady, 1000);

	      function checkReady() {
	        if (document.getElementsByTagName('body')[0] !== undefined) {
	            window.clearInterval(intervalID);
	            callback.call(this);
	        }
	      }
	  }

	  function show(id, value) {
	    document.getElementById(id).style.display = value ? 'block' : 'none';
	  }

	  onReady(function () {
	    show('page', true);
	    show('loading', false);
	  });
	</script>
</script>

@endsection
