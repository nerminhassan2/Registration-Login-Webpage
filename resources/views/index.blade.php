@extends('master')

@section('signup | login')
<li><a href="{{url('login/en')}}"><button id="btnLogin">{{__('msg.Login')}} </button></a></li>
@endsection


@section('head')
@parent
<link rel="stylesheet" href="{{url('CSS\Reg.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>{{__('msg.Register')}}</title>
@endsection


@section('body')
  <br> <br>
  <div class="wrapper">
    <form method="post" action="{{route('sendData')}}" enctype="multipart/form-data" id="form" name="register">
      @csrf
      <br>
      <div class="upload">
        <img src="{{url('149071.png')}}" width=100 height=100 alt="">
        <div class="round">
          <input type="file" name="image">
          <i class="fa fa-camera" style="color: #fff;"></i>
        </div>
      </div>
      <br>
      <div class="input-box">
        <label for="Full_Name"><b>{{__('msg.Full-Name')}} <span class="red-asterisk"></span> </b></label>

        <input type="text" placeholder={{__('msg.Enter Full-Name')}} name="Full_Name" id="Full_Name" required />
      </div>
      <br>
      <div class="input-box">
        <label for="User_Name"><b>{{__('msg.Username')}} <span class="red-asterisk"></span></b></label>
        <input type="text" placeholder={{__('msg.Enter username')}} name="User_Name" id="User_Name" required />
      </div>
      <br>
      <div id="BDate">
        <label for="BDate"><b> {{__('msg.Birthdate')}} <span class="red-asterisk"></span> </b></label>
        <input type="date" value="BDate" id="dd" name="BDate" required />
        <input type="button" value={{__('msg.Send')}} id="BDS">
      </div>
      <br>
      <div class="input-box">
        <label for="phoneNum"><b> {{__('msg.Phone')}} <span class="red-asterisk"></span></b></label>
        <input type="tel" placeholder="xxxxxxxxxxx" name="phoneNum" id="phoneNum" pattern="01[0125][0-9]{8}" required />
      </div>
      <br>
      <div class="input-box">
        <label for="address"><b> {{__('msg.Address')}} <span class="red-asterisk"></span></b></label>
        <input type="text" placeholder="Enter Address" name="address" id="address" required />
      </div>
      <br>
      <div class="input-box">
        <label for="e-mail"><b>{{__('msg.E-mail')}} <span class="red-asterisk"></span> </b></label>
        <input type="email" placeholder="example@gmail.com" pattern="[a-z0-9._%+-]+@gmail.com$" name="e-mail" id="e-mail" required />
      </div>
      <br>
      <div class="input-box">
        <label for="pass"><b>{{__('msg.Passwrd')}} <span class="red-asterisk"></span></b></label>
        <input type="password" name="pass" id="pass" required pattern="^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$" />
        <p><small> <span class="red-asterisk"></span> {{__('msg.At least 8 characters, 1 number literal and 1 special character')}}</small></p>
      </div>
      <br>
      <div class="input-box">
        <label for="confpass"><b>{{__('msg.Confirm Passowrd')}}<span class="red-asterisk"></span> </b></label>
        <input type="password" name="confpass" id="confpass" required onkeyup="passValidation(this.value)" />
        <div id="checkpass"></div>
      </div>
      <div class="g-recaptcha" id="cap" data-callback="recaptchaCallback" data-sitekey="6LcBmYklAAAAADQlk1Y2i8r6Fc_yd6gIZPjJigvf"></div>
      <p id="captchaError"><small> <span class="red-asterisk"></span> {{__('msg.PleaseProve')}}</small></p>
      <br>
      <br>
      <div class="btn-group">
        <input type="button" name="clear" value={{__('msg.Clear')}} onclick="resetForm()">
        <input type="submit" value={{__('msg.Submit')}} id="submitBtn" disabled>
      </div>
      <div id="error"></div>
  </div>
  </form>
  <script src="{{url('JS\signUp.js')}}"></script>

@endsection

