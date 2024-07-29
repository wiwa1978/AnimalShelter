<x-mail::message>
	You have been invited to join {{ config('app.name') }}

	To accept the invitation - click on the link below and create an account:

	<x-mail::button :url="$acceptUrl">
		{{ __('Create Account') }}
	</x-mail::button>

	{{ __('If you have any questions, please contact us at') }} < href="mailto:{{ config('mail.from.address') }}">
		{{ config('mail.from.address') }}

</x-mail::message>
