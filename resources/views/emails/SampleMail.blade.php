@component('mail::message')
# Introduction

Anda menerima email ini karena kami menerima permintaan setel ulang sandi untuk akun Anda.


@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent
