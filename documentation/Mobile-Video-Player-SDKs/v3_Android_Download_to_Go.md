---
layout: page
title: Kaltura's Download to Go Suite for Android Devices
subcat: SDK 3.0 - Android
weight: 501
---

## Background and Motivation  

Kaltura’s **Download to Go** suite enables the end user to download on-demand content and store the content to a storage device so that he or she can watch the content when poor or no connectivity occurs. Following content download, the end user can watch downloaded media items offline, streamed locally from the end user’s device. This increased flexibility enables the end user to Watch content on-the-go without worrying about high data costs or lock of Internet connectivity.

### Supported Devices  

Download to Go’s offline mode works on all mobile and tablet devices supported by the Player SDK for the following operating systems:

* Android 4.3+

### Supported Video Formats  

Download to Go supports the following formats:

* HLS
* MPEG-DASH (Android only)

## Enabling Download to Go  

Download will only be available to users if the application has integrated the Download to Go (DTG) library. Download can be restricted by the application so that it is only available on certain assets and after purchase.

### System Validation Prior to Download  

Before download, the DTG library will verify that there is there enough quota space available for download of the requested item.

## Downloading Content  

When a media asset is downloaded, it is accompanied by additional parameters and metadata, including:

* Download URL
* DRM license (see *DRM*)
* Multiple audio files (see *Captions and Audio Tracks*) 
* Multiple subtitle files in available languages(see *Captions and Audio Tracks*) 
* Any one single bitrate, set by the application

### DRM  

Kaltura’s DTG library supports Widevine modular. 

* For Android 4.2.2 WV classic will be used.
* For DRM-encrypted items, the download process includes download of a persistent, local DRM license that enables online and offline playback according to the media asset’s purchase usage terms (e.g., purchase and license durations). The DRM license is tailored to the download stream and is managed by a local DRM agent. The DRM license is retrieved and updated only when the end user is online.

### Captions and Audio Tracks  

Captions and audio tracks can be downloaded along with the asset. The application can choose to download a single audio file or multiple files.

When downloading multiple files on Android, the application will be able to select languages to download (MPEG-DASH only). On iOS all languages will be downloaded automatically.

### Background Downloading  

Background downloading is supported on both iOS and Android devices.

## Interruptions to Downloading  

A number of issues may interrupt the download process: 
* Problems with wireless connectivity  
* Inadequate download space on the end user’s device 
* The end user closed the application during download 
* The end user switched between 3G and Wi-Fi settings during a download 

Corresponding error messages will be provided for each case and download will be paused until the application actively resumes download.

## Watching Downloaded Content  

Content previously downloaded with DTG is viewable in offline mode (without Internet connectivity). DTG will provide the application with a URL with captions, DRM, and audio tracks (if applicable).
The availability duration can be set by the application.

## Additional Information  

For more information, check out this article: https://kaltura.github.io/playkit-dtg-android/ 
