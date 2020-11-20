<login-form-component @openresetemailmodal="resetEmailModal" locale="{{ App::getLocale() }}" urlLogin="{{route('login')}}" urlReset="{{route('password.request',['token' => csrf_token()])}}" imgPpal={{ asset('images/img/Login.png') }} oldEmail={{old('email')}} forgPass={{Route::has('password.request')}} v-if="ventanaLogin" @close="ventanaLogin = false">

</login-form-component>
