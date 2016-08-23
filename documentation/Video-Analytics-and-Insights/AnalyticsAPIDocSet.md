---
layout: page
title: Introduction to Kaltura Video Insights
weight: 101
subcat: Limited-Alpha
---

*Described below is Kaltura's new analytics platform.*
*It is available by request, as it is currently released as an Early Preview.*
*Please write to maya.schnaidman@kaltura.com to request activation.*

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
With Kaltura Video Insights you can collect, present and analyze data about system usage, viewing behavior, and any other type of Kaltura solution user interaction.

The data in Kaltura Video Insights can be divided into roughly two groups - **Player events** and **other data**.

When a video is played, the Kaltura Player sends Player events that are related to the viewer's behavior, such as “Plays”, “Played 25%”, “Stopped”, etc., to Kaltura Video Insights. If you are using Kaltura Player versions 2.43 or higher, you will get the support for these Player event insights out-of-the-box. However, if you are using a non-Kaltura player, you need to make sure all of the relevant events are reported correctly using the [Event Tracking API](https://vpaas.kaltura.com/documentation/08_Video-Analytics-and-Insights/EventTrackingAPI.html).


## Dimensions  

Every Player event is related to a specific video asset (VOD or live stream) and is triggered by a specific user. Every event has certain pre-defined characteristics (such as time, device, geography, etc.), called *dimensions*.

### Example  
Let’s take a look at an example: Suppose that at 1 pm on the 1st of February, a user in NY clicks the “play” button on her iPhone device (the device has an IOS 9.1 installed on it) and begins to watch video asset #1234.
In this case the recorded event is “play” and the dimensions are:
* Device: iPhone
* OS: 9.1
* Country: USA
* State: NY
* Time: 02/01/2016 13:00
* Offset(from UTC): -240

To learn more about supported dimensions, we recommend reading the [Dimensions Dictionary](https://vpaas.kaltura.com/documentation/08_Video-Analytics-and-Insights/DimensionsLexicon.html).

## Metrics  
These events provide a basis for creating metrics, which are later presented in insights reports. Metrics refer to the data that Kaltura Video Insights collects, which are quantitative measurements. These measurements can assess user actions (such as user activities, plays, comments, drop offs, etc.), resource consumption (such as bandwidth, storage, transcoding, etc.) or quality of experience characteristics (such as buffering time, average bitrate etc'). The collected and aggregated data is accessible through the Data Retrieval API. Some of these metrics will become available in the upcoming versions. As the Video Insights Platform is being developed, more and more metrics are supported.

To learn more about supported metrics, we recommend reading the [Metrics Dictionary](https://vpaas.kaltura.com/documentation/08_Video-Analytics-and-Insights/MetricsLexicon.html).

## Aggregations  

Metrics are stored and presented in an aggregated form. Aggregations are a way to store the huge amount of data in a summarized, pre-computed format that allows fast rendering of reports. The aggregations are designed with your business objectives in mind and anticipate questions you might ask. For example, Kaltura anticipates that you might ask the question “what are the most popular viewing devices in various states?”, so we created an aggregation of the Device dimension and the Geography dimension for the "playRequested" metric.


## About Insight Reports  
Each insight report is comprised of Dimensions, Metrics and Filters. Dimensions and Metrics are explained above. Filters determine how the data will be filtered. For example, instead of returning all user activity for a particular category, a report can return only data for a certain country.
 
## Suggested Reading  
* **[Kaltura API](http://www.kaltura.com/api_v3/testmeDoc/index.php?page=overview):** The Video Insights Data Retrieval API provides a simple but powerful tool to query data programmatically using the Kaltura API standards, such as authentication, client libraries, etc.
* **[Kaltura API Test Console Application](http://www.kaltura.com/api_v3/testme/index.php):** Another source of assistance in building your application is the Kaltura API Test Console Application. Note that the main service of the Video Insights Data Retrieval API is analytics and the action is **query**.
* **[Media Analytics](https://vpaas.kaltura.com/documentation/08_Video-Analytics-and-Insights/media-analytics.html):** Provides details about the existing Kaltura Analytics platform that is used to provide data about system usage.
* **[Dimensions Dictionary](https://vpaas.kaltura.com/documentation/08_Video-Analytics-and-Insights/DimensionsLexicon.html):** Provides details about the the analytics dimensions and how to use them in the Kaltura Video Insights Platform.
* **[Metrics Dictionary](https://vpaas.kaltura.com/documentation/08_Video-Analytics-and-Insights/MetricsLexicon.html):** Provides details about the the analytics metrics and how to use them in the Kaltura Video Insights Platform.
* **[Player Events Guide/Event Tracking API](https://vpaas.kaltura.com/documentation/08_Video-Analytics-and-Insights/EventTrackingAPI.html):** Explains how to use the Event Tracking API to obtain information about available Player events.
* **[Data Retrieval API](https://vpaas.kaltura.com/documentation/08_Video-Analytics-and-Insights/DataRetrievalAPI.html)**: Explains how to use the Data Retrieval API.
