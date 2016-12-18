---
layout: page
title: Kaltura API Authentication and Security
subcat: Working with Application Tokens
weight: 104
---
Kaltura's API is a REST-based web service accessed over HTTP. REST APIs provide a simple and easy interface for communication between applications and the Kaltura server. However, this approach can undermine your application's security, if you overlook proper security and authentication when designing your applications.

Kaltura was designed with privacy and security standards in mind, while at the same time providing the openness of Kaltura’s technology as an open source platform and providing flexible integration models for open and free applications as well as highly secured and limitted applications.

The following overview describes the authentication and security model of Kaltura’s API, and how to put it to practice when implementing Kaltura's applications.

## Authentication and Security  

To establish communication with the Kaltura servers, the client application must have a secret (one of 2 types) coupled with a unique account ID and a set of permissions.

A valid Kaltura Session (KS) is required to interact with the Kaltura API; displaying content, uploading media, deleting, updating or listing. The KS expiry can be set at session initiation to range from 1 second to 10 years.

Once the KS is acquired, it can be used to interact with content by users for specific pre-set actions, such as uploading, deletion, updating and listing.

Securing application content is done by leveraging one or more of the following methods:

* Data: 
  * The Kaltura Session
  * The channel communication (e.g., HTTPS)
* Video Delivery:
  * Delivery methods and obfuscation (segmentation, url obfuscation, expired urls)
  * DRM
 
## Media Access Control  

There are many possible layers of security that can be deployed within Kaltura’s system. 

Publishers can configure the level of required security for their end users - these security layers work in coordination with the site’s user authentication methods as well. Specifically, publishers can control access to each media asset and restrict user access to assets based on each of the following or a combination of several criteria:

* Authorized domains – Solutions can restrict access to media based on a predefined list of approved domains.
* Geo-location – Solutions can restrict access to media based on the origin on the user. This is set using the user's IP. For example, a publisher in Spain can restrict access to their media to all users outside of Spain, allowing users with Spanish IPs only to access the site's media.
* IP - Limit access to media only from a specific IP Address or range of IP address.
* Time limit - Solutions can allow access to media for a specified time period only, for example, allowing users to access certain media for 7 days only.
* Session limit - "Anonymous" users will be restricted and all access to the data will require a valid KS with specific permissions to the desired entry id. The publisher application is then responsible for determining whether a user has access to the a specific content, and if valid, generate and pass a valid KS with the request to the content.

To learn more abou the different layers of security, see [The Kaltura Media Access Control Model](http://knowledge.kaltura.com/node/447).

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

Since October 14, 2012 - Kaltura introduced a second version to the KS format that includes encryption of the fields for protecting the user privacy.

<p class="mce-note-graphic">
  Version 1 (the original format) will continue to be maintained for backward compatibility - the Kaltura server accepts both version 1 and 2. The Kaltura server generates version 2 by default for publisher accounts created after Oct 2012. <strong>Implementations that generate a KS locally are encouraged to use KS version 2 as well.</strong>
</p>

<p class="p1">
  Since the new KS format requires encryption of the fields, performing base64 decode on the KS will not reveal its fields (as was the case with KS version 1). <br />To decode a KS v2, IT admins and developers who operate self hosted Kaltura servers can use the admin console developer tools page: https://[KalturaServerURL]/admin_console/index.php/plugin/KalturaInternalToolsPluginSystemHelperAction
</p>

<p class="p1 mce-sub-heading">
  The steps for generating a KSv2 are:
</p>

<ol class="ol1">
  <li class="li1">
    Gather all the different KS fields and their values: 
  </li>
  <ol class="ol1">
    <li class="li1">
      _e – expiry (unix timestamp)
    </li>
    <li class="li1">
      _u – user
    </li>
    <li class="li1">
      _t – type (<a href="http://www.kaltura.com/api_v3/testmeDoc/index.php?object=KalturaSessionType"><span>KalturaSessionType</span></a>)
    </li>
    <li class="li1">
      Privileges (edit, download, sview, etc.)
    </li>
  </ol>
  
  <li class="li1">
    Compile all fields and URL encode the parameters as a query string. e.g.  <strong><span style="font-family: 'courier new', courier;">_u=userId&_e=12345678&_t=2&Privileges=sview:1_0xada32as;edit:*</span></strong>
  </li>
  <li class="li1">
    Prepend 16 random binary bytes to the fields
  </li>
  <li class="li1">
    Prepend the binary SHA1 hash of the string (20 string)
  </li>
  <li class="li1">
    Encrypt the string with the SHA1 hash of the account's API secret using AES128/CBC/Zero bytes padding
  </li>
  <li class="li1">
    Prepend the KS version and partner ID separated by pipes (e.g. v2|1234|..)
  </li>
  <li class="li1">
    Encode the result using Base64 
  </li>
  <li class="li1">
    Replace + with – and / with _ to make the KS URL-safe
  </li>
</ol>

To see an implementation of the KS generation algorithm, refer to the GenerateSession function in [the client library of your choice][2].

 [2]: http://www.kaltura.com/api_v3/testme/client-libs.php

<p class="mce-heading-3">
  <a name="methods"></a>Methods for generating a valid Kaltura Session:
</p>

*   **Generate Session Locally** - Combine all the above details, and sign them using the shared secret key. This method is great for reducing callbacks to the server and enhanced security, since the session is generated locally and the secret key is kept private.
*   **Call session.start** - Calling the Kaltura Session.start API to generate a session on the server.  
    <span class="mce-note-graphic">Note: Using the session.start API is discouraged unless secure connection (SSL) is enabled on the account and there are specific reasons to generate the KS on the server side, using short expiry time that requires synchronizing to the server time.</span>
*   **Call user.loginByLoginId - **This method is using Kaltura Users and their Password instead of partner id and secret key.   
    <span class="mce-note-graphic">NOTE: This method is should be preferred in most cases. <br />1. It is easier to remember user name and password.<br />2. Users can be limited to specific roles and permissions (e.g. enabling only upload).<br />3. Users can be deleted, password changed or demoted in permissions, while the secret keys can't be easily modified. </span>

<p class="mce-heading-3">
  KS Types
</p>

<span class="mce-sub-heading">User KS <span> (Non-Authenticated User Session)</span></span>

*   A User KS is generated using the USER SECRET.
*   USER type can only use a subset of the available services that are relevant for a user in the system.
*   USER KS can invoke services on his entries and his user-data. (e.g. list actions will result in a filtered list according to the user KS)
*   Attempting to manipulate other users' data will fail.

<span class="mce-sub-heading">Admin KS</span>

*   ADMIN KS is generated using the ADMIN SECRET.
*   ADMIN Type is an absolute administrator and can call / perform all actions in the system. Services that use this type of session are:
*   Services that expose list of entries / users that belong to different users
*   Services that allow to update other user's data
*   Services that delete data.

*   An admin KS should never reach the browser. By letting users access an admin KS they will be able to cause changes not limited to their own content.
*   An admin KS ignores any privilage restirctions.

<span class="mce-sub-heading">User Roles & Permissions (Authenticated User Session)</span>

*   Allow more advanced configuration of the access and permissions based on the defined Kaltura User permissions.

<div>
  <p class="mce-heading-4">
    How May Session Type Affect API Behavior?
  </p>
  
  <p>
    The session type may affect the way that some API calls behave.
  </p>
  
  <p>
    Examples:
  </p>
  
  <ul>
    <li>
      A <em>media.list</em> call:
    </li>
    <ul>
      <li>
        With a <em>user</em> session – lists videos owned by the user specified in the KS
      </li>
      <li>
        With an <em>admin</em> session – lists all entries in the account that match your filter criteria. The list is not filtered for a specific user (unless you specifically filter by <em>userId</em>).
      </li>
    </ul>
    
    <li>
      An <em>update</em> call: If the user specified in a user session is not the owner of content item, the user does not have permission to update the item. You can override this restriction by specifying special session privileges.
    </li>
  </ul>
</div>

<p class="mce-heading-3">
  KS Validation on the Server
</p>

The Kaltura API servers will validate the KS for:

*   Check the signature against the secret of the specific publisher account to verify the authenticity of the KS.
*   Check whether the KS has elapsed or the action limit has been reached.
*   Check whether the KS was explicitly revoked (by issuing a Kaltura API call to expire a KS).

Once all the KS validations pass, the server will use the KS for:

*   Determining the account on which an API call should be performed.
*   Checking which Kaltura API services / actions the user is authorized to perform, and which API objects / properties he's allowed to view / modify. Based on the Kaltura User permissions.
*   Choosing the content entities visible to the specific user.
*   Setting the owning user for the API actions, e.g. any uploaded content will have the user specified in the KS as its owner.

<p class="mce-heading-3">
  <a name="privileges"></a>KS Privileges
</p>

Session privileges allows applications to limit the user to perform only specific actions.

The privileges in the KS, in general, do not block actions but instead limit some actions to a smaller scope.

For example, passing "sview:{entry ID}" enables the KS to be usable for playing a specific entry.

Any attempt to use that specific KS to play another entry ID will fail, as long as the entry is protected with KS-restriction access control.

To be certain that the KS passed to player cannot be used for any update actions you can either:

*   Add "setrole:PLAYBACK\_BASE\_ROLE" privilege to it, so it will not be allowed to perform any action other than a white-list of actions needed for the player (such as baseEntry.get, flavorAsset.list etc.).

<p style="padding-left: 30px;">
  or
</p>

*   Add "widget:1" privilege to the KS to tell the server that this KS was generated for player use only, which will tell the server to make a distinction between a regular USER session and a "PLAYER" session.

You define privileges using a comma-separated list of key-value pairs.

Each key-value pair is a specific privilege:

*   The key is the name of the privilege.
*   The value is the object ID to which the privilege applies.

The key-value pair format is the key followed by the value, separated by a colon: *key:value*

Multiple key-value pairs are separated by commas with no spaces: *key:1\_value,key:0\_value*

Some privileges support a wildcard (*) value (for example, *edit:**). A wildcard permits the action for any object.

<p class="mce-heading-4">
  <a name="ks-permissions-list"></a>The available privileges<span style="color: #000000; font-size: 10px;"> (<a href="https://github.com/kaltura/server/blob/master/alpha/apps/kaltura/lib/request/kSessionBase.class.php#L26" target="_blank">source reference</a>)</span>
</p>

<table border="1" cellspacing="0" cellpadding="0">
  <thead>
    <tr>
      <td valign="top" width="92">
        <p class="TableHeading" style="text-align: center;">
          <strong>Privilege</strong>
        </p>
      </td>
      
      <td style="text-align: center;" valign="top" width="227">
        <p class="TableHeading">
          <strong>Description</strong>
        </p>
      </td>
      
      <td style="text-align: center;" valign="top" width="227">
        <p class="TableHeading">
          <strong>Use Case</strong>
        </p>
      </td>
      
      <td valign="top" width="85">
        <p class="TableHeading" style="text-align: center;">
          <strong>Arguments</strong>
        </p>
      </td>
    </tr>
  </thead>
  
  <tbody>
    <tr>
      <td valign="top" width="92">
        <p style="text-align: left;">
          edit
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        <p class="TableText">
          Allows editing (updating) an entry. For example, <em>edit:0_zsadqv3e</em>
        </p>
      </td>
      
      <td valign="top" width="227">
        <p class="TableText" style="text-align: left;">
          Allow a specific user to edit a specific entry that does not belong to the user.
        </p>
      </td>
      
      <td valign="top" width="85">
        <p class="TableText" style="text-align: left;" align="center">
          Expects entry id or * for wildcard
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="92">
        <p class="TableText" style="text-align: left;">
          sview
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        <p class="TableText">
          Allows viewing and downloading an entry asset
        </p>
      </td>
      
      <td valign="top" width="227">
        <p class="TableText" style="text-align: left;">
          When implementing pay-per-view with the KS Protected Access Control, allow access to the blocked video asset after purchase.
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="85">
        <span>Expects entry id or * for wildcard</span>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="92">
        <p class="TableText" style="text-align: left;">
          list
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        Enables the session to list for entries that are not owned by the user. By default, only admin session can list all entries, this privilege enables it for user sessions. 
      </td>
      
      <td valign="top" width="227">
        <p class="TableText" style="text-align: left;">
          Performing entry search on client side, for example a contribution wizard that allows reuse of entries uploaded by other 
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="85">
        <span>Only list:* is supported (list with other parameters will be ingored)</span> 
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="92">
        <p class="TableText" style="text-align: left;">
          download
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        <p class="TableText">
          Allows downloading an entry asset
        </p>
      </td>
      
      <td valign="top" width="227">
        <p class="TableText" style="text-align: left;">
          Similar to <em>sview</em>. Allow actions that are meant for downloading, as opposed to streaming for playback. For example, raw action (www.kaltura.com/p/1/sp/100/raw/entryId/0_XXXYYYZZ), or download action (www.kaltura.com/p/1/sp/100/download/entryId/0_XXXYYYZZ)
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="85">
        <span>Expects entry id or * for wildcard</span>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="92">
        <p class="TableText" style="text-align: left;">
          <span class="pl-s">downloadasset<span class="pl-pds"><br /></span></span>
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        enables the download of a specific asset / all assets
      </td>
      
      <td valign="top" width="227">
        <p class="TableText" style="text-align: left;">
          Used internally by the server when flavorAsset.getUrl is called.
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="85">
        asset id or * 
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="92">
        <p class="TableText" style="text-align: left;">
          editplaylist
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        <p class="TableText">
          Allows editing an entry in a specific manual playlist
        </p>
      </td>
      
      <td valign="top" width="227">
        <p class="TableText" style="text-align: left;">
          Allow a user to edit a dynamic list of content for a list that is managed in a manual 
        </p>
      </td>
      
      <td valign="top" width="85">
        <p class="TableText" style="text-align: left;" align="center">
          Expects the id of the playlist
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="92">
        <p class="TableText" style="text-align: left;">
          sviewplaylist
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        <p class="TableText">
          Allows viewing an entry in a manual playlist
        </p>
      </td>
      
      <td valign="top" width="227">
        <p class="TableText" style="text-align: left;">
          Similar to <em>sview</em>. Allow a user to view a dynamic list of 
        </p>
      </td>
      
      <td valign="top" width="85">
        <p class="TableText" style="text-align: left;" align="center">
          E<span>xpects the id of the playlist</span>
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="92">
        <p class="TableText" style="text-align: left;">
          actionslimit
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        <p class="TableText">
          Allows a specific session to be used for a defined number of API calls
        </p>
      </td>
      
      <td valign="top" width="227">
        <p class="TableText" style="text-align: left;">
          Allow a session with an exposed KS to be used for a restricted period. The purpose is to minimize the risk of a malicious user using the session for prohibited 
        </p>
      </td>
      
      <td valign="top" width="85">
        <p class="TableText" style="text-align: left;" align="center">
          Expects an integer indicating number of actions
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="92">
        <p class="TableText" style="text-align: left;">
          setrole
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        <p class="TableText">
          Allows a specific session to be used only for a specific role
        </p>
      </td>
      
      <td valign="top" width="227">
        <p class="TableText" style="text-align: left;">
          Temporarily allow a user to perform an action that is not normally permitted, without changing the user 
        </p>
      </td>
      
      <td valign="top" width="85">
        <p class="TableText" style="text-align: left;" align="center">
          Expects the id of the role to apply on the ks
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="92">
        <p class="TableText" style="text-align: left;">
          <span>iprestrict</span>
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        Limits the use of the KS to a certain IP address
      </td>
      
      <td valign="top" width="227">
        <p class="TableText" style="text-align: left;">
          Tighter security for content protection (prevent a user from being able to send the KS to other 
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="85">
        <span>Only a single address is allowed</span> 
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="92">
        <span>urirestrict</span>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        Limits the URI of the API call that the KS can call, e.g.,urirestrict:/api_v3/* will be able to call only api v3 URIs
      </td>
      
      <td valign="top" width="227">
        Used internally by the server in several API calls that return a URL to the client containing a KS.
      </td>
      
      <td style="text-align: left;" valign="top" width="85">
        A URI (starting with /), a trailing * indicates it should be treated as a prefix 
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="92">
        <p class="TableText" style="text-align: left;">
          <span><span>enableentitlement</span></span>
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
         Forces entitlement checks.<p>
          Note: there is a setting on account level (configured in the admin console) that determines the default entitlement enforcement
        </p>
      </td>
      
      <td valign="top" width="227">
        <p style="text-align: left;">
          Applications like MediaSpace rely on the server to perform the entitlement checks, so it uses this flag
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="85">
        <span>Doesn’t have any additional attributes</span> 
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="92">
        <p class="TableText" style="text-align: left;">
          <span>disableentitlement</span>
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        <p>
          Bypasses any entitlement checks, for example, a session with this privilege will be able to access entries in private categories that the user is not a member of
        </p>
        
        <p>
          <span>Note: there is a setting on account level (configured in the admin console) that determines the default entitlement enforcement</span>
        </p>
      </td>
      
      <td valign="top" width="227">
        <p class="TableText" style="text-align: left;">
          Admin applications (e.g. KMC) that work on accounts that have entitlement enabled by 
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="85">
        Doesn’t have any additional attributes
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="92">
        <p class="TableText" style="text-align: left;">
          <span>disableentitlementforentry</span>
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        Bypasses entitlement checks for a given entry ID. In other words, access to the given entry will be allowed even if it belongs to a private category that the user is not a member of
      </td>
      
      <td valign="top" width="227">
        <p class="TableText" style="text-align: left;">
           Sharing an entitlement protected 
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="85">
        Only a single entry id is allowed (if more are needed multiple privileges of this type can be chained)
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="92">
        <p class="TableText" style="text-align: left;">
          <span><span>privacycontext</span></span>
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        Sets the privacy context for entitlement checks.
      </td>
      
      <td valign="top" width="227">
        <p class="TableText" style="text-align: left;">
           See <a href="http://knowledge.kaltura.com/node/575/attachment/field_media" target="_blank">Kaltura’s Entitlement Infrastructure Information Guide</a>.
        </p>
      </td>
      
      <td valign="top" width="85">
         
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="92">
        <p class="TableText" style="text-align: left;">
          <span><span><span>enablecategorymoderation</span></span></span>
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        When set, new category entries that are created on categories that have moderation=true will be created in PENDING status.  Otherwise, they will be created in ACTIVE status.
      </td>
      
      <td valign="top" width="227">
        Supports the category moderation flow when entitlement is not enforced.
      </td>
      
      <td style="text-align: left;" valign="top" width="85">
        No additional attributes 
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="92">
        <span>reftime</span>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        A Unix timestamp that is used as the reference of relative date fields. For example, if the API gets a value of 300 for some date field, it will be translated to <reftime> + 300 (5 minutes).<p>
          When this privilege is not supplied, the server uses the current time.                      
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        Tests the result of some API call in some timestamp in the future, can be used to validate the effect of scheduled tasks' filters.
      </td>
      
      <td style="text-align: left;" valign="top" width="85">
        A Unix timestamp 
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="92">
        <span><span><span>preview</span></span></span>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        A limit (in bytes) on the size of the file that is returned from the flavor download action
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        Used internally by the server when flavorAsset.getUrl is called on an entry whose access control has preview restrictions.
      </td>
      
      <td style="text-align: left;" valign="top" width="85">
        size in bytes 
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="92">
        <span>sessionid</span>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        <p>
          Can be used to group a set of KS's together for invalidation purposes - when session.end is called.
        </p>
        
        <p>
          With a ks that has sessionid=X, all other KS's that have sessionId=X become invalid as well.
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        Applications that create multiple KS's for different uses can use this privilege to terminate all KS's upon user logoff, without the need to keep track of them 
      </td>
      
      <td style="text-align: left;" valign="top" width="85">
        An arbitrary string identifying the session 
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="92">
        <span><span><span>apptoken</span></span></span>
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        For a KS that was created with appToken.startSession, this privilege will contain the app token through which the KS was created.
      </td>
      
      <td style="text-align: left;" valign="top" width="227">
        <p>
          Used mainly for investigation/tracking purposes.
        </p> 
      </td>
      
      <td valign="top" width="85">
        <p style="text-align: left;">
          The apptoken id
        </p> 
      </td>
    </tr>
  </tbody>
</table>

<p class="mce-heading-4">
  Examples are in PHP using the PHP5 Kaltura Client Library:
</p>

<p class="mce-heading-4">
  <span style="font-size: small;"><strong>Never use KalturaSessionType::ADMIN in ks generated for end users.</strong></span>
</p>

**Allow access to a specific entry Id (limitation is set via Access Control):**  
Example: allow access to entry id 0_iuasd7 (<a href="http://blog.kaltura.org/create-ks-protected-videos-with-free-preview" target="_blank">Read this blog post for use-case</a>):

<pre class="brush: php;fontsize: 100; first-line: 1; ">$ks = $client-&gt;session-&gt;start ( $userSecret, "myUser", KalturaSessionType::USER, $partnerID , null, "sview:0_iuasd7");</pre>

**Limit number of action For KS:**  
Example: limit number of actions to 4:

<pre class="brush: php;fontsize: 100; first-line: 1; ">$ks = $client-&gt;session-&gt;start ( $userSecret, "myUser", KalturaSessionType::USER, $partnerID , null, "actionslimit:4");</pre>

**Set Role on the KS:**  
Example:  set role id 2345 on a ks:

<pre class="brush: php;fontsize: 100; first-line: 1; ">$ks = $client-&gt;session-&gt;start ( $userSecret, "myUser", KalturaSessionType::USER, $partnerID , null, "setrole:2345");</pre>

<span class="mce-heading-2">Secured Delivery</span>Kaltura supports various methods of securing delivery of video streams, as follows:

*   Progressive download over HTTPS
*   RTMPE / RTMPTE
*   Akamai HD Network (chunked/throttled HTTPS)
*   SWF Verification
*   IP-linked token authentication

The table below shows the Stream security techniques as these apply differently across devices -

<table class="kaltura-table" style="width: 100%;">
  <thead>
    <tr class="kaltura-table-header">
      <th class="kaltura-table-head-item" style="width: 20%;">
         <span>Delivery</span>
      </th>
      
      <th class="kaltura-table-head-item" style="width: 20%;">
         <span>Device</span>
      </th>
      
      <th class="kaltura-table-head-item" style="width: 20%; text-align: left;">
         <span>Player Security</span>
      </th>
      
      <th class="kaltura-table-head-item" style="width: 20%; text-align: left;">
         <span>Entitlement</span>
      </th>
      
      <th class="kaltura-table-head-item" style="width: 20%; text-align: left;">
         <span>Encryption</span>
      </th>
    </tr>
  </thead>
  
  <tbody>
    <tr class="kaltura-table-row">
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>Akamai HD</span> 
      </td>
      
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>Flash - PC, Android</span> 
      </td>
      
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>SWF verification</span> 
      </td>
      
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>IP based token</span> 
      </td>
      
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>HTTPS</span> 
      </td>
    </tr>
    
    <tr class="kaltura-table-row">
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>RTMP</span>
      </td>
      
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>Flash - PC, Android</span>
      </td>
      
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>SWF verification</span>
      </td>
      
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>IP based token</span>
      </td>
      
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>RTMPE</span>
      </td>
    </tr>
    
    <tr class="kaltura-table-row">
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>Progressive</span>
      </td>
      
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>All – iOS, Bberry, Flash, etc.</span>
      </td>
      
      <td class="kaltura-table-row-item" style="width: 20%;">
         
      </td>
      
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>IP based token</span>
      </td>
      
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>HTTPS</span>
      </td>
    </tr>
    
    <tr class="kaltura-table-row">
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>IOS Streaming (HLS)</span>
      </td>
      
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>iPhone, iPad</span>
      </td>
      
      <td class="kaltura-table-row-item" style="width: 20%;">
         
      </td>
      
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>IP based token</span>
      </td>
      
      <td class="kaltura-table-row-item" style="width: 20%; text-align: left;">
        <span>HTTPS</span>
      </td>
    </tr>
  </tbody>
</table>

Kaltura’s integrated DRM solutions seamlessly plug in to its existing infrastructure and workflows, protecting customers from vendor lock-in.DRM Support

Encrypted video files are generated as additional “flavors” of original asset using Kaltura’s transcoding farm and based on selected vendor and license policy. 

<img src="../../assets/228.img">

<span class="mce-note-graphic">NOTE: Due to licensing requirements, DRM solutions are only available for commercial Kaltura editions (SaaS and On Prem) and are at additional cost. For more information about DRM and the available DRM solutions, please <a href="http://corp.kaltura.com/company/contact-us" target="_blank">contact us</a> or contact your Kaltura Account Manager.</span>

<span class="mce-heading-2">Important Considerations For Application Developers</span><span class="mce-heading-3"></span>

When not applications are not developed with security in mind, a malicious user can use:

*   A compromised secret to create a KS at will
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

 
