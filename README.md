![welfare app logo](https://github.com/Kuyas/Welfare/blob/master/app/src/main/res/mipmap-xxxhdpi/ic_launcher_round.png?raw=true) 
# Welfare App Backend
This is the backend code for the android application made by students of [BITS Pilani](http://www.bits-pilani.ac.in/) as their Internship (Practise School) project under Centre of Development for Imaging Technology ([CDIT](http://cdit.org)) 
The application has been made for [Kerala Traders Welfare Board](https://kerala.gov.in/welfare-fund-boards) to allow remote registration of traders. It also allows the traders to pay annual fee, check application status and make changes to details. The code is available in this [repo](https://github.com/Kuyas/Welfare)
The developers are:  
Ishan Bhanuka ([twitu](https://github.com/twitu))  
Omkar Kanade ([omkar-decode](https://github.com/omkar-decode))  
Shreyas Sunil Kulkarni ([Kuyas](https://github.com/Kuyas))

## Note
We have taken a number of design decisions based on given specifications and taken the help of many blogs, videos and only tutorials for implementing the given features. We have used xampp apache to locally host and test our code. The database design is based on the android app requirements.

# Functionality
#### Authentication
login, register and forgot password files for authentication. 
#### Registration forms
personal, family, trading, others, banking forms for storing user data
#### Getting user data
uses mobile number and password of user to retrieve data and store in local cache
#### Claims status
responds with current status of claims
#### Database scripts
SQL scripts to generate database

# Features left to implement
There are many features left to implement before it is completely functional and deployable, however bulk of the work is done.
1. Implement user sessions to prevent sending cache
2. Implement boolean to maintain of form data is changed
3. Make sign up secure by implementing some form of otp feature
4. Make regex checks more robust

# Contribute or use the code
The code works in conjunction with the android app deigned for it and can be directly cloned and run. Feel free to contribute to this project or use it for your own purpose. **For any suggestions or bugs make drop an issue** and we'll get back to you. To contribute make a fork and generate a pull request with your changes (and might need the android app which is in this [repo](https://github.com/Kuyas/Welfare))
