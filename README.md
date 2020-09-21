

## Documentation for REST API endpoints built with PHP 
+ This API has the login,register,profile and edit profile endpoint
+ Demo for this project is available at Endpoint URL:  [https://chrony.netlify.app/login](https://chrony.netlify.app/login)

Let's get started

### REGISTER ENDPOINT

Endpoint URL:  [http://echeckers.000webhostapp.com/chrony/register](http://echeckers.000webhostapp.com/chrony/register)

This endpoint accepts a POST request with a JSON request body

Request BODY: {
 - Email Address of the user to be registered
 - Username of the user to be registered
 - Password of the user to be registered 
}

#### Sample Body : '{"email":"email@dev.com","username":"username","password":"password"}'

Request Response (Registration Successful) : Code : 200 
                  Text : "Token"

Other Responses : COde : 203,
The text varies from
 - Email Already exists
 - Email Address or Username Invalid
 - Password is less than 8 characters
 
 
 ### INDEX:
 Token : The request body for successful request is the assigned token for the user. The token should be cached on the browser for use in further requests like
 profile and edit profile 
 
 
 
 + Example Request With Javascript
 ```javascript
            var data = JSON.stringify({"email":email,"username":username,"password":password});
                        fetch('http://echeckers.000webhostapp.com/chrony/register',{
                            method:'POST',
                            body:data,
                        })
```

## Login ENDPOINT

Endpoint URL:  [http://echeckers.000webhostapp.com/chrony/login](http://echeckers.000webhostapp.com/chrony/login)

This endpoint accepts a POST request with a JSON request body

Request BODY: {
 - Email Address of the user 
 - Password of the user 
}

#### Sample Body : '{"email":"email@dev.com","password":"password"}'

Request Response (Registration Successful) : Code : 200 
                  Text : "Token"

Other Responses : COde : 203,
The text varies from
 - Email Address or Password Empty
 - Email Address Invalid
 - Email Address or Password Incorrect
 
 
 
 ### INDEX:
 Token : The request body for successful request is the assigned token for the user. The token should be cached on the browser for use in further requests like
 profile and edit profile 
 
 
 
 + Example Request With Javascript
 ```javascript
            var data = JSON.stringify({"email":email,"password":password});
                        fetch('http://echeckers.000webhostapp.com/chrony/login',{
                            method:'POST',
                            body:data,
                        })
```

## PROFILE ENDPOINT
//This endpoint would be called to retrieve User details 
Endpoint URL:  [http://echeckers.000webhostapp.com/chrony/profile](http://echeckers.000webhostapp.com/chrony/profile)

This endpoint accepts a POST request with a Header AuthToken

Request Headers {
  AuthToken : Token (Token sent after registration or login)
}



Request Response (Registration Successful) : Code : 200 
                  Text : {"email":email,"username":username,"password":password}

Other Responses : COde : 203,205
The text varies from
- Invalid Authentication Token
- Expired Authentication Token
 
 
 ### INDEX:
 Token :The token is returned after signing in from the login endpoint
 
 
 
 + Example Request With Javascript
 ```javascript
                        fetch('http://echeckers.000webhostapp.com/chrony/profile',{
                          method:'POST',
                          headers:{
                              'AuthToken':token,
                          }
                       })
                       
```

## EDIT PROFILE ENDPOINT

+ This endpoint receives a new username for the user and changes it 

Endpoint URL:  [http://echeckers.000webhostapp.com/chrony/edit](http://echeckers.000webhostapp.com/chrony/edit)

This endpoint accepts a POST request with a JSON request body

Request Headers {
  AuthToken : Token (Token sent after registration or login)
}
Request Body {
  - Username to be changed
}


Request Response (Registration Successful) : Code : 200 
                  Text : Successful

Other Responses : COde : 203,205
The text varies from
- Invalid Authentication Token
- Expired Authentication Token
- Username should contain only letters
 
 ### INDEX:
 Token :The token is returned after signing in from the login endpoint
 
 
 
 + Example Request With Javascript
 ```javascript          
                         var data = JSON.stringify({"username":username});
                        fetch('http://echeckers.000webhostapp.com/chrony/edit',{
                          method:'POST',
                          headers:{
                              'AuthToken':token,
                          },
                          body : data
                       })
                       
```


