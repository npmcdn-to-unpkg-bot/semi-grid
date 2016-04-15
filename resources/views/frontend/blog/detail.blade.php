<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{$article->title}}</title>
	<!-- Bootstrap Core CSS -->
	<link href="{{URL::asset('/assets/bower/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">
							{{$article->title}}
							<div class="pull-right">
								<i class="fa fa-trash-o" aria-hidden="true"></i>
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</div>
						</h3>
					</div>
					<div class="panel-body">
						{{$article->content}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>