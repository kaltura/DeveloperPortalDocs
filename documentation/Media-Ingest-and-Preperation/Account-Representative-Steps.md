test
---
layout: page
title: Creating an Application Token User
subcat: Application Token Steps
weight: 150
---

## Overview  

An Application Token enables clients to provide their development partners or internal technical teams with restricted access to the Kaltura API. Each Application Token restricts the API methods that may be called by its users, and can allow restricted content access for clients who use entitlements (e.g., restricted access to MediaSpace content).

Developers who are provided with an Application Token use it to create temporary Kaltura Session (KS) tokens, which they will then use to access API functions. These KS tokens will have the restrictions of their originating Application Token. The documentation for how to create a KS from an Application Token can be found in this [article](https://knowledge.kaltura.com/node/1280)

## Application Token Design  

The following three attributes are built into the Application Token:

### User with the Desired Content Permissions   

Accounts with entitlements may use a "service user" to restrict the content access permissions of the Appliation Token. You may create a new user, or use an existing user entity (such as a MediaSpace user). This user entity must be correctly permissioned with entitlements to the Channels or categories that you want to provide your development partners.

**Note:** Do not use a KMC user for this purpose, because a KMC user has unrestricted content access.

To create the user, open the KMC, go to the Administration tab, select the Users tab, click **Add User**, and fill in the details in the Add User window.

 (![Add User Window](https://github.com/kaltura/DeveloperPortalDocs/blob/master/documentation/Media-Ingest-and-Preperation/adduser.PNG)). 

## Role with the Required Privileges  

The role determines the allowed actions that this Application Token user will be allowed to perform. Common role permissions are listed in the table under the **Relevant Roles** section below. It is recommended to create a role for each type of Application Token. This way, roles may be changed independently later without affecting other system components or other Tokens.

**Note:** This role dictates the use case, since it tells the API which role to call; therefore, verify that you've set up the role according to your current needs.

1. To set the role, in the Add User window, select **Add Role**. (![Add Role](https://github.com/kaltura/DeveloperPortalDocs/blob/master/documentation/Media-Ingest-and-Preperation/roles1.PNG)). 
2. Enter the role name and description, then and select the relevant set of permissions in the Add Role window. You can select which KMC functionalities are available to users with the defined role. 
3. Clicking the checkmark next to each permission group name will toggle the permission level for the specific KMC functionality according to the following modes:

 * Full Permission (checked) – Grants access to all KMC functionalities listed under the permission group.
 * View-Only Permission (partially checked) – Only part of the functionality listed in the group is selected.
 * No Permission (cleared) – No access to the KMC pages that are relevant to the KMC functionalities listed under the permission group.

(![Setting Role Permissions](https://github.com/kaltura/DeveloperPortalDocs/blob/master/documentation/Media-Ingest-and-Preperation/roles2.PNG)).

When done, save your changes.

**Note:** To view the ID of the role created, you'll need to use the userRole API.

### Hashing Function  

The default and recommended hashing function associated with an Application Token is SHA1. This type of hash function is available to all developers. Because Application Token hashes are salted, it does not pose a security risk. Clients with specific security requirements may select MD5, SHA-256, and SHA-512 functions.

After deciding about these three issues, you're ready to call the API.

1.	Using the Kaltura API for creating users (api_v3/service/user/action/register), create a user that represents the application.
2.	Next, associate the user with a role that has the required application permissions (or create a new role if none exists) using the addRole API (api_v3/service/user/action/addRole). See role considerations above for more information about role association.
3.	Create an Application Token for the user by using the following API: /api/service/appToken/action/add.
4.	Supply the customer with the ID, the value of the token, and hashType as per the following information:

sessionPrivileges: list:*,enableentitlement,privacycontext:MediaSpace_privacy_context,setrole:role_id.

**Note:** The required permissions depend on the application for which the Application Token is being created. For an administrative application, you may want to use of the Operator, Manager, or Administrator roles, which include permissions to all methods. If you are creating a custom limited role, you may want to remove the ‘User’ role that is associated automatically with the user when the user is created (in step 1 above).

### Relevant Roles  

The most likely relevant roles to assign to users of the application Token are:

* Content ingestion
* Content management
* Custom metadata

Note that roles can be either for viewing alone (read-only) or for editing as well.

| Name        | Type | Writable | Description|
|:------------ |:------------------:|------------------:|------------------:|
| id  | strng | X         |The ID of the application token (this ID is not writable; it is returned when the token is completed).  | 
| expiry  | int | V         |	The application token expiration. This must be provided in a UNIX timestamp format. This field is mandatory and should be set when creating the application token. | 
| partnerId  | int | X         |	The partner identifier; this is parameter is not writable and not passed. | 
| sessionDuration  | int | V         |	Expiry duration of KS that was created using the current token (in seconds). The standard is 72-hours (259,200 seconds). | 
| hashType  | string | V         |	The hashType, which can be one of the following:	MD5, SHA1 (default), SHA256, SHA512| 
| sessionPrivileges  | string | V         |	Comma separated privileges, which are defined according to the role that is assigned, and applied to a KS that was created using the current token. |
| sessionType  | int | V         |	The type of Kaltura Session (KS) that was created using the current token, which can be: User = 0, Admin = 2. Nte that nearly all session types will be of type *user* while a small percentage will be of type *admin*.|
| status  | int | X         | The Application Token status, which can be: Disabled =1, Active = 2, Deleted = 3 |
| token  | string | X         |	The application token generated by the system. | 
| sessionUserId  | string | V         |	User ID of the KS that was created using the current token  | 
