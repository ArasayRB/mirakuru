<reset-email-form-component imgPpal="{{ asset('images/img/Login.png') }}" buttonEmail={{__('Send Password Reset Link')}} labelEmail={{ __('E-Mail Address') }} urlResetEmail="{{ route('password.email') }}" titleReset="{{ __('Reset Password') }}" v-if="ventanaResetEmail" @close="ventanaResetEmail = false">
</reset-email-form-component>

<!--/images/img/Login.png

-->
