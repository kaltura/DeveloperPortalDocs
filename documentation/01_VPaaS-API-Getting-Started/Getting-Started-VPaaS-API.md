---
layout: page
title: Get Started with the Kaltura VPaaS API
weight: 102
---

At the most basic level, building video workflows and video experiences consists of ingesting and preparing media files, embedding player instances and playing the media, and finally collecting analytics regrading usage and engagement. But in between there is a world of neuances and needs that your unique use-case may require. Kaltura VPaaS API is built on the principles of atomic services allowing you full control and flexibility over every element and process in the life cycle of your media.   
The guides on this site, and the developer tools you'll find under resources will enable you to get a quick start and deep-dive into customizing your own video experience and workflow.  

Before you dive into the details, let's review the foundational building blocks, and learn how to build the most basic workflow. 

In this Getting Started guide, you will learn how to:

0. API Authentication (Creating a Kaltura Session)
1. Upload a video
2. Retrieve the video details
3. Update your video metadata
4. Create a player instance
5. Embed your video on a web page
6. Interact with the Player
7. Retrieve engagement analytics for your video

## Creating a Kaltura Session

The Kaltura API is [stateless](https://en.wikipedia.org/wiki/Stateless_protocol), that means that every request made to the Kaltura API requires an authenticated session string to be passed, the Kaltura Session (aka KS), identifies the Kaltura account and end-user on which the executed API action is to be carried, as well as other permissions and configurations such as the role of the user, time duration the session is good for and more.

> Read more about Kaltura Session, its algorithm, guidelines and options in the [Kaltura's API Authentication and Security article](https://knowledge.kaltura.com/node/229).

EMBED Recipe: https://developer.kaltura.com/recipes/authentication

## Uploading your media files

Media files are uploaded to Kaltura through [CORS enabled](https://www.w3.org/wiki/CORS_Enabled) REST API.  
You can implement an upload flow, either completely on your own by calling the API, or by using a Kaltura tested JavaScript widget for chunked upload through web pages. Which method you chose to implement depends on your application needs.

>  Side note: Kaltura manages all forms of media files including video, image, and audio files. It even provides APIs to host, deliver and process document files such as PDF and PPT files to create rich experiences such as synchronized side-by-side video and presentation slides.

### Upload files using JavaScript with jQuery Upload Widget

If your app is HTML5 based, you can implement a reliable and fault tolerant large-files upload with automatic pause-and-resume functionality by simply including and using the Kaltura Upload JavaScript widget.
The [Kaltura Upload JavaScript widget](https://github.com/kaltura/jQuery-File-Upload) provides a simple JavaScript library that abstracts the use of the Kaltura API, as well as handling of the files locally (such as file chunking, and pause-resume).

TODO: INCLUDE THE RECIPE SHOWING THE USE OF THE JQUERY WIDGET

### Upload files by calling the API directly

{% onebox https://developer.kaltura.com/recipes/upload/embed#/start %}

## Retrieving your Media Entry details

At the end of the upload flow you have created a KalturaMediaEntry object by calling the [media.add](https://developer.kaltura.com/api-docs/#/media.add) action, and then you've assigned the uploaded file to this media entry by calling the [media.addContent](https://developer.kaltura.com/api-docs/#/media.addContent) action.
