---
layout: page
title: iOS Disable Widevine
subcat: SDK Version 2.0
subcat: iOS
weight: 330
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article details the process of disabling Widevine on iOS:

* `Core` - Contains all source files, **including** Widevine-related files.
* `Widevine` - Contains the Widevine library and a preprocessor macro WIDEVINE_ENABLED=1.

## How to Use  

By default, the entire SDK is enabled.

### Entire SDK  

To use the entire SDK, the client app must use the following:

```
pod 'KalturaPlayerSDK'
```

### Exclude Widevine

To exclude Widevine, only include the subspec Core:

```
pod 'KalturaPlayerSDK/Core'
```
