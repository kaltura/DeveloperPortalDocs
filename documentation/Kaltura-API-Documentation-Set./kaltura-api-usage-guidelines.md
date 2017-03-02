---
layout: page
title: Kaltura API Usage Guidelines
---

This document describes how to:

*   Access the Kaltura application programming interface (API)
*   Use the Kaltura API

To learn the basics about the Kaltura API and API architecture, refer to [Introduction to the Kaltura API Architecture][1].

 [1]: http://knowledge.kaltura.com/introduction-kaltura-api-architecture

<p class="mce-heading-2">
  Applicability
</p>

This document applies to Kaltura API version 3 and later.

Document Conventions

A string in brackets [] represents a value.

Replace the string – including the brackets – with an actual value.

Example: Replace *[SERVICENAME]* with *syndicationFeed*.

<h2 class="mce-heading-2">
  Prerequisites
</h2>

To access the Kaltura API, you require:

1.  A Kaltura publisher account - To obtain a Kaltura account, start a <a href="http://corp.kaltura.com/free-trial" target="_blank">free trial</a>, <a href="http://corp.kaltura.com/company/contact-us" target="_blank">contact us</a> or <a href="http://www.kaltura.org/project/community_edition_video_platform" target="_blank">Download Kaltura CE</a>.
2.  Obtain your Kaltura API publisher credentials via the <a href="http://www.kaltura.com/index.php/kmc/kmc4#account|integration" target="_blank">KMC Integration Settings</a>. 

<h2 class="mce-heading-2">
  <a name="FindingtheLatestAPIVersionNumber"></a>Finding the Latest API Version Number
</h2>

<p class="Sub-Heading mce-note-graphic">
  To find the version number of the API that contains the latest updates:
</p>

Go to the full XML description of the API schema: [http://www.kaltura.com/api\_v3/api\_schema.php][2]

 [2]: http://www.kaltura.com/api_v3/api_schema.php

The version and date of the API schema appear near the beginning of the file.

<p class="Sub-Heading">
  <strong>API Schema Version Data Example</strong>
</p>

<pre class="brush: xml;fontsize: 100; first-line: 1; ">&lt;xml apiVersion="3.1.3" generatedDate="1312093534"&gt;
- &lt;!--  Generated on date 31/07/11 02:25:34   --&gt;</pre>

The *generatedDate* value is a UNIX timestamp.

<h2 class="mce-heading-2">
  Using the Kaltura API Test Console
</h2>

The [Kaltura API Test Console][3] web page enables you to interact with the entire Kaltura API using a simple user interface (see the figure below).

 [3]: https://developer.kaltura.com/console

You use the Test Console to:

*   Browse the Kaltura API.
*   Try out the Kaltura API without writing code.

<h2 class="mce-heading-2">
  <a name="GettingaClientLibraryfortheKalturaAPI"></a>Getting a Client Library for the Kaltura API
</h2>

To work with the Kaltura API, you need code that can:

*   Construct a Kaltura request.
*   Perform an HTTP request.
*   Parse the result of a Kaltura request.

To save you time, Kaltura provides client libraries. A client library is a set of classes that includes:

*   The functional infrastructure for communication with the Kaltura API: constructing a request, performing an HTTP request, and parsing a response
*   A full object representation of all the entities that are available through the Kaltura API, including enumeration objects
*   Infrastructure for developers, such as built-in log capabilities

The Kaltura API SDK includes client library packages in different languages, including PHP, Java, C#, and JavaScript. For the latest version of all client libraries, refer to [Kaltura API SDK - Native Client Libraries][5].

 [5]: https://developer.kaltura.com/api-docs/#/Client%20Libraries

To get the entire API in your IDE, just download the client library for the language that you use to develop your applications and include the client library in your application or project.

To learn more about the client library structure and how to use a client library, refer to *Kaltura API: Introduction to Kaltura Client Libraries: Technical Guide*.

<h3 class="mce-heading-3">
  Getting a Client Library for a Language that Kaltura Does Not Provide
</h3>

The Kaltura client libraries are generated automatically based on API schema (see [Finding the Latest API Version Number][6]).

 [6]: #FindingtheLatestAPIVersionNumber

As an open-source project, Kaltura strives to include contributions from the community and customers. Kaltura welcomes contributions of client libraries for languages that Kaltura does not yet provide.

You can write a custom generator class in PHP that generates code in the language of your choice.

If you provide the generator class to Kaltura, Kaltura will include your generator class in the Kaltura core generator. The new client library will be automatically generated and will be publicly available.

For more information on creating a client library generator, refer to [Adding New Kaltura API Client Library Generator][7].

 [7]: /adding-new-kaltura-api-client-library-generator

<h2 class="mce-heading-2">
  API Authentication and Kaltura Sessions
</h2>

Most Kaltura API calls require you to authenticate before executing a call.

Calls that require authentication usually have a response that cannot be shared between different accounts. For the Kaltura server to know that you are allowed to “ask that question,” you must authenticate before executing the call.

To learn more about the Kaltura Session and API Authentication, read: [Kaltura's API Authentication and Security][8].

 [8]: /kalturas-api-authentication-and-security

<p class="mce-heading-2">
  Kaltura API Response/Request Format
</p>

<h3 class="mce-heading-3">
  Request Structure
</h3>

The Kaltura API implements a standard HTTP POST/GET URL encoded request structure. URL-encoded requests are targeted to a specific API method.

Each API method location is concatenated from:

*   Base URI
*   Service identifier string
*   Action identifier string

The format of the API method location is:

<pre class="brush: plain;fontsize: 100; first-line: 1; ">https://developer.kaltura.com/api-docs/#/[SERVICENAME].[ACTIONNAME]</pre>

where

*   [SERVICENAME] represents a specific service.
*   [ACTIONNAME] represent an action to be applied in the specific service.

<p class="Sub-Heading">
  <strong>Request URL Example</strong>
</p>

Post a request to activate the *list* action of the *media* service to the following URL:

<pre class="brush: plain;fontsize: 100; first-line: 1; ">https://developer.kaltura.com/api-docs/#/media.list</pre>

<h3 class="mce-heading-3">
  Request Input Parameters
</h3>

Each API method receives a different set of input parameters.

For all request types:

*   Send input parameters as a standard URL-encoded key-value string.
*   When an input parameter is an object, flatten it to pairs of ObjectName:Param keys.

<p class="Sub-Heading">
  <strong>Request Input Parameters Example</strong>
</p>

<pre class="brush: plain;fontsize: 100; first-line: 1; ">id=abc12&name=name%20with%20spaces&entry:tag=mytag&entry:description=mydesc</pre>

In the example, the following parameters are URL encoded and are passed as API input parameters:

<pre class="brush: plain;fontsize: 100; first-line: 1; ">id = ‘abc’
name = ‘name with spaces’
entry {
	tag = ‘mytag’,
	description = ‘mydesc’	
}</pre>

<p class="mce-heading-3">
  Response Structure
</p>

When a client supports [gzip][9], the content of a Kaltura API response is compressed with gzip by default.

 [9]: http://en.wikipedia.org/wiki/Gzip

Supported Kaltura API response formats include the following:

*   XML (Default)
*   JSON
*   PHP
*   JSONP

To work with a non-default format, append the format parameter to the query string of a request.

<p class="Sub-Heading">
  <strong>Response Structure Example</strong>
</p>

To receive a [JSON][10] output of a request, use following URL:

 [10]: http://en.wikipedia.org/wiki/JSON

<pre class="brush: plain;fontsize: 100; first-line: 1; ">https://developer.kaltura.com/api-docs/#/media&action.list </pre>

Numeric IDs of the most commonly used formats:

*   RESPONSE\_TYPE\_JSON = 1;
*   RESPONSE\_TYPE\_XML = 2;
*   RESPONSE\_TYPE\_PHP = 3;
*   RESPONSE\_TYPE\_JSONP = 9;

<h3 class="mce-heading-3">
  Successful Response: XML Format
</h3>

When Kaltura server successfully executes an API request, the *<result>* element within the response body holds a structure of parameters that are relevant for the specific request.

A response *<result>* structure may be simple or complex:

*   A simple structure holds from one to a few parameters.
*   A complex structure holds many parameters, including nested objects.

<p class="Sub-Heading">
  <strong>Successful Response Example</strong>
</p>

<pre class="brush: xml;fontsize: 100; first-line: 1; ">&lt;?xml version="1.0" encoding="utf-8" ?&gt; 
&lt;xml&gt;
  &lt;result&gt;
    &lt;objectType&gt;KalturaMediaEntry&lt;/objectType&gt;
	&lt;id&gt;vcnp8h76m8&lt;/id&gt;
	&lt;name&gt;Demo Video&lt;/name&gt;
	&lt;description/&gt;
	&lt;partnerId&gt;1&lt;/partnerId&gt;
	&lt;userId/&gt;
	&lt;tags/&gt;
	&lt;adminTags&gt;demo&lt;/adminTags&gt;
	&lt;status&gt;2&lt;/status&gt;
	&lt;type&gt;1&lt;/type&gt;
	&lt;createdAt&gt;1240844664&lt;/createdAt&gt; 
  &lt;/result&gt;
  &lt;executionTime&gt;0.08957796096802&lt;/executionTime&gt; 
&lt;/xml&gt;</pre>

<h3 class="mce-heading-3">
  <a name="ErrorResponse"></a>Error Response
</h3>

When the Kaltura server fails to execute a specific API request, an *<error>* element is nested in the response *<result>* element.

The *<error>* element holds the response error code and the error message.

The table lists some general API error codes and corresponding error messages.

Text enclosed in quotes and percentage signs ("%) is a placeholder for dynamically replaced values.

The actual message contains the specific value that the request passes.

For an exhaustive list of error codes, <a href="https://github.com/kaltura/server/blob/master/api_v3/lib/KalturaErrors.php" target="_blank">review the KalturaErrors class</a>.


| Error Code                         | Error Message                                                                                                       |   |
|------------------------------------|---------------------------------------------------------------------------------------------------------------------|---|
| INTERNAL_SERVERL_ERROR             | Internal server error occurred                                                                                      |   |
| MISSING_KS                         | Missing KS, session not established                                                                                 |   |
| INVALID_KS                         | Invalid KS "%KS%", Error "%KS_ERROR_CODE%,%KS_ERROR_DESCRIPTION%"                                                   |   |
| SERVICE_NOT_SPECIFIED              | Service name was not specified, please specify one                                                                  |   |
| SERVICE_DOES_NOT_EXISTS            | Service "%SERVICE_NAME%" does not exist                                                                             |   |
| ACTION_NOT_SPECIFIED               | Action name was not specified, please specify one                                                                   |   |
| ACTION_DOES_NOT_EXISTS             | Action "%ACTION_NAME%" does not exist for service "%SERVICE_NAME%"                                                  |   |
| MISSING_MANDATORY_PARAMETER        | Missing parameter "%PARAMETER_NAME%"                                                                                |   |
| INVALID_OBJECT_TYPE                | Invalid object type "%OBJECT_TYPE%"                                                                                 |   |
| INVALID_ENUM_VALUE                 | Invalid enumeration value "%GIVEN_VALUE%" for parameter "%PARAMETER_NAME%", expecting enumeration type "%ENUM_TYPE" |   |
| INVALID_PARTNER_ID                 | Invalid partner id "%PARTNER_ID%"                                                                                   |   |
| INVALID_SERVICE_CONFIGURATION      | Invalid service configuration. Unknown service [%SERVICE_NAME%:%ACTION_NAME%].                                      |   |
| PROPERTY_VALIDATION_CANNOT_BE_NULL | The property "%PROPERTY_NAME%" cannot be NULL                                                                       |   |
| PROPERTY_VALIDATION_MIN_LENGTH     | The property "%PROPERTY_NAME%" must have a min length of %MININUM_LENGTH% characters                                |   |
| PROPERTY_VALIDATION_MAX_LENGTH     | The property "%PROPERTY_NAME%" cannot have more than %MAXIMUM_LENGTH% characters                                    |   |
| PROPERTY_VALIDATION_NOT_UPDATABLE  | The property "%PROPERTY_NAME%" cannot be updated                                                                    |   |
| INVALID_USER_ID                    | Invalid user id                                                                                                     |   |


<table border="1" cellspacing="0" cellpadding="0">
  <thead>
    <tr>
      <td valign="top" width="310">
        <p class="TableHeading">
          <strong>Error Code</strong>
        </p>
      </td>
      
      <td valign="top" width="329">
        <p class="TableHeading">
          <strong>Error Message</strong>
        </p>
      </td>
    </tr>
  </thead>
  
  <tbody>
    <tr>
      <td style="text-align: left;" valign="top" width="310">
        <p class="TableText">
          INTERNAL_SERVERL_ERROR
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="329">
        <p class="TableText">
          Internal server error occurred
        </p>
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="310">
        <p class="TableText">
          MISSING_KS
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="329">
        <p class="TableText">
          Missing KS, session not established
        </p>
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="310">
        <p class="TableText">
          INVALID_KS
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="329">
        <p class="TableText">
          Invalid KS "%KS%", Error "%KS_ERROR_CODE%,%KS_ERROR_DESCRIPTION%"
        </p>
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="310">
        <p class="TableText">
          SERVICE_NOT_SPECIFIED
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="329">
        <p class="TableText">
          Service name was not specified, please specify one
        </p>
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="310">
        <p class="TableText">
          SERVICE_DOES_NOT_EXISTS
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="329">
        <p class="TableText">
          Service "%SERVICE_NAME%" does not exist
        </p>
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="310">
        <p class="TableText">
          ACTION_NOT_SPECIFIED
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="329">
        <p class="TableText">
          Action name was not specified, please specify one
        </p>
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="310">
        <p class="TableText">
          ACTION_DOES_NOT_EXISTS
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="329">
        <p class="TableText">
          Action "%ACTION_NAME%" does not exist for service "%SERVICE_NAME%"
        </p>
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="310">
        <p class="TableText">
          MISSING_MANDATORY_PARAMETER
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="329">
        <p class="TableText">
          Missing parameter "%PARAMETER_NAME%"
        </p>
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="310">
        <p class="TableText">
          INVALID_OBJECT_TYPE
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="329">
        <p class="TableText">
          Invalid object type "%OBJECT_TYPE%"
        </p>
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="310">
        <p class="TableText">
          INVALID_ENUM_VALUE
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="329">
        <p class="TableText">
          Invalid enumeration value "%GIVEN_VALUE%" for parameter "%PARAMETER_NAME%", expecting enumeration type "%ENUM_TYPE"
        </p>
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="310">
        <p class="TableText">
          INVALID_PARTNER_ID
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="329">
        <p class="TableText">
          Invalid partner id "%PARTNER_ID%"
        </p>
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="310">
        <p class="TableText">
          INVALID_SERVICE_CONFIGURATION
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="329">
        <p class="TableText">
          Invalid service configuration. Unknown service [%SERVICE_NAME%:%ACTION_NAME%].
        </p>
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="310">
        <p class="TableText">
          PROPERTY_VALIDATION_CANNOT_BE_NULL
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="329">
        <p class="TableText">
          The property "%PROPERTY_NAME%" cannot be NULL
        </p>
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;" valign="top" width="310">
        <p class="TableText">
          PROPERTY_VALIDATION_MIN_LENGTH
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="329">

<p class="Sub-Heading">
  <strong>Error Response Example</strong>
</p>

<pre class="brush: xml;fontsize: 100; first-line: 1; ">&lt;?xml version="1.0" encoding="utf-8" ?&gt; 
&lt;xml&gt;
  &lt;result&gt;
    &lt;error&gt;
      &lt;code&gt;MISSING_KS&lt;/code&gt;
      &lt;message&gt;Missing KS. Session not established&lt;/message&gt;
    &lt;/error&gt;
  &lt;/result&gt;
  &lt;executionTime&gt;0.011207971573&lt;/executionTime&gt;
&lt;/xml&gt;</pre>

<h2 class="mce-heading-2">
  API Errors and Error Handling
</h2>

The Kaltura API can return errors.

API errors are represented by an error identifier followed by a description:

*   An error ID is a unique string. The parts of the string are separated by underscores.
*   An error description is textual. The description may include a dynamic value.

A comma separates the error ID from the description.

<p class="Sub-Heading">
  <strong>API Error Example</strong>
</p>

<pre class="brush: plain;fontsize: 100; first-line: 1; ">ENTRY_ID_NOT_FOUND,Entry id "%s" not found </pre>

*%s* is replaced with the value that is sent to the API call.

In the response XML:

*   The *<code>* node contains the error code (such as *ENTRY\_ID\_NOT_FOUND*).
*   The *<message>* node contains the description (such as *Entry id “%s” not found*).

See [Error Response][11] for a detailed code example.

 [11]: #ErrorResponse

<p class="Sub-Heading">
  <strong>Error Handling</strong>
</p>

In most client libraries, the client library code throws an exception when an error is returned from the API.

Depending on the programming language, catching the exception to read the code and/or the message enables user-friendly error handling.

Errors that you encounter during development usually are caused by incorrect implementation.

<h2 class="mce-heading-2">
  <a name="multirequest-api"></a>The Multirequest API
</h2>

<h3 class="mce-heading-3">
  Understanding the Multi-Request Feature
</h3>

The Kaltura API can execute several API calls in a single HTTP request to Kaltura.

The multi-request feature improves performance in Kaltura integrations.

The feature enables a developer to stack multiple API calls and issue them in a single request. This reduces the number of round-trips from server-side or client-side developer code to Kaltura.

The Kaltura API processes each of the API calls that are included in the single HTTP request. The response essentially is a list of the results for each of the calls in the request.

The multi-request feature includes the ability to have one request depend on the result of another request.

While the Kaltura API is processing each of the API calls in a multi-request, it detects when there is a dependency in one of the call parameters. The Kaltura API parses the dependency and replaces it with the result of the relevant call.

<h3 class="mce-heading-3">
  Using the Multi-Request Feature
</h3>

<p class="Sub-Heading">
  <strong>Multi-Request with Dependency: Sample Use Case</strong>
</p>

To create a new entry out of a file in your server, you execute several different API calls:

1.  uploadToken.add
2.  uploadToken.upload
3.  baseEntry.addFromUploadedFile

The result of *uploadToken.add* is an *uploadToken* object that consists of a token string.

You need the token string when executing the next action – uploading the file. So you must complete the first action in order to call the second.

Using the multi-request feature, in the second request you specify obtaining the value of the token parameter from the token property that is the result of the first request.

<p class="Sub-Heading">
  <strong>Multi-Request Structure</strong>
</p>

<p class="Sub-Heading mce-procedure">
  To perform a multi-request call:
</p>

1.  Define the *GET* parameter of *service* as *multirequest* and define *action* as *null*:[  
    ][12]<pre class="brush: as3;fontsize: 100; first-line: 1; ">http://www.kaltura.com/api_v3/?service=multirequest&action=null</pre>

2.  Prefix each API call with a number that represents its order in the multi-request call, followed by a colon. Prefix the first call with *1:*, the second with *2:*, and so on.
3.  Use the prefix for each of an API call's parameters (service, action, and action parameters).

 [12]: http://www.kaltura.com/api_v3/?service=multirequest&action=null

**Multi-Request Structure Example**

<pre class="brush: xml;fontsize: 100; first-line: 1; ">Request URL: api_v3/index.php?service=multirequest&action=null
	POST variables:
		1:service=baseEntry
		1:action=get
		1:version=-1
		1:entryId=0_zsadqv3e
		2:service=flavorasset
		2:action=getWebPlayableByEntryId
		2:entryId=0_zsadqv3e
		2:version=-1
		ks={ks}</pre>

<p class="Sub-Heading">
  <strong>Multi-Request with Dependency: Structure</strong>
</p>

<p class="Sub-Heading mce-procedure">
  To create a multi-request with a dependent request:
</p>

Use the following structure as input in the variable whose value you want to replace with a result of a preceding request:

<pre class="brush: xml;fontsize: 100; first-line: 1; ">{num:result:propertyName}</pre>

where:

*   *num* is the number of the request from which to collect data.
*   *result* instructs the Kaltura API to replace this value with a result from another request.
*   *propertyName* is the property to obtain from the object of the required result.

<p class="Sub-Heading">
  <strong>Multi-Request With Dependency: Example</strong>
</p>

<pre class="brush: xml;fontsize: 100; first-line: 1; ">Request URL: api_v3/index.php?service=multirequest&action=null
	POST variables:
		1:service=media
		1:action=list
		1:filter:nameLike=myentry
		2:service=media
		2:action=get
		2:entryId={1:result:objects:0:id}
		ks={ks}</pre>

In the example, the first request lists entries whose names resemble *myentry*.

The *media.list* request returns an object of type *KalturaMediaListResponse*, which contains an object named *objects* of type *KalturaMediaEntryArray*.

The second request is *media.get*, which uses *entryId* as input.

The *entryId* input is dynamic, and the value is obtained from the first request. Since the *media.list* response is constructed of array object within a response object, the first property to access is *KalturaMediaEntryArray*.

Since in *KalturaMediaEntryArray* you want to obtain the first element (index **), you add *:0* to the request value.

Since from the first element you want only the ID that is the input for the second request, you add *:id* to the request value.
