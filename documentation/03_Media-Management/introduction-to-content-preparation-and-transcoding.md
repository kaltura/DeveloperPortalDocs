---
layout: page
title: Intro to Content Preparation & Transcoding
weight: 302
---

* Kaltura's cloud transcoding microservices and tools are designed to manage encoding workflows at any scale and quality requirements - for the web, broadcast, studio, or secure internal enterprise applications. 
* Architected to handle any input type and file size over large volumes of jobs - converting any input format of uploaded video, audio, image and even documents into a variety of flavors (transcoded output renditions).
* Built to be deployed on any infrastructure - on premises or public cloud. 

>**Knowledge Article:** [Kaltura Media Transcoding Services and Technology](http://knowledge.kaltura.com/kaltura-media-transcoding-services-and-technology#transcoding)

### Ingest From Any Source -  Transcode For Any Target

New devices, cameras and input sources are introduced to the market every month - Kaltura Media Transcoding Services provide always up-to-date transcoding services that are optimized for the latest formats, codecs and standards.

#### Integrated Encoding Engines

The following lists the various tools and encoding engines currently integrated and orchestrated (see: Kaltura Decision Layer) in the Kaltura Media Transcoding Services:

* Common Video Encoding Engines: FFMPEG, Mencoder, VLC
* Proprietary Video Encoding/Encryption Engines: Microsoft Expression Encoder, QuickTimeTools, WebexNbrplayer, Widevine
* Video Segmentation and Delivery Optimization Engines: Mp4box, FastStart, Segmenter, ISM Index, ISM Manifest, SmilManifest, SmoothProtect 
* Image Conversion: ImageMagick
* Document Conversion: PPT 2 Image, PDF 2 SWF, PDF Creator
* Experimental Video Features: Third party encoders
* Deprecated or Legacy Video Encoders

### QuickStart
When a piece of content is uploaded or ingested into Kaltura, a Conversation Profile is applied. This profile specifics what renditions of the source content should be created. For example, the best practise for web delivery of video content requires a conversion profile that transcodes source video into H264 (at a minimum) renditions of different bitrates and dimensions.

To specify a conversion profile on uploaded or ingested content, use the [`conversionProfile service`](https://www.kaltura.com/api_v3/testmeDoc/index.php?service=conversionProfile). This service will also allow you to add, delete, update, get and list Conversion Profiles associated with entries.

Need to add:

Decision layer
Code recipes
conversionProfileAssetParams service
