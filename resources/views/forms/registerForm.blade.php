<register-form-component urlRegister="{{route('register')}}" imgPpal={{ asset('images/img/Registrar.png') }} titleRegister={{ __('Register') }} labelName={{ __('Name') }} labelEmail={{ __('E-Mail Address') }} labelPass={{ __('Password') }} labelConfirmPass={{__('Confirm Password')}} v-if="ventanaRegister" @close="ventanaRegister = false">

</register-form-component>
