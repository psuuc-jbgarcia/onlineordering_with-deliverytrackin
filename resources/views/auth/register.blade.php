<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* Custom CSS */
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
            width: 400px;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: #8a2be2;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            color: #333;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            color: #333;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #8a2be2;
        }

        .form-error {
            color: red;
            font-size: 0.8rem;
            margin-top: 6px;
            display: block;
        }

        .form-submit {
            display: block;
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: none;
            background-color: #8a2be2;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-submit:hover {
            background-color: #6c1cb7;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #8a2be2;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .logo {
            display: block;
            margin: 0 auto 20px; /* Center logo horizontally and provide some space */
            width: 150px; /* Adjust width as needed */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <img class="logo" src="notext-removebg-preview.png" alt="Your Logo" >

        <div class="form-title">{{ __('Register') }}</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">{{ __('First Name') }}</label>
                <input id="name"  class="form-input" type="text" name="name" value="{{ old('name') }}" autofocus autocomplete="name" />
                @if ($errors->has('name'))
                    <span class="form-error">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="lname" class="form-label">{{ __('Last Name') }}</label>
                <input id="lname"  class="form-input" type="text" name="lname" value="{{ old('lname') }}" autofocus autocomplete="lname" />
                @if ($errors->has('lname'))
                    <span class="form-error">{{ $errors->first('lname') }}</span>
                @endif
            </div>
            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}"  autocomplete="username" />
                @if ($errors->has('email'))
                    <span class="form-error">{{ $errors->first('email') }}</span>
                @endif
            </div>
          <!-- Address -->
<div class="form-group">
    <label for="address" class="form-label">{{ __('Address') }}</label>
    <input id="address" class="form-input" type="text" name="address" value="{{ old('address') }}"  autocomplete="address" />
    @if ($errors->has('address'))
        <span class="form-error">{{ $errors->first('address') }}</span>
    @endif
</div>
<!-- Phone Number -->
<div class="form-group">
    <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
    <input id="phone" class="form-input" type="text" name="phone" value="{{ old('phone') }}"  autocomplete="tel" />
    @if ($errors->has('phone'))
        <span class="form-error">{{ $errors->first('phone') }}</span>
    @endif
</div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" class="form-input" type="password" name="password"  value="{{ old('password') }}" autocomplete="new-password" />
                @if ($errors->has('password'))
                    <span class="form-error">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" class="form-input" type="password" name="password_confirmation"  value="{{ old('password_confirmation') }}"autocomplete="new-password" />
                @if ($errors->has('password_confirmation'))
                    <span class="form-error">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>

            <!-- Register Button -->
            <button type="submit" class="form-submit">{{ __('Register') }}</button>

            <!-- Login Link -->
            <div class="login-link">
                <a href="{{ route('login') }}">{{ __('Already registered?') }}</a>
            </div>
        </form>
    </div>
</body>
</html>
