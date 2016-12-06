---
layout: page
title: Authorizing with an Application Token
subcat: Application Token Steps
weight: 151
---

This article details how to build a KS token from an Application Token. The relevant API call details are provided in Tables 1 and 2 below.

**Application Token Authorization Workflow**

1. Request an unprivileged KS token ("widget session") using the session.getWidgetSession API call (see Table 1 below). This will return an unprivileged widget session to use in Step 2.
2. Next, create an authorization bundle by concatenating the widget session and the Application Token's token and then performing a hash of the resulting string: HASH(widgetSession + ApplicationToken.token).
3. Request a privileged KS token by passing the authorization bundle to the appToken.startSession API call (see Table 2 below). This will return a privileged KS that you can use to make other API calls.
4. Use the KS to make other API calls.

![Application Token Authorization Workflow](./images/application_token_flow.png) 

### Table 1. session.startWidgetSession  

This table shows the parameters for the **session** service and the **startWidgetSession** action:

| Parameter Name | Required | Default Value | Notes                                                                                             |
|----------------|----------|---------------|---------------------------------------------------------------------------------------------------|
| widgetId       | Yes      | N/A           | Provide the value _PID (including the leading underscore), where PID is your Kaltura Partner ID. |
| expiry         | No       | 84600         | The expiry for an unprivileged session is 24 hours (86400 seconds). Do not adjust this value.     |

**This action returns an unprivileged widget session that can be used to invoke appToken.startSession.**

### Table 2. appToken.startSession  

The table shows the parameters for the **startSession** action of the **appToken** service.

**When making this call, ensure the KS being passed by your application is the widget session returned by the previous call to startWidgetSession**.

| Parameter Name  | Required | Default Value | Notes|
|------------ |------------------|------------------|------------------|
|id | Yes| N/A |Provide the ID of your Application Token. |
|tokenHash |Yes |SHA-1 |Concatenate the widget session from session.startWidgetSession and the Application Token's token value. Then, perform a hash of the entire string. The hash function to use is provided with your Application Token details. |
|userId |No |N/A |(Advanced) This value is already set in your Application Token. Do not pass this parameter. |
|type |No |N/A |(Advanced) This value is already set in your Application Token. Do not pass this parameter. |
|expiry |No |N/A |This value is already set in your Application Token. Do not pass this parameter. |
 
**This action returns	a privileged KS. Change your application's KS to this new value to make other API calls.**

### Sample PHP Code  

```require_once('php5/KalturaClient.php');
$config = new KalturaConfiguration();
$config->serviceUrl = 'https://www.kaltura.com';
$config->method = 'GET';
$client = new KalturaClient($config);

// EXAMPLE 0 - Generate and set a KS from an App Token
$widgetSession = $client->session->startWidgetSession('_PARTNER_ID'); // Note the leading underscore (_)
$client->setKs($widgetSession->ks);
$session = $client->appToken->startSession('INSERT_APP_TOKEN_ID', sha1($widgetSession->ks . 'INSERT_APP_TOKEN_SECRET'));
$client->setKs($session->ks);
// END EXAMPLE 0```

