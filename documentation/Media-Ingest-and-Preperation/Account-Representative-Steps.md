test
---
layout: page
title: Creating an Application Token User
subcat: AppToken Steps
weight: 150
---

Customers who wish to implement the Application Token will need to have their administrator (or Kaltura professional services provider) create a user with Operator (or higher) roles in the Backend.

1.	Using the Kaltura API for creating users (api_v3/service/ottuser/action/register), create a user that represents the application.
2.	Next, associate the user with a role that has the required application permissions (or create a new role if none exists) using the addRole API: api_v3/service/ottuser/action/addRole.
3.	Create an Application Token for the user by using the following API: /api/service/appToken/action/add.
4.	Supply the customer with the ID, the value of the token, and hashType as per the following tables.

**Note:** The required permissions depend on the application for which the Application Token is being created. For an administrative application, you may want to use of the Operator, Manager, or Administrator roles, which include permissions to all methods. If you are creating a custom limited role, you may want to remove the ‘User’ role that is associated automatically with the user when the user is created (in step 1 above).

| Name        | Type | Writable | Description|
|:------------ |:------------------:|------------------:|------------------:|
| id  | strng | X         |The ID of the application token  | 
| expiry  | int | V         |	The application token expiration  | 
| partnerId  | int | X         |	The partner identifier  | 
| sessionDuration  | int | V         |	Expiry duration of KS that was created using the current token (in seconds)  | 
| hashType  | string | V         |	The hashType, which can be one of the following:	MD5, SHA1, SHA256, SHA512| 
| sessionPrivileges  | string | V         |	Comma separated privileges to be applied on KS that was created using the current token. |
| sessionType  | int | V         |	The type of Kaltura Session (KS) that was created using the current token, which can be: User = 0, Admin = 2|
| status  | int | X         | The Application Token status, which can be: Disabled =1, Active = 2, Deleted = 3 |
| token  | string | V         |	The application token  | 
| sessionUserId  | string | V         |	User ID of the KS that was created using the current token  | 

