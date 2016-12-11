Kaltura's API is a REST-based web service accessed over HTTP. REST APIs provide a simple and easy interface for communication between applications and the Kaltura server. However, this can also be a door for weaknesses in your applications if you overlook proper security and authentication when designing your applications.
Kaltura was designed with privacy and security standards in mind, while at the same time providing openness of Kaltura’s technology as an open source platform and providing flexible integration models for open and free applications as well as highly secured and limitted applications.
The following overview describes the authntication and security model of Kaltura’s API, and how to put it to practice when implementing Kaltura applications.

## Authentication and Security  

To establish communication with the Kaltura servers, the client application must have a secret (one of 2 types) coupled with a unique account ID and a set of permissions.
A valid Kaltura Session (KS) is required to interact with the Kaltura API; displaying content, upload media, delete, update or list.
The KS expiry can be set at session initiation to range from 1 second to 10 years.

Once the KS is acquired, it can be used to interact with content by users for specific pre-set actions, such as uploading, deletion, updating and listing.
Securing apps content is done by leveraging one or more of the following methods -

* Data: 
  * The Kaltura Session.
  * The channel communication (e.g., HTTPS).
* Video Delivery:
  * Delivery methods and obfuscation (segmentation, url obfuscation, expired urls).
DRM.
  * Media Access Control

There are many possible layers of security that can be deployed within Kaltura’s system. To learn more, see [The Kaltura Media Access Control Model](http://knowledge.kaltura.com/node/447).

Publishers can configure the level of required security for their end users - these security layers work in coordination with the site’s user authentication methods as well. Specifically, Publishers can control access to each media asset and restrict user access to assets based on each of the following or a combination of several criteria:

* Authorized domains –Solutions can restrict access to media based on a predefined list of approved domains.
* Geo-location – Solutions can restrict access to media based on the origin on the user. This is set using the user's IP. For example, a publisher in Spain can restrict access to their media to all users outside of Spain, allowing users with Spanish IPs only to access the site's media.
* IP - Limit access to media only from a specific IP Address or range of IP address.
* Time limit - Solutions can allow access to media for a specified time period only. For example, allowing users to access certain media for 7 days only.
* Session limit - "Anonymous" users will be restricted and every access to the data will be required by a valid Kaltura Session with specific permissions to the desired entry id. The Publisher application is then responsible to determine whether a user has access to the a specific content, and if valid, generate and pass a valid KS with the request to the content.


## The Kaltura Session  

Every Kaltura Session is limited by one or more of the following components:

* Expiry time – Can be set to a short period (1 second) up to 10 years. 
  NOTE: The player has to perform all Kaltura API calls before the user hits play, so setting this too short for player sessions may break the playback experience. About 30 minutes is reasonable for just playback, or you could extend the player to re-negotiate for a session if it was expired.
* Number of API calls - e.g. no more than 5 API calls allowed on the KS. 
  NOTE: The number of needed API calls may not be an expected number, especially if you use 3rd party plugins in the player. When using this limitation, make sure all API calling components in your app are known and counted in number of API calls.
* Specific entry playback - When limited by an Access Control Profile, approved entries must be specifically stated by passing the privilege sview:entryId.
* Specific IP address - Limit access to the API from a specific IP or range of IPs by passing privilege **iprestrict:IPADDRESS**.

### KS Components   

The KS is a string composed of the following details:

* Publisher ID – A unique identifier allocated to every Kaltura account. The partner Id can be retrieved from the KMC Integration Settings tab.
* User ID – The id of the user within the publisher account performing the API call. This id is the end-user id on the publisher's system.
* KS Type (admin / user) – An admin KS can access all the content of the publisher account and call management APIs, while a user KS can only access content items owned by the specific user.
* Expiry time - Can be set to a short period (1 second) up to 10 years. In Seconds. Integer.
* Action limit – Maximum number of API calls allowed using this KS. Integer.
* Random number – A time based random number to make every KS string unique.
* ksdata - An arbitrary data that will be overlooked by Kaltura and can be used to pass additional information on the KS for custom application use.
* Signature – The KS is cryptographically signed (one-way MD5 hashing algorithm), by hashing all the above with a secret key shared between Kaltura and the publisher.

The information above is then combined with either Admin or User Secret (depending on the KS type desired), and then compiled using SHA1 algorithm. To generate the KS that is sent through the API: combine the SHA1 hash (in lowercase) and the above parameters in plain-text seperated by semi-colons (i.e. ';'), in Base64.

###  Kaltura Session Version 2  

*   A compromised admin KS to cause irreversible harm to your account (such as deleting all content)

In this section, we highlight a number of common and important practices to consider when creating applications that interact with the Kaltura API.

<p class="mce-heading-3">
  Authenticated User Privileges override the User Type KS
</p>

When you generate a user session KS and specify an ID of a Kaltura Admin User, the KS will allow all the actions included in the user’s role.

<span class="mce-heading-3">Always Protect your API Secret Keys</span>

Your API Secret Keys (ADMIN and USER) are generated when you create am account. These keys hold global access permissions to your account and thus should always be kept in secret.

*   Always prefer local session generation over server session.start.
*   Prefer User Login over session.start when local KS generation is not possible.
*   When calling the session.start API request - Make sure the connection between your client and the Kaltura server is encryoted and secured.
*   NEVER keep your secret keys in a front-end application (such as Flash or JavaScript). A KS should always be generated on the server side and then passed to the front-end.
*   Keep the secret keys in a seperated file with strict file permissions.

<div class="mce-heading-3">
  Use Admin KS with care
</div>

A compromised Admin KS will allow a malicious user to gain full access to the publisher account, leading way to harm.

Use Admin KS in between servers and with secured communication channel.

<div class="mce-heading-3">
  Prefer Login of Users with Defined Roles and Permissions over Generic Admin KS
</div>

Kaltura Users can be assigned a fine grained level of permissions. This allows applications developers to provide a stronger login and authentication mechanism while not exposing the account secret keys.

Use user.loginByLoginId providing user credentials and your account Id. 

<p class="mce-heading-3">
  Use Widget KS for Anonynous Public Content Playback
</p>

The session.startWidgetSession provides an anonymous simple and light KS generation mechanism that does not require a secret. This type of session can be used to perform READ operations only and only on content that is defined as publicly available with no Access Control or special permissions.

The Widget KS is perfect for cases where public content needs to be accessed freely and without secured authentication. 

 
