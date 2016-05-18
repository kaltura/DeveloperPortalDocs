---
layout: page
title: Kaltura Video Insights
weight: 100
---

## Introduction to Kaltura Video Insights  
Kaltura Video Insights helps you get precise, actionable insights into various aspects of your business by answering a wide variety of questions, such as:

**User Behavior Questions:**
* How are my videos doing?
* Who is watching them?
* Where?
* On what devices?
* What is popular now?

**Operational Questions:**
* What is the quality of service my users are experiencing?
* Are there any glitches?
* How can I improve my quality of service?

**Budget Questions:**
* What is my system usage?
* Am I close to my allowance?
* How do I charge back for usage expenses?
* How do I optimize my budget?

## Events  
With Kaltura Video Insights you can collect, present and analyze data about system usage, viewing behavior, and any other type of user interaction with the Kaltura solution.

The data in Kaltura Video Insights can be divided into roughly two groups: Player events and other data.

As a video is played, the Kaltura Player sends Player events related to viewer behavior (such as “Plays”, “Played 25%”, “Stopped”, etc.) to Kaltura Video Insights. If you are using Kaltura Player versions 2.43 or higher, you will get the support for these Player event insights out-of-the-box. If you are using a non-Kaltura player, you need to make sure all of the relevant events are reported correctly using Kaltura Event Tracking API. 


## Dimensions  

Every player event is related to a specific video asset (a VOD or a live stream) and is triggered by a specific user. Every event has certain pre-defined characteristics (such as time, device, geography, etc.) that are called dimensions.

Let’s take a look at an example.
Suppose that at 1 pm EST a user in California clicked the “play” button on her iPhone device (the device has an IOS 9.1 installed on it) and begins to watch video asset #1234.
In this case the recorded event is “play” and the dimensions are:
Device: iPhone
OS: 9.1
Country: USA
State: California
Time: ….

You can read more about currently supported dimensions [here](https://vpaas.kaltura.com/documentation/08_Video-Analytics-and-Insights/DimensionsLexicon.html).

## Metrics  
These events provide a basis for measuring metrics, which are later presented in insights reports, accessible through the Data Retrieval API. Metrics refer to the data that Kaltura Video Insights measures, which are quantitative measurements. These measurements can assess user actions (such as user activities, plays, comments, drop offs, etc.) or resource consumption (such as bandwidth, storage, transcoding, etc.).
You can read more about the currently supported metrics [here](https://vpaas.kaltura.com/documentation/08_Video-Analytics-and-Insights/MetricsLexicon.html).

## Aggregations  

Metrics are stored and presented in an aggregated form. Aggregations are a way to store the huge amount of data in a summarized, pre-computed format that allows fast rendering of reports. The aggregations are designed with your business objectives in mind and anticipate questions you might ask. For example, Kaltura anticipates that you might ask the question “what are the most popular viewing devices in various states?”, so we created an aggregation of device X geography for the play requested metric.

You can read more about the currently supported Event Tracking API aggregations [here](https://vpaas.kaltura.com/documentation/08_Video-Analytics-and-Insights/EventTrackingAPI.html).

## About Insight Reports  
Each insight report is comprised of Dimensions, Metrics and Filters. Dimensions and Metrics are explained above. Filters determine how the data will be filtered. For example, instead of returning all user activity for a particular category, a report can return only data for a certain country.
 
## Suggested Reading  
* **[Kaltura API](http://www.kaltura.com/api_v3/testmeDoc/index.php?page=overview):** The Video Intelligence Data Retrieval API provides a simple but powerful tool to query data programmatically using the standards of the Kaltura API standards, such as authentication, client libraries, etc.
* **[Kaltura API Test Console Application](http://www.kaltura.com/api_v3/testme/index.php):** Another source of assistance in building your application is the Kaltura API Test Console Application. Note that the main service of the Video Insights Data Retrieval API is analytics and the action is **getData**.
* **[Media Analytics](https://vpaas.kaltura.com/documentation/08_Video-Analytics-and-Insights/media-analytics.html):** Details the existing Kaltura Analytics platform, which provides data about system usage.
* **[Dimensions Dictionary](https://vpaas.kaltura.com/documentation/08_Video-Analytics-and-Insights/DimensionsLexicon.html):** Details the dimensions and their meaning within the Kaltura Video Insights project.
* **[Metrics Dictionary](https://vpaas.kaltura.com/documentation/08_Video-Analytics-and-Insights/MetricsLexicon.html):** Features a list of the metrics and their meaning within the Kaltura Video Insights project.
* **[Player Events Guide/Event Tracking API](https://github.com/kaltura/DeveloperPortalDocs/blob/master/documentation/08_Video-Analytics-and-Insights/EventTrackingAPI.md):** Details the available Player events.
* **Supported Aggregations:** Details the aggregations implemented for the supported aggregations.
* **Event Tracking**
     * With the Kaltura Player
     * With a non-Kaltura Player
* **[Data Retrieval API](https://vpaas.kaltura.com/documentation/08_Video-Analytics-and-Insights/DataRetrievalAPI.html)**
