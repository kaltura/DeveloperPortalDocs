---
layout: page
title: Picture-in-Picture (PIP) - iOS Plugin
---

This article describes how to use the iOS plugin for the PIP feature.

## How to Enable Background Modes
You can enable support for 'Audio, AirPlay and Picture in Picture' from the Background modes section of the Capabilities tab in your Xcode project.

![](https://developer.apple.com/library/ios/documentation/IDEs/Conceptual/AppDistributionGuide/Art/4_enablebackgroundmodes_2x.png)

## How to Attach the 'pipBtn' Plugin to your `Config` Instance
To attach the 'pipBtn' plugin to your `Config` instance:
```objective_c 
[config addConfigKey:@"pipBtn.plugin" withValue:@"true"];
```

**Note:** This feature is available from [Kaltura Player version 2.38](https://github.com/kaltura/mwEmbed/releases) and later.

{% extlink Kaltura Player version 2.3 https://github.com/kaltura/mwEmbed/releases %}
