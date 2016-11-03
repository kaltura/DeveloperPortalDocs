---
layout: page
title: iOS Disable Widevine
subcat: iOS
weight: 330
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article details the process of disabling Widevine on iOS.

`Core` - contains all source files, INCLUDING Widevine-related files.

`Widevine` - contains the Widevine library and a preprocessor macro WIDEVINE_ENABLED=1.

## How To Use
By defualt, the entire SDK is enabled.

### Entire SDK

To use the entire SDK, a client app has to use, as before:

```
pod 'KalturaPlayerSDK'
```

### Exclude Widevine

To exclude Widevine, only include the subspec Core:

```
pod 'KalturaPlayerSDK/Core'
```
