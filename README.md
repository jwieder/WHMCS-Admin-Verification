# WHMCS-Admin-Verification
The [demo script](http://docs.whmcs.com/Admin_Password_Hashing) provided by WHMCS for enabling first factor auth verification for admins does not work . This repo resolves the errors with the demo. Tested in WHMCS v6.3.1, but will likely function in v7.x as well. I've gone into more detail explaining why this is neccessary on [my blog](http://www.joshwieder.net/2016/12/how-to-authenticate-whmcs-admin-users.html)

For those who aren't fans of links, these scripts provide a very basic example of how to authentication WHMCS admin users in a non-WHMCS application. If used as-is, these scripts must reside within the root directory of a WHMCS instance. You can avoid this requirement by builiding your own WHMCS API query for this authentication mechanism. I haven't checked yet if symlinks and/or URI redirection or rewriting can be used to avoid this requirement. 

Each line of the PHP script is commented; both the script and HTMl file are almost exactly the same as those provided by WHMCS, the changes I made were largely syntactical.
