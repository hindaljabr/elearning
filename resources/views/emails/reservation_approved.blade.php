@component('mail::message')
##Hello {{ $user->firstname." ".$user->lastname }}

Thank you!<br />
Your reservation has been APPROVED. <br />

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
