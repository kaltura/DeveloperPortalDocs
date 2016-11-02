test
---
layout: page
title: Generating Kaltura Sessions with Application Tokens
weight: 100
---

The Application Token is used to enable applications to acquire a valid Kaltura Session (KS). The valid KS must be passed with each call to Kaltura's API. The session context embedded into a KS identifies your application, content access permissions, and API access permissions (it also contains other internal session data). This information is securely encrypted and hashed, preventing unauthorized manipulation of the session context.

Your application will use permanent Application Tokens to generate temporary KS tokens. The Application Token is never sent between your server and the API, minimizing the risk of security breaches. In addition, you may generate a KS with fewer privileges than the Application Secret used to generate it, limiting its use to potential attackers.

## How to Create an Application Token  

The Application Token will need to be created by an administrator (or Kaltura professional services provider), which you'll then use to generate temporary Kaltura Sessions. The Application Token is comprised of an its ID (ApplicationToken.id) and token (ApplicationToken.token). 

It is preconfigured with a maximum session length, a set of content entitlements (Channel access permissions), and API access privileges. The temporary session tokens that the Application Token is used for generating will inherit these preconfigured properties. You will also be told which hash function to use when working with the Application Token (the default is SHA1, but MD5, SHA-256, and others are also available).

Once the Application Token user has been created, your developer can then build a KS token from an Application Token. See the next articles for details.

<add links to both articles here when they are ready>

## Security Considerations  

* The Application Token and all of its attributes must be securely stored on your backend. It must never be coded into an end-user application.
* The Application Token must never be sent to the Kaltura API. Instead, send the authorization bundle, which includes the Application Token hashed with a salt.
* If the Application Token is compromised, notify your technical account representative right away. The Application Token can be deactivated, which will also deactivate any KS tokens it was used to generate.
