@extends('cms.application')
@section('content')

<div class="row ">
	<div class="large-6 medium-12 small-12 columns">
		<div class="content-panel">


				<div class="title">

					{{$user->name }} Roles  <a href="{{ URL::route('cms.users.create-user-form', $user->id) }}" class="item-edit">Back to users list</a>
				</div>

				<div class="content content-large">
					{!! Form::open(['route' => 'cms.users.update-user-roles']) !!}
					{!!Form::hidden('user_id',$user->id)!!}
						<table>
							<thead>
								<tr>
									<th>Name</th>
									<th></th>
								</tr>
							</thead>

							<tbody>

							@foreach($roles as $role)
								<tr>
									<td class="show"><label>{!! Form::checkbox('roles[]',$role->id,$role->role_id) !!} {{ $role->name }}</label><a href="{{ URL::route('cms.users.user-permissions-form', $role->id) }}" class="item-edit">View Permissions</a></td>
									<td>

									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
						<div class="row">
							<div class="large-12 small-12 medium-12 columns">
								{!! Form::submit("UPDATE", ['class' => 'custom-button']) !!}
							</div>
						</div>
					{!! Form::close() !!}
				</div>

		</div>

	</div>

</div>


@stop
