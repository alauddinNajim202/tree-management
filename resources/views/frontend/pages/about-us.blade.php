@extends('frontend.app')

@section('content')
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li class='active'>About Us</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="terms-conditions-page">
			<div class="row">
				<div class="col-md-12 terms-conditions">
                    <h2 class="heading-title">About Us</h2>
                    <div class="">
                        @if($content)
                            {!! $content !!}
                        @else
                            <p>About Us content will be updated soon.</p>
                        @endif
                    </div>
                </div>			
            </div><!-- /.row -->
		</div><!-- /.sigin-in-->
	</div><!-- /.container -->
</div><!-- /.body-content -->
@endsection
