test
---
layout: page
title: Generating Kaltura Sessions with Application Tokens
weight: 303
---

## Overview  

The Application Token is used to enable applications to acquire a valid Kaltura Session (KS). The valide KS must be passed with each call to Kaltura's API. The session context embedded into a KS identifies your application, content access permissions, and API access permissions (it also contains other internal session data). This information is securely encrypted and hashed, preventing unauthorized manipulation of the session context.

Your application will use permanent Application Tokens to generate temporary KS tokens. The Application Token is never sent between your server and the API, minimizing the risk of security breaches. In addition, you may generate a KS with fewer privileges than the Application Secret used to generate it, limiting its use to potential attackers.


## Application Token  

Your technical account representative will provide you with an Application Token, which you will use to generate temporary Kaltura Sessions. The Application Token is composed of its ID (ApplicationToken.id) and its token (ApplicationToken.token). It is preconfigured with a maximum session length, a set of content entitlements (Channel access permissions), and API access privileges. The temporary session tokens that the Application Token is used for generating will inherit these preconfigured properties. You will also be told which hash function to use when working with the Application Token (the default is SHA1, but MD5, SHA-256, and others are also available).

### Permissions  

Customers who wish to implement the Application Token will need to have their Kaltura technical account representative set up a user in the Backend with Operator (or higher) roles. You will not be able to proceed until you have a user with these roles.

## Setting Application Tokens for Applications  

To set the Application Token for applications requires both technical account representative and customer functions, which are detailed in the next sections.

### Technical Account Representative Steps  

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

### Application Developer Steps  

To use the functionality required, the developer will need to obtain a KS as follows:

1.	Make the first call to the application using the following: /api/service/ottUser/anonymousLogin, which will supply an anonymous KS.
2.	The application can now call the /api/service/appToken/action/startSession using the parameters id and tokenHash, which were provided by the technical account representative.


| Name        | Type | Writable | Description|
|:------------ |:------------------:|------------------:|------------------:|
| id  | string | X  |The ID of the application token  |
| tokenHash  | string         | V         |The tokenHash is the current anonymous KS (from step 1 above), concatenated with the application token (supplied by the technical account representative), and encrypted using the hashType (also provided by the technical account representative).|


**Note:** The KS generated by the startSession API should be used in all future calls to the API.

### Authorizing with an Application Token  

The following process, illustrated in Figure 1, demonstrates how to build a KS token from an Application Token. The relevant API call details are provided in Table 1 and Table 2.

1. Request an unprivileged KS token ("widget session") using session.getWidgetSession API call (see Table 1). This will return an unprivileged widget session to use in Step 2.
2. Create an authorization bundle by concatenating the widget session and the Application Token's token and then performing a hash of the resulting string: HASH(widgetSession + ApplicationToken.token).
3. Request a privileged KS token by passing the authorization bundle to the appToken.startSession API call (see Table 2). This will return a privileged KS that you can use to make other API calls.
4. Use the KS to make other API calls.

**Figure 1. Application Token Authorization Workflow**

 (![Application Token Authorization Workflow](https://github.com/kaltura/DeveloperPortalDocs/blob/master/documentation/Media-Ingest-and-Preperation/application_token.png)). 
 
### Table 1. session.startWidgetSession  

This table shows the parameters for the **session** service and the **startWidgetSession** action:

| Parameter Name  | Required | Default Value | Notes|
|:------------ |:------------------:|------------------:|------------------:| 
|widgetId |Yes |N/A  |Provide the value _PID (inncluding the leading underscore), where PID is your Kaltura Partner ID. |
|expiry |No | 84600 |The expiry for an unprivileged session is 24 hours (86400 seconds). Do not adjust this value. |
**This action returns an unprivileged widget session that can be used to invoke an appToken.startSession.**

### Table 2. appToken.startSession  

This table shows the parameters for the **appToken** service and the **startSession** action:

| Parameter Name  | Required | Default Value | Notes|
|:------------ |:------------------:|------------------:|------------------:| 
| ks   | Yes | N/A| Provide the widget session generated by session.startWidgetSession.|
|id| Yes| N/A|Provide the ID of your Application Token.|
|tokenHash|Yes|SHA-1|Concatenate the widget session from session.startWidgetSession and the Application Token's token value. Then, perform a hash of the entire string. The hash function to use is provided with your Application Token details.|
|userId|No|N/A|(Advanced) This value is already set in your Application Token. Do not pass this parameter.|
|type|No|N/A|(Advanced) This value is already set in your Application Token. Do not pass this parameter.|
|expiry|No|N/A|This value is already set in your Application Token. Do not pass this parameter.|
**This action returns	a privileged KS that can be used to make other API calls.**


## Security Considerations  

* The Application Token and all of its attributes must be securely stored on your backend. It must never be coded into an end-user application.
* The Application Token must never be sent to the Kaltura API. Instead, send the authorization bundle, which includes the Application Token hashed with a salt.
* If the Application Token is compromised, notify your technical account representative right away. The Application Token can be deactivated, which will also deactivate any KS tokens it was used to generate.
