---
layout: page
title: PIP (Picture-in-Picture) - iOS Plugin
---

# PIP (Picture-in-Picture) - iOS Plugin 

## How to Enable Background modes?
Enable support for 'Audio, AirPlay and Picture in Picture' from the Background modes section of the Capabilities tab in your Xcode project.

![](https://developer.apple.com/library/ios/documentation/IDEs/Conceptual/AppDistributionGuide/Art/4_enablebackgroundmodes_2x.png)

## How to Attach 'pipBtn' Plugin to your `Config` instance?

```objective_c 
[config addConfigKey:@"pipBtn.plugin" withValue:@"true"];
```


### This feature is available from [v2.38 - Kaltura Player](https://github.com/kaltura/mwEmbed/releases)