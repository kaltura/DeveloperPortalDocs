---
layout: page
title: Troubelshooting Android Player Issues
subcat: SDK 2.0 - Android
weight: 501
---

This article provides troubleshooting solutions for common Android Player issues.

## Android: Device Info  

Use the Kaltura Device Info application to generate a report of device capabilities with regards to media playback and DRM.
Get the app here: [Google Play](https://play.google.com/store/apps/details?id=com.kaltura.kalturadeviceinfo) | [source](https://github.com/kaltura/kaltura-device-info-android).

Install and execute the application. After receiving the report (in JSON format), tap the share button to share the report with Kaltura (preferably via email).

### Android: ExoPlayer Demo  

Another way to diagnose DRM and playback issues on Android is by using the ExoPlayer Demo app. This app is provided in source by Google, and it allows playing some Google-provided streams.
We have built a version of the app, [available as an APK](https://dl.dropboxusercontent.com/u/125871244/apps/testapps/drm/exoplayer/exoplayer-demo-v1.5.7.apk).

Install and execute the application, then run all tests in the "Widevine DASH Policy Tests" section. Keep note of the passing and failing tests.

> Note: **Don't** expect all tests to pass, as some require specialized hardware and security features.
