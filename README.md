store webservice info :
post http://localhost/V1/buyer register as buyer required {fullname,username,password}
post http://localhosy/V1/seller register as seller required {fullname,username,password}
get http://localhost/V1/buyer list all buyer required {admin accesstoken}
get http://localhost/V1/seller list all seller required {admin accesstoken}
get http://localhost/V1/user list all user (buyer,seller) required {admin accesstoken}
post http://localhost/V1/seller/sessions login as seller required {username,password}
post http://localhost/V1/buyer/sessions login as buyer required {username,password}
post http://localhost/V1/admin/sessions lohin as admin required {username,password}