---
layout: page
title: Maintaining Backward Compatibility and Tracking Version Changes
weight: 105
---

Maintaining backward compatibility during API upgrades is a common concern for developers utilizing APIs to build applications. 

Kaltura's client libraries are automatically generated from the server code, that include an automatic client libraries' generator mechanism. See [Adding the New Kaltura API Client Library Generator](https://vpaas.kaltura.com/documentation/VPaaS-API-Getting-Started/Adding the New Kaltura API Client Library Generator.html) for more information. As a result, the Kaltura API client libraries are not available as a static code repository that you can track for changes.

To keep up to date with the changes between releases, follow the [Kaltura API Twitter account](https://twitter.com/Kaltura_API). 

For each Kaltura release, the Kaltura API Twitter account notifies followers about additions and changes made to the REST APIs, Players APIs, and changes to the Client Libraries, and release notes are provided about the new release.

Kaltura API based applications do not require frequent updates to the client library used. Kaltura is committed to provide full backward computability to the API layer, keeping deprecated APIs functional, and ensuring that additions or changes introduced in new versions will not break existing applications. 

When new functionalities for your applications are introduced, or when maintainance upgrades are made to your applications, we encourage you to keep your client libraries updated even though an upgrade based on the availability of new Kaltura releases is not required.
