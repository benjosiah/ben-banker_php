# ben-banker_php
A PHP package that help payment integration using flutterwave's  Rave API
# Get Started 
to get started with banker_php, Start by creating a flutterwave accout. [ Click here ]( https://dashboard.flutterwave.com/signup ) to create an account 

# install package 
install bankw=er_php via composer.
run on your terminal
`composer require ben/banker_php`

# API keys
API keys to access the flutterwave rave API can be gotten at the flutter wave's dashboard.
After Signing in to ypiu account, go to settings->API
[ read more ](https://developer.flutterwave.com/docs/api-keys)

# .env
API keys should be stored be stored in the a `.env` file in the `src` directory.

# Card bin verification
 to Get card bin via banker_php
 require autoload
 `require('vendor/autoload.php')`
  `use Cardify\slamify;`
  
  then call for the function
  `new Slamify`
  ` getCardbin(<bin>)` 
  and pass in the argument of the card bin


# BVN verification
 to verify BVN via banker_php
 require autoload
 `require('vendor/autoload.php')`
  `use Cardify\slamify;`
  
  
  then call for the function
  `new Slamify`
  ` get_bvn(<bvn>)` 
  and pass BVN as the argument


Note: this will require a charge of N50



# Get all banks
 to Get card bin via banker_php
 require autoload
 `require('vendor/autoload.php')`
  `use Cardify\slamify;`
  
  
  then call for the function
  `new Slamify`
  ` getBanks(<country_code>)` 
  and pass in the country code as an argument
  e.g NG for Nigeria.
  it's set to NG b default.


# Account verification

 to Get card bin via banker_php
 require autoload
 `require('vendor/autoload.php')`
  `use Cardify\slamify;`
  
  
  then call for the function
  `new Slamify`
  ` getAccount(<accout_no>, <bank>)` 
  and pass in the account number as the first argument, and the bank code or the bank name as the secound argument

# Card payments
 
 to Get card bin via banker_php
 require autoload
 `require('vendor/autoload.php')`
  `use Cardify\Payment;`
  
  
  then call for the function
  `new Payment`
  `cardPaymet(<payment details>)` 
  and pass in the payment details as an argument


# Post OTP

 to Get card bin via banker_php
 require autoload
 `require('vendor/autoload.php')`
  `use Cardify\Payment;`
  
  
  then call for the function
  `new Payment`
  `postOTP(<otp>)` 
  and pass in the otp as an argument







