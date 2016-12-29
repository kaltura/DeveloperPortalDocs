---
layout: page
title: Generating Kaltura Sessions with Application Tokens
subcat: Working with Application Tokens
weight: 101
---

The Application Token is used to enable applications to acquire a valid Kaltura Session (KS). The valid KS must be passed with each call to Kaltura's API. The session context embedded into a KS identifies your application, content access permissions, and API access permissions (it also contains other internal session data). This information is securely encrypted and hashed, preventing unauthorized manipulation of the session context.

Your application will use permanent Application Tokens to generate temporary KS tokens. The Application Token is never sent between your server and the API, minimizing the risk of security breaches. In addition, you may generate a KS with fewer privileges than the Application Secret used to generate it, limiting its use to potential attackers.

## How to Create an Application Token  

The Application Token will need to be created by your account administrator (or by Kaltura Professional Services). A developer will then use the Application Token to generate Kaltura Session tokens in her or his applications.

The Application Token is comprised of an ID (ApplicationToken.id) and token (ApplicationToken.token). The Application Token is preconfigured with a maximum session length, a set of content entitlements (category access permissions), and API access privileges. Kaltura Sessions generated using an Application Token will inherit these properties from it. You'll also be told which hash function to use when working with the Application Token (the default is SHA1, but MD5, SHA-256, and others are also available).

See the following articles for details:

* For Account Administrators: [Creating an Application Token User](https://vpaas.kaltura.com/documentation/Media-Ingest-and-Preperation/Account-Representative-Steps.html)
* For Application Developers: [Authorizing with an Application Token](https://vpaas.kaltura.com/documentation/Media-Ingest-and-Preperation/Authorizing-With-Application-Token.html)

## Security Considerations  

* The Application Token and all of its attributes must be securely stored on your backend. It must never be coded into an end-user application.
* The Application Token must never be sent to the Kaltura API. Instead, send the authorization bundle, which includes the Application Token hashed with a salt.
* If the Application Token is compromised, notify your Kaltura technical account representative right away. The Application Token can be deactivated, which will also deactivate any KS tokens it was used to generate.

## Learn More  

* To learn more about creating Application Tokens, check out the Application Token code recipe below:

{% onebox https://developer.kaltura.com/recipes/app_tokens/embed#/start %}

* To learn about creating Application Tokens with Kaltura API, refer to the [developer API site](https://developer.kaltura.com/api-docs/#/appToken).
