test
---
layout: page
title: Creating an Application Token User
subcat: AppToken Steps
weight: 150
---

Customers who wish to implement the Application Token will need to have their administrator (or Kaltura professional services provider) create a user with Operator (or higher) roles in the Backend.

When creating this user, you'll need to taken into account three considerations:

1. **Create a user who has the correct content permissions:** For these purposes, you can create a new user or event use an existing one, such as a MediaSpace user. In any case, this user must have the correct entitlements to the channels or categories that you want to provide your customers with access to. These permissions  will be inhertited by the Application Token user. 
2. **Decide which roles you wish the Application Token to have:** The roles determine the set of API actions that this Application Token will be allowed to dperformo. The most common role is PLAYER_ROLE, which has acces to all of the API endpoints, but read-only actions. If you need a dmore sophisticated role, option 2 is to  take a KMC-defined role, such as publisher administrator – and use that one. Option 3 is to go to the KMC and define your own role or work with Kaltura's Professional Services to create a role that meets the specific API services that you want this token to use (e.g., just to read metadata).
3. **Select a hashing function:** You may use the recommended default SHA1, since all hashes are already salted, and this hashing is usually acceptable security for users and easy enough for the developer to create. Other options are available – for security conscious clients may use others such as SHA12, etc., depending on your security approach.

After deciding about these three issues, you're ready to call the API.

1.	Using the Kaltura API for creating users (api_v3/service/user/action/register)(??? Remember to ask Dev about this!!!????, create a user that represents the application.
2.	Next, associate the user with a role that has the required application permissions (or create a new role if none exists) using the addRole API: api_v3/service/user/action/addRole. (AGAIN CHECK THIS API LISTING with Deve!!!}. See role considerations above for more information about role association.
3.	Create an Application Token for the user by using the following API: /api/service/appToken/action/add.
4.	Supply the customer with the ID, the value of the token, and hashType as per the following tables.

**Note:** The required permissions depend on the application for which the Application Token is being created. For an administrative application, you may want to use of the Operator, Manager, or Administrator roles, which include permissions to all methods. If you are creating a custom limited role, you may want to remove the ‘User’ role that is associated automatically with the user when the user is created (in step 1 above).


| Name        | Type | Writable | Description|
|:------------ |:------------------:|------------------:|------------------:|
| id  | strng | X         |The ID of the application token (this ID is not writable; it is returned when the token is completed).  | 
| expiry  | int | V         |	The application token expiration. This must be provided in an a UNIX timestampt format (the default is 20) | 
| partnerId  | int | X         |	The partner identifier; this is parameter is not writable and not passed. | 
| sessionDuration  | int | V         |	Expiry duration of KS that was created using the current token (in seconds). The standard is 24-hours (86,400 seconds); however, for best practice purposes, you may want to set this to 90,000 so that the token doesn't expire in exactly 24 hours but has a safety interval. | 
| hashType  | string | V         |	The hashType, which can be one of the following:	MD5, SHA1, SHA256, SHA512| 
| sessionPrivileges  | string | V         |	Comma separated privileges, which are defined according to the role that is assigned, and applied to a KS that was created using the current token. You may want to use the ones that are assigned to the PLAYER_ROLE, or see review this article, which explains these privileges in detail.???? GET LINK |
| sessionType  | int | V         |	The type of Kaltura Session (KS) that was created using the current token, which can be: User = 0, Admin = 2. Nte that nearly all session types will be of type *user* while a small percentage will be of type *admin*.|
| status  | int | X         | The Application Token status, which can be: Disabled =1, Active = 2, Deleted = 3 |
| token  | string | X         |	The application token  set by the system. | 
| sessionUserId  | string | V         |	User ID of the KS that was created using the current token  | 

