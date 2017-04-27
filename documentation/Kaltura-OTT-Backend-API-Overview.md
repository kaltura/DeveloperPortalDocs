temp
---
layout: page
title: Kaltura’s OTT Backend API Overview
---

Kaltura’s OTT Backend features hundreds of REST-based APIs that provide programmable access to every OTT service. With full access to the OTT Backend API, you can extend every feature and functionality of the Kaltura Platform integrate Kaltura’s solutions, services, and widgets seamlessly, creating a unified experience within your chosen environments.
This site provides comprehensive documentation on Kaltura’s OTT Backend API, and is intended to developers who wish to use these APIs within their services. To gain a greater understanding of Kaltura’s OTT Video Platform, please review the [introduction to Kaltura OTT TV](https://corp.kaltura.com/Video-Solutions/OTT-TV-and-TV-Everywhere) article.

## About Kaltura’s OTT Backend  

The Kaltura OTT Backend platform exposes its Server API to applications by implementing a standard HTTP POST/GET url-encoded requests structure. Kaltura’s OTT Backend APIs are designed to follow REST principles; the APIs consist of service actions for querying, setting, updating and listing entities as well as for activating processes within Kaltura’s OTT platform. Service actions are grouped according to the entity type they are applied to, and provide all actions relevant to the specific entity.
This API documentation provides specific information on:

* Kaltura services and their related actions
* Kaltura objects and their related properties
* Kaltura enumerated types and their values

>Note: A prerequisite for using Kaltura’s OTT Backend APIs is obtaining Kaltura account identifiers such as Account ID and User ID.

## Terminology  

Before you begin using Kaltura’s OTT Backend APIs, here are a few terms you should familiarize yourself with:


|    Term           |    Description                                                                                                                                                                                                                                                                                                                                                                       |
|-------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
|    OTT            |    Over The Top: Video transmitted via the Internet without an operator   of multiple cable controlling or distributing the content.                                                                                                                                                                                                                                                 |
|    KS             |    Kaltura Session: A valid KS must be passed with each call to   Kaltura’s API. The session context embedded into a KS identifies your   application, content access permissions, and API access permissions (it also   contains other internal session data). This information is securely encrypted   and hashed, preventing unauthorized manipulation of the session context.    |
|    EPG            |    Electronic Program Guide: An application used with digital set-top   boxes and newer television sets to list current and scheduled programs that   are or will be available on each channel and a short summary or commentary   for each program. EPG is the electronic equivalent of a printed television   program guide.                                                       |
|    VOD            |    Video On Demand: Allows end users to watch video content whenever the   user chooses.                                                                                                                                                                                                                                                                                             |
|    Asset          |    This is any Kaltura EPG program or VOD content.                                                                                                                                                                                                                                                                                                                                   |
|    Channel        |    A set of Kaltura assets, selected manually or dynamically, using   predefined filters.                                                                                                                                                                                                                                                                                            |
|    EPG Channel    |    Equivalent to a TV channel, this represents a set of EPG programs   related to the same playable source on a single timeline.                                                                                                                                                                                                                                                     |
|    Group          |    A Kaltura OTT account owned by an operator.                                                                                                                                                                                                                                                                                                                                       |
|    Household      |    A users account, which must be associated with a group, and is owned   by the operator’s customers.                                                                                                                                                                                                                                                                               |
|    OTT User       |    A specific user account that must be associated with household   account.                                                                                                                                                                                                                                                                                                         |

## Using Kaltura’s OTT Backend REST APIs  

The following are the general characteristics of any REST API:

* Client – Server model.
* Stateless – The session information shouldn’t be save on the server side.
* Cacheable – The responses can be cached using standard HTTP headers.
* Layered – The client cannot tell whether it is connected to an end server or to an intermediary server.
* Uniform interface:
  * Identification of resources – Resources represented by their exposed data, the server may have different representation of that data.
  * Manipulation of resources through representations – The client holds enough metadata to modify or delete the resource.
  * Self-descriptive messages – The message includes enough information to describe how to process it.
  * Hypermedia as the engine of application state – The client should be able to use URLs dynamically to discover all actions and resources.

### REST API Request Formats  

Although both form data and a Kaltura proprietary requests are supported, JSON is the recommended request format, as per the example below:
(see https://ott.developer.kaltura.com/api-docs/Services/asset/asset_get for details):

{% highlight c %}
 {
  "apiVersion": "3.6.1579.29065",
  "assetReferenceType": "media",
  "clientTag": "dotnet:16-12-20",
  "format": 1,
  "id": "566254",
  "kalsig": "ef6ddd187091e42003f2c59dbbcdaf4f",
  "ks": "MGVjNGY4YzBkM2ZhYmIxYTA4Y2VhYjYwZGM4NWQ5NzczNzcxY2JmYXwxODY7MTg2OzE0ODQxNDAwNzE7MDs2MzYxOTc0MzQ3MTA0NDI3NzU7MDAwMDA3MTcyMkBnbWFpbC5jb20udGVzdDs7"
}
{% endhighlight %}

### REST API Response Formats  

To define the required request format, use the Accept HTTP header with application/json or text/xml.
The REST APIs use the following response formats:

{% highlight c %}
JSON (format = 1, Accept: application/json)
{
  "executionTime": 0.900651,
  "result": {
    "objectType": "KalturaLoginSession",
    "ks": " MGVjNGY4YzBkM2ZhYmIxYTA4Y2VhYjYwZGM4NWQ5NzczNzcxY2JmYXwxODY7MTg2OzE0ODQxNDAwNzE7MDs2MzYxOTc0MzQ3MTA0NDI3NzU7MDAwMDA3MTcyMkBnbWFpbC5jb20udGVzdDs7"
  }
}
{% endhighlight %}

{% highlight c %}
XML (format = 2 , Accept: text/xml)
<?xml version="1.0" encoding="utf-8"?>
<xml>
    <executionTime>0.6486599</executionTime>
    <result>
        <objectType>KalturaLoginSession</objectType>
        <ks> MGVjNGY4YzBkM2ZhYmIxYTA4Y2VhYjYwZGM4NWQ5NzczNzcxY2JmYXwxODY7MTg2OzE0ODQxNDAwNzE7MDs2MzYxOTc0MzQ3MTA0NDI3NzU7MDAwMDA3MTcyMkBnbWFpbC5jb20udGVzdDs7</ks>
    </result>
</xml>
{% endhighlight %}

### API Services and Actions  

A **service** represents a resource in the data mode that groups all actions that relevant to a specific object. For example, OTT-User, Recording, Asset.

An **action** represents read and write operations (CRUD) that expects known arguments and returns known objects. For example: add, update, delete. get, list.

#### Objects  

All objects extend from the KalturaObjectBase (note that the name may be different in different coding languages):

* The client may use any object that extends the expected object in any request.
* If the expected object is abstract, only extended objects may be used.
* The server may return any object that extends the expected object in any response.

#### Multi-Requests  

Multi-requests enable sending multiple applicative requests in a single HTTP request. 

{% highlight c %}
{
  "apiVersion": "3.6.1579.29065",
  "ks": "MGVjNGY4YzBkM2ZhYmIxYTA4Y2VhYjYwZGM4NWQ5NzczNzcxY2JmYXwxODY7MTg2OzE0ODQxNDAwNzE7MDs2MzYxOTc0MzQ3MTA0NDI3NzU7MDAwMDA3MTcyMkBnbWFpbC5jb20udGVzdDs7",
  "0": {
    "service": "asset",
    "action": "list"
  },
  "1": {
    "service": "channel",
    "action": "get"
  }
}
{% endhighlight %}

This enables using responses from one applicative request in another applicative request in the same HTTP request.

{% highlight c %}
 {
  "apiVersion": "3.6.1579.29065",
  "ks": "MGVjNGY4YzBkM2ZhYmIxYTA4Y2VhYjYwZGM4NWQ5NzczNzcxY2JmYXwxODY7MTg2OzE0ODQxNDAwNzE7MDs2MzYxOTc0MzQ3MTA0NDI3NzU7MDAwMDA3MTcyMkBnbWFpbC5jb20udGVzdDs7",
  "0": {
    "service": "ottUser",
    "action": "anonymousLogin",
    "partnerId": 203345
  },
  "1": {
    "service": "asset",
    "action": "list",
    "ks": "{1:result:ks}"
  }
}
{% endhighlight %}

#### Global Parameters

The Kaltura Ott Backend API utilizes the following global parameters:
* **clientTag** – Free text, used to identify the application in the logs, using the application name, client library coding language and application version is recommended.
* **apiVersion** – Mandatory since Storm version, used to identify the expected server compatibility version, sent correctly and automatically by all client libraries.
* **ks** – Kaltura session, supports also deprecated TVP-API access-token, used to apply roles and permissions.
* **userId** – Replaces the operating user for all actions, enables privileged user to impersonate as a different user.
* **language** – Used to return content in specific language.

### Roles and Permissions  

#### Permission-item 

* **Action** – Allows you to use an API action. All actions are forbidden by default.
* **Object Property** – Allows you to read, insert or update of a property. All properties are permitted unless specified otherwise.
* **Action Argument** – Allows you to use an action argument. All arguments are permitted unless specified otherwise.
* **Permission** – Defines a set of permission items.
* **Role (anonymous, user, master, operator, manager, administrator, custom) ** – Defines a set of allowed permissions.

### Error Handling  

All HTTP requests are expected to return HTTP 200, OK, even in case of an applicative error.
Errors are returned in the serialized response (JSON or XML) and automatically interpreted by all client libraries. In case of a regular request (not multi-request) the client library will throw the exception and raise the error to the error handling callback (depending on the coding language); however, in case of errors inside a multi-request, the exception object will be returned in the results array and should be handled manually by the application.

#### Error Response Examples  

**XML:**

{% highlight c %}
<?xml version="1.0" encoding="utf-8"?>
<xml>
    <executionTime>0.0011062</executionTime>
    <result>
        <error>
            <objectType>KalturaAPIException</objectType>
            <code>500016</code>
            <message>KS expired</message>
        </error>
    </result>
</xml>
{% endhighlight %}

**JSON:**

{% highlight c %}
{
  "executionTime": 0.0007125,
  "result": {
    "error": {
      "objectType": "KalturaAPIException",
      "message": "KS expired",
      "code": "500016"
    }
  }
}
{% endhighlight %}

**Multi-request:**

{% highlight c %}
{
  "executionTime": 3.40099,
  "result": [
    {
      "objectType": "KalturaLoginSession",
      "refreshToken": "vsdvssdp046ab84d27b1abb6djowdsd34",
      "ks": "jsdfo9MI9KKzY0uE7J_lsdjofdsp09mLILmn0LIJML_sokdfsf0lsfLOJKLOJKp9ikmkl-dflgkdfgp0idfkmsdlflokkplOKPplLpKLJHJHBMJUH_KJBH0k090_lsdfsdfKLJKLJ909-0klj ="
    },
    {
      "error": {
        "objectType": "KalturaAPIException",
        "message": "Search failed",
        "code": "1"
      }
    }
  ]
}
{% endhighlight %}

## Using the TVP-API Security Model  

TVP-API works with refresh-token, a long-lived token that is created upon login, and an access-token, a short-lived token that used in any request to authenticate the user, the access-token is retrieved from the server using the refresh-token.
Requests to TVP-API should be accompanied with init-object that contains the access-token.
Requests to the OTT API can be accompanied by a ks property; this property will usually contain a KS as returned from the OTT API login, but it may also contain an access-token instead. When the access-token is used instead of KS, no init-object is needed; for example
https://ott.developer.kaltura.com/api-docs/Services/asset/asset_get:

{% highlight c %}
 {
  "apiVersion": "3.6.1579.29065",
  "assetReferenceType": "media",
  "clientTag": "dotnet:16-12-20",
  "format": 1,
  "id": "566254",
  "kalsig": "ef6ddd187091e42003f2c59dbbcdaf4f",
  "ks": "MGVjNGY4YzBkM2ZhYmIxYTA4Y2VhYjYwZGM4NWQ5NzczNzcxY2JmYXwxODY7MTg2OzE0ODQxNDAwNzE7MDs2MzYxOTc0MzQ3MTA0NDI3NzU7MDAwMDA3MTcyMkBnbWFpbC5jb20udGVzdDs7"
}
{% endhighlight %}

