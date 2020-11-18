<login-form-component @openresetemailmodal="resetEmailModal" urlLogin="{{route('login')}}" urlReset="{{route('password.request',['token' => csrf_token()])}}" imgPpal={{ asset('images/img/Login.png') }} titleLogin={{ __('Login') }} labelEmail={{ __('E-Mail Address') }} oldEmail={{old('email')}} forgPass={{Route::has('password.request')}} labelPass={{ __('Password') }} v-if="ventanaLogin" @close="ventanaLogin = false">

</login-form-component>
