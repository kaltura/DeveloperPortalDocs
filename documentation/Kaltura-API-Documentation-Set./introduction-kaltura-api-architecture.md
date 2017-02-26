---
layout: page
title: Introduction to the Kaltura API Architecture
---

**For Interactive Code Recipes and Examples, visit https://developers.kaltura.org.**

This document introduces the Kaltura Application Programming Interface (API) and API architecture.

This document does not cover Kaltura API usage. To learn how to use the Kaltura API, refer to [Kaltura API Usage Guidelines][1].

 [1]: http://knowledge.kaltura.com/node/162

This document applies to Kaltura API version 3 and later.

## Before You Begin  

To access the Kaltura API, you'll need the following:

1. A Kaltura publisher account - To obtain a Kaltura account, start a [free trail](http://corp.kaltura.com/free-trial), [contact us](http://corp.kaltura.com/company/contact-us), or [download Kaltura CE<](http://www.kaltura.org/project/community_edition_video_platform).
2. Obtain your Kaltura API publisher credentials via the [KMC Integration Settings](http://www.kaltura.com/index.php/kmc/kmc4#account|integration).

## Understanding Kaltura API Architecture  

### Kaltura API Architecture Overview  

Kaltura is an open source video platform.For an overview of the architecture of the Kaltura platform, refer to [The Kaltura Platform Architecture Overview][2].

 [2]: http://knowledge.kaltura.com/kaltura-video-platform-architecture-overview

Kaltura provides server APIs for every core feature.

<p class="Note">
  <span class="mce-note-graphic">Kaltura server APIs also are referred to as Kaltura Partner Services.</span>
</p>

The Kaltura web services layer exposes Kaltura server APIs to web applications through a standard HTTP POST/GET URL encoded requests structure.

[Client libraries][3] implement the actual calls to the Kaltura server APIs.

 [3]: #Client_Libraries

Developers use the Kaltura API to incorporate Kaltura features in web applications and web sites.

The Kaltura API provides maximum flexibility by enabling developers to work with the lowest-level building blocks (atomic actions) for all Kaltura entities.

<p class="Sub-Heading mce-heading-3">
  <strong>Design Principles</strong>
</p>

The architecture of Kaltura server API follows [Representational State Transfer][4] (REST) principles.

 [4]: http://en.wikipedia.org/wiki/Representational_State_Transfer

<p class="mce-heading-3">
  <a name="ServiceActions"></a>Service Actions
</p>

The Kaltura API architecture consists of several service actions for:

*   Querying entities
*   Setting entities
*   Updating entities
*   Listing entities
*   Activating processes within the Kaltura platform

Service actions:

*   Are grouped according to the entity type that they apply to
*   Provide all actions relevant to the applicable entity

For more information on the structure of service actions, see [Service Action Structure][5].

 [5]: #Service_Action_Structure

<h2 class="mce-heading-2">
  Current API Version
</h2>

The current major version of the Kaltura API is API version 3 (api_v3).

Only API version 3 is updated continuously.

<p class="Note">
  <span class="mce-note-graphic">The Partner Services 2 API (referred to as PS2 and api_v2) is deprecated and is not being updated.</span>
</p>

<h2 class="mce-heading-2">
  <a name="Service_Action_Structure"></a>Service Action Structure
</h2>

<p class="Sub-Heading">
  The Kaltura API is represented by a list of different services, each of which includes several actions. See <a href="#ServiceActions">Service Actions</a>.
</p>

Services are grouped according to an applicable entity and include actions that are relevant to the entity.

<p class="mce-heading-3">
  Naming Convention
</p>

A service name is the same as the entity name.

Example: For an entity named *syndicationFeed*, there is a service named *syndicationFeed*.

<p class="mce-heading-3">
  <a name="ServiceActionsStandardandAdditional"></a>Standard and Additional Service Actions
</p>

A service usually includes the following standard actions:

*   CRUD actions:
    *   *create*
    *   *read*
    *   *update*
    *   *delete*
*   *list*

A service also includes additional actions that are relevant to the specific entry. An additional action may support an internal requirement.

Example: The *syndicationFeed* service comprises standard and additional actions that are relevant to the *syndicationFeed* entity. Some additional actions are required for internal integration.

*   *add*
*   *get*
*   *update*
*   *delete*
*   *list*
*   *getEntryCount*
*   *requestConversion*

<h2 class="mce-heading-2">
  API Development Approach
</h2>

Since Kaltura is an open source video platform*,* Kaltura development ensures that partners can use all features through the Kaltura API.

The Kaltura API enables access to Kaltura features by:

*   Kaltura’s built-in tools, such as:
    *   [Kaltura Contributor Wizard (KCW)][6]
    *   [Kaltura Dynamic Player (KDP)][7]
    *   [Kaltura Management Console (KMC)][8]

*   Applications that partners integrate with Kaltura features

 [6]: http://www.kaltura.org/kcw-contribution-wizard
 [7]: http://www.kaltura.org/kdp-3x-adobe-osmf-based-kaltura-dynamic-media-player
 [8]: http://www.kaltura.org/project/Kaltura_Management_Console

<p class="mce-heading-3">
  New Feature Development
</p>

To ensure full access to Kaltura features, API development is integral to every new feature.

When Kaltura develops a new object, the developer creates a new service to enable interacting with the new entity. See [Service Action Structure][5].

The new service includes standard actions, and any additional actions that the entity requires. Actions that Kaltura develops to support internal needs also are accessible by external applications. See [Standard and Additional Service Actions][9].

 [9]: #ServiceActionsStandardandAdditional

<p class="mce-heading-2">
  <a name="Client_Libraries"></a>Client Libraries
</p>

To enable easy integration with Kaltura’s open source video platform, Kaltura provides several API client libraries written in various programming languages.

The client libraries implement the actual calls to Kaltura server APIs.

The client libraries handle:

*   HTTP request creation
*   Queuing
*   Response processing

The client libraries provide specific classes that correspond to entities and data types used by Kaltura server APIs.

Kaltura API client libraries are available for commonly-used programming languages.

<p class="mce-heading-2">
  Object-Oriented Methodology
</p>

The Kaltura API design uses object-oriented methodology.

Examples include:

*   Logical structure of the API
    *   Each service represents an object in the system.
    *   Each object has methods.
    *   An action (in a service) is basically a method of an object.

*   Inheritances between objects: Some Kaltura entities extend more basic entities.

*   In the API, there is a service to the basic object and another service for the extending object.

*   In compliance with object-oriented methodology, an extending object can be used with the base service.

*   Kaltura client libraries (see [Client Libraries][3] and Kaltura API:  Kaltura API Usage Guidelines: Technical Guide)
*   Kaltura develops client libraries using an object-oriented methodology that reflects the API structure.
