---
layout: page
title: Picture-in-Picture (PIP) - iOS Plugin
subcat: iOS
weight: 280
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article describes how to use the iOS plugin for the PIP feature.

## Enabling Background Modes  

To enable support for Audio, AirPlay and Picture-in-Picture (PIP):

Use the Background modes section of the Capabilities tab in your Xcode project.

![](https://developer.apple.com/library/ios/documentation/IDEs/Conceptual/AppDistributionGuide/Art/4_enablebackgroundmodes_2x.png)

## Attaching the 'pipBtn' Plugin to your `Config` Instance  

To attach the 'pipBtn' plugin to your `Config` instance:
```objective_c 
[config addConfigKey:@"pipBtn.plugin" withValue:@"true"];
```

> Note: This feature is available from [Kaltura Player version 2.38](https://github.com/kaltura/mwEmbed/releases) and later.
