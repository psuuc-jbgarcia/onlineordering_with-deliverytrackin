    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <style>
        /* Custom CSS */
        body {
            background-color: #f5f5f5;
        }

        .custom-form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column; /* Stack items vertically */
        }

        .custom-form {
            background-color: #fff;
            padding: 30px; /* Increased padding for more height */
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2); /* Increased shadow */
            width: 400px;
            margin-top: 20px; /* Add margin to separate from the logo */
            transition: box-shadow 0.3s ease; /* Smooth transition for shadow */
        }

        .custom-form:hover {
            box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3); /* Adjusted shadow on hover */
        }

        .custom-form label {
            color: #8a2be2;
            font-weight: bold;
            margin-bottom: 6px; /* Added margin-bottom for labels */
        }

        .custom-form input[type="email"],
        .custom-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 6px;
            border: 1px solid #8a2be2;
            background-color: #f5f5f5;
            color: #333;
        }

        .custom-form input[type="email"]:focus,
        .custom-form input[type="password"]:focus {
            outline: none;
            border-color: #8a2be2;
            box-shadow: 0 0 5px #8a2be2;
        }

        .custom-form input[type="checkbox"] {
            margin-right: 6px;
        }

        .custom-form button {
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            background-color: #8a2be2;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px; /* Added margin-top for button */
        }

        .custom-form button:hover {
            background-color: #6c1cb7;
        }

        .custom-form .form-group {
            margin-bottom: 15px; /* Added margin-bottom for form groups */
        }

        .custom-form .form-group:last-child {
            margin-bottom: 0; /* Remove margin-bottom for the last form group */
        }

        .custom-form .form-check {
            margin-bottom: 10px; /* Added margin-bottom for form-check */
        }

        .forgot-password {
            margin-top: 10px; /* Added margin-top for forgot password link */
        }

        .error-message {
            color: red;
            margin-top: 6px; /* Added margin-top for error message */
            font-size: 0.8rem; /* Adjust font size */
        }
        .logo-container {
    display: flex;
    flex-direction: column;
    align-items: center;
}




    </style>

    <div class="custom-form-container">
        <!-- Your Logo -->
        <div class="logo-container mb-4">
    <img src="notext-removebg-preview.png" alt="Your Logo" style="max-height: 200px;">
</div>



        <div class="custom-form">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    @if ($errors->has('email'))
                        <div class="error-message">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                    @if ($errors->has('password'))
                        <div class="error-message">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <!-- Remember Me -->
                <div class="form-group form-check">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <label class="form-check-label text-8a2be2" for="remember_me">{{ __('Remember me') }}</label>
                </div>

                <div class="form-group d-flex justify-content-between">
                    @if (Route::has('password.request'))
                        <a class="text-8a2be2 forgot-password mr-auto" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button type="submit" class="btn btn-primary" style="margin-left: 100px;">{{ __('Log in') }}</button>
                </div>
            </form>
        </div>
    </div>

