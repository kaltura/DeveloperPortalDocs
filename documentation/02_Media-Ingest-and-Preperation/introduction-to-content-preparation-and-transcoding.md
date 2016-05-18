---
layout: page
title: Intro to Content Preparation & Transcoding
weight: 202
---

* Kaltura's cloud transcoding microservices and tools are designed to manage encoding workflows at any scale and quality requirements - for the web, broadcast, studio, or secure internal applications with sensitive content. 
* Architected to handle any file size over large volumes - converting any input format of uploaded video, audio, image and even documents into a variety of flavors (transcoded output renditions).
* Built to be deployed on any infrastructure - on premises or public cloud. 
* Kaltura's transcoding decision layer engine supports more than 60 video and image formats as well as 140 video and audio codecs.
* New devices, cameras and input sources are introduced to the market frequently - Kaltura Media Transcoding Services provide always up-to-date transcoding services that are optimized for the latest formats, codecs and standards.

### Media Ingestion APIs and Tools

The Kaltura VPaaS offers many ways for ingesting content; a file upload API, bulk files import using CSV or XML, MRSS ingest services, and various widgets you can integrate into your workflows or sites to allow user contributions and build custom upload interfaces.
Find the sutiable ingestion methologies for your workflow below:

* [The File Upload and Import REST APIs](https://developer.kaltura.com/recipes/upload)
	* [Web Upload in JavaScript/jQuery (with chunked parallel pause-resume support)](https://github.com/kaltura/chunked-file-upload-jquery)
	* [Upload in Java](https://github.com/kaltura/Sample-Kaltura-Chunked-Upload-Java)
* [Bulk Upload XML and CSV formats](https://vpaas.kaltura.com/documentation/02_Media-Ingest-and-Preperation/Bulk-Content-Ingestion)
* [Live Streaming and Webcam Recording](https://developer.kaltura.com/recipes/live_broadcast)
* [Drop Folders and Aspera](https://knowledge.kaltura.com/node/737)

## Conversion Profiles and Flavor Assets

In order to make your video accessible and play on any device, Kaltura provides robust API for media transcoding. When transcoding your video, you can control a wide range of parameters, including; output file type, bit-rate, GOP size (keyframe-frequency), frame-rate, frame dimensions, and much more. You can use Kaltura to prepare transcoded videos for optimized for playback, download, editing, broadcasting, archive and more.

Flavors are versions of an uploaded source video that was transcoded by Kaltura. You can generate multiple flavors per uploaded file, there is no limit to number of flavors you can define and use in Kaltura. Each flavor is a single output video file on its own. Flavors are represented in Kaltura by the [flavorAsset service](https://developer.kaltura.com/api-docs/#/flavorAsset).  
Review all the available parameters and options your can set for your transcoded flavors: [KalturaFlavorParams](https://developer.kaltura.com/api-docs/#/KalturaFlavorParams).

Your Kaltura account comes with a default set of flavors preconfigured to seamlessly support any device or browser your users are likely to use. You can chose to enable or disable any of them at any time. To add and configure new flavors to your account use the [flavorParams](http://developer.kaltura.com/api-docs/#/flavorParams) service.

The "source flavor", is the original file that was uploaded to Kaltura. The source flavor represents the highest quality available for that specific video entry. Normally you would store your source file in Kaltura in order to continue generate new flavors form it, cut thumbnails and more. It is also possible to delete the source flavor and mark any of the transcoded flavors as the new source by calling the [flavorAsset.setAsSource action](https://developer.kaltura.com/api-docs/#/flavorAsset.setAsSource).

When a video is uploaded to Kaltura, the video is associated with a [conversionProfile](https://developer.kaltura.com/api-docs/#/conversionProfile), also known as a Transcoding Profile. A Conversion Profile may be comprised of a single or multiple flavors. For each upload session, you can select the Conversion Profile you'd like apply with the uploaded videos. And you can also set a default Conversion Profile to be executed automatically when videos are uploaded to your account.  

### Default Account Conversion Porfiles 

There are three transcoding profiles that are automatically created for new accounts:
* Default - The flavors included in the default transcoding profile of the account. 
* Source Only - Does not execute transcoding for the uploaded file. 
* All Flavors - Transcodes uploaded files into all of the flavors defined in the account by default.

### Default Account Flavors 

There are 9 flavors that are defined automatically for every new account. These flavors are optimized for delivery of video across all devices and browsers to ensure you can reach your users on any device they use without having to manually configure flavors yourself.  

The default flavors:

| Id     	| Name                             	| Description                                 	|
|--------	|----------------------------------	|---------------------------------------------	|
| 0      	| Source                           	| The original file that was uploaded         	|
| 301991 	| Mobile (3GP)                     	| Support Nokia and Blackberry legacy devices 	|
| 487041 	| Basic/Small - WEB/MBL (H264/400) 	| Optimized mp4 - modern devices - lowres     	|
| 487051 	| Basic/Small - WEB/MBL (H264/600) 	| Optimized mp4 - modern devices - lowres     	|
| 487061 	| SD/Small - WEB/MBL (H264/900)    	| Optimized mp4 - modern devices - standard   	|
| 487071 	| SD/Large - WEB/MBL (H264/1500)   	| Optimized mp4 - modern devices - 720p       	|
| 487081 	| HD/720 - WEB (H264/2500)         	| Optimized mp4 - modern devices - 720p       	|
| 487091 	| HD/1080 - WEB (H264/4000)        	| Optimized mp4 - modern devices - 1080p      	|
| 487111 	| WebM                             	| For devices not supporting h264             	|


> Read more: [Kaltura Media Transcoding Services and Technology](http://knowledge.kaltura.com/kaltura-media-transcoding-services-and-technology#transcoding)
