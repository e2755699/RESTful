# RESTful

Implementing RESTful API architecture in php

##Communicate

URL : http://{yourhost}/{action}/{params}

Http Method/ Data operate : 
  Post : Creat
  Get : Read
  Put : Update
  Delete : Delete
  
Response Status Code:
  200 : OK
  404 : Not fund
  401 : Unauthorized 
  400 : Bad Request
  503 : Service Unavailable
  501 : Not Implemented
  
Demo code(Javascript) :

GET
    var option = {
      url : 'http://localhost/user/dustin',
      type : 'get',
      data : ''
    }
    
    $.ajax(option).reponseText;
    
POST 
    var option = {
      url : 'http://localhost/user/',
      type : 'post',
      data : 'dustin'
    }
    
    $.ajax(option).reponseText;
